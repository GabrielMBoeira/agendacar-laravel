<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClientController;
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


Route::get('client-index', [ClientController::class, 'index'])->name('client.index');
Route::post('client-store', [ClientController::class, 'store'])->name('client.store');
// Route::post('client-store', [ClientController::class, 'store'])->name('client.store');
Route::get('client-agenda', [ClientController::class, 'agenda'])->name('client.agenda');
Route::post('client-ajax-date', [ClientController::class, 'ajaxDate'])->name('client.ajax.date');
Route::post('client-ajax-agenda', [ClientController::class, 'ajaxAgenda'])->name('client.ajax.agenda');
Route::post('client-ajax-professional', [ClientController::class, 'ajaxProfessional'])->name('client.ajax.professional');
Route::get('client-link', [ClientController::class, 'link'])->name('client.link');
Route::get('client-create', [ClientController::class, 'create'])->name('client.create');


// Socialite
Route::get('login/facebook', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirectToProvider');
Route::get('login/facebook/callback', [SocialiteController::class, 'handleProviderCallback'])->name('socialite.handleProviderCallback');
Route::get('login/google', [SocialiteController::class, 'redirectToProviderGoogle'])->name('socialite.redirectToProviderGoogle');
Route::get('login/google/callback', [SocialiteController::class, 'handleProviderCallbackGoogle'])->name('socialite.handleProviderCallbackGoogle');


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('services-create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::get('services-index/{professional_id}', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('services-edit/{service_id}', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::post('services-create', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::put('services/{service_id}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('services/{service_id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');


    Route::get('agendas-create', [AgendaController::class, 'create'])->name('admin.agenda.create');
    Route::get('agendas-create-single', [AgendaController::class, 'createSingle'])->name('admin.agenda.create.single');
    Route::get('agendas-clean/{id_agenda}', [AgendaController::class, 'clean'])->name('admin.agenda.clean');
    Route::get('agenda/{professional_id}', [AgendaController::class, 'index'])->name('admin.agenda.index');
    Route::get('agenda-view/{date}/{professional_id}', [AgendaController::class, 'view'])->name('admin.agenda.view');
    Route::get('agendas-show/{id_agenda}', [AgendaController::class, 'show'])->name('admin.agenda.show');
    Route::post('agendas-show/{id_agenda}', [AgendaController::class, 'scheduling'])->name('admin.agenda.scheduling');
    Route::post('agendas-store', [AgendaController::class, 'store'])->name('admin.agenda.store');
    Route::post('agendas-store-single', [AgendaController::class, 'storeSingle'])->name('admin.agenda.store.single');
    Route::delete('agenda/{agenda_id}', [AgendaController::class, 'destroy'])->name('admin.agenda.destroy');
    Route::delete('agendas-destroy-date/{date}/{professional_id}', [AgendaController::class, 'destroyDate'])->name('admin.agenda.destroy.date');


    Route::get('professionals/create', [ProfessionalController::class, 'create'])->name('admin.professionals.create');
    // Route::get('/professionals/{id}', [ProfessionalController::class, 'edit'])->name('admin.professionals.edit');
    Route::get('professionals', [ProfessionalController::class, 'index'])->name('admin.professionals.index');
    Route::put('professionals/{id}', [ProfessionalController::class, 'update'])->name('admin.professionals.update');
    Route::post('professionals', [ProfessionalController::class, 'store'])->name('admin.professionals.store');
    Route::delete('professionals/{id}', [ProfessionalController::class, 'destroy'])->name('admin.professionals.destroy');

});

require __DIR__ . '/auth.php';
