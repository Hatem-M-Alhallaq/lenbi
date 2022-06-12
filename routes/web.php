<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\Phase1sController;
use App\Http\Controllers\Phase2sController;
use App\Http\Controllers\UserAuthController;
use App\Models\question_option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/')->middleware('guest:clients')->group(
    function () {
        //Route::resource('/', ClientController::class);
        Route::get('/', [ClientController::class, 'index'])->name('frontend');
        Route::post('register', [ClientController::class, 'store'])->name('frontend.register');
        Route::get('verification', [ClientController::class, 'msg_v'])->name('frontend.msg_v');
        Route::get('plane', [ClientController::class, 'plane'])->name('frontend.plane');
        Route::post('verification_check', [ClientController::class, 'verification_check'])->name('frontend.user_check_validate');
        Route::resource('/phase1', \Phase1sController::class);
        //Route::resource('/phase2', \Phase2sController::class);
        Route::get('phase2/{app_id}',  'Phase2sController@index')->name('phase2.index');
        Route::post('phase2', [Phase2sController::class, 'store'])->name('phase2.store');

        Route::get('phase3/{app_id}',  'Phase3sController@index')->name('phase3.index');
        Route::post('phase3',  'Phase3sController@store')->name('phase3.store');

        Route::get('phase3a/{app_id}',  'Phase3sController@phase3a')->name('phase3a.index');
        Route::get('phase3b/{app_id}',  'Phase3sController@phase3b')->name('phase3b.index');
        Route::post('phase3a',  'Phase3sController@phase3a_store')->name('phase3a.store');

    }
);


Route::prefix('/')->middleware('guest:admin')->group(function () {
    Route::get('admin', [UserAuthController::class, 'showLogin'])->name('dashboard.login');
    Route::post('admin', [UserAuthController::class, 'login']);
});

Route::prefix('cms/admin')->middleware('auth:admin,clink')->group(function () {
    Route::get('/logout', [UserAuthController::class, 'logout'])->middleware('auth:admin,clink')->name('dashboard.auth.logout');

    Route::get('password/edit', [UserAuthController::class, 'editPassword'])->name('dashboard.auth.edit-password');
    Route::post('password/update', [UserAuthController::class, 'updatePassword'])->name('dashboard.auth.update-password');
    Route::get('profile/edit', [UserAuthController::class, 'editProfile'])->name('dashboard.auth.edit-profile');
    Route::put('profile/update', [UserAuthController::class, 'updateProfile'])->name('dashboard.auth.update-profile');
    Route::get('/', 'PagesController@index')->name('admin.dashboard');
});
Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {

    Route::get('password/admin/reset/{id}', 'AdminController@showResetPasswordView')->name('admin.showResetPasswordView');
    Route::post('password/admin/reset', 'AdminController@resetPassword')->name('admin.password_reset');
});
Route::prefix('cms/admin')->middleware('auth:admin,clink')->group(function () {

//    Route::resource('/phases', Phase1sController::class);
//    Route::post('update/phases1', 'Phase1sController@updateAjax')->name('update.phases1');

    Route::resource('/admins', AdminController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/role.permissions', RolePermissionController::class);
});

Route::get('/datatables', 'PagesController@datatables')->name('datatables');

Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
