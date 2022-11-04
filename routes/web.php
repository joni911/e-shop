<?php

use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\AdministrasiDetailController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\DaftarPesertaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileTeknisController;
use App\Http\Controllers\jenis_kontrakController;
use App\Http\Controllers\jenis_pengadaanController;
use App\Http\Controllers\katagori_barangController;
use App\Http\Controllers\komentarController;
use App\Http\Controllers\KoreksiController;
use App\Http\Controllers\ManagemenController;
use App\Http\Controllers\metode_pengadaanController;
use App\Http\Controllers\MetodePengadaanController;
use App\Http\Controllers\PekerjaanBerjalanController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\PenawaranFileController;
use App\Http\Controllers\PenawaranPesertaController;
use App\Http\Controllers\PenawaranPesertaFileController;
use App\Http\Controllers\PengalamanTenderController;
use App\Http\Controllers\PenilaianAdministrasiController;
use App\Http\Controllers\PenilaianKualifikasiController;
use App\Http\Controllers\PenilaianPenawaranPesertaController;
use App\Http\Controllers\PenilaianTeknisController;
use App\Http\Controllers\PenilaianTenderController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\PerubahanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\StatusTenderController;
use App\Http\Controllers\SyaratController;
use App\Http\Controllers\SyaratDetailController;
use App\Http\Controllers\TahapanController;
use App\Http\Controllers\TenagaAhliController;
use App\Http\Controllers\tenderController;
use App\Http\Controllers\TenderFileController;
use App\Http\Controllers\TenderFileDetailController;
use App\Http\Controllers\TenderHomeController;
use App\Http\Controllers\TenderKomenController;
use App\Http\Controllers\TenderPersyaratanController;
use App\Http\Controllers\TenderPersyaratanFileController;
use App\Http\Controllers\UserBarangController;
use App\Http\Controllers\ValidasiFileController;
use App\Models\penilaian_tender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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
Auth::routes(['verify' => true]);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::middleware(['middleware' => 'auth','verified' ])->group(function () {
    Route::get('/home', [TenderHomeController::class, 'index'])->name('home');
    Route::resource('/barang',barangController::class);
    //barang admin
    Route::get('/CreatePhoto',[barangController::class,'create_photo'])->name('photo.buat');
    Route::get('/foto/barang/{id}',[barangController::class,'edit_photo'])->name('photo.edit');
    Route::post('/photoStore',[barangController::class,'photoStore'])->name('photo.simpan');
    Route::resource('/katagori', katagori_barangController::class);
    Route::resource('komentar',komentarController::class);

    //barang user
    Route::resource('shops', UserBarangController::class);
    Route::get('shops/add/{id}',[UserBarangController::class,'add'])->name('shops.add');

    //resource Master
    Route::resource('jenis_pengadaan',jenis_pengadaanController::class);
    Route::resource('jenis_kontrak',jenis_kontrakController::class);
    Route::resource('metode_pengadaan',MetodePengadaanController::class);
    Route::resource('status_tender',StatusTenderController::class);
    Route::get('send',[StatusTenderController::class,'send'])->name('send');
    route::get('test',[StatusTenderController::class,'test']);
    Route::resource('tahapan',TahapanController::class);

    //Resource Tender
    Route::resource('tender_admin',tenderController::class);
    Route::get('/tender_admin/syarat/{id}',[tenderController::class ,'show_syarat'])->name('tender_admin.syarat');
    Route::get('/tender_admin/tahapan/{id}',[tenderController::class ,'show_tahapan'])->name('tender_admin.tahapan');
    Route::resource('perubahan',PerubahanController::class);
    //Home
    Route::resource('tender_home',TenderHomeController::class);
    //Syarat
    Route::resource('syarat',SyaratController::class);
    Route::resource('syarat_detail',SyaratDetailController::class);
    //FILES
    Route::resource('tender_file',TenderFileController::class);
    Route::resource('tender_file_detail',TenderFileDetailController::class);
    //Peserta
    Route::resource('administrasi', AdministrasiController::class);
    Route::resource('peserta',PesertaController::class);
    Route::get('peserta/tender/{id}',[PesertaController::class,'show_peserta'])->name('peserta.tender');
    Route::get('peserta/{id}/file_tender/{pid}',[PesertaController::class,'show_file_peserta'])->name('peserta.file');
    Route::resource('pengalaman', PengalamanTenderController::class);
    Route::resource('tenagaahli', TenagaAhliController::class);
    Route::resource('peralatan', PeralatanController::class);
    Route::resource('pekerjaan_berjalan', PekerjaanBerjalanController::class);
    Route::resource('managemen', ManagemenController::class);
    Route::resource('validasi_file', ValidasiFileController::class);
    Route::resource('tender_persyarat', TenderPersyaratanController::class);
    Route::resource('tender_persyaratan_file', TenderPersyaratanFileController::class);
    Route::resource('penawaran', PenawaranController::class);
    Route::resource('penawaran_file', PenawaranFileController::class);
    Route::resource('penawaran_peserta', PenawaranPesertaController::class);
    Route::resource('penawaran_peserta_file', PenawaranPesertaFileController::class);
    Route::resource('administrasi_list', AdministrasiDetailController::class);
    Route::resource('file_teknis', FileTeknisController::class);
    //daftar peserta
    Route::resource('daftar_peserta', DaftarPesertaController::class);
    //Komentar
    Route::resource('komen', TenderKomenController::class);
    Route::resource('koreksi', KoreksiController::class);
    Route::resource('pemeriksaan', PemeriksaanController::class);
    //penilaian
    Route::resource('p_admin', PenilaianAdministrasiController::class);
    Route::resource('p_kualifikasi', PenilaianKualifikasiController::class);
    Route::resource('p_teknis', PenilaianTeknisController::class);
    Route::resource('p_peserta', PenilaianPenawaranPesertaController::class);
    //dashboard
    Route::resource('dashboard', DashboardController::class);
    Route::resource('periksa', PenilaianTenderController::class);
    //mail
    Route::get('testmail', function () {
        $user = Auth::user();
        $pt = $user->peserta->nama_pt;
        $details = [
            'PT' => $pt,
            'title' => 'Mail from Online Web Tutor',
            'body' => 'Test mail sent by Laravel 8 using SMTP.'
        ];

        Mail::to('artha699@gmail.com')->send(new \App\Mail\VMail($details));

        dd("Email is Sent, please check your inbox.");
    });

    Route::post('send_hasil', [PesertaController::class,'send_hasil'])->name('send.hasil');

});

