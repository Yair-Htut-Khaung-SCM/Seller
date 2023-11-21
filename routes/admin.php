<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SellPostController;
use App\Http\Controllers\Admin\BuyPostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\BuildTypeController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\PlateDivisionController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'create'])->name('admin.login.create');
Route::post('/login', [LoginController::class, 'store'])->name('admin.login.store');
Route::delete('/logout', [LoginController::class, 'destroy'])->name('admin.logout');

Route::middleware('admin.auth')->name('admin.')->group(function () {

    //register
    Route::resource('register',RegisterController::class)->except('index','edit','show','update','destroy');

    Route::get('/', [AdminPageController::class, 'index'])->name('home');

    //profile
    Route::resource('profile',ProfileController::class)->except('edit','show','update','destroy');

    //users
    Route::resource('users',UserController::class)->except('create','edit','show','store');

    Route::get('/admin-users', [AdminUserController::class, 'index'])->name('admin-user.index');

    //sellpost
    Route::resource('sell',SellPostController::class)->except('create','edit','show','store');

    //buypost
    Route::resource('buy',BuyPostController::class)->except('create','edit','show','store');

    //manufacturer
    Route::post('/manufacturer/store', [ManufacturerController::class, 'store'])->name('manufacturer.store');
    Route::resource('manufacturer',ManufacturerController::class)->except('show','store');

    //build-type
    Route::resource('build-type',BuildTypeController::class)->except('show');

    //plate-division
    Route::resource('plate-division',PlateDivisionController::class)->except('show');
});
