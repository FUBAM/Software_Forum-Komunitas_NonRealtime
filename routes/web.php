<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesanGrupController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LaporanController;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/home', [LandingController::class, 'index'])->name('home');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.detail');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| KOMUNITAS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/komunitas', [KomunitasController::class, 'index'])->name('komunitas.index');
    Route::get('/komunitas/{id}', [KomunitasController::class, 'show'])->name('komunitas.show');
    Route::post('/komunitas/join', [KomunitasController::class, 'join'])->name('komunitas.join');
    Route::get('/komunitas-saya', [KomunitasController::class, 'myCommunities'])->name('komunitas.my');
    Route::get('/komunitas/{id}/events', [KomunitasController::class, 'events'])->name('komunitas.events');

});

/*
|--------------------------------------------------------------------------
| EVENTS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/events', [EventsController::class, 'index'])->name('events.index');
    Route::get('/events/riwayat', [EventsController::class, 'riwayat'])->name('events.riwayat');
    Route::get('/events/{id}', [EventsController::class, 'show'])->name('events.show');
    Route::post('/events/{id}/klaim', [EventsController::class, 'klaimXP'])->name('events.klaim');

});

/*
|--------------------------------------------------------------------------
| PEMBAYARAN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/events/{id}/bayar', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/events/{id}/bayar', [PembayaranController::class, 'store'])->name('pembayaran.store');

});

/*
|--------------------------------------------------------------------------
| CHAT (NON REALTIME)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/grup/{id}/chat', [PesanGrupController::class, 'chat'])->name('grup.chat');
    Route::post('/grup/{id}/chat', [PesanGrupController::class, 'sendMessage'])->name('grup.chat.send');

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'adminIndex'])
        ->name('admin.dashboard');

    // Pembayaran
    Route::post('/admin/pembayaran/{id}/verifikasi', [PembayaranController::class, 'verify'])
        ->name('admin.pembayaran.verify');

    // Berita
    Route::resource('/admin/berita', BeritaController::class);


    // Laporan
    Route::get('/admin/laporan', [LaporanController::class, 'index'])
        ->name('admin.laporan.index');
    Route::post('/admin/laporan/{id}/resolve', [LaporanController::class, 'resolve'])
        ->name('admin.laporan.resolve');

});

/*
|--------------------------------------------------------------------------
| PROFILE (PUBLIC)
|--------------------------------------------------------------------------
*/


Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


// Route::get('/profile', function (Request $request) {
//     $viewedUser = null;

//     if ($slug = $request->query('user')) {
//         $slug = Str::slug($slug);
//         $viewedUser = User::all()->firstWhere(
//             fn ($u) => Str::slug($u->nama) === $slug
//         );
//     }

//     return view('profile', compact('viewedUser'));
// });

/*
|--------------------------------------------------------------------------
| STATIC PAGES
|--------------------------------------------------------------------------
*/

Route::view('/tentang_kami', 'tentang_kami');
Route::view('/reset-password', 'reset-password');