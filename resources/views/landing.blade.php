<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>ZHIB</title>
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

<header class="navbar">
  <div class="navbar-container">

    <nav class="nav-left">
      <a href="#" data-auth>Home</a>

      <div class="nav-dropdown">
        <button class="nav-link" type="button">
          Komunitas <span class="arrow">▾</span>
        </button>
        <div class="dropdown-menu">
          <a href="#" data-auth>Komunitas Saya</a>
          <a href="#" data-auth>Cari Komunitas</a>
        </div>
      </div>

      <div class="nav-dropdown">
        <button class="nav-link" type="button">
          Event <span class="arrow">▾</span>
        </button>
        <div class="dropdown-menu">
          <a href="#" data-auth>Cari Event</a>
          <a href="#" data-auth>Riwayat Event</a>
        </div>
      </div>
    </nav>

    <div class="logo">ZHIB</div>

    <div class="nav-right">
      <a href="#" onclick="openLogin()">Masuk</a>
      <span>|</span>
      <a href="#" onclick="openRegister()">Daftar</a>
    </div>

  </div>
</header>

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

      <a href="#" class="news-card" onclick="openLogin(); return false;">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (9).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

      <a href="#" class="news-card" onclick="openLogin(); return false;">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (1).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

      <a href="#" class="news-card" onclick="openLogin(); return false;">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (10).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

      <a href="#" class="news-card" onclick="openLogin(); return false;">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (9).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

      <a href="#" class="news-card" onclick="openLogin(); return false;">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (5).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

      <a href="#" class="news-card" onclick="openLogin(); return false;">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (10).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

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

        <div class="community-card">
  <div class="event-image">
    <img src="{{ asset('image/img (1).jpg') }}" alt="Poster Event">
  </div>
  <div class="card-content">
    <h3>Turnamen futsal Open Sumatera total hadiah jutaan rupiah.</h3>
    <a href="#" class="card-link">Lihat Detail ></a>
  </div>
</div>

<div class="community-card">
  <div class="event-image">
    <img src="{{ asset('image/img (2).jpg') }}" alt="Poster Event">
  </div>
  <div class="card-content">
    <h3>Kompetisi Mobile Legends offline.</h3>
    <a href="#" class="card-link">Lihat Detail ></a>
  </div>
</div>

<div class="community-card">
  <div class="event-image">
    <img src="{{ asset('image/img (3).jpg') }}" alt="Poster Event">
  </div>
  <div class="card-content">
    <h3>Marathon Jakarta–Bandung 2025.</h3>
    <a href="#" class="card-link">Lihat Detail ></a>
  </div>
</div>

<div class="community-card">
  <div class="event-image">
    <img src="{{ asset('image/img (4).jpg') }}" alt="Poster Event">
  </div>
  <div class="card-content">
    <h3>Workshop fotografi untuk pemula.</h3>
    <a href="#" class="card-link">Lihat Detail ></a>
  </div>
</div>

<div class="community-card">
  <div class="event-image">
    <img src="{{ asset('image/img (1).jpg') }}" alt="Poster Event">
  </div>
  <div class="card-content">
    <h3>Turnamen futsal Open Sumatera total hadiah jutaan rupiah.</h3>
    <a href="#" class="card-link">Lihat Detail ></a>
  </div>
</div>

<div class="community-card">
  <div class="event-image">
    <img src="{{ asset('image/img (2).jpg') }}" alt="Poster Event">
  </div>
  <div class="card-content">
    <h3>Kompetisi Mobile Legends offline.</h3>
    <a href="#" class="card-link">Lihat Detail ></a>
  </div>
</div>

<div class="community-card">
  <div class="event-image">
    <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Event">
  </div>
  <div class="card-content">
    <h3>Marathon Jakarta–Bandung 2025.</h3>
    <a href="#" class="card-link">Lihat Detail ></a>
  </div>
</div>


        <button class="slider-btn next-btn" id="event-next">❯</button>
    </div>
</section>

<section class="section">
  <div class="section-container">
    <h2 class="section-title">HALL OF FAME</h2>
    <h6 class="section-subtitle">
    Mereka yang telah mengukir jejak terbaik di komunitas ini
    </h6>


    <div class="hof-grid">

      <div class="hof-card">
        <img class="avatar" src="{{ asset('image/download (13).jpg') }}">
        <h4>hengky ugar</h4>
        <h6>level 999</h6>
        <div class="badges">
          <img src="{{ asset('image/badges/badge (1).png') }}">
          <img src="{{ asset('image/badges/badge (2).png') }}">
          <img src="{{ asset('image/badges/badge (3).png') }}">
          <img src="{{ asset('image/badges/badge (4).png') }}">
          <img src="{{ asset('image/badges/badge (5).png') }}">
        <img src="{{ asset('image/badges/badge (6).png') }}">
        </div>
      </div>

      <div class="hof-card">
        <img class="avatar" src="{{ asset('image/download (13).jpg') }}">
        <h4>hengky farhan</h4>
        <h6>level 998</h6>
        <div class="badges">
          <img src="{{ asset('image/badges/badge (1).png') }}">
            <img src="{{ asset('image/badges/badge (2).png') }}">
            <img src="{{ asset('image/badges/badge (3).png') }}">
            <img src="{{ asset('image/badges/badge (4).png') }}">
        </div>
        </div>

        <div class="hof-card">
        <img class="avatar" src="{{ asset('image/download (13).jpg') }}">
        <h4>ihsan hengky</h4>
        <h6>level 997</h6>
        <div class="badges">
          <img src="{{ asset('image/badges/badge (1).png') }}">
          <img src="{{ asset('image/badges/badge (2).png') }}">
          <img src="{{ asset('image/badges/badge (4).png') }}">
          <img src="{{ asset('image/badges/badge (6).png') }}">

        </div>
      </div>

      <div class="hof-card">
        <img class="avatar" src="{{ asset('image/download (13).jpg') }}">
        <h4>afrizal hengky</h4>
        <h6>level 996</h6>
        <div class="badges">
          <img src="{{ asset('image/badges/badge (1).png') }}">
          <img src="{{ asset('image/badges/badge (2).png') }}">
          <img src="{{ asset('image/badges/badge (3).png') }}">
        </div>
      </div>

      <div class="hof-card">
        <img class="avatar" src="{{ asset('image/download (13).jpg') }}">
        <h4>hengky Nur</h4>
        <h6>level 995</h6>
        <div class="badges">
          <img src="{{ asset('image/badges/badge (1).png') }}">
          <img src="{{ asset('image/badges/badge (2).png') }}">

        </div>
      </div>


    </div>
  </div>
</section>

<footer>
  <div class="footer-container">
    
    <div class="footer-section">
      <h3 class="footer-brand">ZHIB</h3>
      <div class="footer-social">
        <a href="#" class="social-link">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
        </a>
        <a href="#" class="social-link">
          <svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
        </a>
        <a href="#" class="social-link">
          <svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
        </a>
      </div>
    </div>

    <div class="footer-section">
      <a href="#" class="footer-text-link" onclick="openLogin(); return false;">Komunitas Saya</a>
      <a href="#" class="footer-text-link" onclick="openLogin(); return false;">Cari Komunitas</a>
    </div>

    <div class="footer-section">
      <a href="#" class="footer-text-link" onclick="openLogin(); return false;">Riwayat Event</a>
      <a href="#" class="footer-text-link" onclick="openLogin(); return false;">Cari Event</a>
    </div>

    <div class="footer-section">
      <a href="#" class="footer-text-link" onclick="openLogin(); return false;">Tentang Kami</a>
    </div>

  </div>
</footer>

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
================================ */
document.addEventListener('DOMContentLoaded', () => {
  // PILIHAN EVENT
  initSlider(
    'event-list',   // id scroll-wrapper event
    'event-prev',   // tombol kiri event
    'event-next',   // tombol kanan event
    260             // lebar 1 card + gap
  );
});
</script>

<div class="auth-overlay" id="authOverlay"></div>

<div class="auth-modal" id="loginModal">
  <button class="close-btn" onclick="closeAuth()">×</button>
  <h2>Masuk</h2>

  <label>Username/Email</label>
  <input type="text" placeholder="Masukkan Username/Email Anda">

  <label>Password</label>
  <input type="password" placeholder="Masukkan Password Anda">

<div class="form-options">
  <label class="remember">
    <input type="checkbox">
    Remember me
  </label>

<a href="#" class="forgot-link" onclick="openForgot()">Lupa?</a>
</div>

  <button class="primary-btn" onclick="loginSuccess()">Masuk</button>

  <p class="switch-text">
    Belum Punya Akun? 
    <a href="#" onclick="switchToRegister()">Buat Akun</a>
  </p>
</div>

<div class="auth-modal" id="registerModal">
  <button class="close-btn" onclick="closeAuth()">×</button>
  <h2>Buat Akun</h2>

  <label>Username</label>
  <input type="text" placeholder="Masukkan Username Anda">

  <label>Email</label>
  <input type="email" placeholder="Masukkan Email Anda">

  <label>Password</label>
  <input type="password" placeholder="Masukkan Password Anda">

  <label>Konfirmasi Password</label>
  <input type="password" placeholder="Konfirmasi Password Anda">

  <div class="register-agree">
  <input type="checkbox">
  <span>Saya setuju dengan Syarat & Ketentuan</span>
</div>

<button class="primary-btn" onclick="registerSuccess()">Buat Akun</button>

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

// 2. Fungsi Reset Tampilan (Sembunyikan semua modal)
function closeAuth() {
  overlay.style.display = 'none';
  loginModal.style.display = 'none';
  registerModal.style.display = 'none';
  forgotModal.style.display = 'none';
}

// 3. Fungsi Buka Login (Awal)
function openLogin() {
  closeAuth(); // Tutup yang lain dulu biar aman
  overlay.style.display = 'block';
  loginModal.style.display = 'block';
}

// 4. Fungsi Buka Register (Awal)
function openRegister() {
  closeAuth();
  overlay.style.display = 'block';
  registerModal.style.display = 'block';
}

// 5. Fungsi Buka Lupa Password
function openForgot() {
  closeAuth();
  overlay.style.display = 'block';
  forgotModal.style.display = 'block';
}

// 6. Fungsi Pindah dari Login ke Register (YANG HILANG TADI)
function switchToRegister() {
  loginModal.style.display = 'none';
  registerModal.style.display = 'block';
}

// 7. Fungsi Pindah dari Register ke Login (YANG HILANG TADI)
function switchToLogin() {
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
});

function loginSuccess() {
  // Redirect ke Route Laravel 'home'
  window.location.href = "{{ url('/home') }}";
}

function registerSuccess() {
  // simulasi register berhasil
  closeAuth();       // tutup semua modal
  openLogin();       // buka popup login
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
});

/* ===============================
   GUEST NAVBAR INTERCEPT
================================ */
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

</body>
</html>