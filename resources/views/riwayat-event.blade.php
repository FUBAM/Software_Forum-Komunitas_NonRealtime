<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Event - ZHIB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('css/riwayat-event.css') }}">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
          <button class="nav-link active-nav" type="button">Event <span>▾</span></button>
          <div class="nav-dropdown-menu">
            <a href="{{ url('/event') }}">Cari Event</a>
            <a href="{{ url('/riwayat-event') }}" class="active">Riwayat Event</a>
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

  <main class="riwayat-page">
    <div class="container">

      <div class="top-search-bar">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Search">
      </div>

      <div class="big-tab-container">
        <button class="big-tab-btn" id="btnPast" onclick="switchTab('past')">Riwayat Event</button>
        <button class="big-tab-btn" id="btnUpcoming" onclick="switchTab('upcoming')">Event Mendatang</button>
      </div>

      <div id="past" class="tab-content active">
        <h2 class="section-title">Event yang Pernah Anda Ikuti</h2>
        
        <div class="history-grid">
          <div class="history-card">
            <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
            <div class="card-meta">
              <div class="meta-row"><i class="fa-regular fa-calendar"></i> 15 Desember 2025</div>
              <div class="meta-row"><i class="fa-solid fa-location-dot"></i> Bento Kopi JCM, Yogyakarta</div>
              <div class="meta-row"><i class="fa-solid fa-file-lines"></i> Sudah Selesai</div>
            </div>
          </div>

          <div class="history-card">
            <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
            <div class="card-meta">
              <div class="meta-row"><i class="fa-regular fa-calendar"></i> 15 Desember 2025</div>
              <div class="meta-row"><i class="fa-solid fa-location-dot"></i> Bento Kopi JCM, Yogyakarta</div>
              <div class="meta-row"><i class="fa-solid fa-file-lines"></i> Sudah Selesai</div>
            </div>
          </div>

          <div class="history-card">
            <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
            <div class="card-meta">
              <div class="meta-row"><i class="fa-regular fa-calendar"></i> 15 Desember 2025</div>
              <div class="meta-row"><i class="fa-solid fa-location-dot"></i> Bento Kopi JCM, Yogyakarta</div>
              <div class="meta-row"><i class="fa-solid fa-file-lines"></i> Sudah Selesai</div>
            </div>
          </div>

          <div class="history-card">
            <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
            <div class="card-meta">
              <div class="meta-row"><i class="fa-regular fa-calendar"></i> 15 Desember 2025</div>
              <div class="meta-row"><i class="fa-solid fa-location-dot"></i> Bento Kopi JCM, Yogyakarta</div>
              <div class="meta-row"><i class="fa-solid fa-file-lines"></i> Sudah Selesai</div>
            </div>
          </div>
        </div>
      </div>

      <div id="upcoming" class="tab-content">
        <h2 class="section-title">Event yang akan mendatang</h2>
        
        <div class="history-grid">
          <div class="history-card">
            <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
            <div class="card-meta">
              <div class="meta-row"><i class="fa-regular fa-calendar"></i> 15 Desember 2025</div>
              <div class="meta-row"><i class="fa-solid fa-location-dot"></i> Bento Kopi JCM, Yogyakarta</div>
              <div class="meta-row"><i class="fa-solid fa-file-lines"></i> Terdaftar</div>
            </div>
          </div>

          <div class="history-card">
            <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
            <div class="card-meta">
              <div class="meta-row"><i class="fa-regular fa-calendar"></i> 15 Desember 2025</div>
              <div class="meta-row"><i class="fa-solid fa-location-dot"></i> kopi kenangan, Yogyakarta</div>
              <div class="meta-row"><i class="fa-solid fa-file-lines"></i> Terdaftar</div>
            </div>
          </div>
           <div class="history-card">
            <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
            <div class="card-meta">
              <div class="meta-row"><i class="fa-regular fa-calendar"></i> 15 Desember 2025</div>
              <div class="meta-row"><i class="fa-solid fa-location-dot"></i> ayam artomoro, Yogyakarta</div>
              <div class="meta-row"><i class="fa-solid fa-file-lines"></i> Terdaftar</div>
            </div>
          </div>

          <div class="history-card">
            <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
            <div class="card-meta">
              <div class="meta-row"><i class="fa-regular fa-calendar"></i> 15 Desember 2025</div>
              <div class="meta-row"><i class="fa-solid fa-location-dot"></i> gudeg yu jum, Yogyakarta</div>
              <div class="meta-row"><i class="fa-solid fa-file-lines"></i> Terdaftar</div>
            </div>
          </div>
        </div>
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
    // 1. DROPDOWN NAVBAR
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

    // 2. TAB LOGIC (Disesuaikan dengan Desain Tombol Besar)
    function switchTab(tabName) {
      // Hide all content
      document.getElementById('past').style.display = 'none';
      document.getElementById('upcoming').style.display = 'none';
      
      // Reset buttons style (Grey bg, Black text)
      document.getElementById('btnPast').className = 'big-tab-btn';
      document.getElementById('btnUpcoming').className = 'big-tab-btn';

      // Show selected content
      document.getElementById(tabName).style.display = 'block';

      // Set active button style (Black bg, White text)
      if(tabName === 'past') {
        document.getElementById('btnPast').className = 'big-tab-btn active';
      } else {
        document.getElementById('btnUpcoming').className = 'big-tab-btn active';
      }
    }

    // Initialize: Jalankan tab pertama saat load
    window.onload = function() {
      switchTab('past'); // Default tab Riwayat
    }
  </script>

</div>
</body>
</html>