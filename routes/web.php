<?php

use App\Http\Controllers\DrugController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
*/

Route::get('/', function(){
    return redirect()->route('login');
});

Route::get('login', function(){
    return view('auth.login');
})->name('login');


Route::get('Profile', function(){
    return view('profile');
})->name('profile');

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Route::get('/UserList/doctor', [UserController::class, 'showTableDoctor'])->name('userlist.doctor')->middleware('can:isAdmin');
Route::get('/UserList/patient', [UserController::class, 'showTablePatient'])->name('userlist.patient')->middleware('can:isAdmin');
Route::get('/UserList/pharmacist', [UserController::class, 'showTablePharmacist'])->name('userlist.pharmacist')->middleware('can:isAdmin');

Route::post('/UserList/doctor', [UserController::class, 'registerDoctor'])->name('userlist.doctor.register')->middleware('can:isAdmin');
Route::get('/UserList/doctor/edit/{id}', [UserController::class, 'editDoctor'])->name('userlist.edit.doctor')->middleware('can:isAdmin');
Route::put('/UserList/doctor/update/{id}', [UserController::class, 'updateDoctor'])->name('userlist.update.doctor')->middleware('can:isAdmin');
Route::delete('/UserList/doctor/delete/{id}', [UserController::class, 'deleteDoctor'])->name('userlist.delete.doctor')->middleware('can:isAdmin');

Route::post('/UserList/patient', [UserController::class, 'registerPatient'])->name('userlist.patient.register')->middleware('can:isAdmin');
Route::get('/UserList/patient/edit/{id}', [UserController::class, 'editPatient'])->name('userlist.edit.patient')->middleware('can:isAdmin');
Route::put('/UserList/patient/update/{id}', [UserController::class, 'updatePatient'])->name('userlist.update.patient')->middleware('can:isAdmin');
Route::delete('/UserList/patient/delete/{id}', [UserController::class, 'deletePatient'])->name('userlist.delete.patient')->middleware('can:isAdmin');

Route::post('/UserList/pharmacist', [UserController::class, 'registerPharmacist'])->name('userlist.pharmacist.register')->middleware('can:isAdmin');
Route::get('/UserList/pharmacist/edit/{id}', [UserController::class, 'editPharmacist'])->name('userlist.edit.pharmacist')->middleware('can:isAdmin');
Route::put('/UserList/pharmacist/update/{id}', [UserController::class, 'updatePharmacist'])->name('userlist.update.pharmacist')->middleware('can:isAdmin');
Route::delete('/UserList/pharmacist/delete/{id}', [UserController::class, 'deletePharmacist'])->name('userlist.delete.pharmacist')->middleware('can:isAdmin');

Route::get('/MedicineList', [DrugController::class, 'showTableMedicine'])->name('medicinelist')->middleware('can:isPharmacist');


Route::middleware(['can:isDoctorOrPatientPharmacist'])->group(function () {
    Route::get('/MedicalRecordList', [MedicalRecordController::class, 'showTableMedicalRecord'])->name('medicalrecordlist');
});
Route::get('/MedicalRecordList/add', [MedicalRecordController::class, 'create'])->name('medical_records.create')->middleware('can:isDoctor');
Route::post('/MedicalRecordList/add', [MedicalRecordController::class, 'store'])->name('medical_records.store')->middleware('can:isDoctor');
Route::get('/MedicalRecordList/edit/{id}', [MedicalRecordController::class, 'edit'])->name('medical_records.edit')->middleware('can:isDoctor');
Route::put('/MedicalRecordList/update/{id}', [MedicalRecordController::class, 'update'])->name('medical_records.update')->middleware('can:isDoctor');
Route::delete('/MedicalRecordList/delete/{id}', [MedicalRecordController::class, 'delete'])->name('medical_records.delete')->middleware('can:isDoctor');

Route::put('/MedicalRecordList/done/{id}', [MedicalRecordController::class, 'statusCheckDone'])->name('medical_records.done')->middleware('can:isPharmacist');

