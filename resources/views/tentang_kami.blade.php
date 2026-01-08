<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tentang Kami - ZHIB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('css/tentang_kami.css') }}">
</head>
<body>
<div class="page-wrapper">

<header class="navbar">
  <div class="navbar-container">
    <div class="nav-left">
      <a href="{{ url('/home') }}" class="nav-item">Home</a>
      <div class="nav-dropdown">
        <button class="nav-link" type="button">Komunitas <span>▾</span></button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/komunitas-saya') }}">Komunitas Saya</a>
          <a href="{{ url('/cari-komunitas') }}">Cari Komunitas</a>
        </div>
      </div>
      <div class="nav-dropdown">
        <button class="nav-link" type="button">Event <span>▾</span></button>
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

<main class="about-page">
  <div class="about-container">

    <section class="about-row">
      <div class="about-image">
        <img src="{{ asset('image/img (1).jpg') }}" alt="Siapa Kami">
      </div>
      <div class="about-text">
        <h2>Siapa kami?</h2>
        <p>
          Kami adalah sebuah platform komunitas dan forum internasional yang dirancang untuk membantu individu menemukan teman, komunitas, dan event yang sesuai dengan hobi serta ketertarikan mereka.
        </p>
        <p>
          Platform ini hadir sebagai ruang aman bagi siapa saja—terutama bagi mereka yang merasa sulit memulai interaksi sosial, memiliki kepribadian introvert, atau tinggal di lingkungan yang kurang mendukung aktivitas komunitas. Kami percaya bahwa setiap orang memiliki potensi untuk berkembang ketika berada di komunitas yang tepat, tanpa harus dipaksa berinteraksi secara intens atau menekan.
        </p>
      </div>
    </section>

    <section class="about-row reverse">
      <div class="about-text">
        <h2>Tujuan kami!</h2>
        <p>
          Kami adalah platform komunitas dan forum berbasis minat yang inklusif dan aman bagi semua orang—terutama bagi mereka yang introvert dan butuh ruang aman. Sistem ini dirancang khusus untuk pengguna yang ingin terhubung namun tetap tanpa tekanan komunikasi realtime. Melalui komunitas, forum, dan event berbasis minat, kami mendorong partisipasi aktif (bahkan secara leveling dan achievement), sehingga setiap kontribusi tetap dihargai. Kami percaya bahwa koneksi yang kuat dapat tumbuh secara alam—ketika orang-orang dipertemukan oleh minat yang sama.
        </p>
      </div>
      <div class="about-image">
        <img src="{{ asset('image/img (2).jpg') }}" alt="Tujuan Kami">
      </div>
    </section>

    <section class="about-row">
      <div class="about-image overlay-wrapper">
        <img src="{{ asset('image/img (3).jpg') }}" alt="Misi">
        <h2 class="overlay-text">Misi</h2>
      </div>
      <div class="about-text">
        <p>
          Menyediakan wadah komunitas dan forum terverifikasi yang ramah bagi semua pengguna, khususnya individu yang kesulitan bersosialisasi, dengan menghadirkan fitur komunitas, forum, dan event berbasis minat serta sistem apresiasi melalui leveling dan achievement untuk mendorong partisipasi positif.
        </p>
      </div>
    </section>

    <section class="about-row reverse">
      <div class="about-text">
        <p>
          Menjadi platform komunitas berbasis minat yang inklusif dan nyaman, tempat setiap hobi dapat menemukan komunitas yang sesuai, berkembang bersama, dan membangun koneksi secara alami tanpa tekanan interaksi realtime.
        </p>
      </div>
      <div class="about-image overlay-wrapper">
        <img src="{{ asset('image/img (4).jpg') }}" alt="Visi">
        <h2 class="overlay-text">Visi</h2>
      </div>
    </section>

    <section class="team-section">
      <h2 class="team-title">Tim Kami</h2>
      
      <div class="team-grid">
        <div class="team-card">
          <img src="{{ asset('image/download (13).jpg') }}" alt="Team Member">
          <div class="team-info">
            <h4>IHSAN ZUFAR A</h4>
            <span>UI/UX DESIGN</span>
          </div>
        </div>
        
        <div class="team-card">
          <img src="{{ asset('image/download (13).jpg') }}" alt="Team Member">
          <div class="team-info">
            <h4>HABIB FARHAN</h4>
            <span>FRONT END</span>
          </div>
        </div>

        <div class="team-card">
          <img src="{{ asset('image/download (13).jpg') }}" alt="Team Member">
          <div class="team-info">
            <h4>M BASIRU F. A. U</h4>
            <span>BACK END</span>
          </div>
        </div>

        <div class="team-card">
          <img src="{{ asset('image/download (13).jpg') }}" alt="Team Member">
          <div class="team-info">
            <h4>AFRIZAL IBNU AZIZ</h4>
            <span>BACK END</span>
          </div>
        </div>

        <div class="team-card">
          <img src="{{ asset('image/download (13).jpg') }}" alt="Team Member">
          <div class="team-info">
            <h4>RIDWAN KAMIL</h4>
            <span>Audit</span>
          </div>
        </div>

         <div class="team-card">
          <img src="{{ asset('image/download (13).jpg') }}" alt="Team Member">
          <div class="team-info">
            <h4>MBAK MBAK</h4>
            <span>Audit</span>
          </div>
        </div>

      </div>
    </section>

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
        <a href="#" class="social-icon">
          <svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
        </a>
        <a href="#" class="social-icon">
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