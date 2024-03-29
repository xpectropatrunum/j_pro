<?php

namespace App\Http\Controllers\Admin;

use App\Controllers\Admin\Excel\LettersExcel;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Admin\Excel\LettersExcel as ExcelLettersExcel;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\Controller;
use App\Models\DoctorSpecialty;
use App\Models\Letter;
use App\Models\LetterSubject;
use App\Models\LetterSubjects;
use App\Models\Project;
use App\Models\SupervisorUser;
use App\Models\User;
use Illuminate\Http\Request;


class LetterController extends Controller
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
            $query = Letter::latest();
            
        } else {
            $query = Letter::latest("letters.created_at");

            $query =  $query
                ->join('users', 'letters.user_id', '=', 'users.id')
                ->join('supervisor_user', 'users.id', '=', 'supervisor_user.user_id')
                ->where('supervisor_user.supervisor_id', '=', auth()->user()->id)
                ->select(
                    '*',
                    'letters.id as letter_id',
                );


            }
        if ($date = $request->date) {
            $query->where("date", $request->date);
        }
        if ($user = $request->user) {
            $query->where("letters.user_id", $request->user);
        }
        if ($title = $request->title) {
            $query->whereHas("letter_subject", function($query) use($title ){
                 $query->where("title", "LIKE", "%$title%");
            });
        }
        if ($number = $request->number) {
            $query->where("letters.number", $request->number);
        }
        if ($company = $request->company) {
            $query->where("project_id", $request->company);

        }
        if ($request->limit) {
            $limit = $request->limit;
        }

        $items = $query->orderBy("letters.created_at")->paginate($limit);



        return view('admin.pages.letters.index', compact('items', 'search', 'limit', 'user', 'date', 'company', 'title', 'number'));
    }
    public function excel(Request $request)
    {

        $search = "";


        if (auth()->user()->hasRole("supervisor")) {
            $query = Letter::query();

            $query =  $query
                ->join('users', 'letters.user_id', '=', 'users.id')
                ->join('supervisor_user', 'users.id', '=', 'supervisor_user.user_id')
                ->where('supervisor_user.supervisor_id', '=', auth()->user()->id);
        } else {
            $query = Letter::latest();
        }


        if ($date = $request->date) {
            $query->where("date", $request->date);
        }
        if ($user = $request->user) {
            $query->where("letters.user_id", $request->user);
        }
        if ($title = $request->title) {
            $query->whereHas("letter_subject", function($query) use($title ){
                 $query->where("title", "LIKE", "%$title%");
            });
        }
        if ($number = $request->number) {
            $query->where("letters.number", $request->number);
        }
        if ($company = $request->company) {
            $query->where("project_id", $request->company);

        }

        $items = $query->orderBy("letters.created_at");
        $time = time();
     

        return Excel::download(new ExcelLettersExcel($items->get()), "letters_{$time}.xlsx");

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
    public function destroy(Letter $letter)
    {
        if ($letter->delete()) {
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
