<?php

namespace App\Http\Controllers\Panel\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Forget;
use App\Models\Admin;
use App\Models\ResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{

    public function index()
    {
        if (auth()->check()) {
            return redirect()->route("panel.main");
        }
        return view("panel.auth.login");
    }
    public function forget()
    {
        return view("panel.auth.forget");
    }
    public function resetPassword($token)
    {
        $req = ResetToken::where("token", $token)->firstOrFail();
        if (time() > $req->expiration) {
            $msg = "درخواست شما منقضی شده است دوباره تلاش کنید";
            return view("panel.auth.forget-res", compact("msg"));
        }
        $req->user()->update(["password" => Hash::make($req->password)]);

        $msg = "رمز عبور با موفقیت تغییر یافت";
        return view("panel.auth.forget-res", compact("msg"));
    }


    function forget_attemp(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|digits:6",
            "password_confirm" => "required|same:password",
        ], [
            "email.email" => "ایمیل وارد شده معتبر نیست",
            "password_confirm.same" => "رمزعبور با تکرار آن مطابقت ندارد",
            "password.digits" => "رمزعبور حداقل 6 حرفی باشد",
        ]);
        $user = User::where("email", strtolower($request->email))->first();
        if (!$user) {
            return redirect()->back()->withError("این ایمیل در سیستم موجود نیست");
        }
        $user->token()->delete();
        $token = md5(time() . $user->id);
        $user->token()->create(["token" => $token, "expiration" => time() + 86400, "password" => $request->password]);
        $link = env("APP_URL") . "forget/" . $token;
       
        Mail::to($user->email)->send(new Forget($user, $link));

        return redirect()->back()->withSuccess("لطفا ایمیل خود را چک کنید");
    }
    public function loginAttemp(Request $request)
    {

        $this->validator($request);
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->merge([
            $fieldType => $request->username,
            "enable" => 1
        ]);

        if (Auth::attempt($request->only($fieldType, 'password', 'enable'))) {
            return redirect()
                ->route('panel.main')
                ->withSuccess("با موفقیت وارد شدید");
        }


        return redirect()->back()->withError("اطلاعات ورود صحیح نیست");
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('login')->with('success', "با موفقیت خارج شدید");
    }
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '-' . time() . '.' . $extension;

            $image = Image::make($request->file('upload'))->orientate()->resize(800, null, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode($extension, 75);

            File::put('uploads/' . $filenametostore, (string) $image);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/' . $filenametostore);
            $msg = 'تصویر با موفقیت آپلود شد.';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        //validate the request.
        $request->validate($rules, [
            "username.required" => "نام کاربری الزامی می باشد",
            "password.required" => "رمزعبور الزامی می باشد",
        ]);
    }
}
