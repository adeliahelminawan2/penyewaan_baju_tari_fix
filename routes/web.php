<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BajuController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenyewaanController;
use App\Models\Baju;
use App\Models\Penyewaan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $baju = Baju::all();

    return view('welcome', compact('baju'));
})->name('beranda');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        $jml_baju = Baju::count();
        $jml_pelanggan = Penyewaan::distinct('id_pelanggan')->count('id_pelanggan');
        $jml_sewa_aktif = Penyewaan::whereIn('status', ['disewa', 'Disewa', 'Proses', 'Belum Kembali'])->count();

        return view('admin.dashboard', compact('jml_baju', 'jml_pelanggan', 'jml_sewa_aktif'));
    })->name('dashboard');

    Route::resource('baju', BajuController::class);

    Route::get('/penyewaan', [PenyewaanController::class, 'index'])->name('penyewaan.index');
    Route::get('/penyewaan/create', [PenyewaanController::class, 'create'])->name('penyewaan.create');
    Route::post('/penyewaan/store', [PenyewaanController::class, 'store'])->name('penyewaan.store');
    Route::get('/penyewaan/nota/{id}', [PenyewaanController::class, 'cetakNota'])->name('penyewaan.nota');
    Route::get('/penyewaan/{id}', [PenyewaanController::class, 'show'])->name('penyewaan.show');

    Route::get('/pengembalian/create/{id}', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('/pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
