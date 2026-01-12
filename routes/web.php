<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
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
        // Admin dashboard (login redirects here for admins)
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/admin/laporan', [KomunitasController::class, 'listLaporan'])->name('admin.laporan');

        // Admin Lomba pages (simple demo routes)
        Route::get('/admin/lomba', function () {
            return view('admin.lomba');
        })->name('admin.lomba');

        Route::get('/admin/kelola-lomba/{id}', function ($id) {
            // Demo payload: in production, load model by id
            $lomba = (object) [
                'id' => $id,
                'judul' => "Lomba #{$id}",
                'deskripsi' => 'Deskripsi lomba (demo)'
            ];
            return view('admin.kelola-lomba', ['lomba' => $lomba]);
        })->name('admin.kelola.lomba');

        Route::post('/admin/lomba/store', function () {
            // Demo handler: accept the form and redirect back with a success flash
            return redirect('/admin/lomba')->with('success', 'Lomba tersimpan (demo).');
        })->name('admin.lomba.store');

        // Admin pages: pembayaran, komunitas, berita (simple view handlers)
        Route::get('/admin/pembayaran', function () {
            return view('admin.pembayaran');
        })->name('admin.pembayaran');

        Route::get('/admin/komunitas', function () {
            return view('admin.komunitas');
        })->name('admin.komunitas');

        Route::get('/admin/berita', function () {
            return view('admin.berita');
        })->name('admin.berita');
    });

    // Handler for public / forms that post to /lomba/store (requires auth)
    Route::post('/lomba/store', function () {
        return redirect()->back()->with('success', 'Pendaftaran lomba diterima (demo).');
    })->name('lomba.store');
});

use App\Http\Controllers\LandingController;

// Halaman Depan (Landing)
Route::get('/', [LandingController::class, 'index']);

// Halaman Utama (Dashboard) — sekarang menggunakan controller yang sama agar data Hall of Fame konsisten
Route::get('/home', [LandingController::class, 'index'])->name('home');

// Fitur Komunitas
Route::get('/cari-komunitas', function () {
    return view('cari-komunitas');
});
Route::get('/komunitas-saya', [KomunitasController::class, 'myCommunities'])->name('komunitas.my');

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

// Additional static pages (map available views to simple routes)
Route::get('/detail-lomba', function () {
    return view('detail-lomba');
});

// Temporary local-only debug route: reports auth, role, and gate checks
if (env('APP_ENV') === 'local') {
    // Register a single handler and expose it on both the canonical path and the encoded
    // '%20' variant so copies with a stray leading space still work — serve content directly
    // instead of performing redirects (that can cause loops in some browsers/environments).
    $debugHandler = function () {
        $user = auth()->user();
        $isAuth = auth()->check();
        return response()->json([
            'authenticated' => $isAuth,
            'auth_id' => $isAuth ? auth()->id() : null,
            'user' => $user ? [
                'id' => $user?->id,
                'email' => $user?->email,
                'role' => $user?->role,
                'nama' => $user?->nama,
            ] : null,
            'gate_admin' => $isAuth ? \Illuminate\Support\Facades\Gate::forUser($user)->allows('admin') : null,
            'gate_moderator' => $isAuth ? \Illuminate\Support\Facades\Gate::forUser($user)->allows('moderator') : null,
            'gate_defined' => \Illuminate\Support\Facades\Gate::has('admin'),
            'user_class' => $isAuth ? get_class($user) : null,
            'user_is_model' => $isAuth ? ($user instanceof \App\Models\User) : null,
            'user_role' => $isAuth ? $user->role : null,
            'provider_loaded' => array_key_exists('App\\Providers\\AuthServiceProvider', app()->getLoadedProviders()),
            'session_id' => session()->getId(),
            'csrf_token' => csrf_token(),
        ]);
    };

    // Local-only helper to sign in as admin for debugging (idempotent, removed later)
    Route::get('/_debug/login-as-admin', function () {
        if (app()->environment() !== 'local') {
            abort(404);
        }
        $user = \App\Models\User::where('email', 'admin@mail.com')->first();
        if (! $user) {
            return response('No admin user found', 404);
        }
        auth()->login($user);
        session()->regenerate();
        return redirect('/_debug/auth');
    });

    // Accept both the canonical and encoded variants without redirecting
    Route::get('/%20_debug/auth', $debugHandler);
    Route::get('/_debug/auth', $debugHandler);

    unset($debugHandler);
}

Route::get('/form-esports', function () {
    return view('form-esports');
});
Route::get('/form-literasi-seni', function () {
    return view('form-literasi-seni');
});
Route::get('/form-teknologi', function () {
    return view('form-teknologi');
});
Route::get('/payment', function () {
    return view('payment');
});

// Moderator pages — require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/moderator-chat', function () {
        return view('moderator-chat');
    });
    Route::get('/moderator-events', function () {
        return view('moderator-events');
    });
});

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

Route::get('/profile', function (Request $request) {
    $viewedUser = null;
    if ($slug = $request->query('user')) {
        $slug = Str::slug($slug);
        // Simple lookup by slugified name (for demo). For production, store slugs on the user model.
        $viewedUser = User::get()->firstWhere(function ($u) use ($slug) {
            return Str::slug($u->nama) === $slug;
        });
    }

    return view('profile', ['viewedUser' => $viewedUser]);
});
Route::get('/detail-berita', function () {
    return view('detail-berita');
});
Route::get('/tentang_kami', function () {
    return view('tentang_kami');
});
Route::get('/reset-password', function () {
    return view('reset-password');
});