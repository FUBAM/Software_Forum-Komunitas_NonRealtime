<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Komunitas Saya - ZHIB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('css/komunitas-saya.css') }}">
  
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
          <a href="{{ url('/komunitas-saya') }}" class="active">Komunitas Saya</a>
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

<main class="my-comm-page">
  <div class="container">

    <div class="page-header">
      <h1 class="page-title">Grup Saya</h1>
      <div class="search-box">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="searchInput" placeholder="Search" onkeyup="searchMyCommunity()">
      </div>
    </div>

    <div class="community-list" id="communityList">

      <div class="comm-card">
        <div class="comm-img">
          <img src="{{ asset('image/img (9).jpg') }}" alt="Komunitas KDI">
        </div>
        <div class="comm-content">
          <h2 class="comm-title">Komunitas Desain Indonesia (KDI)</h2>
          <p class="comm-desc">
            Komunitas Desain Indonesia mewadahi desainer grafis, UI/UX, dan ilustrator dari seluruh Indonesia untuk berbagi karya.
          </p>
        </div>
        <div class="comm-action">
           <a href="{{ url('/chat') }}" class="btn-open-chat">Masuk Grup <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>

      <div class="comm-card">
        <div class="comm-img">
          <img src="{{ asset('image/img (9).jpg') }}" alt="Komunitas Front-End">
        </div>
        <div class="comm-content">
          <h2 class="comm-title">Komunitas Front-End Dev</h2>
          <p class="comm-desc">
            Wadah bagi para pengembang web front-end untuk saling berbagi tips seputar HTML, CSS, JavaScript.
          </p>
        </div>
        <div class="comm-action">
           <a href="{{ url('/chat') }}" class="btn-open-chat">Masuk Grup <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>

       <div class="comm-card">
        <div class="comm-img">
          <img src="{{ asset('image/img (9).jpg') }}" alt="Pecinta Kucing">
        </div>
        <div class="comm-content">
          <h2 class="comm-title">Pecinta Kucing Yogyakarta</h2>
          <p class="comm-desc">
            Komunitas lokal untuk berbagi informasi seputar perawatan kucing dan adopsi.
          </p>
        </div>
        <div class="comm-action">
           <a href="{{ url('/chat') }}" class="btn-open-chat">Masuk Grup <i class="fa-solid fa-arrow-right"></i></a>
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
      <a href="{{ url('/tentang_kami') }}" class="footer-text-link">Tentang Kami</a>
    </div>
  </div>
</footer>

<script>
  // 1. DROPDOWN NAVBAR (Wajib Ada)
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

  // 2. SEARCH FUNCTION (Client Side Search)
  function searchMyCommunity() {
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