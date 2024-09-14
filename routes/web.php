<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IbuController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LansiaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\SasaranController;
use App\Http\Controllers\UserController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');

Route::resource('anak', AnakController::class)->middleware('auth');

Route::resource('kegiatan', KegiatanController::class)->middleware('auth');

Route::resource('pemeriksaan', PemeriksaanController::class)->middleware('auth');

Route::resource('user', UserController::class)->middleware('auth');

Route::resource('sasaran', SasaranController::class)->middleware('auth');

Route::get('/search', [SearchController::class, 'search'])->name('search')->middleware('auth');

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index')->middleware('auth');

Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export-pdf');

Route::get('/laporan/kegiatan', [LaporanController::class, 'exportKegiatanPdf'])->name('laporan.kegiatan.pdf');

Route::get('/laporan/anak', [LaporanController::class, 'exportAnakPdf'])->name('laporan.anak.pdf');

Route::get('/laporan/ibuHamil', [LaporanController::class, 'exportIbuHamilPdf'])->name('laporan.ibuHamil.pdf');

Route::get('/laporan/lansia', [LaporanController::class, 'exportLansiaPdf'])->name('laporan.lansia.pdf');

Route::get('/filter', [DashboardController::class, 'filter'])->name('kegiatan.filter');

Route::get('/filter-kegiatan', [DashboardController::class, 'filterKegiatan']);

Route::get('/users/filter', [UserController::class, 'filter'])->name('user.filter');

Route::get('/kegiatans/filter', [KegiatanController::class, 'filter']);

Route::get('/sasaran/filter', [SasaranController::class, 'filter']);

Route::get('/pemeriksaan/filter', [PemeriksaanController::class, 'filter'])->name('pemeriksaan.filter');

Route::get('/profile', function () {
    return view('profile', ['title' => 'Profile']);
})->name('profile')->middleware('auth');

Route::get('/create', function () {
    return view('tambah-lansia' );
})->middleware('auth');

Route::get('/laporan-kegiatan', function () {
    return view('laporan-kegiatan', ['title' => 'Laporan kegiatan posyandu']);
})->middleware('auth');

Route::get('/laporan-bumil', function () {
    return view('laporan-bumil', ['title' => 'Laporan Data Ibu Hamil']);
})->middleware('auth');

Route::get('/laporan-balita', function () {
    return view('laporan-balita', ['title' => 'Laporan Data Balita']);
})->middleware('auth');

Route::get('/laporan-lansia', function () {
    return view('laporan-lansia', ['title' => 'Laporan Data Lansia']);
})->middleware('auth');
