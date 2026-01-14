@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('content')

<section class="hero">
    <img src="{{ asset('image/img (8).jpg') }}" alt="">
    <div class="hero-overlay">
        <h1>Temukan Teman Satu Frekuensi</h1>
        <p>Ribuan komunitas dan event seru menantimu.</p>
    </div>
</section>

<section class="section">
    <div class="section-container">
        <h2 class="section-title">REKOMENDASI BERITA</h2>

        <div class="grid-3">
            @forelse($berita as $item)
                <a href="{{ route('berita.detail', $item->id) }}"
                   class="news-card"
                   @guest onclick="openLogin(); return false;" @endguest>

                    <div class="news-image-frame">
                        <img src="{{ asset($item->gambar_url ?? 'image/default-news.jpg') }}">
                    </div>

                    <p>{{ Str::limit($item->judul, 80) }}</p>
                </a>
            @empty
                <p>Tidak ada berita.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="communities" id="event">
    <h2>PILIHAN EVENT</h2>
    <p class="communities-subtitle">
        Daftar Event terpilih untuk menambah<br>
        pengalaman, relasi, dan koleksi lencana
    </p>

    <div class="slider-container">
        <button class="slider-btn prev-btn" id="event-prev">❮</button>

        <div class="scroll-wrapper" id="event-list">
            @foreach($events as $event)
                <div class="community-card">
                    <div class="event-image">
                        <img src="{{ asset($event->poster_url ?? 'image/default-event.jpg') }}">
                    </div>

                    <div class="card-content">
                        <h3>{{ Str::limit($event->judul, 60) }}</h3>

                        <a href="{{ route('events.show', $event->id) }}"
                        class="card-link"
                        @guest onclick="openLogin(); return false;" @endguest>
                            Lihat Detail &gt;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>    
</section>

<section class="section">
    <div class="section-container">
        <h2 class="section-title">HALL OF FAME</h2>
        <h6 class="section-subtitle">
            Mereka yang telah mengukir jejak terbaik di komunitas ini
        </h6>
        @include('partials.hall-of-fame', ['users' => $hallOfFame])
    </div>
</section>

@endsection

@section('scripts')
<script>
    /* ===============================
   GENERIC SLIDER FUNCTION
================================ */
    function initSlider(containerId, prevBtnId, nextBtnId, scrollAmount) {
        const container = document.getElementById(containerId);
        const prevBtn = document.getElementById(prevBtnId);
        const nextBtn = document.getElementById(nextBtnId);

        if (!container || !prevBtn || !nextBtn) return;

        nextBtn.addEventListener('click', () => {
            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        prevBtn.addEventListener('click', () => {
            container.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });
    }

    /* ===============================
       INIT AFTER DOM READY
    =============================== */
    document.addEventListener('DOMContentLoaded', () => {
        // PILIHAN EVENT
        initSlider(
            'event-list', // id scroll-wrapper event
            'event-prev', // tombol kiri event
            'event-next', // tombol kanan event
            260 // lebar 1 card + gap
        );
    });
</script>

@guest
<!-- Auth overlays & modals (only for guests) -->
<div class="auth-overlay" id="authOverlay"></div>
<div id="blade-helpers" data-has-errors="{{ $errors->any() ? '1' : '0' }}"
    data-register-errors="{{ (old('nama') || $errors->has('nama') || $errors->has('password') || $errors->has('password_confirmation')) ? '1' : '0' }}"
    style="display:none"></div>

<div class="auth-modal" id="loginModal">
    <button class="close-btn" onclick="closeAuth()">×</button>
    <h2>Masuk</h2>

    @if($errors->has('email'))
    <div class="error-message" style="color:#b00020;margin-bottom:8px;">{{ $errors->first('email') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Username / Email</label>
        <input type="text" name="login" value="{{ old('login') }}">

        <label>Password</label>
        <input type="password" name="password">

        <div class="form-options">
            <label class="remember">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Remember me
            </label>

            <a href="#" class="forgot-link" onclick="openForgot()">Lupa?</a>
        </div>        

        <button type="submit" class="primary-btn">Masuk</button>
    </form>

    <p class="switch-text">
        Belum Punya Akun?
        <a href="#" onclick="switchToRegister()">Buat Akun</a>
    </p>
</div>

<div class="auth-modal" id="registerModal">
    <button class="close-btn" onclick="closeAuth()">×</button>
    <h2>Buat Akun</h2>

    @if(session('status'))
    <div class="success-message" style="color:#00695c;margin-bottom:8px;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <label>Password</label>
        <input type="password" name="password">

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation">

        <div class="register-agree">
            <input type="checkbox" name="terms" {{ old('terms') ? 'checked' : '' }}>
            <span>Saya setuju dengan Syarat & Ketentuan</span>
        </div>

        <button type="submit" class="primary-btn">Buat Akun</button>
    </form>

    <p class="switch-text">
        Sudah Punya Akun?
        <a href="#" onclick="switchToLogin()">Masuk</a>
    </p>
</div>

<div class="auth-modal" id="forgotModal">
    <button class="close-btn" onclick="closeAuth()">×</button>

    <h2>Lupa sandi?</h2>

    <img src="{{ asset('image/icon/lupasandi.png') }}" alt="Lupa Sandi" class="forgot-icon">

    <p class="forgot-desc">
        Silahkan masukkan Username atau Email Anda dan kami akan
        mengirimkan tautan untuk masuk ke akun anda semula
    </p>

    <input type="text" placeholder="Masukkan Username/Email Anda">

    <button class="primary-btn" onclick="goToResetPage()">
        Kirim Tautan
    </button>

    <div class="divider">ATAU</div>

    <a href="#" onclick="openRegister()">Buat Akun Baru</a>
</div>

<script>
    // 1. Definisikan Elemen
    const overlay = document.getElementById('authOverlay');
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    const forgotModal = document.getElementById('forgotModal');

    // 2. Helper: Hapus pesan error/success di modal auth
    function clearAuthErrors() {
        // Hapus pesan error/success yang di-render server
        loginModal.querySelectorAll('.error-message, .success-message').forEach(el => el.remove());
        registerModal.querySelectorAll('.error-message, .success-message').forEach(el => el.remove());

        // Update helper dataset agar tidak auto-open lagi pada runtime
        const bladeHelpers = document.getElementById('blade-helpers');
        if (bladeHelpers) {
            bladeHelpers.dataset.hasErrors = '0';
            bladeHelpers.dataset.registerErrors = '0';
        }
    }

    // 3. Fungsi Reset Tampilan (Sembunyikan semua modal)
    function closeAuth() {
        overlay.style.display = 'none';
        loginModal.style.display = 'none';
        registerModal.style.display = 'none';
        forgotModal.style.display = 'none';

        // Clear any leftover server-rendered messages so switching modals is clean
        clearAuthErrors();
    }

    // 4. Fungsi Buka Login (Awal)
    function openLogin() {
        // Jangan clear server-rendered messages saat membuka login otomatis
        registerModal.style.display = 'none';
        forgotModal.style.display = 'none';
        overlay.style.display = 'block';
        loginModal.style.display = 'block';
    }

    // 4. Fungsi Buka Register (Awal)
    function openRegister() {
        // Jangan clear server-rendered messages saat membuka register
        loginModal.style.display = 'none';
        forgotModal.style.display = 'none';
        overlay.style.display = 'block';
        registerModal.style.display = 'block';
    }

    // 5. Fungsi Buka Lupa Password
    function openForgot() {
        // Jangan clear server-rendered messages saat membuka forgot
        loginModal.style.display = 'none';
        registerModal.style.display = 'none';
        overlay.style.display = 'block';
        forgotModal.style.display = 'block';
    }

    // 6. Fungsi Pindah dari Login ke Register (YANG HILANG TADI)
    function switchToRegister() {
        // bersihkan pesan sebelum pindah
        clearAuthErrors();
        loginModal.style.display = 'none';
        registerModal.style.display = 'block';
    }

    // 7. Fungsi Pindah dari Register ke Login (YANG HILANG TADI)
    function switchToLogin() {
        // bersihkan pesan sebelum pindah
        clearAuthErrors();
        registerModal.style.display = 'none';
        loginModal.style.display = 'block';
    }

    // 8. Fungsi Reset Password Action
    function goToResetPage() {
        // Redirect ke Route Laravel 'reset-password'
        window.location.href = "{{ url('/reset-password') }}";
    }

    document.addEventListener('DOMContentLoaded', () => {
        const params = new URLSearchParams(window.location.search);

        if (params.get('login') === '1') {
            openLogin();
        }

        const __hasErrors = document.getElementById('blade-helpers')?.dataset.hasErrors === '1';
        if (__hasErrors) {
            openLogin();
        }
    });

    function registerSuccess() {
        // simulasi register berhasil
        closeAuth(); // tutup semua modal
        openLogin(); // buka popup login
    }

    // 9. Event Listener untuk klik Overlay (Klik luar modal = tutup)
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            closeAuth();
        }
    });

    // 10. Cek URL Parameter (Opsional, untuk auto open register)
    document.addEventListener('DOMContentLoaded', () => {
        const params = new URLSearchParams(window.location.search);
        if (params.get('register') === '1') {
            openRegister();
        }

        const regErr = document.getElementById('blade-helpers')?.dataset.registerErrors === '1';
        if (regErr) {
            openRegister();
        }
    });

    /* ===============================
       GUEST NAVBAR INTERCEPT
    =============================== */
    document.addEventListener('DOMContentLoaded', () => {
        const guestLinks = document.querySelectorAll('[data-auth]');

        guestLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                openLogin();
            });
        });
    });
</script>

@endguest

@endsection