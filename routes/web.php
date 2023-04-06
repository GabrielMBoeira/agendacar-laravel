<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Business;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;


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


    Route::get('/client', [AgendaController::class, 'view'])->name('admin.agenda.view');


    Route::get('services-create/{professional_id}', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('services-create', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('services-index/{professional_id}', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('services-edit/{service_id}', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('services/{service_id}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('services/{service_id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');


    Route::get('agenda/{professional_id}', [AgendaController::class, 'index'])->name('admin.agenda.index');
    Route::get('agenda-view/{date}/{professional_id}', [AgendaController::class, 'view'])->name('admin.agenda.view');
    Route::get('agendas-show/{id_agenda}', [AgendaController::class, 'show'])->name('admin.agenda.show');
    Route::post('agendas-show/{id_agenda}', [AgendaController::class, 'store'])->name('admin.agenda.store');
    Route::delete('/agenda/{agenda_id}', [AgendaController::class, 'destroy'])->name('admin.agenda.destroy');


    Route::get('/professionals/create', [ProfessionalController::class, 'create'])->name('admin.professionals.create');
    // Route::get('/professionals/{id}', [ProfessionalController::class, 'edit'])->name('admin.professionals.edit');
    Route::put('/professionals/{id}', [ProfessionalController::class, 'update'])->name('admin.professionals.update');
    Route::get('/professionals', [ProfessionalController::class, 'index'])->name('admin.professionals.index');
    Route::post('/professionals', [ProfessionalController::class, 'store'])->name('admin.professionals.store');
    Route::delete('/professionals/{id}', [ProfessionalController::class, 'destroy'])->name('admin.professionals.destroy');


});


// Socialite
Route::get('login/facebook', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirectToProvider');
Route::get('login/facebook/callback', [SocialiteController::class, 'handleProviderCallback'])->name('socialite.handleProviderCallback');
Route::get('login/google', [SocialiteController::class, 'redirectToProviderGoogle'])->name('socialite.redirectToProviderGoogle');
Route::get('login/google/callback', [SocialiteController::class, 'handleProviderCallbackGoogle'])->name('socialite.handleProviderCallbackGoogle');

require __DIR__ . '/auth.php';
