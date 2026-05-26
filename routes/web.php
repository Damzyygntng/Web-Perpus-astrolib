<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminPeminjamanController;
use App\Http\Controllers\DashboardController;
use App\Models\Peminjaman;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanUserController;
use App\Http\Controllers\LaporanPetugasController;
use App\Http\Controllers\LaporanPeminjamanController;
use App\Http\Controllers\LaporanPengembalianController;
use App\Http\Controllers\DashboardPetugasController;
use App\Http\Controllers\PetugasKelolaBukuController;
use App\Http\Controllers\PetugasPeminjamanController;
use App\Http\Controllers\PetugasPengembalianController;
use App\Http\Controllers\PetugasLaporanController;
use App\Http\Controllers\KoleksiPribadiController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', function () {
    return view('user.login');
});

Route::get('/register', function () {
    return view('user.register');
});

Route::get('/landingpage', function () {
    return view('user.landingpage');
});

Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::get('/peminjaman', function () {

    $peminjaman = Peminjaman::with('buku')
        ->where('user_id', auth()->id())
        ->get();

    $sedangDipinjam = Peminjaman::where('user_id', auth()->id())
        ->where('status', 'disetujui')
        ->count();

    return view('user.peminjaman', compact('peminjaman', 'sedangDipinjam'));

})->middleware('auth');

Route::get('/pengembalian', [PengembalianController::class, 'index']);

Route::post('/pengembalian/konfirmasi/{id}', [PengembalianController::class, 'konfirmasi']);

Route::post(
    '/pengembalian/tolak/{id}',
    [PengembalianController::class, 'tolak']
);

Route::post('/koleksi/{id}', [KoleksiPribadiController::class, 'store']);

Route::get('/koleksiprib', [KoleksiPribadiController::class, 'index']);

Route::get('/koleksibuku', [BukuController::class, 'index'])
    ->middleware('auth');

Route::get('/editprofile', function () {
    return view('user.editprofile');
})->middleware('auth');

Route::post('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('password.update');
Route::post('/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');

Route::get('/login-admin', function () {
    return view('admin.admin');
});

Route::post('/login-admin', [AdminController::class, 'loginAdmin'])
    ->name('login.admin');

Route::get('/dashboard-admin', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/petugas-dashboard', [DashboardPetugasController::class, 'index'])
    ->name('petugas.dashboard')
    ->middleware('auth');

Route::get('/buku/{id}', [BukuController::class, 'show']);

Route::get('/pinjam/{id}', [BukuController::class, 'pinjam']);

Route::post('/pinjam', [PeminjamanController::class, 'store'])
    ->name('pinjam.store');

Route::post('/ulasan', [UlasanController::class, 'store'])
    ->middleware('auth');

Route::get('/kelolapeminjaman', [AdminController::class, 'index']);

Route::post('/peminjaman/terima/{id}', [AdminPeminjamanController::class, 'terima']);

Route::post('/peminjaman/tolak/{id}', [AdminPeminjamanController::class, 'tolak']);

Route::get('/cetak-bukti/{id}', [PeminjamanController::class, 'cetakBukti']); 

Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori/store', [KategoriController::class, 'store']);
Route::put('/kategori/update/{id}', [KategoriController::class, 'update']);
Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy']);

Route::get('/admin/kelola-buku', [BukuController::class, 'kelola']);
Route::post('/buku/store', [BukuController::class, 'store']);
Route::put('/buku/update/{id}', [BukuController::class, 'update']);
Route::delete('/buku/delete/{id}', [BukuController::class, 'destroy']);

Route::get('/kelolauser', [UserController::class, 'index']);

Route::post('/user/store', [UserController::class, 'store'])
    ->name('user.store');

Route::put('/user/update/{id}', [UserController::class, 'update']);

Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

Route::get('/kelolapetugas', [PetugasController::class, 'index'])
    ->name('kelolapetugas');

Route::post('/petugas/store', [PetugasController::class, 'store'])
    ->name('petugas.store');

Route::put('/petugas/update/{id}', [PetugasController::class, 'update']);

Route::delete('/petugas/delete/{id}', [PetugasController::class, 'destroy']);

// ADMIN KELOLA PENGEMBALIAN
Route::get(
    '/admin/pengembalian',
    [PengembalianController::class, 'admin']
);

// TERIMA PENGEMBALIAN
Route::post(
    '/admin/pengembalian/terima/{id}',
    [PengembalianController::class, 'terima']
);

// TOLAK PENGEMBALIAN
Route::post(
    '/admin/pengembalian/tolak/{id}',
    [PengembalianController::class, 'tolak']
);

Route::get('/pengembalian/cetak/{id}', [PengembalianController::class, 'cetakBukti']);

Route::get(
    '/ajukan-pengembalian/{id}',
    [PengembalianController::class, 'ajukanLagi']
);

Route::get('/kelolaulasan', [UlasanController::class, 'index']);
Route::delete('/ulasan/delete/{id}', [UlasanController::class, 'destroy']);

Route::get('/laporanbuku', [LaporanController::class, 'index'])
    ->name('laporan.index');

Route::get('/laporanbuku/cetak', [LaporanController::class, 'cetakPdf'])
    ->name('laporan.buku.cetak');

   Route::get('/laporanuser', [LaporanUserController::class, 'index']);

Route::get('/laporanuser/pdf', [LaporanUserController::class, 'cetakPdf']);

Route::get('/laporanpetugas', [LaporanPetugasController::class, 'index']);
Route::get('/laporanpetugas/cetak', [LaporanPetugasController::class, 'cetak']);

Route::get('/laporanpeminjaman', [LaporanPeminjamanController::class, 'index']);
Route::get('/laporanpeminjaman/cetak', [LaporanPeminjamanController::class, 'cetak']);

Route::get('/laporanpengembalian', [LaporanPengembalianController::class, 'index']);
Route::get('/cetakpengembalian', [LaporanPengembalianController::class, 'cetak']);

Route::middleware(['auth', 'cekrole:petugas'])->group(function () {

    Route::get('/petugas/kelolabuku', [PetugasKelolaBukuController::class, 'index']);

    Route::post('/petugas/kelolabuku', [PetugasKelolaBukuController::class, 'store']);

    Route::put('/petugas/kelolabuku/update/{id}', [PetugasKelolaBukuController::class, 'update']);

    Route::delete('/petugas/kelolabuku/delete/{id}', [PetugasKelolaBukuController::class, 'destroy']);

});

Route::middleware(['auth', 'cekrole:petugas'])->group(function () {

    Route::get('/petugaspinjam', [PetugasPeminjamanController::class, 'index']);

    Route::put('/petugaspinjam/setujui/{id}', [PetugasPeminjamanController::class, 'setujui']);

    Route::put('/petugaspinjam/tolak/{id}', [PetugasPeminjamanController::class, 'tolak']);
});

Route::get('/petugas/pengembalian',
[PetugasPengembalianController::class, 'index']);

Route::post('/petugas/pengembalian/terima/{id}',
[PetugasPengembalianController::class, 'terima']);

Route::post('/petugas/pengembalian/tolak/{id}',
[PetugasPengembalianController::class, 'tolak']);

Route::get('/petugas/laporanbuku',
[PetugasLaporanController::class, 'buku']);

Route::get('/petugas/laporanbuku/pdf',
[PetugasLaporanController::class, 'cetakBuku']);

Route::get('/petugas/laporanpeminjaman',
[PetugasLaporanController::class, 'peminjaman']);

Route::get('/petugas/laporanpeminjaman/pdf',
[PetugasLaporanController::class, 'cetakPeminjaman']);

Route::get('/petugas/laporanpengembalian',
[PetugasLaporanController::class, 'pengembalian']);

Route::get('/petugas/laporanpengembalian/pdf',
[PetugasLaporanController::class, 'cetakPengembalian']);

Route::get('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect('/login');

});

Route::get('/detail/{id}', [BukuController::class, 'show']);