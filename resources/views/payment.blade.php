@php
    /* MOCK DATA (DATA DUMMY)
       Backend: Ganti variabel ini dengan data asli dari database/controller.
    */
    
    // Data User Login
    $authUser = (object)[
        'name'  => Auth::user()->name ?? 'Windah Batubara',
        'level' => 999,
        'url'   => 'image/download (13).jpg' // Path foto profil
    ];

    // Data Event yang sedang dibayar
    $paymentData = (object)[
        'event_title' => 'Mobile Legends Offline Tournament',
        'price'       => '50.000',
        'banks'       => [
            (object)['label' => 'BCA', 'value' => '1234 567 890', 'holder' => 'ZHIB JOGJA'],
            (object)['label' => 'Dana/Gopay', 'value' => '0812 3456 7890', 'holder' => null]
        ]
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - ZHIB</title>
    
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
    
    <button class="profile-navbar" id="profileToggle" type="button">
      <div class="profile-text">
        <div class="profile-name">{{ $authUser->name }}</div>
        <div class="profile-level">LVL. {{ $authUser->level }}</div>
      </div>
      
      <img src="{{ asset($authUser->url) }}" class="profile-avatar" alt="Profile">
    </button>

    <div class="profile-menu">
      <a href="{{ url('/profile') }}">Profil</a>
      <a href="{{ url('/profile?edit=true') }}">Edit Profil</a>
      <hr>
      <form action="{{ url('/logout') }}" method="POST" style="margin: 0;">
        @csrf
        <button type="submit" class="logout" style="background:none; border:none; width:100%; text-align:left; padding:10px 16px; font-weight:700; color:#ff2d2d; cursor:pointer; font-family: inherit;">
          Logout
        </button>
      </form>
    </div>

  </div>
</div>
    </div>
</header>

<main class="payment-page">
    <div class="payment-container">
        
        <div class="payment-form">
            <form id="payment-form" action="{{ url('/payment/process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label>Nama Pemilik Rekening</label>
                    <input type="text" name="nama_rekening" placeholder="Masukkan nama pengirim di bukti transfer" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Transfer</label>
                    <input type="date" name="tanggal_transfer" required>
                </div>

                <div class="form-group">
                    <label>Unggah Bukti Transfer</label>
                    <div class="upload-area">
                        <div class="upload-content">
                            <i class="fa-regular fa-image upload-icon"></i>
                            <p class="upload-text">Pilih file gambar atau drag and drop</p>
                            <p class="upload-sub">PNG, JPG, PDF hingga 2MB</p>
                        </div>
                        <input type="file" name="bukti_transfer" class="file-input" required>
                    </div>
                </div>
            </form>
        </div>

        <div class="payment-summary">
            <div class="summary-card">
                <h3>PEMBAYARAN PENDAFTARAN</h3>
                <p class="event-name">{{ $paymentData->event_title }}</p>
                <div class="price-tag">Rp {{ $paymentData->price }}</div>
            </div>

            <div class="instruction-box">
                <h4>Instruksi Transfer:</h4>
                <p>Silakan transfer ke salah satu rekening di bawah ini:</p>
                
                {{-- Looping Standard untuk Rekening Bank --}}
                @foreach($paymentData->banks as $bank)
                <div class="bank-row">
                    <span class="bank-label">{{ $bank->label }}:</span>
                    <span class="bank-value">{{ $bank->value }} @if($bank->holder) <small>(a.n {{ $bank->holder }})</small> @endif</span>
                </div>
                @endforeach
            </div>

            <button class="btn-confirm" onclick="document.getElementById('payment-form').submit()">Konfirmasi Pembayaran</button>

            <div class="security-note">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Data Anda akan diverifikasi secara manual oleh Admin Pusat ZHIB.</span>
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
      <a href="{{ url('/tentang-kami') }}" class="footer-text-link">Tentang Kami</a>
    </div>

  </div>
</footer>

<script>
    // Script Dropdown Profil
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

    // Script Dropdown Navbar
    const dropdowns = document.querySelectorAll('.nav-dropdown');
    dropdowns.forEach(dropdown => {
        const btn = dropdown.querySelector('.nav-link');
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            // Tutup dropdown lain yang sedang terbuka
            dropdowns.forEach(d => {
                if (d !== dropdown) d.classList.remove('active');
            });
            dropdown.classList.toggle('active');
        });
    });
    
    document.addEventListener('click', () => {
        dropdowns.forEach(d => d.classList.remove('active'));
    });
</script>

</body>
</html>