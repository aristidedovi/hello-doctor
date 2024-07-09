<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');


    // Route pour afficher la liste des rendez-vous
    Route::get('/appointment', [AppointmentController::class, 'index'])
    ->name('appointment.index');

    // Route pour afficher la liste des rendez-vous
    Route::get('/appointment/archive', [AppointmentController::class, 'archive'])
    ->name('appointment.archive');

    // Route pour afficher le formulaire de création d'un rendez-vous
    Route::get('/appointment/create', [AppointmentController::class, 'create'])
    ->name('appointment.create');

    // Route pour traiter la création d'un rendez-vous (via le formulaire)
    Route::post('/appointment', [AppointmentController::class, 'store'])
    ->name('appointment.store');

    //Route::get('/appointment/show', [AppointmentController::class, 'show'])
    //->name('appointment.show');

    // Route pour afficher les détails d'un rendez-vous spécifique
    Route::get('/appointment/show', [AppointmentController::class, 'show'])
    ->name('appointment.show');

    // Route pour afficher le detail d'un appointement
    Route::get('/appointment/{id}', [PatientController::class, 'detail'])
    ->name('appointment.detail');

    // Route pour supprimer un rendez-vous
    // Route::delete('/appointment/{id}', [AppointmentController::class, 'destroy'])
    // ->name('appointment.destroy');


    // Route pour afficher le formulaire de modification d'un rendez-vous
    Route::get('/appointment/{appointment}/edit', [AppointmentController::class, 'edit'])
    ->name('appointment.edit');

    // Route pour traiter la modification d'un rendez-vous (via le formulaire)
    Route::put('/appointment/{appointment}', [AppointmentController::class, 'update'])
    ->name('appointment.update');

    // Route pour supprimer un rendez-vous
    // Route::delete('/appointment/{appointment}', [AppointmentController::class, 'destroy'])
    // ->name('appointment.destroy');

    // Route pour supprimer un rendez-vous
    Route::get('/appointment/delete/{appointment}', [AppointmentController::class, 'delete'])
    ->name('appointment.delete');

    Route::get('/appointment/{id}/get-data', [AppointmentController::class, 'getAppointmentData']);

    Route::get('/appointment/{id}/get-data/cloturer', [AppointmentController::class, 'getAppointmentDataCloturer']);


    Route::post('/appointment/{id}/reprogram', [AppointmentController::class, 'appointmentReprogram'])
    ->name('appointment.reprogram');

    Route::post('/appointment/{id}/cloturer', [AppointmentController::class, 'appointmentCloturer'])
    ->name('appointment.cloturer');

    Route::get('/patient', [PatientController::class, 'index'])
    ->name('patient.index');

    // Patient store
    Route::post('/patient/create', [PatientController::class, 'store'])
    ->name('patient.store');

    // Route pour crée un patient
    Route::get('/patient/create', [PatientController::class, 'create'])
    ->name('patient.create');

    // Route pour afficher le detail d'un patient
    Route::get('/patient/{patient}', [PatientController::class, 'detail'])
    ->name('patient.detail');

    // Route pour supprimer un patient
    Route::get('/patient/delete/{patient}', [PatientController::class, 'delete'])
    ->name('patient.delete');

    
    // Patient store
    Route::post('/patient', [PatientController::class, 'store'])
    ->name('patient.store');


    // Route pour afficher le calendrier
    Route::get('/calendar', [DashboardController::class, 'calendar'])
    ->name('calendar');


    Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices');
    Route::get('invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::get('invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::delete('invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::get('invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('invoices/{id}', [InvoiceController::class, 'update'])->name('invoices.update');





});



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
