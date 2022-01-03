<?php

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

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::get('/karyawan-cuti', [App\Http\Controllers\DashboardController::class, 'KaryawanCuti'])->name('karyawan-cuti');
Route::get('/karyawan-cuti-lebih-sekali', [App\Http\Controllers\DashboardController::class, 'KaryawanCutiLebih'])->name('karyawan-cuti-lebih-sekali');
Route::get('/sisa-cuti', [App\Http\Controllers\DashboardController::class, 'SisaCuti'])->name('sisa-cuti');

Route::get('/master-karyawan', [App\Http\Controllers\KaryawanController::class, 'index'])->name('karyawan');
Route::get('/get-karyawan', [App\Http\Controllers\KaryawanController::class, 'get'])->name('get-karyawan');
Route::post('/save-karyawan', [App\Http\Controllers\KaryawanController::class, 'save'])->name('save-karyawan');
Route::get('/get-byid-karyawan/{id}', [App\Http\Controllers\KaryawanController::class, 'getById'])->name('get-byid-karyawan');
Route::delete('/delete-karyawa/{id}', [App\Http\Controllers\KaryawanController::class, 'delete'])->name('delete-karyawan');
