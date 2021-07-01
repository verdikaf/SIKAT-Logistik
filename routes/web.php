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

//auth
Route::get('/', 'AuthController@index');
Route::post('/', 'AuthController@login');
Route::get('/user-validate/{pegawai}', 'PegawaiController@user_validate');

Route::group(['middleware' => 'AuthLogin'], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/auth/logout', 'AuthController@logout');

    //satuan
    Route::get('/master-data/satuan', 'SatuanController@index');
    Route::get('/master-data/satuan/create', 'SatuanController@create');
    Route::post('/master-data/satuan', 'SatuanController@store');
    Route::get('/master-data/satuan/{satuan}', 'SatuanController@show');
    Route::get('/master-data/satuan/{satuan}/edit', 'SatuanController@edit');
    Route::put('/master-data/satuan/{satuan}', 'SatuanController@update');
    Route::delete('/master-data/satuan/{satuan}', 'SatuanController@destroy');

    //kategori
    Route::get('/master-data/kategori', 'KategoriController@index');
    Route::get('/master-data/kategori/create', 'KategoriController@create');
    Route::post('/master-data/kategori', 'KategoriController@store');
    Route::get('/master-data/kategori/{kategori}', 'KategoriController@show');
    Route::get('/master-data/kategori/{kategori}/edit', 'KategoriController@edit');
    Route::put('/master-data/kategori/{kategori}', 'KategoriController@update');
    Route::delete('/master-data/kategori/{kategori}', 'KategoriController@destroy');

    //supplier
    Route::get('/master-data/supplier', 'SupplierController@index');
    Route::get('/master-data/supplier/create', 'SupplierController@create');
    Route::post('/master-data/supplier', 'SupplierController@store');
    Route::get('/master-data/supplier/{supplier}', 'SupplierController@show');
    Route::get('/master-data/supplier/{supplier}/edit', 'SupplierController@edit');
    Route::put('/master-data/supplier/{supplier}', 'SupplierController@update');
    Route::delete('/master-data/supplier/{supplier}', 'SupplierController@destroy');

    //logistik
    Route::get('/master-data/logistik', 'LogistikController@index');
    Route::get('/master-data/logistik/create', 'LogistikController@create');
    Route::post('/master-data/logistik', 'LogistikController@store');
    Route::get('/master-data/logistik/{logistik}', 'LogistikController@show');
    Route::get('/master-data/logistik/{logistik}/edit', 'LogistikController@edit');
    Route::put('/master-data/logistik/{logistik}', 'LogistikController@update');
    Route::delete('/master-data/logistik/{logistik}', 'LogistikController@destroy');

    //pegawai
    Route::get('/data-pegawai/pegawai', 'PegawaiController@index');
    Route::get('/data-pegawai/pegawai/create', 'PegawaiController@create');
    Route::post('/data-pegawai/pegawai', 'PegawaiController@store');
    Route::get('/data-pegawai/pegawai/{pegawai}', 'PegawaiController@show');
    Route::get('/data-pegawai/pegawai/{pegawai}/edit', 'PegawaiController@edit');
    Route::put('/data-pegawai/pegawai/{pegawai}', 'PegawaiController@update');
    Route::delete('/data-pegawai/pegawai/{pegawai}', 'PegawaiController@destroy');

    Route::get('/profil', 'PegawaiController@profil');
    Route::put('/profil/{profil}', 'PegawaiController@updateProfil');

    //role
    Route::get('/data-pegawai/role', 'RoleController@index');
    Route::get('/data-pegawai/role/create', 'RoleController@create');
    Route::post('/data-pegawai/role', 'RoleController@store');
    Route::get('/data-pegawai/role/{role}', 'RoleController@show');
    Route::get('/data-pegawai/role/{role}/edit', 'RoleController@edit');
    Route::put('/data-pegawai/role/{role}', 'RoleController@update');
    Route::delete('/data-pegawai/role/{role}', 'RoleController@destroy');

    //transaksi masuk
    Route::get('/transaksi/t_masuk', 'TransaksiMasukController@index');
    Route::get('/transaksi/t_masuk/create', 'TransaksiMasukController@create');
    Route::post('/transaksi/t_masuk', 'TransaksiMasukController@store');
    Route::get('/transaksi/t_masuk/{t_masuk}', 'TransaksiMasukController@show');
    Route::get('/transaksi/t_masuk/{t_masuk}/edit', 'TransaksiMasukController@edit');
    Route::put('/transaksi/t_masuk/{t_masuk}', 'TransaksiMasukController@update');
    Route::delete('/transaksi/t_masuk/{t_masuk}', 'TransaksiMasukController@destroy');

    Route::get('/transaksi/t_masuk/{id}/cart', 'TransaksiMasukController@cart');
    Route::post('/transaksi/t_masuk/cart', 'TransaksiMasukController@store_cart');
    Route::get('/transaksi/t_masuk/cart/{transaksi_masuk_id}/{logistik_id}', 'TransaksiMasukController@delete_cart');
    Route::get('/transaksi/t_masuk/cart/{transaksi_masuk_id}', 'TransaksiMasukController@submit_cart');
    Route::get('/transaksi/t_masuk/verifikasiAll/{transaksi_masuk_id}', 'TransaksiMasukController@verif_all');

    Route::get('/verifikasiCartMasuk/{transaksi_masuk_id}/{logistik_id}/{expired}', 'TransaksiMasukController@verif_cart');
    Route::post('/verifikasiCartMasuk/false', 'TransaksiMasukController@verif_cart_false');
    Route::post('/addSupplier', 'TransaksiMasukController@store_supplier');
    Route::post('/addLogistik', 'TransaksiMasukController@store_logistik');

    Route::get('/transaksi/t_masuk/{id}/cetak', 'TransaksiMasukController@cetak');

    //transaksi keluar
    Route::get('/transaksi/t_keluar', 'TransaksiKeluarController@index');
    Route::get('/transaksi/t_keluar/create', 'TransaksiKeluarController@create');
    Route::post('/transaksi/t_keluar', 'TransaksiKeluarController@store');
    Route::get('/transaksi/t_keluar/{t_keluar}', 'TransaksiKeluarController@show');
    Route::get('/transaksi/t_keluar/{t_keluar}/edit', 'TransaksiKeluarController@edit');
    Route::put('/transaksi/t_keluar/{t_keluar}', 'TransaksiKeluarController@update');
    Route::delete('/transaksi/t_keluar/{t_keluar}', 'TransaksiKeluarController@destroy');

    Route::get('/transaksi/t_keluar/{id}/cart', 'TransaksiKeluarController@cart');
    Route::post('/transaksi/t_keluar/cart', 'TransaksiKeluarController@store_cart');
    Route::get('/transaksi/t_keluar/cart/{transaksi_keluar_id}/{logistik_id}', 'TransaksiKeluarController@delete_cart');
    Route::get('/transaksi/t_keluar/cart/{transaksi_keluar_id}', 'TransaksiKeluarController@submit_cart');
    Route::get('/transaksi/t_keluar/verifikasiAll/{transaksi_keluar_id}', 'TransaksiKeluarController@verif_all');

    Route::get('/verifikasiCartKeluar/{transaksi_keluar_id}/{logistik_id}', 'TransaksiKeluarController@verif_cart');
    Route::post('/verifikasiCartKeluar/false', 'TransaksiKeluarController@verif_cart_batal');
    // Route::get('/verifikasiCartKeluar/{transaksi_keluar_id}/{logistik_id}', 'TransaksiKeluarController@verif_cart')->name('verifikasiCartKeluar');
    // Route::get('/batalCartKeluar/{transaksi_keluar_id}/{logistik_id}', 'TransaksiKeluarController@verif_cart_batal')->name('batalCartKeluar');

    Route::get('/transaksi/t_keluar/{id}/cetak', 'TransaksiKeluarController@cetak');

    //transaksi kembali
    Route::get('/transaksi/t_kembali', 'TransaksiKembaliController@index');
    Route::get('/transaksi/t_kembali/create', 'TransaksiKembaliController@create');
    Route::post('/transaksi/t_kembali', 'TransaksiKembaliController@store');
    Route::get('/transaksi/t_kembali/{t_kembali}', 'TransaksiKembaliController@show');
    Route::get('/transaksi/t_kembali/{t_kembali}/edit', 'TransaksiKembaliController@edit');
    Route::put('/transaksi/t_kembali/{t_kembali}', 'TransaksiKembaliController@update');
    Route::delete('/transaksi/t_kembali/{t_kembali}', 'TransaksiKembaliController@destroy');

    Route::get('/transaksi/t_kembali/{id}/cart', 'TransaksiKembaliController@cart');
    Route::get('/transaksi/t_kembali/logistik_kembali/{transaksi_keluar_id}', 'TransaksiKembaliController@verif_back');

    Route::get('/logistikKembali/{transaksi_keluar_id}/{logistik_id}', 'TransaksiKembaliController@logistik_kembali')->name('logistikKembali');

    //laporan
    Route::get('/laporan/log_masuk', 'LaporanController@lap_masuk');
    Route::get('/laporan/log_keluar', 'LaporanController@lap_keluar');
    Route::get('/laporan/supplier', 'LaporanController@lap_supplier');

    Route::get('/laporan/log_masuk/print', 'LaporanController@lap_masuk_print');
    Route::get('/laporan/log_keluar/print', 'LaporanController@lap_keluar_print');
    Route::get('/laporan/supplier/print', 'LaporanController@lap_supplier_print');
});
