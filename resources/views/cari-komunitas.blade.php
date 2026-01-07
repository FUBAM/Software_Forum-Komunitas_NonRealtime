<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cari Komunitas - ZHIB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cari-komunitas.css') }}">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="page-wrapper">

<header class="navbar">
  <div class="navbar-container">
    <div class="nav-left">
      <a href="{{ url('/home') }}" class="nav-item">Home</a>
      <div class="nav-dropdown">
        <button class="nav-link active-nav" type="button">Komunitas <span>▾</span></button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/komunitas-saya') }}">Komunitas Saya</a>
          <a href="{{ url('/cari-komunitas') }}" class="active">Cari Komunitas</a>
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

<main class="comm-page">
  <div class="comm-container">

    <div class="search-bar-wrapper">
      <button class="btn-filter" onclick="openFilter()">
        <i class="fa-solid fa-sliders"></i> Filters
      </button>
      
      <div class="search-input-group">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="searchInput" placeholder="Search" onkeyup="searchCommunity()">
      </div>
    </div>

    <div class="community-list" id="communityList">

      <div class="comm-card">
        <div class="comm-img">
            <img src="{{ asset('image/img (2).jpg') }}" alt="Komunitas">
        </div>
        <div class="comm-content">
          <h2 class="comm-title">Komunitas Indonesia Belajar</h2>
          <p class="comm-desc">
            Indonesia Belajar adalah komunitas nasional yang fokus pada pengembangan diri dan literasi belajar sepanjang hayat. Eventnya meliputi diskusi daring, kelas pengembangan skill, dan berbagi insight edukatif dengan suasana inklusif dan tidak memaksa interaksi aktif.
          </p>
          <span class="comm-stat">100 orang masuk di komunitas ini</span>
        </div>
        <div class="comm-action">
          <button class="btn-join" onclick="openJoinPopup('Komunitas Indonesia Belajar')">Bergabung</button>
        </div>
      </div>

      <div class="comm-card">
        <div class="comm-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Komunitas">
        </div>
        <div class="comm-content">
          <h2 class="comm-title">Komunitas Desain Indonesia (KDI)</h2>
          <p class="comm-desc">
            Komunitas Desain Indonesia mewadahi desainer grafis, UI/UX, dan ilustrator dari seluruh Indonesia untuk berbagi karya, berdiskusi, serta belajar bersama. Interaksi lebih banyak berbasis karya sehingga cocok bagi anggota yang tidak terlalu suka komunikasi verbal intens.
          </p>
          <span class="comm-stat">200 orang masuk di komunitas ini</span>
        </div>
        <div class="comm-action">
          <button class="btn-join" onclick="openJoinPopup('Komunitas Desain Indonesia (KDI)')">Bergabung</button>
        </div>
      </div>

      <div class="comm-card">
        <div class="comm-img">
            <img src="{{ asset('image/img (9).jpg') }}" alt="Komunitas">
        </div>
        <div class="comm-content">
          <h2 class="comm-title">Indonesia Linux Community (ILC)</h2>
          <p class="comm-desc">
            Indonesia Linux Community adalah komunitas nasional bagi pengguna dan pengembang Linux serta open-source. Eventnya meliputi diskusi teknis, berbagi tutorial, dan kolaborasi proyek secara online maupun offline dengan pendekatan komunitas yang tenang dan berbasis minat.
          </p>
          <span class="comm-stat">200 orang masuk di komunitas ini</span>
        </div>
        <div class="comm-action">
          <button class="btn-join" onclick="openJoinPopup('Indonesia Linux Community (ILC)')">Bergabung</button>
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

<div class="modal-overlay" id="filterModal">
  <div class="modal-box custom-filter-box">
    
    <button class="close-filter-btn" onclick="closeModals()">×</button>

    <form action="" method="GET">
      <div class="filter-container">
        
        <div class="filter-column">
          <div class="filter-header-pill">Provinsi <span>▾</span></div>
          <div class="filter-options-card">
            <label class="checkbox-item">
              <input type="checkbox" name="prov[]" value="jateng">
              <span>Jawa Tengah</span>
            </label>
            <label class="checkbox-item">
              <input type="checkbox" name="prov[]" value="diy" checked>
              <span>Daerah Istimewa Yogyakarta</span>
            </label>
            <label class="checkbox-item">
              <input type="checkbox" name="prov[]" value="kaltim">
              <span>Kalimantan Timur</span>
            </label>
            <label class="checkbox-item">
              <input type="checkbox" name="prov[]" value="papua">
              <span>Papua Barat</span>
            </label>
            <div class="more-options">+ More</div>
          </div>
        </div>

        <div class="filter-column">
          <div class="filter-header-pill">Kota <span>▾</span></div>
          <div class="filter-options-card">
            <label class="checkbox-item">
              <input type="checkbox" name="kota[]" value="jogja">
              <span>Yogyakarta</span>
            </label>
            <label class="checkbox-item">
              <input type="checkbox" name="kota[]" value="sleman" checked>
              <span>Sleman</span>
            </label>
            <label class="checkbox-item">
              <input type="checkbox" name="kota[]" value="bantul">
              <span>Bantul</span>
            </label>
            <label class="checkbox-item">
              <input type="checkbox" name="kota[]" value="kulonprogo">
              <span>Kulon Progo</span>
            </label>
          </div>
        </div>

        <div class="filter-column">
          <div class="filter-header-pill">Kategori <span>▾</span></div>
          <div class="filter-options-card">
            <label class="checkbox-item">
              <input type="checkbox" name="cat[]" value="gaming">
              <span>Gaming & E-sport</span>
            </label>
            <label class="checkbox-item">
              <input type="checkbox" name="cat[]" value="tech" checked>
              <span>Teknologi & Coding</span>
            </label>
            <label class="checkbox-item">
              <input type="checkbox" name="cat[]" value="art">
              <span>Seni & Desain</span>
            </label>
            <label class="checkbox-item">
              <input type="checkbox" name="cat[]" value="health">
              <span>Kesehatan Mental</span>
            </label>
            <div class="more-options">+ More</div>
          </div>
        </div>

      </div>

      <div class="filter-footer-custom">
        <button type="submit" class="btn-black-filter">Filter</button>
      </div>
    </form>
  </div>
</div>

<div class="modal-overlay" id="joinModal">
  <div class="modal-box join-box-custom">
    
    <h3>Yakin mau gabung<br>Komunitas ini dek !?!</h3>
    
    <div class="join-buttons">
      <button class="btn-pill" onclick="closeModals()">Gajadi Bg</button>
      <button class="btn-pill" onclick="confirmJoin()">Yakin Bg</button>
    </div>
  </div>
</div>

<script>
  // ================= 1. DROPDOWN NAVBAR =================
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

  // ================= 2. MODAL & LOGIC GABUNG (UPDATED) =================
  const filterModal = document.getElementById('filterModal');
  const joinModal = document.getElementById('joinModal');
  
  // Variabel Global
  let selectedCommunity = {}; 

  function closeModals() {
    if(filterModal) filterModal.classList.remove('active');
    if(joinModal) joinModal.classList.remove('active');
  }

  function openFilter() {
    if(filterModal) filterModal.classList.add('active');
  }

  // --- FUNGSI JOIN ---
  function openJoinPopup(name, image, desc) {
    selectedCommunity = { name: name, image: image, desc: desc };
    const popupTitle = document.querySelector('.join-box-custom h3');
    if (popupTitle) {
        popupTitle.innerHTML = `Yakin mau gabung<br>${name} dek !?!`;
    }
    joinModal.classList.add('active');
  }

  // --- FUNGSI KONFIRMASI (YAKIN BG) ---
  function confirmJoin() {
    // Redirect menggunakan Blade URL syntax di dalam Javascript
    window.location.href = "{{ url('/komunitas-saya') }}";
  }

  // Tutup modal jika klik di luar kotak
  window.onclick = function(event) {
    if (event.target == filterModal) closeModals();
    if (event.target == joinModal) closeModals();
  }

  // ================= 3. FUNGSI SEARCH =================
  function searchCommunity() {
    let input = document.getElementById('searchInput').value.toLowerCase();
    let cards = document.getElementsByClassName('comm-card');

    for (let i = 0; i < cards.length; i++) {
      let title = cards[i].getElementsByClassName('comm-title')[0].textContent.toLowerCase();
      let desc = cards[i].getElementsByClassName('comm-desc')[0].textContent.toLowerCase();
      if (title.includes(input) || desc.includes(input)) {
        cards[i].style.display = "flex";
      } else {
        cards[i].style.display = "none";
      }
    }
  }
</script>

</div>
</body>
</html>