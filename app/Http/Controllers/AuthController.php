<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form login (landing modal)
    public function showLoginForm()
    {
        // Landing page contains the login modal and proper CSRF tokens.
        return redirect('/?login=1');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Ubah 'email' jadi 'email_pengguna' sesuai database
        // Auth::attempt butuh penyesuaian jika nama kolom custom
        // Cara manual cek user:
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->remember);
            $request->session()->regenerate();

            // Redirect: prefer intended URL but default admins to admin dashboard
            $default = ($user->role === 'admin') ? route('admin.dashboard') : route('home');
            return redirect()->intended($default);
        }

        // Redirect to landing page where the login modal exists so CSRF/token+session remain valid
        return redirect('/?login=1')->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->withInput();
    }

    // Tampilkan form register (landing modal)
    public function showRegisterForm()
    {
        return redirect('/?register=1');
    }

    // Backwards-compatible aliases used by routes
    public function showLogin()
    {
        return $this->showLoginForm();
    }

    public function showRegister()
    {
        return $this->showRegisterForm();
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
            'xp_terkini' => 0,
            'level_terkini' => 1,
        ]);

        // Require the user to login after registration instead of auto-login
        return redirect('/?register=1')->with('status', 'Akun berhasil dibuat. Silakan masuk.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Dashboard route target (simple dispatcher)
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        if ($user->role === 'admin') {
            return view('admin.dashboard');
        }

        return view('dashboard');
    }
}
