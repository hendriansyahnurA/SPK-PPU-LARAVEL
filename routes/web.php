<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AspekController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HasilAkhirController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\NilaiKriteriaController;
use App\Http\Controllers\subNilaikriteriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\users\klasifikasiController as UsersKlasifikasiController;
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



Route::get('/', [AuthController::class, 'show'])->name('home');
Route::post('/', [AuthController::class, 'login'])->name('login');



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Dahboard
    Route::get('/admin/dashboard', [AuthController::class, 'index'])->name('admin.dashboard');
    // Dahboard

    // Data ALternatif
    Route::get('/admin/alternatif', [AlternatifController::class, 'index'])->name('admin.alternatif');
    Route::post('/admin/created', [AlternatifController::class, 'store'])->name('admin.store');
    Route::put('/admin/update/{id}', [AlternatifController::class, 'update'])->name('admin.update');
    Route::delete('/admin/destroy/{id}', [AlternatifController::class, 'destroy'])->name('admin.destroy');
    // Data ALternatif

    // Data Evaluator
    Route::get('/admin/evaluator', [UserController::class, 'index'])->name('admin.evaluator');
    Route::post('/admin/evaluator/created', [UserController::class, 'store'])->name('admin.created');
    Route::put('/admin/evaluator/update/{id}', [UserController::class, 'update'])->name('admin.evaluator.update');
    Route::delete('/admin/evaluator/destroy/{id}', [UserController::class, 'destroy'])->name('admin.evaluator.destroy');
    // Data Evaluator

    // Data Aspek
    Route::get('/admin/aspek', [AspekController::class, 'index'])->name('admin.aspek');
    Route::post('/admin/aspek/creted', [AspekController::class, 'store'])->name('admin.aspek.store');
    Route::put('/admin/aspek/update/{id}', [AspekController::class, 'update'])->name('admin.aspek.update');
    Route::delete('/admin/aspek/destroy/{id}', [AspekController::class, 'destroy'])->name('admin.aspek.destroy');
    // Data Aspek

    // Kriteria
    Route::get('/admin/kriteria', [KriteriaController::class, 'index'])->name('admin.kriteria');
    Route::post('/admin/kriteria/creted', [KriteriaController::class, 'store'])->name('admin.kriteria.store');
    Route::put('/admin/kriteria/update/{id}', [KriteriaController::class, 'update'])->name('admin.kriteria.update');
    Route::delete('/admin/kriteria/destroy/{id}', [KriteriaController::class, 'destroy'])->name('admin.kriteria.destroy');
    // Kriteria

    // Sub Nilai
    Route::get('/admin/subNilai', [subNilaikriteriaController::class, 'index'])->name('admin.subNilai');
    Route::post('/admin/subNilai/creted', [subNilaikriteriaController::class, 'store'])->name('admin.subNilai.store');
    Route::put('/admin/subNilai/update/{id}', [subNilaikriteriaController::class, 'update'])->name('admin.subNilai.update');
    Route::delete('/admin/subNilai/destroy/{id}', [subNilaikriteriaController::class, 'destroy'])->name('admin.subNilai.destroy');
    // Sub Nilai

    // Penilaian / klasifikasi
    Route::get('/admin/klasifikasi', [KlasifikasiController::class, 'index'])->name('admin.klasifikasi');
    Route::post('/admin/klasifikasi/creted', [KlasifikasiController::class, 'store'])->name('admin.klasifikasi.store');
    Route::put('/admin/klasifikasi/update/{id}', [KlasifikasiController::class, 'update'])->name('admin.klasifikasi.update');
    Route::delete('/admin/klasifikasi/destroy/{id}', [KlasifikasiController::class, 'destroy'])->name('admin.klasifikasi.destroy');
    // Penilaian / klasifikasi

    // Hasil Akhir Penilaian
    Route::get('/admin/hasil', [HasilAkhirController::class, 'index'])->name('admin.hasil');
    Route::post('/admin/klasifikasi/creted', [KlasifikasiController::class, 'store'])->name('admin.klasifikasi.store');
    Route::put('/admin/klasifikasi/update/{id}', [KlasifikasiController::class, 'update'])->name('admin.klasifikasi.update');
    Route::delete('/admin/klasifikasi/destroy/{id}', [KlasifikasiController::class, 'destroy'])->name('admin.klasifikasi.destroy');
    // Hasil Akhir Penilaian
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/users/dashboard', [UsersKlasifikasiController::class, 'evaluator'])->name('users.dashboard');
    Route::get('/users/klasifikasi', [UsersKlasifikasiController::class, 'index'])->name('users.klasifikasi');
});
