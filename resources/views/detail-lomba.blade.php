<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Lomba - ZHIB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  <link rel="stylesheet" href="{{ asset('css/event.css') }}">
  <link rel="stylesheet" href="{{ asset('css/detail-lomba.css') }}">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

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
            <a href="{{ url('/profile?edit=true') }}">Edit Profil</a>
            <hr>
            <a href="{{ url('/') }}" class="logout">Logout</a>
          </div>
        </div>
      </div>
    </div>
</header>

<main class="detail-page">
    <div class="detail-container">
        
        <div class="poster-wrapper">
            <img src="{{ asset('image/img (3).jpg') }}" alt="Poster Mobile Legends" class="poster-img">
        </div>

        <h1 class="detail-title">Mobile Legends Offline Tournament - Kopi Selon Cup</h1>

        <div class="detail-content">
            <p>
                Ikuti turnamen offline Mobile Legends Bang Bang (MLBB) di Kopi Selon! Buktikan kekompakan tim kalian dan rebut total hadiah (Prize Pool) sebesar Rp 1.600.000.
            </p>

            <ul class="detail-list">
                <li>Slot Terbatas: Hanya untuk 32 Tim (Slot).</li>
                <li>Format: Offline Tournament.</li>
                <li>Open Registration: 03 - 15 September 2023.</li>
            </ul>

            <div class="info-row">
                <i class="fa-solid fa-location-dot"></i>
                <span>Kopi Selon Yogyakarta, Jl. Kaliurang KM 5 No. 12, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta.</span>
            </div>

            <div class="info-row">
                <i class="fa-regular fa-clock"></i>
                <span>09:00 WIB</span>
            </div>

            <div class="info-row">
                <i class="fa-regular fa-calendar"></i>
                <span>21 Januari 2026</span>
            </div>

            <p class="price-text">Biaya Pendaftaran: Rp 50.000</p>

            <p class="contact-text"><strong>Contact Person:</strong> 08523XXXX (Admin 1) / 08787XXXX (Admin 2).</p>

            <button class="btn-daftar-hitam" onclick="window.location.href='{{ url('/daftar-esports') }}'">Daftar</button>
        </div>

    </div>
</main>

<footer>
  <div class="footer-container">
    
    <div class="footer-section">
      <h3 class="footer-brand">ZHIB</h3>
      <div class="footer-social">
        <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" class="social-link"><i class="fa-brands fa-facebook"></i></a>
        <a href="#" class="social-link"><i class="fa-brands fa-twitter"></i></a>
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
      <a href="{{ url('/tentang-kami') }}" class="footer-text-link">Tentang Kami</a>
    </div>

  </div>
</footer>

<script>
    // SCRIPT DROPDOWN PROFIL
    const profileToggle = document.getElementById('profileToggle');
    if (profileToggle) {
      profileToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        document.getElementById('profileDropdown').classList.toggle('active');
      });
      
      document.addEventListener('click', (e) => {
          const dropdown = document.getElementById('profileDropdown');
          if (dropdown && !dropdown.contains(e.target)) {
              dropdown.classList.remove('active');
          }
      });
    }
</script>

</body>
</html>