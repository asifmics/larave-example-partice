<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleDeleteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPermissionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes(['verify' => true]);
Route::get('/', [DashboardController::class,'index'])->middleware('auth');
Route::resource('/user', UserController::class)->except(['show','destroy'])->middleware('auth')
    ->missing(function (Request $request) {
        return \redirect(\route('user.index'));
    });
Route::get('user/permission/{user}',[UserPermissionController::class,'index']);
Route::resource('/role', RoleController::class)->except(['destroy'])->middleware('auth')
    ->missing(function (Request $request) {
        return \redirect(\route('role.index'));
});
Route::post('role/delete',RoleDeleteController::class);
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('customer',[CustomerController::class,'index']);
