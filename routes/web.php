<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/login', function () {
    return view('login');
});

Route::get('/', function () {
    return view('dashboard', ['title' => 'Dashboard']);
});

Route::get('/bumil', function () {
    return view('HalBumil', ['title' => 'Data Ibu Hamil']);
});

Route::get('/tambahDataBumil', function () {
    return view('add-bumil', ['title' => 'Tambah Data Ibu Hamil']);
});

Route::get('/ibu', function () {
    return view('HalIbu', ['title' => 'Data Ibu']);
});

Route::get('/tambahDataIbu', function () {
    return view('add-ibu', ['title' => 'Tambah Data Ibu']);
});

Route::get('/balita', function () {
    return view('HalBalita', ['title' => 'Data Anak']);
});

Route::get('/tambahDataBalita', function () {
    return view('add-balita', ['title' => 'Tambah Data Anak']);
});

Route::get('/lansia', function () {
    return view('HalLansia', ['title' => 'Data Lansia']);
});

Route::get('/tambahDataLansia', function () {
    return view('add-lansia', ['title' => 'Tambah Data Lansia']);
});


Route::get('/kegiatan', function () {
    return view('kegiatan', ['title' => 'Kegiatan Posyandu']);
});

Route::get('/pelayanan-bumil', function () {
    return view('pelayanan-Bumil', ['title' => 'Pelayanan Ibu Hamil']);
});

Route::get('/pelayanan-balita', function () {
    return view('Pelayanan-Balita', ['title' => 'Pelayanan Balita']);
});

Route::get('/pelayanan-lansia', function () {
    return view('pelayanan-Lansia', ['title' => 'Pelayanan Lansia']);
});

Route::get('/laporan-kegiatan', function () {
    return view('laporan-kegiatan', ['title' => 'Laporan kegiatan posyandu']);
});

Route::get('/laporan-bumil', function () {
    return view('laporan-bumil', ['title' => 'Laporan Data Ibu Hamil']);
});

Route::get('/laporan-balita', function () {
    return view('laporan-balita', ['title' => 'Laporan Data Balita']);
});

Route::get('/laporan-lansia', function () {
    return view('laporan-lansia', ['title' => 'Laporan Data Lansia']);
});

Route::get('/profile', function () {
    return view('profile', ['title' => 'Profile']);
});

Route::get('/admin', function () {
    return view('dashboardAdmin', ['title' => 'Dashboard Admin']);
});

Route::get('/kader-posyandu', function () {
    return view('kader', ['title' => 'Data Kader Posyandu']);
});

Route::get('/sasaran-posyandu', function () {
    return view('sasaran', ['title' => 'Data Sasaran Posyandu']);
});

Route::get('/kegiatan-pelayanan', function () {
    return view('kegiatan-pelayanan', ['title' => 'Data Kegiatan dan Pelayanan Posyandu']);
});