<?php

use App\Models\BuildType;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\MyPostController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\BuildTypeController;
use App\Http\Controllers\API\ManufacturerController;
use App\Http\Controllers\API\FavouritePostController;
use App\Http\Controllers\API\ForgetPasswordController;
use App\Http\Controllers\API\MyProfileController;
use App\Http\Controllers\API\PlateDivisionController;
use App\Http\Controllers\API\UserOwnPostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('login', [LoginController::class, 'store']);
Route::delete('logout', [LoginController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('register', [RegisterController::class, 'store']);
Route::post('forget-password', [ForgetPasswordController::class, 'store']);

// Profile
Route::get('profile/{id}', [ProfileController::class, 'show']);
Route::get('profile/{id}/post', [UserOwnPostController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [MyProfileController::class, 'show']);
    Route::post('profile', [MyProfileController::class, 'update']);
});

// Favorite Post
Route::middleware('auth:sanctum')->group(function () {
    Route::get('post/favorite', [FavouritePostController::class, 'index']);
    Route::post('post/favorite/{id}', [FavouritePostController::class, 'store']);
    Route::delete('post/favorite/{id}', [FavouritePostController::class, 'destroy']);
});

// My Post
Route::middleware('auth:sanctum')->group(function () {
    Route::get('post/my', [MyPostController::class, 'index']);
});

// Post 
Route::get('post', [PostController::class, 'index']);
Route::get('post/{id}', [PostController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('post', [PostController::class, 'store']);
    Route::post('post/{id}', [PostController::class, 'update']);
    Route::delete('post/{id}', [PostController::class, 'destroy']);
});

// Search
Route::get('search', [PostController::class, 'search']);

// Manufacturers
Route::get('manufacturers', [ManufacturerController::class, 'index']);

//BuildTypes
Route::get('build-types', [BuildTypeController::class, 'index']);

//Divisions
Route::get('divisions', [PlateDivisionController::class, 'index']);
