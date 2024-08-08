<?php

use App\Http\Controllers\GaleriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;

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

Route::get('/', [PegawaiController::class, 'index']);

Route::get('/pegawai/data', [PegawaiController::class, 'data'])->name('pegawai.data');
Route::resource('/pegawai', PegawaiController::class);

Route::resource('/galeri', GaleriController::class);
