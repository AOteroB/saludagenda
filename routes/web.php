<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MedicalHistoryController;
use App\Models\MedicalHistory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|


Route::get('/', function () {
    return view('index');
});*/


Route::get('/', [WelcomeController::class, 'welcome']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');});

Route::post('/user/{user}/assign-role', [UserController::class, 'assignRole'])->name('user.assignRole');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

Route::get('/admin/reports', [App\Http\Controllers\AdminController::class, 'reports'])
    ->name('admin.reports.index')->middleware('auth')->middleware('can:admin.user.index');

############################################################
##                     ZONA USUARIOS                      ##
############################################################
Route::middleware('auth')->group(function () {
    Route::get('/admin/user', [UserController::class, 'index'])
        ->middleware('can:admin.user.index')->name('admin.user.index');

    Route::get('/admin/user/create', [UserController::class, 'create'])
        ->middleware('can:admin.user.create')->name('admin.user.create');

    Route::get('/admin/user/pdf', [UserController::class, 'pdf'])
        ->middleware('can:admin.user.create')->name('admin.user.pdf');

    Route::post('/admin/user', [UserController::class, 'store'])
        ->middleware('can:admin.user.store')->name('admin.user.store');

    Route::get('/admin/user/{id}', [UserController::class, 'show'])
        ->middleware('can:admin.user.show')->name('admin.user.show');

    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])
        ->middleware('can:admin.user.edit')->name('admin.user.edit');

    Route::put('/admin/user/{id}', [UserController::class, 'update'])
        ->middleware('can:admin.user.update')->name('admin.user.update');

    Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])
        ->middleware('can:admin.user.destroy')->name('admin.user.destroy');
});

############################################################
##                     ZONA PACIENTES                     ##
############################################################
Route::middleware('auth')->group(function () {
    Route::get('/admin/patients', [PatientController::class, 'index'])
        ->middleware('can:admin.patients.index')->name('admin.patients.index');

    Route::get('/admin/patients/create', [PatientController::class, 'create'])
        ->middleware('can:admin.patients.create')->name('admin.patients.create');

    Route::get('/admin/patients/pdf', [PatientController::class, 'pdf'])
        ->middleware('can:admin.patients.create')->name('admin.patients.pdf');

    Route::post('/admin/patients', [PatientController::class, 'store'])
        ->middleware('can:admin.patients.store')->name('admin.patients.store');

    Route::get('/admin/patients/{id}', [PatientController::class, 'show'])
        ->middleware('can:admin.patients.show')->name('admin.patients.show');

    Route::get('/admin/patients/{id}/edit', [PatientController::class, 'edit'])
        ->middleware('can:admin.patients.edit')->name('admin.patients.edit');

    Route::put('/admin/patients/{id}', [PatientController::class, 'update'])
        ->middleware('can:admin.patients.update')->name('admin.patients.update');

    Route::delete('/admin/patients/{id}', [PatientController::class, 'destroy'])
        ->middleware('can:admin.patients.destroy')->name('admin.patients.destroy');
});

############################################################
##                  ZONA ESPECIALIDADES                   ##
############################################################
Route::middleware('auth')->group(function () {
    Route::get('/admin/specialties', [SpecialtyController::class, 'index'])
        ->middleware('can:admin.specialties.index')->name('admin.specialties.index');

    Route::get('/admin/specialties/create', [SpecialtyController::class, 'create'])
        ->middleware('can:admin.specialties.create')->name('admin.specialties.create');

    Route::get('/admin/specialties/pdf', [SpecialtyController::class, 'pdf'])
        ->middleware('can:admin.specialties.create')->name('admin.specialties.pdf');

    Route::post('/admin/specialties', [SpecialtyController::class, 'store'])
        ->middleware('can:admin.specialties.store')->name('admin.specialties.store');

    Route::get('/admin/specialties/{id}', [SpecialtyController::class, 'show'])
        ->middleware('can:admin.specialties.show')->name('admin.specialties.show');

    Route::get('/admin/specialties/{id}/edit', [SpecialtyController::class, 'edit'])
        ->middleware('can:admin.specialties.edit')->name('admin.specialties.edit');

    Route::put('/admin/specialties/{id}', [SpecialtyController::class, 'update'])
        ->middleware('can:admin.specialties.update')->name('admin.specialties.update');

    Route::delete('/admin/specialties/{id}', [SpecialtyController::class, 'destroy'])
        ->middleware('can:admin.specialties.destroy')->name('admin.specialties.destroy');
});

############################################################
##                      ZONA DOCTORES                     ##
############################################################
Route::middleware('auth')->group(function () {
 Route::get('/admin/doctors', [DoctorController::class, 'index'])
        ->middleware('can:admin.doctors.index')->name('admin.doctors.index');

    Route::get('/admin/doctors/create', [DoctorController::class, 'create'])
        ->middleware('can:admin.doctors.create')->name('admin.doctors.create');

    Route::post('/admin/doctors', [DoctorController::class, 'store'])
        ->middleware('can:admin.doctors.store')->name('admin.doctors.store');

    Route::get('/admin/doctors/reports', [DoctorController::class, 'reports'])
        ->middleware('can:admin.doctors.create')->name('admin.doctors.reports');

    Route::get('/admin/doctors/pdf', [DoctorController::class, 'pdf'])
        ->middleware('can:admin.doctors.create')->name('admin.doctors.pdf');

    Route::get('/admin/doctors/{id}', [DoctorController::class, 'show'])
        ->middleware('can:admin.doctors.show')->name('admin.doctors.show');

    Route::get('/admin/doctors/{id}/edit', [DoctorController::class, 'edit'])
        ->middleware('can:admin.doctors.edit')->name('admin.doctors.edit');

    Route::put('/admin/doctors/{id}', [DoctorController::class, 'update'])
        ->middleware('can:admin.doctors.update')->name('admin.doctors.update');

    Route::delete('/admin/doctors/{id}', [DoctorController::class, 'destroy'])
        ->middleware('can:admin.doctors.destroy')->name('admin.doctors.destroy');

    Route::get('/doctor/edit-patient/{user_id}', [DoctorController::class, 'editPatient'])
        ->middleware('can:admin.patients.edit')->name('doctor.edit.patient');
        
    Route::put('/doctor/edit-patient/{user_id}', [DoctorController::class, 'updatePatient'])
        ->middleware('can:admin.patients.update')->name('doctor.update.patient');

    // Crear historial médico a partie del listado de citas disponibles
    Route::get('admin/medical_histories/create/{patient}', [MedicalHistoryController::class, 'createFromAppointment'])
        ->name('admin.medical_histories.createFromAppointment');

});


############################################################
##                      ZONA HORARIOS                     ##
############################################################
Route::middleware('auth')->group(function () {
    Route::get('/admin/schedules', [ScheduleController::class, 'index'])
        ->middleware('can:admin.schedules.index')->name('admin.schedules.index');

    Route::get('/admin/schedules/create', [ScheduleController::class, 'create'])
        ->middleware('can:admin.schedules.create')->name('admin.schedules.create');

    Route::post('/admin/schedules/create', [ScheduleController::class, 'store'])
        ->middleware('can:admin.schedules.store')->name('admin.schedules.store');

    Route::get('/admin/schedules/{id}', [ScheduleController::class, 'show'])
        ->middleware('can:admin.schedules.show')->name('admin.schedules.show');

    Route::get('/admin/schedules/{id}/edit', [ScheduleController::class, 'edit'])
        ->middleware('can:admin.schedules.edit')->name('admin.schedules.edit');

    Route::put('/admin/schedules/{id}', [ScheduleController::class, 'update'])
        ->middleware('can:admin.schedules.update')->name('admin.schedules.update');
        
    Route::delete('/admin/schedules/{id}', [ScheduleController::class, 'destroy'])
        ->middleware('can:admin.schedules.destroy')->name('admin.schedules.destroy');
});

############################################################
##                         ZONA CITAS                     ##
############################################################
Route::middleware('auth')->group(function () {

    Route::get('/admin/events', [EventController::class, 'index'])
        ->middleware('can:admin.appointments.index')
        ->name('admin.events.index');
    
    // Generar PDF 
    Route::get('/admin/events/pdf', [EventController::class, 'pdf'])
        ->middleware('can:admin.user.index')->name('admin.events.pdf');

    // Generar PDF por fechas 
    Route::get('/admin/events/pdf_dates', [EventController::class, 'pdf_dates'])
        ->middleware('can:admin.user.index')->name('admin.events.pdf_dates');


    // Crear cita
    Route::post('/admin/events/create', [EventController::class, 'store'])
        ->middleware('can:admin.appointments.create')
        ->name('admin.events.create');

    // Ver cita
    Route::get('/admin/events/show', [EventController::class, 'show'])
        ->middleware('can:admin.appointments.show')
        ->name('admin.events.show');

    // Eliminar cita
    Route::delete('/admin/events/{id}', [EventController::class, 'destroy'])
        ->middleware('can:admin.appointments.destroy')
        ->name('admin.events.destroy');

    Route::post('/admin/events/check-availability', [EventController::class, 'checkAvailability'])
        ->name('check.availability');
});


############################################################
##                   ZONA HISTORIAL CLÍNICO               ##
############################################################
Route::middleware('auth')->group(function () {

    Route::get('/admin/medical-histories', [MedicalHistoryController::class, 'index'])
        ->middleware('can:admin.medical_histories.index')->name('admin.medical_histories.index');

    Route::get('/admin/medical-histories/create', [MedicalHistoryController::class, 'create'])
        ->middleware('can:admin.medical_histories.create')->name('admin.medical_histories.create');

    Route::post('/admin/medical-histories', [MedicalHistoryController::class, 'store'])
        ->middleware('can:admin.medical_histories.store')->name('admin.medical_histories.store');

    // PDF de un historial médico individual
    Route::get('/admin/medical-histories/pdf/{id}', [MedicalHistoryController::class, 'pdfSingle'])
        ->middleware('can:admin.medical_histories.pdf')->name('admin.medical_histories.pdf_single');
    
    // PDF con todos los historiales de un paciente
    Route::get('/admin/patients/{id}/medical-histories/pdf', [MedicalHistoryController::class, 'pdfAll'])
        ->middleware('can:admin.medical_histories.pdf')->name('admin.medical_histories.pdf_all');

    Route::get('/admin/medical-histories/{medicalHistory}', [MedicalHistoryController::class, 'show'])
        ->middleware('can:admin.medical_histories.show')->name('admin.medical_histories.show');

    Route::get('/admin/medical-histories/{medicalHistory}/edit', [MedicalHistoryController::class, 'edit'])
        ->middleware('can:admin.medical_histories.edit')->name('admin.medical_histories.edit');

    Route::put('/admin/medical-histories/{medicalHistory}', [MedicalHistoryController::class, 'update'])
        ->middleware('can:admin.medical_histories.update')->name('admin.medical_histories.update');

    Route::delete('/admin/medical-histories/{medicalHistory}', [MedicalHistoryController::class, 'destroy'])
        ->middleware('can:admin.medical_histories.destroy')->name('admin.medical_histories.destroy');
});
