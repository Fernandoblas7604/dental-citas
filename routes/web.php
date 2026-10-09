<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PublicAppointmentController;
use App\Http\Controllers\PromotionController;

Route::view('/', 'welcome')->name('home');

Route::get('/solicitar-cita', [
    PublicAppointmentController::class,
    'create',
])->name('public.appointments.create');

Route::post('/solicitar-cita', [
    PublicAppointmentController::class,
    'store',
])->middleware('throttle:5,1')
  ->name('public.appointments.store');
Route::middleware(['auth', 'ensure.dentist'])
    ->prefix('panel')
    ->group(function () {
        Route::view('/', 'dashboard')->name('dashboard');

        Route::resource('appointments', AppointmentController::class);
        Route::resource('promotions', PromotionController::class);
    });
Route::middleware('auth')->prefix('panel')->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');

    Route::resource('appointments', AppointmentController::class);

    Route::resource('promotions', PromotionController::class);
});

require __DIR__.'/auth.php';