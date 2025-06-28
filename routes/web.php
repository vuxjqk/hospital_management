<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialtyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('appointments', AppointmentController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('specialties', SpecialtyController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('examinations', ExaminationController::class);
});

require __DIR__ . '/auth.php';
