<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Events - KOMUNITAS DESAIN INDONESIA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/grup-event.css') }}">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

  <header class="event-header">
    <div class="header-left">
      <a href="{{ url('/chat') }}" class="header-link">Chat</a>
      <a href="{{ url('/grup-event') }}" class="header-link active">Events</a>
    </div>

    <div class="header-center">
      <h1>KOMUNITAS DESAIN INDONESIA</h1>
    </div>

    <div class="header-right">
      <div class="search-pill">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Search">
      </div>
    </div>
  </header>

  <main class="event-container">

    <section class="section-group">
      <h2 class="section-title">KEGIATAN MENDATANG</h2>
      
      <div class="activity-grid">
        <div class="activity-card">
          <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
          <div class="meta-info">
            <div class="meta-item">
              <i class="fa-regular fa-calendar"></i> 15 Desember 2025
            </div>
            <div class="meta-item">
              <i class="fa-solid fa-location-dot"></i> Bento Kopi JCM, Yogyakarta
            </div>
            <div class="meta-item status-registered">
              <i class="fa-solid fa-clipboard-check"></i> Terdaftar
            </div>
          </div>
        </div>

        <div class="activity-card">
          <h3>Workshop Design System untuk Pemula</h3>
          <div class="meta-info">
            <div class="meta-item">
              <i class="fa-regular fa-calendar"></i> 20 Desember 2025
            </div>
            <div class="meta-item">
              <i class="fa-solid fa-location-dot"></i> Co-Working Space, Sleman
            </div>
            <div class="meta-item status-registered">
              <i class="fa-solid fa-clipboard-check"></i> Terdaftar
            </div>
          </div>
        </div>

        <div class="activity-card">
          <h3>Sharing Session: Freelance Designer</h3>
          <div class="meta-info">
            <div class="meta-item">
              <i class="fa-regular fa-calendar"></i> 15 Januari 2026
            </div>
            <div class="meta-item">
              <i class="fa-solid fa-location-dot"></i> Online (Zoom)
            </div>
            <div class="meta-item status-registered">
              <i class="fa-solid fa-clipboard-check"></i> Terdaftar
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-group">
      <h2 class="section-title">LOMBA MENDATANG</h2>
      
      <div class="competition-grid">
        <div class="comp-card">
          <div class="comp-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Lomba">
          </div>
          <div class="comp-content">
            <h4>Kompetisi Offline Mobile Legend</h4>
            <div class="meta-info">
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i> 7 Januari 2026
              </div>
              <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i> Yogyakarta
              </div>
            </div>
          </div>
        </div>

        <div class="comp-card">
          <div class="comp-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Lomba">
          </div>
          <div class="comp-content">
            <h4>Hackathon UI/UX Nasional</h4>
            <div class="meta-info">
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i> 10 Februari 2026
              </div>
              <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i> Jakarta
              </div>
            </div>
          </div>
        </div>

        <div class="comp-card">
          <div class="comp-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Lomba">
          </div>
          <div class="comp-content">
            <h4>Lomba Ilustrasi Karakter 2026</h4>
            <div class="meta-info">
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i> 1 Maret 2026
              </div>
              <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i> Bandung
              </div>
            </div>
          </div>
        </div>

        <div class="comp-card">
          <div class="comp-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Lomba">
          </div>
          <div class="comp-content">
            <h4>Design Sprint Challenge</h4>
            <div class="meta-info">
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i> 5 April 2026
              </div>
              <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i> Surabaya
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="slider-nav">
        <button class="nav-btn"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="nav-btn"><i class="fa-solid fa-chevron-right"></i></button>
      </div>
    </section>

  </main>

<footer>
  <div class="footer-container">
    <div class="footer-section">
      <h3 class="footer-brand">ZHIB</h3>
      <div class="footer-social">
        <a href="#" class="social-link"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
        <a href="#" class="social-link"><svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
        <a href="#" class="social-link"><svg viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg></a>
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

</body>
</html>