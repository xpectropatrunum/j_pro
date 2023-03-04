<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Models\DoctorSpecialty;
use App\Models\Project;
use App\Models\SupervisorUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class ProjectController extends Controller
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
        if (auth()->user()->hasRole("admin")) {
            $query = Project::latest();
        } else {
            $query = auth()->user()->projects()->latest();
        }


        if ($request->search) {
            $searching_for = $request->search;
            $search = $request->search;
            $query->where("name", "LIKE", "%$search%");
        }

        if ($request->limit) {
            $limit = $request->limit;
        }

        $items = $query->paginate($limit);



        return view('admin.pages.projects.index', compact('items', 'search', 'limit'));
    }

    public function detail(Request $request, Project $project)
    {

        $search = "";
        $limit = 10;
        $query = $project;
        $items = $project->logs()->paginate($limit);





        return view('admin.pages.projects.detail', compact('items', 'query', 'search', 'limit', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole("supervisor")) {
            return view("admin.pages.projects.create");
        }
        return redirect()->back()->withError("You are not supervisor");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            "name" => "required",
            "company_name" => "required",
            "area" => "required",
            "x" => "required",
            "y" => "required",
        ]);



        if (auth()->user()->projects()->create($request->all())) {
            return redirect()->route("admin.projects.index")->withSuccess("The project successfully created");
        }
        return redirect()->back()->withError("Something went wrong");
    }
    public function update(Project $project, Request $request)
    {

        $request->validate([
            "name" => "required",
            "area" => "required",
            "x" => "required",
            "company_name" => "required",
            "y" => "required",
        ]);



        if ($project->update($request->all())) {
            return redirect()->back()->withSuccess("The project successfully updated");
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
    public function edit(Project $project)
    {
        return view('admin.pages.projects.edit', compact('project'));
    }
    public function destroy(Project $project)
    {
        if ($project->delete()) {
            return redirect()->back()->withSuccess("The user successfully deleted");
        }
        return redirect()->back()->withError("Something went wrong");
    }
}
