<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\SearchController;

// ==================== ROUTING UNTUK APLIKASI ====================

// Route untuk halaman utama (Home) yang akan menampilkan daftar tugas utama
Route::get('/', [TaskController::class, 'index'])->name('home');

Route::get('/profile', [TaskController::class, 'profile'])->name('profile');

// Resource controller untuk mengelola daftar tugas (lists)
// Secara otomatis mencakup route untuk:
// - index (menampilkan semua daftar tugas)
// - create (menampilkan form pembuatan daftar tugas baru)
// - store (menyimpan daftar tugas baru)
// - show (menampilkan satu daftar tugas)
// - edit (menampilkan form edit daftar tugas)
// - update (memperbarui daftar tugas)
// - destroy (menghapus daftar tugas)
Route::resource('lists', TaskListController::class);

// Route untuk fitur pencarian tugas dan daftar tugas
Route::get('search', [SearchController::class, 'search'])->name('search'); 

// Resource controller untuk mengelola tugas (tasks)
// Sama seperti daftar tugas, ini mencakup operasi CRUD (Create, Read, Update, Delete)
Route::resource('tasks', TaskController::class);

// Route tambahan untuk menandai tugas sebagai selesai
// Menggunakan metode PATCH karena hanya memperbarui status tugas
Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

Route::patch('/tasks/{task}/change-list', [TaskController::class, 'changeList'])->name('tasks.changeList');