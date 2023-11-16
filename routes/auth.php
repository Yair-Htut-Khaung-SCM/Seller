<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
| This is auth routes
|
*/

// Authentication
Route::get('login', [LoginController::class, 'create'])->name('login.create')->middleware('verify.isSignIn');
Route::post('login', [LoginController::class, 'store'])->name('login.store');
Route::delete('logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

// Register
Route::get('register', [RegisterController::class, 'create'])->name('register.create')->middleware('verify.isSignIn');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

//Forget
Route::get('forget-password', [ForgetPasswordController::class, 'create'])->name('forget-password.create')->middleware('verify.isSignIn');
Route::post('forget-password', [ForgetPasswordController::class, 'store'])->name('forget-password.store')->middleware('verify.isSignIn');

// Reset
Route::get('reset-password/{token}', [ResetPasswordController::class, 'create'])->name('reset-password.create');
Route::post('reset-password}', [ResetPasswordController::class, 'store'])->name('reset-password.store');

// Change Password
Route::get('change_password', [ChangePasswordController::class, 'index'])->name('change_password.index')->middleware('auth');
Route::put('change_password', [ChangePasswordController::class, 'store'])->name('change_password.store');
