@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/event.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@endsection

@section('content')
<main class="event-page">
  <div class="event-container">
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
          <a href="{{ url('/event') }}" class="active">Cari Event</a>
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

  <main class="event-page">
    <div class="event-container">

      <div class="search-bar-wrapper">
        <button class="btn-filter" onclick="openFilter()">
          Filters <i class="fa-solid fa-sliders"></i>
        </button>
        <div class="search-input-group">
          <i class="fa-solid fa-magnifying-glass search-icon"></i>
          <input type="text" id="searchEventInput" placeholder="Search events, competitions..." onkeyup="searchEvent()">
        </div>
      </div>

      <div class="event-grid" id="eventGrid">

        <div class="event-card">
          <div class="card-img">
            <img src="{{ asset('image/img (2).jpg') }}" alt="Poster Event">
          </div>
          <div class="card-content">
            <h3 class="event-title">Kompetisi Offline Mobile Legend</h3>
            <div class="event-meta">
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i> 7 Januari 2026
              </div>
              <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i> Yogyakarta
              </div>
            </div>
          </div>
        </div>

        <div class="event-card">
          <div class="card-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Event">
          </div>
          <div class="card-content">
            <h3 class="event-title">Lomba Desain Poster Nasional</h3>
            <div class="event-meta">
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i> 14 Februari 2026
              </div>
              <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i> Online (Zoom)
              </div>
            </div>
          </div>
        </div>

        <div class="event-card">
          <div class="card-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Event">
          </div>
          <div class="card-content">
            <h3 class="event-title">Hackathon Mahasiswa 2026</h3>
            <div class="event-meta">
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i> 20 Maret 2026
              </div>
              <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i> Jakarta Pusat
              </div>
            </div>
          </div>
        </div>

        <div class="event-card">
          <div class="card-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Event">
          </div>
          <div class="card-content">
            <h3 class="event-title">Festival Musik Indie Jogja</h3>
            <div class="event-meta">
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i> 5 April 2026
              </div>
              <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i> Sleman, DIY
              </div>
            </div>
          </div>
        </div>

        <div class="event-card">
          <div class="card-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Event">
          </div>
          <div class="card-content">
            <h3 class="event-title">Seminar Cyber Security</h3>
            <div class="event-meta">
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i> 10 Mei 2026
              </div>
              <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i> Bandung
              </div>
            </div>
          </div>
        </div>

        <div class="event-card">
          <div class="card-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Event">
          </div>
          <div class="card-content">
            <h3 class="event-title">Workshop Fotografi Jalanan</h3>
            <div class="event-meta">
              <div class="meta-item">
                <i class="fa-regular fa-calendar"></i> 12 Juni 2026
              </div>
              <div class="meta-item">
                <i class="fa-solid fa-location-dot"></i> Surabaya
              </div>
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
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
            </svg>
          </a>
          <a href="#" class="social-link">
            <svg viewBox="0 0 24 24" fill="currentColor" stroke="none">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
            </svg>
          </a>
          <a href="#" class="social-link">
            <svg viewBox="0 0 24 24" fill="currentColor" stroke="none">
              <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
            </svg>
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


    <div id="filterModal" class="modal-overlay">
      <div class="modal-box">
        <div class="modal-header">
          <h3>Filter Event</h3>
          <button class="close-btn" onclick="closeFilter()">&times;</button>
        </div>

        <div class="modal-body">
          <div class="filter-group">
            <label class="filter-label">Kategori</label>
            <div class="checkbox-group">
              <label><input type="checkbox"> Lomba / Kompetisi</label>
              <label><input type="checkbox"> Workshop</label>
              <label><input type="checkbox"> Seminar / Webinar</label>
              <label><input type="checkbox"> Exhibition</label>
            </div>
          </div>

          <div class="filter-group">
            <label class="filter-label">Lokasi</label>
            <select class="filter-select">
              <option>Semua Lokasi</option>
              <option>Online (Zoom/Gmeet)</option>
              <option>Yogyakarta</option>
              <option>Jakarta</option>
              <option>Bandung</option>
              <option>Surabaya</option>
            </select>
          </div>

          <div class="filter-group">
            <label class="filter-label">Waktu Pelaksanaan</label>
            <div class="checkbox-group">
              <label><input type="checkbox"> Minggu Ini</label>
              <label><input type="checkbox"> Bulan Ini</label>
              <label><input type="checkbox"> 3 Bulan Kedepan</label>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn-reset">Reset</button>
          <button class="btn-apply" onclick="closeFilter()">Terapkan</button>
        </div>
      </div>
    </div>

    </div>
</main>
@endsection

@section('scripts')
<script>
  // 1. DROPDOWN NAVBAR handled by header partial
  // Header script toggles `#profileDropdown` and closes other nav dropdowns when needed

  // 2. SEARCH FUNCTION (Client Side)
  function searchEvent() {
    let input = document.getElementById('searchEventInput').value.toLowerCase();
    let cards = document.getElementsByClassName('event-card');

    for (let i = 0; i < cards.length; i++) {
      let title = cards[i].getElementsByClassName('event-title')[0].textContent.toLowerCase();
      let loc = cards[i].getElementsByClassName('event-meta')[0].textContent.toLowerCase(); // Cek lokasi juga

      if (title.includes(input) || loc.includes(input)) {
        cards[i].style.display = "block"; // Tampilkan (block karena dalam grid)
      } else {
        cards[i].style.display = "none"; // Sembunyikan
      }
    }
  }

  // === TAMBAHKAN KODE INI DI DALAM SCRIPT ===
  const filterModal = document.getElementById('filterModal');

  function openFilter() {
    if (filterModal) filterModal.classList.add('active');
  }

  function closeFilter() {
    if (filterModal) filterModal.classList.remove('active');
  }

  // Tutup jika user klik di luar kotak popup
  window.onclick = function(event) {
    if (event.target == filterModal) {
      closeFilter();
    }
  }
</script>
</script>
@endsection