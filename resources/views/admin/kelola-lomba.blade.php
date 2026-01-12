@php
    /* MOCK DATA (DATA DUMMY)
       Backend: Ganti variabel di bawah ini dengan data asli dari Controller.
    */
    
    // Data Notifikasi
    $notifications = [
        (object)[
            'id' => 1,
            'title' => 'Pembayaran Baru Masuk',
            'desc' => 'Rizky Pratama telah mengunggah bukti.',
            'time' => 'Sekarang',
            'is_unread' => true,
            'icon' => 'fa-regular fa-circle-check',
            'color' => 'green'
        ],
        (object)[
            'id' => 2,
            'title' => 'Laporan Baru',
            'desc' => 'Ada laporan baru di forum Sleman.',
            'time' => '10 menit lalu',
            'is_unread' => true,
            'icon' => 'fa-solid fa-triangle-exclamation',
            'color' => 'red'
        ],
    ];

    // Data Detail Lomba
    $lomba = (object)[
        'id' => 101,
        'judul' => 'Lomba Foto Lanskap Merapi',
        'harga' => 150000,
        'kategori' => 'Seni & Desain',
        'tgl_mulai' => '2026-02-15',
        'jam_mulai' => '09:00',
        'lokasi' => 'Online Submission',
        'url' => 'image/img (1).jpg' // Path poster dari database
    ];

    // Data Peserta
    $pesertaList = [
        (object)[
            'id' => 1,
            'name' => 'Budi Santoso',
            'region' => 'Sleman',
            'initial' => 'BS',
            'color' => '',
            'status_pembayaran' => 'Terkonfirmasi',
            'status_class' => 'success',
            'karya_url' => '#',
            'skor' => 87,
            'is_warning' => false
        ],
        (object)[
            'id' => 2,
            'name' => 'Siti Rahayu',
            'region' => 'Bantul',
            'initial' => 'SR',
            'color' => 'purple',
            'status_pembayaran' => 'Terkonfirmasi',
            'status_class' => 'success',
            'karya_url' => '#',
            'skor' => 92,
            'is_warning' => false
        ],
        (object)[
            'id' => 3,
            'name' => 'Ahmad Hidayat',
            'region' => 'Kota Yogyakarta',
            'initial' => 'AH',
            'color' => '',
            'status_pembayaran' => 'Terkonfirmasi',
            'status_class' => 'success',
            'karya_url' => null,
            'skor' => 78,
            'is_warning' => true
        ],
        (object)[
            'id' => 4,
            'name' => 'Dewi Lestari',
            'region' => 'Kulon Progo',
            'initial' => 'DL',
            'color' => 'blue',
            'status_pembayaran' => 'Tertunda',
            'status_class' => 'warning',
            'karya_url' => null,
            'skor' => 85,
            'is_warning' => false
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Lomba - ZHIB Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/lomba.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="admin-container">
  
  <aside class="sidebar">
    <div class="sidebar-header">
      <h2>ZHIB Admin</h2>
      <span>Regional DIY</span>
    </div>
    <ul class="sidebar-menu">
      <li><a href="{{ url('/admin/dashboard') }}"><i class="fa-solid fa-border-all"></i> Dashboard</a></li>
      <li><a href="{{ url('/admin/pembayaran') }}"><i class="fa-regular fa-credit-card"></i> Pembayaran</a></li>
      <li><a href="{{ url('/admin/lomba') }}" class="active"><i class="fa-solid fa-trophy"></i> Lomba</a></li>
      <li><a href="{{ url('/admin/komunitas') }}"><i class="fa-solid fa-user-group"></i> Komunitas</a></li>
      <li><a href="{{ url('/admin/laporan') }}"><i class="fa-solid fa-triangle-exclamation"></i> Laporan</a></li>
      <li><a href="{{ url('/admin/berita') }}"><i class="fa-regular fa-newspaper"></i> Berita</a></li>
      <li class="spacer"></li>
      <li>
        <form action="{{ url('/logout') }}" method="POST" style="width: 100%;">
            @csrf
            <button type="submit" class="logout" style="background:none; border:none; width:100%; text-align:left; padding:12px 15px; font-family:inherit; font-size:16px; font-weight:500; display:flex; align-items:center; gap:12px; cursor:pointer;">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </button>
        </form>
      </li>
    </ul>
  </aside>

  <main class="main-content">
    
    <header class="topbar">
      <h1>Kelola Lomba: {{ $lomba->judul }}</h1> 
      
      <div class="topbar-right">
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Cari anggota, acara...">
        </div>

        <div class="notif-wrapper">
          <button class="btn-icon" onclick="toggleNotif()">
            <i class="fa-regular fa-bell"></i>
            <span class="badge-dot"></span>
          </button>

          <div class="notif-popup" id="notifPopup">
            <div class="popup-header">
                <div class="ph-content">
                    <div class="ph-icon-circle"><i class="fa-regular fa-bell"></i></div>
                    <div class="ph-text"><h3>Notifikasi</h3><span>{{ count(collect($notifications)->where('is_unread', true)) }} belum dibaca</span></div>
                </div>
                <button class="ph-close-btn" onclick="toggleNotif()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="popup-body">
                @foreach($notifications as $item)
                <div class="p-item {{ $item->is_unread ? 'unread' : '' }}">
                    <div class="p-icon-circle {{ $item->color }}"><i class="{{ $item->icon }}"></i></div>
                    <div class="p-details">
                        <h4>{{ $item->title }}</h4>
                        <p>{{ $item->desc }}</p>
                        <small>{{ $item->time }}</small>
                    </div>
                    @if($item->is_unread)
                        <div class="unread-dot"></div>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="popup-footer"><button>Tandai Semua Sudah Dibaca</button></div>
          </div>
        </div>
      </div>
    </header>

    <a href="{{ url('/admin/lomba') }}" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Lomba
    </a>

    <div class="kelola-wrapper">
        
        <div class="kelola-card panel-left">
            <div class="card-header">
                <h3>Pengaturan Lomba</h3>
                <p>Edit detail dan konfigurasi lomba</p>
            </div>

            <div class="form-group">
                <label>Judul Lomba</label>
                <input type="text" value="{{ $lomba->judul }}">
            </div>

            <div class="form-group">
                <label>Harga Pendaftaran (IDR)</label>
                <input type="text" value="Rp {{ number_format($lomba->harga) }}">
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" value="{{ $lomba->kategori }}">
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label>Tanggal Mulai</label>
                    <input type="date" value="{{ $lomba->tgl_mulai }}">
                </div>
                <div class="form-col">
                    <label>Jam Mulai</label>
                    <input type="time" value="{{ $lomba->jam_mulai }}">
                </div>
            </div>

            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" value="{{ $lomba->lokasi }}">
            </div>

            <div class="form-group">
                <label>Poster Lomba</label>
                <div class="upload-area" style="background-image: url('{{ asset($lomba->url) }}'); background-size: cover; background-position: center; position: relative;">
                    <div style="position: absolute; inset: 0; background: rgba(255,255,255,0.7); display: flex; flex-direction: column; align-items: center; justify-content: center; border-radius: 8px;">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <p style="margin:0; font-weight:600; font-size:13px;">Klik untuk ganti poster</p>
                        <small style="font-size:11px;">atau seret dan lepas (PNG, JPG)</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="kelola-card panel-right">
            <div class="card-header">
                <h3>Daftar Peserta</h3>
                <p>Total peserta: {{ count($pesertaList) }}</p>
            </div>

            <div class="table-responsive">
                <table class="table-peserta">
                    <thead>
                        <tr>
                            <th>PESERTA</th>
                            <th>PEMBAYARAN</th>
                            <th>KARYA</th>
                            <th>SKOR KEPERCAYAAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesertaList as $item)
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="avatar-circle {{ $item->color }}">{{ $item->initial }}</div>
                                    <div>
                                        <strong>{{ $item->name }}</strong><br>
                                        <small>{{ $item->region }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge badge-{{ $item->status_class }}"><i class="fa-solid {{ $item->status_class == 'success' ? 'fa-circle-check' : 'fa-clock' }}"></i> {{ $item->status_pembayaran }}</span></td>
                            <td>
                                @if($item->karya_url)
                                    <a href="{{ $item->karya_url }}" class="link-blue"><i class="fa-solid fa-link"></i> Lihat</a>
                                @else
                                    <span style="color:#ccc; font-size:12px;">Belum ada karya</span>
                                @endif
                            </td>
                            <td class="score-cell {{ $item->is_warning ? 'warning' : '' }}">
                                <i class="fa-solid fa-shield-halved"></i> {{ $item->skor }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="action-bar-bottom">
        <button class="btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan</button>
        <button class="btn-danger"><i class="fa-regular fa-circle-xmark"></i> Akhiri Lomba (Tandai Selesai)</button>
        <button class="btn-outline"><i class="fa-solid fa-download"></i> Unduh Data Peserta (CSV)</button>
    </div>

  </main>
</div>

<script>
    // FUNGSI NOTIFIKASI
    function toggleNotif() {
        const popup = document.getElementById('notifPopup');
        popup.classList.toggle('active');
    }

    // TUTUP JIKA KLIK DI LUAR
    window.onclick = function(e) {
        const notifPopup = document.getElementById('notifPopup');
        const notifBtn = document.querySelector('.btn-icon');
        
        if (notifPopup && notifBtn && !notifPopup.contains(e.target) && !notifBtn.contains(e.target)) {
            notifPopup.classList.remove('active');
        }
    }
</script>

</body>
</html>