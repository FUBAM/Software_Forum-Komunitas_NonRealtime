<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi E-Sports - ZHIB</title>
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('css/form-lomba.css') }}">

  <style>
    /* --- CUSTOM STYLE UNTUK HALAMAN INI --- */
    
    /* Background Hero (Menggunakan asset Laravel) */
    .hero-section { 
        background-image: url("{{ asset('image/esport.jpg') }}"); 
    }

    /* Layout Grid 3 Kolom untuk Anggota Tim */
    .form-row-3 {
        display: grid; grid-template-columns: 1.5fr 1fr 1fr; gap: 15px;
    }

    /* Sub-Section Header */
    .sub-section-title {
        font-size: 14px; font-weight: 800; color: #111; margin-top: 30px; margin-bottom: 15px;
        display: flex; align-items: center; gap: 8px;
    }

    /* Box Container Ringan */
    .member-box {
        background-color: #F8F9FB; /* Abu sangat muda */
        padding: 20px; border-radius: 8px; border: 1px solid #eee; margin-bottom: 20px;
    }

    /* Label kecil */
    .member-label {
        font-size: 12px; font-weight: 700; color: #555; margin-bottom: 10px; display: block;
    }

    /* Styling khusus input kecil di grid anggota */
    .input-small {
        width: 100%; padding: 10px; border: 1px solid #E5E7EB; border-radius: 6px; font-family: 'Inter'; font-size: 13px;
    }

    /* Responsif Mobile */
    @media (max-width: 640px) {
        .form-row-3 { grid-template-columns: 1fr; gap: 10px; }
    }
  </style>
</head>
<body>

<header class="navbar">
  <div class="navbar-container">
    <nav class="nav-left">
      <a href="{{ url('/home') }}" class="nav-item">Home</a>
      <div class="nav-dropdown" id="komunitasDropdown">
        <button class="nav-link" id="komunitasToggle">Komunitas <span class="arrow">▾</span></button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/komunitas-saya') }}">Komunitas Saya</a>
          <a href="{{ url('/cari-komunitas') }}">Cari Komunitas</a>
        </div>
      </div>
      <div class="nav-dropdown" id="eventDropdown">
        <button class="nav-link" id="eventToggle">Event <span class="arrow">▾</span></button>
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
          <div class="profile-text"><div class="profile-name">Windah Batubara</div><div class="profile-level">LVL. 999</div></div>
          <img src="{{ asset('image/download (13).jpg') }}" class="profile-avatar" alt="Profile">
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

<div class="form-area-wrapper">
    <section class="hero-section">
        <div class="hero-content">
            <h2>REGISTRASI KOMPETISI</h2>
            <p>Daftarkan diri atau timmu untuk mengikuti kompetisi bergengsi. Pastikan data yang diisi valid dan sesuai.</p>
        </div>
    </section>

    <main class="form-container">
        <div class="form-card">
            
            <div class="form-title-box">
                <h3><i class="fa-solid fa-file-contract"></i> FORMULIR PENDAFTARAN TIM</h3>
                <p>Lengkapi formulir di bawah ini dengan data tim yang benar.</p>
            </div>

            <form>
                <div class="form-group">
                    <label>Nama Lengkap Pendaftar</label>
                    <div class="input-with-icon">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" placeholder="Masukkan nama lengkap sesuai identitas">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Email Aktif</label>
                        <div class="input-with-icon"><i class="fa-regular fa-envelope"></i><input type="email" placeholder="nama@email.com"></div>
                    </div>
                    <div class="form-group">
                        <label>Nomor WhatsApp Aktif</label>
                        <div class="input-with-icon"><i class="fa-solid fa-mobile-screen"></i><input type="text" placeholder="081234567890"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Domisili (Kota/Kabupaten)</label>
                    <div class="input-with-icon"><i class="fa-solid fa-location-dot"></i><input type="text" placeholder="Contoh: Bandung"></div>
                </div>

                <h4 class="sub-section-title"><i class="fa-solid fa-users"></i> Informasi Tim</h4>

                <div class="form-group">
                    <label>Nama Tim</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-trophy"></i>
                        <input type="text" placeholder="Masukkan nama tim">
                    </div>
                </div>

                <div class="member-box">
                    <label class="member-label">Data Kapten Tim</label>
                    
                    <div class="form-group">
                        <label>Nama Lengkap Kapten</label>
                        <div class="input-with-icon">
                            <i class="fa-solid fa-crown"></i>
                            <input type="text" placeholder="Nama Lengkap Kapten">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nickname Akun</label>
                            <input type="text" placeholder="Nickname In-game" class="input-small">
                        </div>
                        <div class="form-group">
                            <label>ID Akun</label>
                            <input type="text" placeholder="ID Akun Game" class="input-small">
                        </div>
                    </div>
                </div>

                <h4 class="sub-section-title">Daftar Anggota Tim Inti</h4>

                <div class="member-box">
                    <label class="member-label">Anggota 1</label>
                    <div class="form-row-3">
                        <div>
                            <label style="font-size:11px; color:#777;">Nama Lengkap</label>
                            <input type="text" placeholder="Nama" class="input-small">
                        </div>
                        <div>
                            <label style="font-size:11px; color:#777;">Nickname</label>
                            <input type="text" placeholder="Nickname" class="input-small">
                        </div>
                        <div>
                            <label style="font-size:11px; color:#777;">ID Akun</label>
                            <input type="text" placeholder="ID" class="input-small">
                        </div>
                    </div>
                </div>

                <div class="member-box">
                    <label class="member-label">Anggota 2</label>
                    <div class="form-row-3">
                        <div><input type="text" placeholder="Nama" class="input-small"></div>
                        <div><input type="text" placeholder="Nickname" class="input-small"></div>
                        <div><input type="text" placeholder="ID" class="input-small"></div>
                    </div>
                </div>

                <div class="member-box">
                    <label class="member-label">Anggota 3</label>
                    <div class="form-row-3">
                        <div><input type="text" placeholder="Nama" class="input-small"></div>
                        <div><input type="text" placeholder="Nickname" class="input-small"></div>
                        <div><input type="text" placeholder="ID" class="input-small"></div>
                    </div>
                </div>

                <div class="member-box">
                    <label class="member-label">Anggota 4</label>
                    <div class="form-row-3">
                        <div><input type="text" placeholder="Nama" class="input-small"></div>
                        <div><input type="text" placeholder="Nickname" class="input-small"></div>
                        <div><input type="text" placeholder="ID" class="input-small"></div>
                    </div>
                </div>

                <div class="separator">Dokumen Pendukung</div>

                <div class="form-group">
                    <label>Upload Identitas (KTP/Kartu Pelajar)</label>
                    <div class="upload-box">
                        <i class="fa-regular fa-id-card upload-icon"></i>
                        <div class="upload-text"><p>Upload file atau drag and drop</p><span>PNG, JPG, PDF up to 2MB</span></div>
                        <input type="file" hidden>
                    </div>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="agree">
                    <label for="agree">Saya menyetujui syarat dan ketentuan.<br>Semua data yang saya isi adalah benar dan dapat dipertanggungjawabkan.</label>
                </div>

                <button type="button" class="btn-submit" onclick="alert('Pendaftaran Squad Terkirim!')">KIRIM PENDAFTARAN</button>
            </form>
        </div>
    </main>
</div>

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
    const profileToggle = document.getElementById('profileToggle');
    const profileDropdown = document.getElementById('profileDropdown');
    const komunitasToggle = document.getElementById('komunitasToggle');
    const komunitasDropdown = document.getElementById('komunitasDropdown');
    const eventToggle = document.getElementById('eventToggle');
    const eventDropdown = document.getElementById('eventDropdown');

    function closeAll(except) {
        if(except !== profileDropdown) profileDropdown.classList.remove('active');
        if(except !== komunitasDropdown) komunitasDropdown.classList.remove('active');
        if(except !== eventDropdown) eventDropdown.classList.remove('active');
    }

    if (profileToggle) {
        profileToggle.addEventListener('click', (e) => { e.stopPropagation(); profileDropdown.classList.toggle('active'); closeAll(profileDropdown); });
    }
    if (komunitasToggle) {
        komunitasToggle.addEventListener('click', (e) => { e.stopPropagation(); komunitasDropdown.classList.toggle('active'); closeAll(komunitasDropdown); });
    }
    if (eventToggle) {
        eventToggle.addEventListener('click', (e) => { e.stopPropagation(); eventDropdown.classList.toggle('active'); closeAll(eventDropdown); });
    }

    document.addEventListener('click', () => { closeAll(null); });
    document.querySelectorAll('.nav-dropdown-menu, .profile-menu').forEach(menu => { menu.addEventListener('click', (e) => { e.stopPropagation(); }); });
</script>

</body>
</html>