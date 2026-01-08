<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>ZHIB</title>
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

<header class="navbar">
  <div class="navbar-container">

    <nav class="nav-left">
      <a href="{{ url('/home') }}" class="nav-item">Home</a>

      <div class="nav-dropdown" id="komunitasDropdown">
        <button class="nav-link" id="komunitasToggle">
          Komunitas <span class="arrow">▾</span>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/komunitas-saya') }}">Komunitas Saya</a>
          <a href="{{ url('/cari-komunitas') }}">Cari Komunitas</a>
        </div>
      </div>

      <div class="nav-dropdown" id="eventDropdown">
        <button class="nav-link" id="eventToggle">
          Event <span class="arrow">▾</span>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/event') }}">Cari Event</a>
          <a href="{{ url('/riwayat-event') }}">Riwayat Event</a>
        </div>
      </div>
    </nav>

    <div class="logo">ZHIB</div>

    <div class="nav-right">
      <div class="profile-dropdown" id="profileDropdown">
        <button class="profile-navbar" id="profileToggle">
          <div class="profile-text">
            <div class="profile-name">Windah Batubara</div>
            <div class="profile-level">LVL. 999</div>
          </div>
          <img src="{{ asset('image/download (13).jpg') }}" class="profile-avatar" alt="Profile">
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

      <a href="{{ url('/detail-berita') }}" class="news-card">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (9).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

      <a href="{{ url('/detail-berita') }}" class="news-card">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (1).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

      <a href="{{ url('/detail-berita') }}" class="news-card">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (10).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

      <a href="{{ url('/detail-berita') }}" class="news-card">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (9).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

      <a href="{{ url('/detail-berita') }}" class="news-card">
        <div class="news-image-frame">
            <img src="{{ asset('image/img (5).jpg') }}">
        </div>
        <p>Turnamen futsal Open Sumatera dengan total hadiah jutaan rupiah.</p>
      </a>

      <a href="{{ url('/detail-berita') }}" class="news-card">
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

  <a href="{{ url('/profile') }}?user=hengky-ugar" class="hof-card">
    <img class="avatar" src="{{ asset('image/download (13).jpg') }}">
    <h4>Hengky Ugar</h4>
    <h6>Level 999</h6>
    <div class="badges">
      <img src="{{ asset('image/badges/badge (1).png') }}">
      <img src="{{ asset('image/badges/badge (2).png') }}">
      <img src="{{ asset('image/badges/badge (3).png') }}">
      <img src="{{ asset('image/badges/badge (4).png') }}">
      <img src="{{ asset('image/badges/badge (5).png') }}">
      <img src="{{ asset('image/badges/badge (6).png') }}">
    </div>
  </a>

  <a href="{{ url('/profile') }}?user=hengky-farhan" class="hof-card">
    <img class="avatar" src="{{ asset('image/download (13).jpg') }}">
    <h4>Hengky Farhan</h4>
    <h6>Level 998</h6>
    <div class="badges">
      <img src="{{ asset('image/badges/badge (1).png') }}">
      <img src="{{ asset('image/badges/badge (2).png') }}">
      <img src="{{ asset('image/badges/badge (3).png') }}">
      <img src="{{ asset('image/badges/badge (4).png') }}">
    </div>
  </a>

  <a href="{{ url('/profile') }}?user=ihsan-hengky" class="hof-card">
    <img class="avatar" src="{{ asset('image/download (13).jpg') }}">
    <h4>Ihsan Hengky</h4>
    <h6>Level 997</h6>
    <div class="badges">
      <img src="{{ asset('image/badges/badge (1).png') }}">
      <img src="{{ asset('image/badges/badge (2).png') }}">
      <img src="{{ asset('image/badges/badge (4).png') }}">
      <img src="{{ asset('image/badges/badge (6).png') }}">
    </div>
  </a>

  <a href="{{ url('/profile') }}?user=afrizal-hengky" class="hof-card">
    <img class="avatar" src="{{ asset('image/download (13).jpg') }}">
    <h4>Afrizal Hengky</h4>
    <h6>Level 996</h6>
    <div class="badges">
      <img src="{{ asset('image/badges/badge (1).png') }}">
      <img src="{{ asset('image/badges/badge (2).png') }}">
      <img src="{{ asset('image/badges/badge (3).png') }}">
    </div>
  </a>

  <a href="{{ url('/profile') }}?user=hengky-nur" class="hof-card">
    <img class="avatar" src="{{ asset('image/download (13).jpg') }}">
    <h4>Hengky Nur</h4>
    <h6>Level 995</h6>
    <div class="badges">
      <img src="{{ asset('image/badges/badge (1).png') }}">
      <img src="{{ asset('image/badges/badge (2).png') }}">
    </div>
  </a>

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
// Profile Dropdown
const profileToggle = document.getElementById('profileToggle');
const profileDropdown = document.getElementById('profileDropdown');

if(profileToggle && profileDropdown){
    profileToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      profileDropdown.classList.toggle('active');
      
      // Close other dropdowns
      if(komunitasDropdown) komunitasDropdown.classList.remove('active');
      if(eventDropdown) eventDropdown.classList.remove('active');
    });
}

// Komunitas Dropdown
const komunitasToggle = document.getElementById('komunitasToggle');
const komunitasDropdown = document.getElementById('komunitasDropdown');

if(komunitasToggle && komunitasDropdown){
    komunitasToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      komunitasDropdown.classList.toggle('active');
      
      // Close other dropdowns
      if(profileDropdown) profileDropdown.classList.remove('active');
      if(eventDropdown) eventDropdown.classList.remove('active');
    });
}

// Event Dropdown
const eventToggle = document.getElementById('eventToggle');
const eventDropdown = document.getElementById('eventDropdown');

if(eventToggle && eventDropdown){
    eventToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      eventDropdown.classList.toggle('active');
      
      // Close other dropdowns
      if(profileDropdown) profileDropdown.classList.remove('active');
      if(komunitasDropdown) komunitasDropdown.classList.remove('active');
    });
}

// Close all dropdowns when clicking outside
document.addEventListener('click', () => {
  if(profileDropdown) profileDropdown.classList.remove('active');
  if(komunitasDropdown) komunitasDropdown.classList.remove('active');
  if(eventDropdown) eventDropdown.classList.remove('active');
});

// Prevent dropdown from closing when clicking inside menu
document.querySelectorAll('.nav-dropdown-menu, .profile-menu').forEach(menu => {
  menu.addEventListener('click', (e) => {
    e.stopPropagation();
  });
});
</script>


</body>
</html>