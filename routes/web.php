<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompnyBranchController;
use App\Http\Controllers\CompnyController;

use App\Http\Controllers\CuntryController;
use App\Http\Controllers\DelateController;
use App\Http\Controllers\UserAuthController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('proj', function () {
    return view('project');
});

Route::view('projt', 'project');


Route::prefix('cms/')->middleware('guest:admin,')->group(function () {
    Route::get('{guard}/login', [UserAuthController::class, 'ShowLogin'])->name('view.login');

    Route::post('{guard}/login', [UserAuthController::class, 'Login']);
});


Route::prefix('cms/admin')->middleware('auth:admin,author')->group(function () {
    Route::get('logout', [UserAuthController::class, 'Logout'])->name('view.logout');
    Route::get('change_password' , [UserAuthController::class , 'changePassword'])->name('change_password');
    Route::post('update_password' , [UserAuthController::class , 'updatePassword'])->name('update_password');

    Route::get('edit-profile-admin' , [UserAuthController::class , 'editProfile'] )->name('edit-profile-admin');
    Route::post('update-profile' , [UserAuthController::class , 'UpdateProfile'] )->name('update-profile');

});


Route::prefix('cms/dashboard/')->group(function (){

    Route::resource('countries' , CuntryController::class );
    Route::post('update-countries/{id}', [CuntryController::class, 'update'])->name('update-countries');
    Route::resource('cities' , CityController::class );
    Route::post('update-cities/{id}', [CityController::class, 'update'])->name('update-cities');
    Route::resource('admins' , AdminController::class );
    Route::post('update-admins/{id}', [AdminController::class, 'update'])->name('update-admins');
    Route::resource('delate' , DelateController::class );
    Route::get('recovery/{id}', [DelateController::class, 'recovery'])->name('recovery');

    Route::resource('compnies' , CompnyController::class );
    Route::post('update-compnies/{id}', [CompnyController::class, 'update'])->name('update-compnies');
    Route::resource('compnybranchs' , CompnyBranchController::class );
    Route::post('update-compnybranchs/{id}', [CompnyBranchController::class, 'update'])->name('update-compnies');



} );
