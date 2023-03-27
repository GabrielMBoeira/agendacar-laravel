<?php

use App\Http\Controllers\Business;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('site.site');
});

// // Business
// Route::get('business-create', [Business::class, 'create'])->name('business.create');
// Route::post('business-store', [Business::class, 'store'])->name('business.store');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');


    Route::get('/professionals/create', [ProfessionalController::class, 'create'])->name('admin.professionals.create');
    Route::post('/professionals', [ProfessionalController::class, 'store'])->name('admin.professionals.store');
    Route::get('/professionals/{id}', [ProfessionalController::class, 'edit'])->name('admin.professionals.edit');
    Route::put('/professionals/{id}', [ProfessionalController::class, 'update'])->name('admin.professionals.update');
    Route::get('/professionals', [ProfessionalController::class, 'index'])->name('admin.professionals.index');
    // Route::get('/edit_professional', [ProfessionalController::class, 'edit'])->name('admin.professional.edit');


});


// Socialite
Route::get('login/facebook', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirectToProvider');
Route::get('login/facebook/callback', [SocialiteController::class, 'handleProviderCallback'])->name('socialite.handleProviderCallback');
Route::get('login/google', [SocialiteController::class, 'redirectToProviderGoogle'])->name('socialite.redirectToProviderGoogle');
Route::get('login/google/callback', [SocialiteController::class, 'handleProviderCallbackGoogle'])->name('socialite.handleProviderCallbackGoogle');

require __DIR__ . '/auth.php';
