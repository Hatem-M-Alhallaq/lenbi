<?php

use App\Http\Controllers\clinkAuthController;
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

if (Auth::guard('admin')->check()) {

    Route::get('/', function () {
        return redirect(url('cms/admin'));
    });
} else {
    Route::get('/', function () {return view('frontend.index');})->name('home');

//     Route::get('/', function () {
//         return redirect(url('/'));
//     });
}
Route::prefix('')->middleware('guest:clink')->group(function () {
    Route::get('', [clinkAuthController::class, 'showLogin'])->name('dashboard.login.clink');
    Route::post('', [clinkAuthController::class, 'login']);
});
Route::prefix('/')->middleware('guest:admin')->group(function () {
    Route::get('{guard}', [UserAuthController::class, 'showLogin'])->name('dashboard.login');
    Route::post('{guard}', [UserAuthController::class, 'login']);
});

Route::prefix('cms/admin')->middleware('auth:admin,clink')->group(function () {
    Route::get('/logout', [UserAuthController::class, 'logout'])->middleware('auth:admin,clink')->name('dashboard.auth.logout');

    Route::get('password/edit', [UserAuthController::class, 'editPassword'])->name('dashboard.auth.edit-password');
    Route::post('password/update', [UserAuthController::class, 'updatePassword'])->name('dashboard.auth.update-password');
    Route::get('profile/edit', [UserAuthController::class, 'editProfile'])->name('dashboard.auth.edit-profile');
    Route::put('profile/update', [UserAuthController::class, 'updateProfile'])->name('dashboard.auth.update-profile');
    Route::get('/', 'PagesController@index')->name('admin.dashboard');
    Route::get('password/clink/reset/{id}', 'clinkController@showResetPasswordView')->name('showResetPasswordView');
    Route::post('password/clink/reset', 'clinkController@resetPassword')->name('clink.password_reset');
});
Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {

    Route::get('password/admin/reset/{id}', 'AdminController@showResetPasswordView')->name('admin.showResetPasswordView');
    Route::post('password/admin/reset', 'AdminController@resetPassword')->name('admin.password_reset');
});
Route::prefix('cms/admin')->middleware('auth:admin,clink')->group(function () {
    Route::resource('/clinks', clinkController::class);
    Route::resource('/members', memberController::class);
    Route::post('members/status', 'memberController@ajaxMemberStatus')->name('members.status');
    Route::get('/createMember/{id}', 'memberController@createMember')->name('createMember');
    Route::get('/medicines/{id}', 'memberController@indexMedic')->name('medicines');
    Route::get('/deleteMedic/{id}', 'memberController@destroyMedic')->name('Medic-remove');
    Route::get('/deleteRole/{id}', 'RoleController@delete')->name('role-remove');
    Route::post('serach/member', 'memberController@serach')->name('search-member');

    Route::get('/events/reports/xlsx', 'ReportsController@event_xlsx');
    Route::get('/events/reports', 'ReportsController@event')->name('events-reports');
    Route::get('/visitors/reports/xlsx', 'ReportsController@visitors_xlsx');
    Route::get('/report/search', 'ReportsController@visitors')->name('visitors-reports');
    Route::post('members/updates', 'memberController@updates')->name('members.updates');

    Route::post('serach/visitor/reports', 'ReportsController@serachVisitor')->name('search-visitor-report');

    Route::get('hospital/user', 'clinkController@indexUser')->name('hospital.user');

    Route::get('/clink/user/create', 'clinkController@clink')->name('create-user');
    Route::post('/clink/user', 'clinkController@user')->name('store-user');
    Route::post('/events/store', 'eventController@update')->name('store-events');
    Route::post('/medicine/store', 'memberController@storeMedic')->name('store-medicine');
    Route::post('/checkIn/store', 'PagesController@check')->name('store-checkIn');

    Route::resource('/events', eventController::class);
    Route::resource('/admins', AdminController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/role.permissions', RolePermissionController::class);

    Route::get('full-calender', 'PagesController@index')->name('full-calender');
    Route::post('full-calender/action', 'PagesController@action')->name('full-calender.action');
    Route::post('full-calender/store', 'PagesController@storeEvent')->name('full-calender.store');
    Route::post('serach/event', 'eventController@serach')->name('search');
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('/datatables', 'PagesController@datatables')->name('datatables');

Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
//if (Auth::guard('admin')->check()) {
//
//    Route::get('/', function () {
//        return redirect(url('cms/admin'));
//    });
//} else {
//    Route::get('/', function () {return view('frontend.index');})->name('home');
//
////     Route::get('/', function () {
////         return redirect(url('/'));
////     });
//}
