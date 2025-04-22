<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukuAdminContrller;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/user/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');
});

// Petugas
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/Petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
});
// Siswa
Route::middleware(['auth',])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/index', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/pinjam', [PinjamController::class, 'index'])->name('pinjam.index');
    Route::get('/pinjam/create', [PinjamController::class, 'create'])->name('pinjam.create');
    Route::post('/pinjam', [PinjamController::class, 'store'])->name('pinjam.store');
    Route::get('/reviews/create/{book}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/show/{book}', [ReviewController::class, 'show'])->name('reviews.show');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/Petugas/buku', [BukuController::class, 'index'])->name('petugas.buku.index');
    Route::get('/Petugas/buku/{buku}', [BukuController::class, 'show'])->name('petugas.buku.show');
    Route::get('/Petugas/buku/{buku}/edit', [BukuController::class, 'edit'])->name('petugas.buku.edit');
    Route::put('/Petugas/buku/{buku}', [BukuController::class, 'update'])->name('petugas.buku.update');
    Route::get('/buku/create', [BukuController::class, 'create'])->name('petugas.buku.create');
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::delete('/petugas/buku/{id}', [BukuController::class, 'destroy'])->name('petugas.buku.destroy');
    Route::get('/pinjam', [PinjamController::class, 'index'])->name('pinjam.index');
    Route::get('/pinjam/create', [PinjamController::class, 'create'])->name('pinjam.create');
    Route::put('/pinjam/{loan}/return', [PinjamController::class, 'returnBook'])->name('pinjam.return');
});


require __DIR__.'/auth.php';
