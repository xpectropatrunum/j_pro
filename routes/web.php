<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BlockedUserController;
use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\Admin\LetterSubjectController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\OffController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Panel\Auth\LoginController as AuthLoginController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//URL::forceScheme('https');
Route::get('forget', [AuthLoginController::class, 'forget'])->name("forget");
Route::get('forget/{token}', [AuthLoginController::class, 'resetPassword'])->name("forget.reset");
Route::post('forget', [AuthLoginController::class, 'forget_attemp'])->name("forget.attemp");
Route::get('login', [AuthLoginController::class, 'index'])->name("login");
Route::get('/', [AuthLoginController::class, 'index'])->name("login");
Route::post('login/attemp', [AuthLoginController::class, 'loginAttemp'])->name("login.attemp");

Route::name("panel.")->group(function () {
    Route::get('logout', [AuthLoginController::class, 'logout'])->name("logout");

    Route::group(['middleware' => ['auth']], function () {
        Route::get('panel', [PanelController::class, 'index'])->name("main")->middleware('log_checker');
        Route::post('submit', [PanelController::class, 'log_submit'])->name("log_submit");
        Route::post('letter/submit', [PanelController::class, 'submit_letter'])->name("submit_letter");
        Route::post('off/submit', [PanelController::class, 'submit_off'])->name("submit_off");
        Route::post('leave/submit', [PanelController::class, 'submit_leave'])->name("submit_leave");
        
        Route::get('off', [PanelController::class, 'off'])->name("off");
        Route::get('leave', [PanelController::class, 'leave'])->name("leave")->middleware('log_checker');
        Route::get('work', [PanelController::class, 'work'])->name("work")->middleware('log_checker');
    });
});



Route::prefix("admin")->name("admin.")->group(function () {
    Route::post('/upload-image', [LoginController::class, 'uploadImage'])->name('upload_image');
    Route::get('login', [LoginController::class, 'index'])->name("login");
    Route::post('logout', [LoginController::class, 'logout'])->name("logout");
    Route::post('login/attemp', [LoginController::class, 'loginAttemp'])->name("login.attemp");
    Route::group(['middleware' => ['auth', 'permission']], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name("dashboard");

        Route::resource('users', UserController::class);
        Route::post('users/{user}/status', [UserController::class, "changeStatus"])->name("users.status");

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
        Route::resource('projects', ProjectController::class);
        Route::get('projects/detail/{project}', [ProjectController::class, "detail"])->name("projects.detail");

        Route::resource('letter_subjects', LetterSubjectController::class);
        Route::get('letters/excel', [LetterController::class, "excel"])->name("letters.excel");

        Route::resource('letters', LetterController::class);
        Route::resource('settings', SettingController::class);
        Route::resource('offs', OffController::class);
        Route::resource('logs', LogController::class);
        Route::resource('leaves', LeaveController::class);
        Route::post('letter_subjects/{letter_subject}/status', [LetterSubjectController::class, "changeStatus"])->name("letter_subjects.status");
    });
});
