<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PanelController extends Controller
{

    public function index()
    {
        return view("panel.log");
    }
    public function work()
    {
        return view("panel.work");
    }
    public function off()
    {
        return view("panel.off");
    }
    public function leave()
    {
        return view("panel.leave");
    }
    function haversineGreatCircleDistance(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo,
        $earthRadius = 6371000
    ) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
    public function log_submit(Request $request)
    {
        $request->validate([
            "lat" => "required",
            "lng" => "required",
            "project" => "required",
        ], [
            "lat.required" => "موقعیت مکانی ارسال نشده است",
            "lng.required" => "موقعیت مکانی ارسال نشده است",
        ]);
        if (!$request->time) {
            $request->merge([
                "time" => date("H:i")
            ]);
        }

        $project = auth()->user()->supervisor()->first()->projects()->findOrFail($request->project);

        $distance = ($this->haversineGreatCircleDistance($project->x, $project->y, $request->lat, $request->lng));

        if ($distance > $project->area) {
            return redirect()->back()->withError("شما در محدوده مجاز پروژه قرار ندارید");
        }
        $have_log = auth()->user()->logs()->where(["date" => date("Y-m-d")])->latest()->first();
        if ($have_log) {
            //  return redirect()->back()->withError("یک مورد ورود ثبت شده");
        }
        $log = auth()->user()->logs()->create(
            [
                "project_id" => $request->project,
                "date" => date("Y-m-d"),
                "time" => $request->time,
            ]
        );

        if ($log) {
            return redirect()->route("panel.work")->withSuccess("ورود موفقیت آمیز به شرکت " . $project->name)->with("icon", "login");
        }
        return redirect()->back()->withError("خطایی رخ داده بعدا تلاش کنید");
    }
    public function submit_leave(Request $request)
    {
        $request->merge([
            "fee" => str_replace(",", "", $request->fee)
        ]);
        $request->validate([
            "note" => "required",
        ], [
            "note.required" => "گزارش کار ضروری می باشد",
        ]);

        if($request->fee && !is_numeric($request->fee)){
            return redirect()->back()->withError("هزینه ایاب ذهاب معتبر نمی باشد");

        }

        $log = auth()->user()->logs()->where(["date" => date("Y-m-d")])->latest()->firstOrFail();
        $project = $log->project;

        $distance = ($this->haversineGreatCircleDistance($project->x, $project->y, $request->lat, $request->lng));

        if ($distance > $project->area) {
            return redirect()->back()->withError("شما در محدوده مجاز پروژه قرار ندارید");
        }


        $leave =  $log->leave()->create($request->all());


        if ($leave) {
            return redirect()->route("panel.main")->withSuccess("پایان کار با موفقیت ثبت شد");
        }
        return redirect()->back()->withError("خطایی رخ داده بعدا تلاش کنید");
    }
    public function submit_letter(Request $request)
    {

        $request->validate([
            "date" => "required",
            "title" => "required",
        ], [
            "title.required" => "عنوان نامه ضروری می باشد",
            "date.required" => "تاریخ نامه ضروری می باشد",
        ]);
        $number = (auth()->user()->supervisor()->first()->super_letters()->latest()->first()?->number ?? (
            auth()->user()->supervisor()->first()->setting->letter_start_from ?? 10000
            )) + 1;
        $log = auth()->user()->logs()->where(["date" => date("Y-m-d")])->latest()->firstOrFail();

        $letter = auth()->user()->letters()->create(
            [
                "letter_subject_id" => $request->title,
                "supervisor_id" => auth()->user()->supervisor()->first()->id,
                "project_id" => $log->project_id,
                "date" => MyHelper::fa_to_en($request->date),
                "number" => $number,
            ]
        );

        if ($letter) {
            return redirect()->route("panel.work")->withSuccess("شماره نامه: " . $letter->number);
        }
        return redirect()->back()->withError("خطایی رخ داده بعدا تلاش کنید");
    }
    public function submit_off(Request $request)
    {

        $request->validate([
            "date" => "required",
        ], [
            "date.required" => "تاریخ ضروری می باشد",
        ]);

        $request->merge([
            "date" => MyHelper::fa_to_en($request->date)
        ]);

        $off = auth()->user()->offs()->create($request->all());

        if ($off) {
            return redirect()->route("panel.off")->withSuccess("مرخصی با موفقیت ثبت شد");
        }
        return redirect()->back()->withError("خطایی رخ داده بعدا تلاش کنید");
    }
}
