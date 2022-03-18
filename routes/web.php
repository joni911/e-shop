<?php

use App\Http\Controllers\barangController;
use App\Http\Controllers\jenis_kontrakController;
use App\Http\Controllers\jenis_pengadaanController;
use App\Http\Controllers\katagori_barangController;
use App\Http\Controllers\komentarController;
use App\Http\Controllers\metode_pengadaanController;
use App\Http\Controllers\StatusTenderController;
use App\Models\katagori_barang;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['middleware' => 'auth' ])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/barang',barangController::class);
    Route::get('/CreatePhoto',[barangController::class,'create_photo'])->name('photo.buat');
    Route::get('/foto/barang/{id}',[barangController::class,'edit_photo'])->name('photo.edit');
    Route::post('/photoStore',[barangController::class,'photoStore'])->name('photo.simpan');
    Route::resource('/katagori', katagori_barangController::class);
    Route::resource('komentar',komentarController::class);

    //resource
    Route::resource('jenis_pengadaan',jenis_pengadaanController::class);
    Route::resource('jenis_kontrak',jenis_kontrakController::class);
    Route::resource('metode_pengadaan',metode_pengadaanController::class);
    Route::resource('status_tender',StatusTenderController::class);
    
});

