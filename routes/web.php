<?php

use App\Http\Controllers\authorController;
use App\Http\Controllers\bukuController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\siswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('kelas', kelasController::class)->parameters([
    'kelas' => 'kelas',
]);
Route::resource('siswa', siswaController::class);
Route::resource('buku', bukuController::class);
Route::resource('author', authorController::class);
Route::resource('kategori', kategoriController::class);

require __DIR__.'/auth.php';
