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

    Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/', [AdminPageController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile/edit', [ProfileController::class, 'store'])->name('profile.store');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::post('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/admin-users', [AdminUserController::class, 'index'])->name('admin-user.index');

    Route::get('sell/post', [SellPostController::class, 'index'])->name('sell.post.index');
    Route::post('sell/post/{id}', [SellPostController::class, 'update'])->name('sell.post.update');
    Route::delete('sell/post/{id}', [SellPostController::class, 'destroy'])->name('sell.post.destroy');

    Route::get('/buy/post', [BuyPostController::class, 'index'])->name('buy.post.index');
    Route::post('/buy/post/{id}', [BuyPostController::class, 'update'])->name('buy.post.update');
    Route::delete('/buy/post/{id}', [BuyPostController::class, 'destroy'])->name('buy.post.destroy');

    Route::get('/manufacturer', [ManufacturerController::class, 'index'])->name('manufacturer.index');
    Route::get('/manufacturer/create', [ManufacturerController::class, 'create'])->name('manufacturer.create');
    Route::post('/manufacturer/store', [ManufacturerController::class, 'store'])->name('manufacturer.store');
    Route::get('/manufacturer/{id}', [ManufacturerController::class, 'edit'])->name('manufacturer.edit');
    Route::post('/manufacturer/{id}', [ManufacturerController::class, 'update'])->name('manufacturer.update');
    Route::delete('/manufacturer/{id}', [ManufacturerController::class, 'destroy'])->name('manufacturer.destroy');

    Route::get('/build-type', [BuildTypeController::class, 'index'])->name('build-type.index');
    Route::get('/build-type/create', [BuildTypeController::class, 'create'])->name('build-type.create');
    Route::post('/build-type/store', [BuildTypeController::class, 'store'])->name('build-type.store');
    Route::get('/build-type/{id}', [BuildTypeController::class, 'edit'])->name('build-type.edit');
    Route::post('/build-type/{id}', [BuildTypeController::class, 'update'])->name('build-type.update');
    Route::delete('/build-type/{id}', [BuildTypeController::class, 'destroy'])->name('build-type.destroy');

    Route::get('/plate-division', [PlateDivisionController::class, 'index'])->name('plate-division.index');
    Route::get('/plate-division/create', [PlateDivisionController::class, 'create'])->name('plate-division.create');
    Route::post('/plate-division/store', [PlateDivisionController::class, 'store'])->name('plate-division.store');
    Route::get('/plate-division/{id}', [PlateDivisionController::class, 'edit'])->name('plate-division.edit');
    Route::post('/plate-division/{id}', [PlateDivisionController::class, 'update'])->name('plate-division.update');
    Route::delete('/plate-division/{id}', [PlateDivisionController::class, 'destroy'])->name('plate-division.destroy');
});
