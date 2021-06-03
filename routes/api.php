<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controller
// use App\Http\Controllers\API\ProdiController;
use App\Http\Controllers\API\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'api','prefix' => 'admin', 'namespace' => 'App\Http\Controllers\API\Admin'], function($router) {

    Route::apiResource('prodi', 'ProdiController');
    Route::apiResource('asal', 'AsalPengadaanController');
    Route::apiResource('staff', 'StaffController');
    Route::apiResource('jabatan', 'JabatanController');
    Route::apiResource('user', 'StaffLaboratoriumController');
    Route::apiResource('lokasi', 'LokasiPenyimpananController');
    Route::apiResource('jenis', 'JenisAlatController');
    Route::apiResource('supplier', 'SupplierController');
    Route::apiResource('mahasiswa', 'MahasiswaController');
    Route::apiResource('ruangan', 'RuanganController');
    Route::apiResource('alat', 'AlatController');
    Route::apiResource('detail-alat', 'DetailAlatController');
    Route::apiResource('image-alat', 'ImageAlatController');
    Route::apiResource('laporan', 'LaporanKerusakanController');
    Route::apiResource('peminjaman', 'PeminjamanController');
    
    // Filter Route
    Route::post('filter/prodi', 'ProdiController@filter')->name('filter.prodi');
    Route::post('filter/asal', 'AsalPengadaanController@filter')->name('filter.asal');
    Route::post('filter/jabatan', 'JabatanController@filter')->name('filter.jabatan');
    Route::post('filter/staff', 'StaffController@filter')->name('filter.staff');
    Route::post('filter/user', 'StaffLaboratoriumController@filter')->name('filter.user');
    Route::post('filter/lokasi', 'LokasiPenyimpananController@filter')->name('filter.lokasi');
    Route::post('filter/jenis', 'JenisAlatController@filter')->name('filter.jenis');
    Route::post('filter/supplier', 'SupplierController@filter')->name('filter.supplier');
    Route::post('filter/mahasiswa', 'MahasiswaController@filter')->name('filter.mahasiswa');
    Route::post('filter/ruangan', 'RuanganController@filter')->name('filter.ruangan');
    Route::post('filter/alat', 'AlatController@filter')->name('filter.alat');
    Route::post('filter/detail-alat/{alatId}', 'DetailAlatController@filter')->name('filter.detailalat');
    Route::post('filter/laporan', 'LaporanKerusakanController@filter')->name('filter.laporan');
    Route::post('filter/peminjaman', 'PeminjamanController@filter')->name('filter.peminjaman');

    // Custom Method Route
    Route::get('lokasi/available/{totalNeed}', 'LokasiPenyimpananController@getAvailableLokasi')->name('lokasi.available-lokasi');
    
    Route::get('detail-alat/get-by-alat-id/{alat_id}', 'DetailAlatController@getByAlatId')->name('detail-alat.get-alat-by-alatid');
    
    Route::put('detail-alat/update-condition/{alat_id}', 'DetailAlatController@updateConditionStatus')->name('detail-alat.update-condition');
    
    Route::put('detail-alat/update-available/{alat_id}', 'DetailAlatController@updateAvailableStatus')->name('detail-alat.update-available');

    Route::get('image-alat/get-by-alat-id/{alat_id}', 'ImageAlatController@getImageByAlatId')->name('image-alat.get-image-by-alatid');

    Route::put('laporan/report-action/{laporan_id}', 'LaporanKerusakanController@reportAction')->name('laporan.report-action');
    
    Route::put('peminjaman/approve-action/{peminjaman_id}', 'PeminjamanController@approveAction')->name('peminjaman.approve-action');


    Route::post('auth/logout', 'AuthController@signout')->name('auth.logout');
});

Route::group(['prefix' => 'admin','namespace' => 'App\Http\Controllers\API\Admin'], function($router){
    Route::post('auth', 'AuthController@login')->name('auth.login');
});

Route::group(['prefix' => 'peminjaman', 'namespace' => 'App\Http\Controllers\API\Peminjaman'], function($router){
    Route::post('/add-mahasiswa', 'PeminjamController@addNewMahasiswa')->name('peminjam.add-mahasiswa');
    Route::post('/add-laporan-kerusakan', 'PeminjamController@addNewLaporanKerusakan')->name('peminjam.add-laporan-kerusakan');
});
