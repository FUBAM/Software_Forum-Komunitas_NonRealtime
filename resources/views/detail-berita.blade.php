<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Berita - ZHIB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}"> 
  <link rel="stylesheet" href="{{ asset('css/detail_berita.css') }}">
</head>
<body>
<div class="page-wrapper">

<header class="navbar">
  <div class="navbar-container">

    <div class="nav-left">
      <a href="{{ url('/home') }}" class="nav-item">Home</a>

      <div class="nav-dropdown">
        <button class="nav-link" type="button">
          Komunitas <span class="arrow">▾</span>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/komunitas-saya') }}">Komunitas Saya</a>
          <a href="{{ url('/cari-komunitas') }}">Cari Komunitas</a>
        </div>
      </div>

      <div class="nav-dropdown">
        <button class="nav-link" type="button">
          Event <span class="arrow">▾</span>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/event') }}">Cari Event</a>
          <a href="{{ url('/riwayat-event') }}">Riwayat Event</a>
        </div>
      </div>
    </div>

    <div class="logo">ZHIB</div>

    <div class="nav-right">
      <div class="profile-dropdown" id="profileDropdown">
        <button class="profile-navbar" id="profileToggle">
          <div class="profile-text">
            <div class="profile-name">Windah Batubara</div>
            <div class="profile-level">LVL. 999</div>
          </div>
          <img src="{{ asset('image/download (13).jpg') }}" class="nav-avatar" alt="Profile">
        </button>

        <div class="profile-menu">
          <a href="{{ url('/profile') }}">Profil</a>
          <a href="{{ url('/profile') }}?edit=true">Edit Profil</a>
          <hr>
          <a href="{{ url('/') }}" class="logout">Logout</a>
        </div>
      </div>
    </div>

  </div>
</header>

<main class="news-page">
  <div class="article-container">
    
    <div class="article-image-wrapper">
      <img src="{{ asset('image/img (2).jpg') }}" alt="Event Olahraga" class="article-img">
    </div>

    <h1 class="article-title">Komunitas Olahraga Lokal Gelar Event Kebersamaan</h1>

    <div class="article-content">
      <p>
        Sebuah komunitas olahraga lokal menggelar event bersama yang diikuti oleh puluhan peserta dari berbagai latar belakang. Acara ini berlangsung dengan antusias dan menjadi ajang berkumpulnya para pecinta olahraga yang memiliki minat serupa.
      </p>
      <p>
        Event ini tidak hanya berfokus pada kompetisi, tetapi juga pada kebersamaan dan interaksi antaranggota komunitas. Para peserta terlihat aktif mengikuti rangkaian acara, mulai dari sesi permainan hingga diskusi santai setelah event berlangsung.
      </p>
      <p>
        Menurut panitia, acara ini diselenggarakan sebagai wadah untuk mempererat hubungan antaranggota serta membuka kesempatan bagi masyarakat yang ingin bergabung dalam komunitas olahraga. Konsep event dibuat terbuka agar peserta baru dapat beradaptasi dengan nyaman.
      </p>
      <p>
        Melalui event ini, komunitas berharap dapat membangun lingkungan yang positif, aktif, dan berkelanjutan, sekaligus mendorong lahirnya event serupa di masa mendatang.
      </p>
    </div>

  </div>
</main>

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
      <a href="{{ url('/komunitas-saya') }}" class="footer-text-link">Komunitas Saya</a>
      <a href="{{ url('/cari-komunitas') }}" class="footer-text-link">Cari Komunitas</a>
    </div>
    <div class="footer-section">
      <a href="{{ url('/riwayat-event') }}" class="footer-text-link">Riwayat Event</a>
      <a href="{{ url('/event') }}" class="footer-text-link">Cari Event</a>
    </div>
    <div class="footer-section">
      <a href="{{ url('/tentang_kami') }}" class="footer-text-link">Tentang Kami</a>
    </div>
  </div>
</footer>

<script>
  const profileToggle = document.getElementById('profileToggle');
  const profileDropdown = document.getElementById('profileDropdown');

  if (profileToggle && profileDropdown) {
    profileToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      profileDropdown.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
        if (!profileDropdown.contains(e.target)) {
            profileDropdown.classList.remove('active');
        }
    });
  }
</script>

</div>
</body>
</html>