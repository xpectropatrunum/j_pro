<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Models\DoctorSpecialty;
use App\Models\Letter;
use App\Models\LetterSubject;
use App\Models\LetterSubjects;
use App\Models\Off;
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

class OffController extends Controller
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


            $query = Off::latest();
    


        if ($request->search) {
            $searching_for = $request->search;
            $search = $request->search;
  
        }

        if ($request->limit) {
            $limit = $request->limit;
        }

        $items = $query->orderBy("offs.id", "desc")->paginate($limit);



        return view('admin.pages.offs.index', compact('items', 'search', 'limit'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole("supervisor")) {
            return view("admin.pages.letter_subjects.create");
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
            "title" => "required",
        ]);



        $request->merge([
            "enable" => 1
        ]);

        if (auth()->user()->letter_subjects()->create($request->all())) {
            return redirect()->route("admin.letter_subjects.index")->withSuccess("The item successfully created");
        }
        return redirect()->back()->withError("Something went wrong");
    }
    public function update(LetterSubject $letterSubject, Request $request)
    {
        $request->validate([
            "title" => "required",
        ]);




        if ($letterSubject->update($request->all())) {
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
    public function edit(LetterSubject $letterSubject)
    {
        return view('admin.pages.letter_subjects.edit', compact('letterSubject'));
    }
    public function destroy(Off $off)
    {
        if ($off->delete()) {
            return redirect()->back()->withSuccess("The item successfully deleted");
        }
        return redirect()->back()->withError("Something went wrong");
    }
    function changeStatus(Request $request, LetterSubject $letterSubject)
    {
        $request->validate([
            "enable" => "required"
        ]);
        $letterSubject->update($request->all());
        return 1;
    }
}
