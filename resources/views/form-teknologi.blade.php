<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi Teknologi & Coding - ZHIB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('css/form-lomba.css') }}">

  <style>
    /* Styling Radio Button */
    .radio-group { display: flex; gap: 30px; margin-top: 10px; margin-bottom: 20px; }
    .radio-item { display: flex; align-items: center; gap: 8px; cursor: pointer; }
    .radio-item input[type="radio"] { accent-color: #111; width: 18px; height: 18px; margin: 0; }
    .radio-item span { font-size: 14px; font-weight: 500; color: #333; }

    /* Background Banner dari public/image */
    .hero-section { 
        background-image: url("{{ asset('image/coding.jpg') }}"); 
    }
    
    /* Animasi fade untuk field Tim */
    #field-tim { transition: all 0.3s ease-in-out; }
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
          <div class="profile-text">
            <div class="profile-name">{{ Auth::user()->name ?? 'Guest User' }}</div>
            <div class="profile-level">LVL. 999</div>
          </div>
          <img src="{{ asset('image/download (13).jpg') }}" class="profile-avatar" alt="Profile">
        </button>
        <div class="profile-menu">
          <a href="{{ url('/profile') }}">Profil</a>
          <a href="{{ url('/profile?edit=true') }}">Edit Profil</a>
          <hr>
          <form action="{{ url('/logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" style="background:none; border:none; width:100%; text-align:left; padding:10px 16px; font-weight:700; color:#ff2d2d; cursor:pointer;" class="logout">Logout</button>
          </form>
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
                <h3><i class="fa-regular fa-file-lines"></i> FORMULIR PENDAFTARAN</h3>
                <p>Lengkapi formulir di bawah ini dengan data yang benar.</p>
            </div>

            <form action="{{ url('/lomba/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-with-icon">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap sesuai identitas" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Email Aktif</label>
                        <div class="input-with-icon">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" name="email" placeholder="nama@email.com" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor WhatsApp Aktif</label>
                        <div class="input-with-icon">
                            <i class="fa-solid fa-mobile-screen"></i>
                            <input type="text" name="whatsapp" placeholder="081234567890" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Domisili (Kota/Kabupaten)</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="domisili" placeholder="Contoh: Bandung" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Jenis Kepesertaan</label>
                    <div class="radio-group">
                        <label class="radio-item">
                            <input type="radio" name="jenis_peserta" value="individu" onclick="toggleTeam('individu')">
                            <span>Individu</span>
                        </label>
                        <label class="radio-item">
                            <input type="radio" name="jenis_peserta" value="tim" checked onclick="toggleTeam('tim')">
                            <span>Tim</span>
                        </label>
                    </div>
                </div>

                <div class="form-row" id="field-tim">
                    <div class="form-group">
                        <label>Nama Tim</label>
                        <div class="input-with-icon">
                            <i class="fa-solid fa-user-group"></i>
                            <input type="text" name="nama_tim" placeholder="Masukkan nama tim">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Anggota</label>
                        <div class="input-with-icon">
                            <i class="fa-solid fa-user-plus"></i>
                            <input type="number" name="jumlah_anggota" placeholder="Jumlah anggota">
                        </div>
                    </div>
                </div>

                <div class="separator">Dokumen Pendukung</div>

                <div class="form-group">
                    <label>Upload Identitas (KTP/Kartu Pelajar)</label>
                    <div class="upload-box">
                        <i class="fa-regular fa-id-card upload-icon"></i>
                        <div class="upload-text">
                            <p>Upload file atau drag and drop</p>
                            <span>PNG, JPG, PDF up to 2MB</span>
                        </div>
                        <input type="file" name="file_identitas" hidden required>
                    </div>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="agree" required>
                    <label for="agree">Saya menyetujui syarat dan ketentuan.<br>Semua data yang saya isi adalah benar dan dapat dipertanggungjawabkan.</label>
                </div>

                <button type="submit" class="btn-submit">KIRIM PENDAFTARAN</button>
            </form>
        </div>
    </main>
</div>

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
      <a href="{{ url('/tentang-kami') }}" class="footer-text-link">Tentang Kami</a>
    </div>
  </div>
</footer>


<script>
    // 1. Logic Toggle Navbar Dropdown
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

    if(profileToggle){
        profileToggle.addEventListener('click', (e) => { e.stopPropagation(); profileDropdown.classList.toggle('active'); closeAll(profileDropdown); });
    }
    if(komunitasToggle){
        komunitasToggle.addEventListener('click', (e) => { e.stopPropagation(); komunitasDropdown.classList.toggle('active'); closeAll(komunitasDropdown); });
    }
    if(eventToggle){
        eventToggle.addEventListener('click', (e) => { e.stopPropagation(); eventDropdown.classList.toggle('active'); closeAll(eventDropdown); });
    }

    document.addEventListener('click', () => { closeAll(null); });
    document.querySelectorAll('.nav-dropdown-menu, .profile-menu').forEach(menu => { menu.addEventListener('click', (e) => { e.stopPropagation(); }); });

    // 2. LOGIC GANTI FORM (INDIVIDU vs TIM)
    function toggleTeam(type) {
        const fieldTim = document.getElementById('field-tim');
        
        if (type === 'individu') {
            fieldTim.style.display = 'none';
        } else {
            // Jika Tim dipilih, munculkan kembali (format grid/flex sesuai CSS)
            // Karena di CSS pakai .form-row { display: flex/grid }, kita set '' (kosong) agar balik ke default CSS
            fieldTim.style.display = ''; 
        }
    }
</script>

</body>
</html>