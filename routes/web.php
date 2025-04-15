<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanBarangController;
use App\Http\Controllers\LaporanBarangKeluarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManajerController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanUangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RegisterController;

// 🚀 **Halaman Utama -> Login**
Route::get('/', function () {
    return redirect('/login');
});

// 🚀 **Register & Login**
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 🚀 **Role: Admin**
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('dashboard.admin');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/{barang}', [BarangController::class, 'show'])->name('barang.show');
    Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::resource('pelanggan', PelangganController::class);
    Route::get('/laporan/barang', [LaporanBarangController::class, 'index'])->name('laporan.barang');
    Route::get('/laporan/barang', [LaporanBarangController::class, 'index'])->name('laporan.barang');
    Route::get('/laporan/barang/export-excel', [LaporanBarangController::class, 'exportExcel'])->name('laporan.barang.excel');
    Route::get('/laporan/barang/export-pdf', [LaporanBarangController::class, 'exportPDF'])->name('laporan.barang.pdf');


    Route::resource('kategori', KategoriController::class);
    Route::resource('pembelian', PembelianController::class);
    Route::resource('users', UserController::class);
    Route::resource('pemasok', PemasokController::class);
});

// 🚀 **Role: Kasir**
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/dashboard-kasir', [KasirController::class, 'index'])->name('dashboard.kasir');
    Route::get('/laporan/penjualan', [LaporanPenjualanController::class, 'penjualan'])->name('laporan.penjualan');
    Route::get('/laporan/uang-masuk', [LaporanUangController::class, 'uangMasuk'])->name('laporan.uang-masuk');
    Route::get('/laporan/uang-masuk/pdf', [LaporanUangController::class, 'uangMasukPDF'])->name('laporan.uang-masuk.pdf');
    Route::get('/laporan/uang-masuk/excel', [LaporanUangController::class, 'uangMasukExcel'])->name('laporan.uang-masuk.excel');
    Route::get('/laporan/barang-keluar', [LaporanBarangKeluarController::class, 'index'])->name('laporan.barang-keluar');
    Route::get('/laporan/barang-keluar/pdf', [LaporanBarangKeluarController::class, 'exportPdf'])->name('laporan.barang-keluar.pdf');
    Route::get('/laporan/barang-keluar/excel', [LaporanBarangKeluarController::class, 'exportExcel'])->name('laporan.barang-keluar.excel');

    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::post('/penjualan/checkout', [PenjualanController::class, 'checkout'])->name('penjualan.checkout');
    Route::post('/penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
});

// 🚀 **Role: Manajer**
Route::middleware(['auth', 'role:manajer'])->group(function () {
    Route::get('/dashboard-manajer', [ManajerController::class, 'index'])->name('dashboard.manajer');
});

// 🚀 **Middleware untuk Membership**
Route::middleware('auth')->group(function () {
    Route::get('/membership/register', [MembershipController::class, 'showRegisterForm'])->name('membership.register');
    Route::post('/membership/register', [MembershipController::class, 'register']);
});

// Route untuk Pengajuan Barang (Tanpa Harus Login)
Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
Route::delete('/pengajuan/delete/{id}', [PengajuanController::class, 'destroy'])->name('pengajuan.destroy');
Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::get('/export/excel', [ExportController::class, 'exportExcel'])->name('export.excel');
Route::get('/export/pdf', [ExportController::class, 'exportPdf'])->name('export.pdf');
Route::post('/pengajuan/{id}/update-status', [PengajuanController::class, 'updateStatus']);

// 🚀 **Rute Penjualan & Laporan**
Route::resource('penjualan', PenjualanController::class);
Route::get('/laporan/penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan.penjualan');
Route::get('/laporan/penjualan/cetak', [LaporanPenjualanController::class, 'cetak'])->name('laporan.cetak');

// 🚀 **Halaman Statis**
Route::view('/menu', 'menu')->name('menu');
Route::view('/stok', 'stok')->name('stok');
Route::view('/order-list', 'order-list')->name('order-list');
Route::view('/history', 'history')->name('history');

// 🚀 **Unauthorized Access**
Route::view('/unauthorized', 'errors.unauthorized')->name('unauthorized');
