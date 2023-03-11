<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\MyHelper;
use App\Helpers\Shamsi;
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
        if (!auth()->user()->remotable) {
            $request->validate([
                "lat" => "required",
                "lng" => "required",
                "project" => "required",
            ], [
                "lat.required" => "موقعیت مکانی ارسال نشده است",
                "lng.required" => "موقعیت مکانی ارسال نشده است",
            ]);
        } else {
            $request->validate([
                "project" => "required",
            ]);
        }

        if (!$request->time) {

            $request->merge([
                "time" => date("H:i")
            ]);
        } else {
            $manual_count = auth()->user()->manual_logs()->where("month_number", (new Shamsi)->jMonthNumber())->count();

            if ($manual_count < env("MAX_MANUAL_COUNT")) {
                auth()->user()->manual_logs()->create(["month_number" => (new Shamsi)->jMonthNumber()]);
            } else {
                return redirect()->back()->withError("شما از تایم دستی در این ماه استفاده کردید");
            }
        }
        $project = auth()->user()->supervisor()->first()->projects()->where("status", 0)->findOrFail($request->project);

        if (!auth()->user()->remotable) {
            $match = 0;
            foreach (auth()->user()->supervisor()->first()->projects()->where("status", 0)->get()  as $item) {
                $distance = ($this->haversineGreatCircleDistance($item->x, $item->y, $request->lat, $request->lng));



                if ($distance <= $item->area) {
                    $match = 1;
                    break;
                }
            }
            if ($match == 0) {
                return redirect()->back()->withError("شما در محدوده مجاز هیچ یک از پروژه ها قرار ندارید");
            }
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
            return redirect()->route("panel.work")->withSuccess("ورود موفقیت آمیز به شرکت " . $project->company_name)->with("icon", "login");
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

        if (!auth()->user()->remotable) {
            $request->validate([
                "lat" => "required",
                "lng" => "required",
            ], [
                "lat.required" => "موقعیت مکانی ارسال نشده است",
                "lng.required" => "موقعیت مکانی ارسال نشده است",
            ]);
        }

        if ($request->fee && !is_numeric($request->fee)) {
            return redirect()->back()->withError("هزینه ایاب ذهاب معتبر نمی باشد");
        }



        $log = auth()->user()->logs()->where(["date" => date("Y-m-d")])->latest()->firstOrFail();
        $project = $log->project;


        if (!auth()->user()->remotable) {
            $match = 0;
            foreach (auth()->user()->supervisor()->first()->projects()->where("status", 0)->get()  as $item) {
                $distance = ($this->haversineGreatCircleDistance($item->x, $item->y, $request->lat, $request->lng));



                if ($distance <= $item->area) {
                    $match = 1;
                    break;
                }
            }
            if ($match == 0) {
                return redirect()->back()->withError("شما در محدوده مجاز هیچ یک از پروژه ها قرار ندارید");
            }
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
        $number = (auth()->user()->supervisor()->first()->super_letters()->latest()->first()?->number ?? (auth()->user()->supervisor()->first()->setting->letter_start_from ?? 10000
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
