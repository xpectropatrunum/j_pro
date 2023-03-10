<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ApiHelper;
use App\Helpers\MyHelper;
use App\Http\Controllers\Admin\Excel\UserStats;
use App\Http\Controllers\Controller;
use App\Models\DoctorSpecialty;
use App\Models\SupervisorUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = "";
        $limit = 10;

        $query = User::latest();

        if ($request->search) {
            $searching_for = $request->search;
            $search = $request->search;
            $query->where("id", $search)
                ->orWhere("name", "like", "%$search%")
                ->orWhere("username", "like", "%$search%")
                ->orWhere("email", "like", "%$search%");
        }

        if ($request->limit) {
            $limit = $request->limit;
        }

        $items = $query->paginate($limit);



        return view('admin.pages.users.index', compact('items', 'search', 'limit'));
    }
    function statsExcel(User $user){


        $dates = MyHelper::dateOfMonths();

        $times = 0;
        foreach ($dates as $date) {
            $logs = $user
                ->logs()
                ->where(\DB::raw('UNIX_TIMESTAMP(date)'), $date->unix)
                ->get();

            foreach ($logs as $log) {
                $times += $log->duration_in_seconds;
            }
        }


        $time = time();
        return Excel::download(new UserStats($dates, $user, $times), "user_stats_{$time}.xlsx");

    
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supervisors = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'supervisor');
            }
        )->get();
        return view("admin.pages.users.create", compact("supervisors"));
    }
    public function getStats(User $user)
    {
        $dates = MyHelper::dateOfMonths();

        $times = 0;
        foreach ($dates as $date) {
            $logs = $user
                ->logs()
                ->where(\DB::raw('UNIX_TIMESTAMP(date)'), $date->unix)
                ->get();

            foreach ($logs as $log) {
                $times += $log->duration_in_seconds;
            }
        }

        return view("admin.pages.users.stats", compact("dates", "user", "times"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            "email" => strtolower($request->email),
        ]);
        $request->validate([
            "email" => "required|email|unique:users,email",
            "phone" => "required|unique:users,phone",
            "username" => "required|unique:users,username",
            "name" => "required",
            "password" => "required",
            "system_id" => "required|unique:users,system_id",
        ]);

        if ($request->password) {
            $request->validate([
                "password_confirm" => "same:password",
            ]);
            $request->merge([
                "password" => Hash::make($request->password),
            ]);
        }

        if (!$request->remotable) {
            $request->merge([
                "remotable" => 0,
            ]);
        }
        if ($user = User::create($request->all())) {

            foreach ($request->roles ?? [] as $role) {
                $role = Role::find($role);
                $user->assignRole($role);
            }
            if (is_numeric($request->supervisor)) {
                SupervisorUser::create(["user_id" => $user->id,  "supervisor_id" => $request->supervisor]);
            }
            return redirect()->route("admin.users.index")->withSuccess("The item successfully created");
        }
        return redirect()->back()->withError("Something went wrong");
    }
    public function update(User $user, Request $request)
    {
        $request->merge([
            "email" => strtolower($request->email),
        ]);
        $request->validate([
            "email" => "required|email|unique:users,email," . $user->id,
            "phone" => "required|unique:users,phone," . $user->id,
            "username" => "required|unique:users,username," . $user->id,
            "name" => "required",
            "system_id" => "required|unique:users,system_id," . $user->id,

        ]);

        if ($request->password) {
            $request->validate([
                "password_confirm" => "same:password",
            ]);
            $request->merge([
                "password" => Hash::make($request->password),
            ]);
        } else {
            $request->merge([
                "password" => Hash::make($user->password),
            ]);
        }
        if (!$request->remotable) {
            $request->merge([
                "remotable" => 0,
            ]);
        }
        if ($user->update($request->all())) {
            $user->roles()->detach();
            foreach ($request->roles ?? [] as $role) {
                $role = Role::find($role);
                $user->assignRole($role);
            }
            if (is_numeric($request->supervisor)) {
                SupervisorUser::updateOrCreate(["user_id" => $user->id], ["supervisor_id" => $request->supervisor]);
            }
            return redirect()->back()->withSuccess("The item successfully updated");
        }
        return redirect()->back()->withError("Something went wrong");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DoctorSpecialty  $tvTemp
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DoctorSpecialty  $DoctorSpecialty
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $supervisors = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'supervisor');
            }
        )->get();
        return view('admin.pages.users.edit', compact('user', 'supervisors'));
    }
    public function destroy(User $user)
    {
        $user->leaves()->delete();
        $user->letters()->delete();
        $user->offs()->delete();
        $user->logs()->delete();
        if ($user->delete()) {
            return redirect()->back()->withSuccess("The item successfully deleted");
        }
        return redirect()->back()->withError("Something went wrong");
    }

    function changeStatus(Request $request, User $user)
    {
        $request->validate([
            "enable" => "required"
        ]);
        $user->update($request->all());
        return 1;
    }
}
