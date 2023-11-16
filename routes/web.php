<?php

use App\Http\Controllers\BrandNewBuyPostController;
use App\Http\Controllers\BrandNewSalePostController;
use App\Http\Controllers\BuildTypeBuyPostController;
use App\Http\Controllers\BuildTypeSalePostController;
use App\Http\Controllers\LatestBuyPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SalePostController;
use App\Http\Controllers\BuyPostController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\FavouritePostController;
use App\Http\Controllers\FavouriteBuyPostController;
use App\Http\Controllers\FavouriteSalePostController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\CommentController;use App\Http\Controllers\LatestSalePostController;
use App\Http\Controllers\ManufacturerBuyPostController;
use App\Http\Controllers\ManufacturerSalePostController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Page
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('about', [PageController::class, 'about'])->name('about');
Route::get('policy', [PageController::class, 'policy'])->name('policy');

// Profile
Route::get('/profile/sale', [ProfileController::class, 'showown_sale'])->name('profile.sale')->middleware('auth', 'verified');
Route::get('/profile/buy', [ProfileController::class, 'showown_buy'])->name('profile.buy')->middleware('auth', 'verified');
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth', 'verified');
Route::post('profile/edit', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth', 'verified');
Route::get('profile/sale/{id}', [ProfileController::class, 'showsale_other']);
Route::get('profile/buy/{id}', [ProfileController::class, 'showbuy_other']);

// // MyFav Post
Route::get('post/favourite', [FavouritePostController::class, 'index'])->name('post.favourite')->middleware('auth', 'verified');
Route::post('post/{id}/favourite', [FavouritePostController::class, 'store'])->name('favourite.store')->middleware('auth', 'verified');
Route::post('post/{id}/destroy', [FavouritePostController::class, 'destroy'])->name('favourite.destroy')->middleware('auth', 'verified');

// // MyFav Buy Post
Route::get('buy/post/favourite', [FavouriteBuyPostController::class, 'index'])->name('buy.post.favourite')->middleware('auth', 'verified');
Route::post('buy/post/{id}/favourite', [FavouriteBuyPostController::class, 'store'])->name('buy.favourite.store');
Route::post('buy/post/{id}/destroy', [FavouriteBuyPostController::class, 'destroy'])->name('buy.favourite.destroy');

// // MyFav Sale Post
Route::get('sale/post/favourite', [FavouriteSalePostController::class, 'index'])->name('sale.post.favourite')->middleware('auth', 'verified');
Route::post('sale/post/{id}/favourite', [FavouriteSalePostController::class, 'store'])->name('sale.favourite.store');
Route::post('sale/post/{id}/destroy', [FavouriteSalePostController::class, 'destroy'])->name('sale.favourite.destroy');

// Post
Route::get('sale/post', [SalePostController::class, 'index'])->name('sale.post.index');  //Post List
Route::get('sale/post/create', [SalePostController::class, 'create'])->name('sale.post.create')->middleware(['auth', 'verified']);
Route::post('sale/post', [SalePostController::class, 'store'])->name('sale.post.store');
Route::get('sale/post/{id}', [SalePostController::class, 'show'])->name('sale.post.show');
Route::get('sale/post/{id}/edit', [SalePostController::class, 'edit'])->name('sale.post.edit')->middleware('auth', 'verified');
Route::put('sale/post/{id}', [SalePostController::class, 'update'])->name('sale.post.update');
Route::delete('sale/post/{id}', [SalePostController::class, 'destroy'])->name('sale.post.delete');

// Latest post
Route::get('latest/buy/post', [LatestBuyPostController::class, 'index'])->name('latest.buy.post.index');  
Route::get('latest/sale/post', [LatestSalePostController::class, 'index'])->name('latest.sale.post.index');  

// Brand New post
Route::get('brand_new/buy/post', [BrandNewBuyPostController::class, 'index'])->name('brand_new.buy.post.index');  
Route::get('brand_new/sale/post', [BrandNewSalePostController::class, 'index'])->name('brand_new.sale.post.index');  

// Build Type 
Route::get('build_type/buy/post', [BuildTypeBuyPostController::class, 'index'])->name('build_type.buy.post.index');
Route::get('build_type/sale/post', [BuildTypeSalePostController::class, 'index'])->name('build_type.sale.post.index');

// Manufacturers
Route::get('manufacturer/buy/post', [ManufacturerBuyPostController::class, 'index'])->name('manufacturer.buy.post.index');
Route::get('manufacturer/sale/post', [ManufacturerSalePostController::class, 'index'])->name('manufacturer.sale.post.index');

// BuyPost
Route::get('buy/post', [BuyPostController::class, 'index'])->name('buy.post.index');  //Post List
Route::get('buy/post/create', [BuyPostController::class, 'create'])->name('buy.post.create')->middleware('auth', 'verified');
Route::post('buy/post', [BuyPostController::class, 'store'])->name('buy.post.store');
Route::get('buy/post/{id}', [BuyPostController::class, 'show'])->name('buy.post.show');
Route::get('buy/post/{id}/edit', [BuyPostController::class, 'edit'])->name('buy.post.edit')->middleware('auth', 'verified');
Route::put('buy/post/{id}', [BuyPostController::class, 'update'])->name('buy.post.update');
Route::delete('buy/post/{id}', [BuyPostController::class, 'destroy'])->name('buy.post.delete');

//Language
Route::get('localization/{locale}', [LocalizationController::class, 'index']);

//Google
Route::controller(GoogleController::class)->group(function () {
  Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
  Route::get('auth/google/callback', 'handleGoogleCallback');
});

//Facebook
Route::controller(FacebookController::class)->group(function () {
  Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
  Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

//Comment
Route::post('comment',[App\Http\Controllers\CommentController::class,'store'])->name('comment.store')->middleware('verified');
Route::delete('components/card-sm/{id}',[App\Http\Controllers\CommentController::class,"delete"])->name('comment.delete');
Route::get('components/card-sm/{id}', [App\Http\Controllers\CommentController::class, 'edit'])->name('comment.edit')->middleware('auth','verified');
Route::put('components/card-sm/{id}', [App\Http\Controllers\CommentController::class, 'update'])->name('comment.update')->middleware('auth','verified');


Route::get('/email/verify', function () {
  return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

require __DIR__ . '/auth.php';