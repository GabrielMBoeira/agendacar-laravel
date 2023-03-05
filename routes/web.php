<?php

use App\Http\Controllers\Business;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('site.site');
});

// Business
Route::get('business-create', [Business::class, 'create'])->name('business.create');
Route::post('business-store', [Business::class, 'store'])->name('business.store');


//Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Socialite
Route::get('login/facebook', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirectToProvider');
Route::get('login/facebook/callback', [SocialiteController::class, 'handleProviderCallback'])->name('socialite.handleProviderCallback');
Route::get('login/google', [SocialiteController::class, 'redirectToProviderGoogle'])->name('socialite.redirectToProviderGoogle');
Route::get('login/google/callback', [SocialiteController::class, 'handleProviderCallbackGoogle'])->name('socialite.handleProviderCallbackGoogle');

require __DIR__.'/auth.php';
