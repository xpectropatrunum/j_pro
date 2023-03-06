<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AltField;
use App\Models\Country;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.settings.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'letter_start_from' => 'required|integer',
            'end_time' => 'required'
        ]);

        Setting::updateOrCreate(["user_id" => auth()->user()->id], $request->except("_token"));

        return back()->with('success', 'New changes successfully saved');
    }
}
