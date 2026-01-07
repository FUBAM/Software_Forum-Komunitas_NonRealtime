<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Route;

<<<<<<< Updated upstream
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/komunitas', [KomunitasController::class, 'index'])->name('komunitas.index');
    Route::get('/komunitas/{id}', [KomunitasController::class, 'show'])->name('komunitas.show');
    Route::post('/komunitas/join', [KomunitasController::class, 'join'])->name('komunitas.join');

    Route::get('/events', [EventsController::class, 'index'])->name('events.index');
    Route::post('/events/{id}/klaim', [EventsController::class, 'klaimXP'])->name('events.klaim');

    Route::middleware(['can:admin'])->group(function () {
        Route::get('/admin/laporan', [KomunitasController::class, 'listLaporan'])->name('admin.laporan');
    });
=======
// Halaman Depan (Landing)
Route::get('/', function () {
    return view('landing');
});

// Halaman Utama (Dashboard)
Route::get('/home', function () {
    return view('home');
});

// Fitur Komunitas
Route::get('/cari-komunitas', function () {
    return view('cari-komunitas');
});
Route::get('/komunitas-saya', function () {
    return view('komunitas-saya');
});

// Fitur Event
Route::get('/event', function () {
    return view('event');
});
Route::get('/riwayat-event', function () {
    return view('riwayat-event');
});
Route::get('/grup-event', function () {
    return view('grup-event');
});

// Fitur Lainnya
Route::get('/chat', function () {
    return view('chat');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/detail-berita', function () {
    return view('detail-berita');
});
Route::get('/tentang_kami', function () {
    return view('tentang_kami');
});
Route::get('/reset-password', function () {
    return view('reset-password');
>>>>>>> Stashed changes
});