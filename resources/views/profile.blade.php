<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profile - ZHIB</title>
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<main class="profile-page">

  <section id="profileViewOwn" class="profile-card">

    <div class="profile-header-own">
      <div class="profile-avatar-section">
        <img class="profile-avatar" src="{{ asset('image/download (13).jpg') }}" alt="Avatar">
        <div class="profile-level-box">
          <span class="level-text">LVL. 999</span>
          <div class="level-bar">
            <div class="level-progress"></div>
          </div>
        </div>
      </div>

      <div class="profile-info-own">
        <h2>Windah Batubara</h2>

        <div class="profile-badges">
          <img src="{{ asset('image/badges/badge (1).png') }}" alt="Badge 1" class="badge">
          <img src="{{ asset('image/badges/badge (2).png') }}" alt="Badge 2" class="badge">
          <img src="{{ asset('image/badges/badge (3).png') }}" alt="Badge 3" class="badge">
          <img src="{{ asset('image/badges/badge (4).png') }}" alt="Badge 4" class="badge">
          <img src="{{ asset('image/badges/badge (5).png') }}" alt="Badge 5" class="badge">
        </div>

        <p class="profile-bio">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
        </p>
        
        <p class="join-date-text">
            <strong>Bergabung Sejak:</strong> 01 Desember 1961
        </p>
      </div>

      <button id="btnEditProfile" class="btn-edit">
        Edit Profil
      </button>
    </div>

    <div class="profile-content-full">
      <div class="profile-box-transparent">
        <h3 class="center-title">Aktivitas Terakhir</h3>
        <div class="activity-grid">
          <img src="{{ asset('image/img (5).jpg') }}" alt="Activity 1">
          <img src="{{ asset('image/img (2).jpg') }}" alt="Activity 2">
          <img src="{{ asset('image/img (3).jpg') }}" alt="Activity 3">
        </div>
      </div>
    </div>
  </section>

  <section id="profileEdit" class="profile-card hidden">

    <h2 class="section-title-center">Edit Profil</h2>

    <div class="edit-profile-top">
      <div class="edit-avatar">
        <img src="{{ asset('image/download (13).jpg') }}" alt="Avatar">
        <button class="btn-change-photo">Ganti Foto</button>
      </div>

      <div class="edit-form">
        <div class="form-row">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" value="Yanto Jawa">
          </div>
          <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" value="083141592653">
          </div>
        </div>

        <div class="form-row">
          
          <div class="left-column-inputs">
            <div class="form-group">
              <label>Username</label>
              <input type="text" value="Windah Batubara">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" value="windah17@gmail.com">
            </div>
          </div>

          <div class="form-group">
            <label>Bio / Tentang Saya</label>
            <textarea style="height: 100%;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</textarea>
          </div>

        </div>
      </div>
    </div>

    <h2 class="section-title-center">Atur Password</h2>

    <div class="edit-password">
      <div class="password-group">
        <label>Password Lama</label>
        <input type="password" placeholder="yanto123">
      </div>
      <div class="password-group">
        <label>Password Baru</label>
        <input type="password" placeholder="yanto1234">
      </div>
      <div class="password-group">
        <label>Konfirmasi Password</label>
        <input type="password" placeholder="yanto1234">
      </div>
    </div>

    <h2 class="section-title-center">Badge & Pencapaian</h2>

    <div class="badge-section">
      <p class="badge-section-title">Badge Aktif (Ditampilkan)</p>
      <div class="badge-list" id="activeBadges">
        <div class="badge-item-edit selected" data-badge="1">
          <img src="{{ asset('image/badges/badge (1).png') }}" alt="Badge 1">
        </div>
        <div class="badge-item-edit selected" data-badge="2">
          <img src="{{ asset('image/badges/badge (2).png') }}" alt="Badge 2">
        </div>
        <div class="badge-item-edit selected" data-badge="3">
          <img src="{{ asset('image/badges/badge (3).png') }}" alt="Badge 3">
        </div>
        <div class="badge-item-edit selected" data-badge="4">
          <img src="{{ asset('image/badges/badge (4).png') }}" alt="Badge 4">
        </div>
        <div class="badge-item-edit selected" data-badge="5">
          <img src="{{ asset('image/badges/badge (5).png') }}" alt="Badge 5">
        </div>
      </div>

      <p class="badge-section-title">Badge yang Dimiliki</p>
      <div class="badge-list large" id="allBadges">
        <div class="badge-item-edit" data-badge="1">
          <img src="{{ asset('image/badges/badge (1).png') }}" alt="Badge 1">
        </div>
        <div class="badge-item-edit" data-badge="2">
          <img src="{{ asset('image/badges/badge (2).png') }}" alt="Badge 2">
        </div>
        <div class="badge-item-edit" data-badge="3">
          <img src="{{ asset('image/badges/badge (3).png') }}" alt="Badge 3">
        </div>
        <div class="badge-item-edit" data-badge="4">
          <img src="{{ asset('image/badges/badge (4).png') }}" alt="Badge 4">
        </div>
        <div class="badge-item-edit" data-badge="5">
          <img src="{{ asset('image/badges/badge (5).png') }}" alt="Badge 5">
        </div>
        <div class="badge-item-edit" data-badge="6">
          <img src="{{ asset('image/badges/badge (6).png') }}" alt="Badge 6">
        </div>
      </div>
    </div>

    <div class="edit-actions">
      <button id="btnCancel" class="btn-cancel"> Batal </button>
      <button class="btn-save">Simpan</button>
    </div>

  </section>

  <section id="profileViewOther" class="profile-card hidden">
    
    <h2 class="section-title-center">Profil Pengguna</h2>

    <div class="profile-header-other">
      <div class="profile-avatar-section-center">
        <img class="profile-avatar" src="{{ asset('image/download (13).jpg') }}" alt="Avatar">
      </div>

      <div class="profile-info-center">
        <h2>Windah Batubara</h2>

        <p class="profile-bio-center">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
        </p>

        <div class="badge-title">Badge & Pencapaian</div>
        <div class="profile-badges-center">
          <img src="{{ asset('image/badges/badge (1).png') }}" alt="Badge 1" class="badge">
          <img src="{{ asset('image/badges/badge (2).png') }}" alt="Badge 2" class="badge">
          <img src="{{ asset('image/badges/badge (3).png') }}" alt="Badge 3" class="badge">
          <img src="{{ asset('image/badges/badge (4).png') }}" alt="Badge 4" class="badge">
          <img src="{{ asset('image/badges/badge (5).png') }}" alt="Badge 5" class="badge">
        </div>

        <div class="join-date">Bergabung sejak Agustus 2025</div>
      </div>
    </div>

    <div class="profile-single-box">
      <h3>Aktivitas Terakhir</h3>
      <div class="activity-grid">
        <img src="{{ asset('image/img (5).jpg') }}" alt="Activity 1">
        <img src="{{ asset('image/img (2).jpg') }}" alt="Activity 2">
        <img src="{{ asset('image/img (3).jpg') }}" alt="Activity 3">
      </div>
    </div>

  </section>

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
  const profileViewOwn = document.getElementById('profileViewOwn');
  const profileEdit = document.getElementById('profileEdit');
  const profileViewOther = document.getElementById('profileViewOther');

  const btnEdit = document.getElementById('btnEditProfile');
  const btnCancel = document.getElementById('btnCancel');

  const params = new URLSearchParams(window.location.search);
  const viewedUser = params.get('user');
  const isEdit = params.get('edit') === 'true';

  // ======================
  // PROFIL PUBLIK
  // ======================
  if (viewedUser) {
    profileViewOwn.classList.add('hidden');
    profileEdit.classList.add('hidden');
    profileViewOther.classList.remove('hidden');
  }

  // ======================
  // PROFIL SENDIRI
  // ======================
  else {
    profileViewOther.classList.add('hidden');

    if (isEdit) {
      profileViewOwn.classList.add('hidden');
      profileEdit.classList.remove('hidden');
    } else {
      profileViewOwn.classList.remove('hidden');
      profileEdit.classList.add('hidden');
    }
  }

  // ======================
  // BUTTON ACTION
  // ======================
  if (btnEdit) {
    btnEdit.onclick = () => {
      // Menggunakan Laravel URL
      window.location.href = "{{ url('/profile') }}?edit=true";
    };
  }

  if (btnCancel) {
    btnCancel.onclick = () => {
      // Menggunakan Laravel URL
      window.location.href = "{{ url('/profile') }}";
    };
  }

  // ==========================================
  // LOGIKA DROPDOWN NAVBAR (Copy dari Home)
  // ==========================================
  const profileToggle = document.getElementById('profileToggle');
  const profileDropdown = document.getElementById('profileDropdown');

  // Cek apakah elemen ada sebelum menjalankan (untuk menghindari error)
  if (profileToggle && profileDropdown) {
    profileToggle.addEventListener('click', (e) => {
      e.stopPropagation(); // Mencegah klik tembus
      profileDropdown.classList.toggle('active');
    });

    // Tutup dropdown jika klik di luar
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