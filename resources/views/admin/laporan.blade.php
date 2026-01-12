@php
    /* |--------------------------------------------------------------------------
    | MOCK DATA (DATA DUMMY)
    |--------------------------------------------------------------------------
    | Backend: Ganti variabel di bawah ini dengan data asli dari Controller.
    */
    
    // 1. Notifikasi
    $notifications = [
        (object)['title' => 'Pembayaran Baru Masuk', 'desc' => 'Rizky Pratama telah mengunggah bukti.', 'time' => 'Sekarang', 'color' => 'green', 'icon' => 'fa-circle-check', 'is_unread' => true],
        (object)['title' => 'Lomba Akan Segera Berakhir', 'desc' => 'Kejuaraan Pertukangan Kayu DIY akan berakhir.', 'time' => '15 menit lalu', 'color' => 'purple', 'icon' => 'fa-trophy', 'is_unread' => true],
        (object)['title' => 'Komunitas Baru Bergabung', 'desc' => 'Komunitas "Kreator Digital Bantul" menunggu verifikasi.', 'time' => '1 jam lalu', 'color' => 'blue', 'icon' => 'fa-user-group', 'is_unread' => true],
        (object)['title' => 'Laporan Prioritas Tinggi', 'desc' => 'Laporan baru diterima di forum Sleman.', 'time' => '2 jam lalu', 'color' => 'red', 'icon' => 'fa-circle-exclamation', 'is_unread' => false],
    ];

    // 2. Laporan Pengguna
    $laporanPengguna = [
        (object)[
            'id' => 1,
            'pelapor' => (object)['nama' => 'Budi Santoso', 'wilayah' => 'Sleman', 'initial' => 'BS', 'color' => ''],
            'target' => (object)['nama' => 'Ahmad Fauzi', 'tipe' => 'Pengguna'],
            'alasan' => 'Pelecehan',
            'url' => 'image/img (1).jpg', // Bukti Gambar
            'status' => 'new',
            'status_label' => 'Baru',
            'desc' => 'Pengguna mengirim pesan tidak pantas di grup chat komunitas.'
        ],
        (object)[
            'id' => 2,
            'pelapor' => (object)['nama' => 'Siti Rahayu', 'wilayah' => 'Bantul', 'initial' => 'SR', 'color' => 'purple'],
            'target' => (object)['nama' => 'Dedi Kurniawan', 'tipe' => 'Pengguna'],
            'alasan' => 'Pembayaran Palsu',
            'url' => 'image/img (2).jpg',
            'status' => 'review',
            'status_label' => 'Dalam Tinjauan',
            'desc' => 'Bukti transfer yang diunggah tidak valid.'
        ]
    ];

    // 3. Laporan Pesan
    $laporanPesan = [
        (object)[
            'id' => 3,
            'pelapor' => (object)['nama' => 'Maya Kusuma', 'wilayah' => 'Kota YK', 'initial' => 'MK', 'color' => 'blue'],
            'target' => (object)['nama' => 'Pesan Menyinggung', 'tipe' => 'di "Gowes Bantul"'],
            'alasan' => 'Konten Tidak Pantas',
            'url' => 'image/img (3).jpg',
            'status' => 'new',
            'status_label' => 'Baru'
        ]
    ];

    // 4. Laporan Acara
    $laporanAcara = [
        (object)[
            'id' => 4,
            'pelapor' => (object)['nama' => 'Joko Widodo', 'wilayah' => 'Sleman', 'initial' => 'JW', 'color' => ''],
            'target' => (object)['nama' => 'Lomba Palsu: "Merapi"', 'tipe' => 'Acara'],
            'alasan' => 'Acara Penipuan',
            'url' => 'image/img (4).jpg',
            'status' => 'new',
            'status_label' => 'Baru'
        ]
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pusat Pengelolaan Laporan - ZHIB Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/lomba.css') }}"> 
  <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="admin-container">
  
  <aside class="sidebar">
    <div class="sidebar-header"><h2>ZHIB Admin</h2><span>Regional DIY</span></div>
    <ul class="sidebar-menu">
      <li><a href="{{ url('/admin/dashboard') }}"><i class="fa-solid fa-border-all"></i> Dashboard</a></li>
      <li><a href="{{ url('/admin/pembayaran') }}"><i class="fa-regular fa-credit-card"></i> Pembayaran</a></li>
      <li><a href="{{ url('/admin/lomba') }}"><i class="fa-solid fa-trophy"></i> Lomba</a></li>
      <li><a href="{{ url('/admin/komunitas') }}"><i class="fa-solid fa-user-group"></i> Komunitas</a></li>
      <li><a href="{{ url('/admin/laporan') }}" class="active"><i class="fa-solid fa-triangle-exclamation"></i> Laporan</a></li>
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
      <h1>Pusat Pengelolaan Laporan</h1> 
      <div class="topbar-right">
        <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" placeholder="Cari laporan..."></div>
        <div class="notif-wrapper">
             <button class="btn-icon" onclick="toggleNotif()"><i class="fa-regular fa-bell"></i><span class="badge-dot"></span></button>
          <div class="notif-popup" id="notifPopup">
            <div class="popup-header">
                <div class="ph-content">
                    <div class="ph-icon-circle"><i class="fa-regular fa-bell"></i></div>
                    <div class="ph-text"><h3>Notifikasi</h3><span>{{ count(collect($notifications)->where('is_unread', true)) }} belum dibaca</span></div>
                </div>
                <button class="ph-close-btn" onclick="toggleNotif()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="popup-body">
                @foreach($notifications as $notif)
                <div class="p-item {{ $notif->is_unread ? 'unread' : '' }}">
                    <div class="p-icon-circle {{ $notif->color }}"><i class="fa-regular {{ $notif->icon }}"></i></div>
                    <div class="p-details"><h4>{{ $notif->title }}</h4><p>{{ $notif->desc }}</p><small>{{ $notif->time }}</small></div>
                    @if($notif->is_unread) <div class="unread-dot"></div> @endif
                </div>
                @endforeach
            </div>
            <div class="popup-footer"><button>Tandai Semua Sudah Dibaca</button></div>
          </div>
        </div>
      </div>
    </header>

    <div class="laporan-tabs">
        <button class="tab-btn active" onclick="switchTab('pengguna', this)">Laporan Pengguna <span class="badge-num red">{{ count($laporanPengguna) }}</span></button>
        <button class="tab-btn" onclick="switchTab('pesan', this)">Laporan Pesan <span class="badge-num pink">{{ count($laporanPesan) }}</span></button>
        <button class="tab-btn" onclick="switchTab('acara', this)">Laporan Acara <span class="badge-num pink">{{ count($laporanAcara) }}</span></button>
    </div>

    {{-- TAB PENGGUNA --}}
    <div id="tab-pengguna" class="tab-content active">
        <div class="table-container-dark">
            <table class="table-laporan">
                <thead>
                    <tr><th>PELAPOR</th><th>TERTUDUH/TARGET</th><th>ALASAN</th><th>BUKTI</th><th>STATUS</th><th>AKSI</th></tr>
                </thead>
                <tbody>
                    @foreach($laporanPengguna as $item)
                    <tr>
                        <td><div class="user-info"><div class="avatar-circle {{ $item->pelapor->color }}">{{ $item->pelapor->initial }}</div><div><strong>{{ $item->pelapor->nama }}</strong><br><small>{{ $item->pelapor->wilayah }}</small></div></div></td>
                        <td><div class="target-info"><div class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></div><div><strong>{{ $item->target->nama }}</strong><br><small>{{ $item->target->tipe }}</small></div></div></td>
                        <td><span class="badge-reason">{{ $item->alasan }}</span></td>
                        <td>
                            <div class="bukti-thumb" onclick="bukaModal('modalBukti')">
                                <img src="{{ asset($item->url) }}" alt="Bukti">
                            </div>
                        </td>
                        <td><span class="badge-status {{ $item->status }}">{{ $item->status_label }}</span></td>
                        <td>
                            <button class="btn-tinjau" onclick="bukaModal('modalBukti')"><i class="fa-regular fa-eye"></i> Tinjau Bukti</button>
                            <div class="action-row">
                                <button class="btn-mini yellow" onclick="handleAction('warn', '{{ $item->target->nama }}')">Peringatan</button>
                                <button class="btn-mini red" onclick="handleAction('block', '{{ $item->target->nama }}')">Blokir</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- TAB PESAN --}}
    <div id="tab-pesan" class="tab-content" style="display:none;">
        <div class="table-container-dark">
            <table class="table-laporan">
                <thead><tr><th>PELAPOR</th><th>TERTUDUH/TARGET</th><th>ALASAN</th><th>BUKTI</th><th>STATUS</th><th>AKSI</th></tr></thead>
                <tbody>
                    @foreach($laporanPesan as $item)
                    <tr>
                        <td><div class="user-info"><div class="avatar-circle {{ $item->pelapor->color }}">{{ $item->pelapor->initial }}</div><div><strong>{{ $item->pelapor->nama }}</strong><br><small>{{ $item->pelapor->wilayah }}</small></div></div></td>
                        <td><div class="target-info"><div class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></div><div><strong>{{ $item->target->nama }}</strong><br><small>{{ $item->target->tipe }}</small></div></div></td>
                        <td><span class="badge-reason">{{ $item->alasan }}</span></td>
                        <td><div class="bukti-thumb"><img src="{{ asset($item->url) }}" alt="Bukti"></div></td>
                        <td><span class="badge-status {{ $item->status }}">{{ $item->status_label }}</span></td>
                        <td><button class="btn-tinjau" onclick="bukaModal('modalBukti')"><i class="fa-regular fa-eye"></i> Tinjau Bukti</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- TAB ACARA --}}
    <div id="tab-acara" class="tab-content" style="display:none;">
        <div class="table-container-dark">
            <table class="table-laporan">
                <thead><tr><th>PELAPOR</th><th>TERTUDUH/TARGET</th><th>ALASAN</th><th>BUKTI</th><th>STATUS</th><th>AKSI</th></tr></thead>
                <tbody>
                    @foreach($laporanAcara as $item)
                    <tr>
                        <td><div class="user-info"><div class="avatar-circle {{ $item->pelapor->color }}">{{ $item->pelapor->initial }}</div><div><strong>{{ $item->pelapor->nama }}</strong><br><small>{{ $item->pelapor->wilayah }}</small></div></div></td>
                        <td><div class="target-info"><div class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></div><div><strong>{{ $item->target->nama }}</strong><br><small>{{ $item->target->tipe }}</small></div></div></td>
                        <td><span class="badge-reason">{{ $item->alasan }}</span></td>
                        <td><div class="bukti-thumb"><img src="{{ asset($item->url) }}" alt="Bukti"></div></td>
                        <td><span class="badge-status {{ $item->status }}">{{ $item->status_label }}</span></td>
                        <td><button class="btn-tinjau" onclick="bukaModal('modalBukti')"><i class="fa-regular fa-eye"></i> Tinjau Bukti</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="laporan-stats-grid">
        <div class="ls-card"><div class="ls-icon red"><i class="fa-solid fa-triangle-exclamation"></i></div><div class="ls-info"><span>Total Laporan</span><h3>{{ count($laporanPengguna) + count($laporanPesan) + count($laporanAcara) }}</h3></div></div>
        <div class="ls-card"><div class="ls-icon pink"><i class="fa-solid fa-file-circle-exclamation"></i></div><div class="ls-info"><span>Laporan Baru</span><h3>{{ count(collect($laporanPengguna)->where('status', 'new')) }}</h3></div></div>
        <div class="ls-card"><div class="ls-icon yellow"><i class="fa-regular fa-eye"></i></div><div class="ls-info"><span>Dalam Tinjauan</span><h3>{{ count(collect($laporanPengguna)->where('status', 'review')) }}</h3></div></div>
        <div class="ls-card"><div class="ls-icon green"><i class="fa-solid fa-clipboard-check"></i></div><div class="ls-info"><span>Terselesaikan</span><h3>0</h3></div></div>
    </div>

  </main>
</div>

{{-- MODAL BUKTI --}}
<div class="modal-overlay" id="modalBukti">
    <div class="modal-box medium-box">
        <div class="modal-header">
            <div style="display:flex; align-items:center; gap:12px;"><div class="danger-icon-circle"><i class="fa-solid fa-triangle-exclamation"></i></div><div><h3 style="margin:0;">Tinjau Bukti</h3><span style="font-size:12px; color:#888;">ID Laporan: #{{ $laporanPengguna[0]->id ?? '0' }}</span></div></div>
            <span class="close-icon" onclick="tutupModal('modalBukti')">&times;</span>
        </div>
        
        <div class="modal-body">
            <div class="split-info-box">
                <div class="info-card"><small>Pelapor</small><div class="user-info mt-2"><div class="avatar-circle">{{ $laporanPengguna[0]->pelapor->initial ?? '' }}</div><div><strong>{{ $laporanPengguna[0]->pelapor->nama ?? '' }}</strong><br><small>{{ $laporanPengguna[0]->pelapor->wilayah ?? '' }}</small></div></div></div>
                <div class="info-card"><small>Tertuduh/Target</small><div class="user-info mt-2"><div class="alert-icon"><i class="fa-solid fa-triangle-exclamation"></i></div><div><strong>{{ $laporanPengguna[0]->target->nama ?? '' }}</strong><br><small>{{ $laporanPengguna[0]->target->tipe ?? '' }}</small></div></div></div>
            </div>

            <div class="desc-box"><small>Deskripsi</small><p>{{ $laporanPengguna[0]->desc ?? '' }}</p></div>

            <div class="evidence-box">
                <small>Tangkapan Layar Bukti</small>
                <div class="evidence-img-wrapper">
                    <img src="{{ asset('image/download (16).jpg') }}" alt="Bukti Full Size">
                </div>
            </div>
        </div>
        
        <div class="modal-footer footer-grid">
            <button class="btn-action-large yellow" onclick="handleAction('warn', '{{ $laporanPengguna[0]->target->nama ?? '' }}')">
                <i class="fa-solid fa-triangle-exclamation"></i> Beri Peringatan
            </button>
            <button class="btn-action-large red" onclick="handleAction('block', '{{ $laporanPengguna[0]->target->nama ?? '' }}')">
                <i class="fa-solid fa-ban"></i> Blokir Akun
            </button>
            <button class="btn-action-large gray" onclick="handleAction('reject', 'Target')">
                <i class="fa-solid fa-xmark"></i> Tolak Laporan
            </button>
        </div>
    </div>
</div>

<script>
    function toggleNotif() { document.getElementById('notifPopup').classList.toggle('active'); }
    function bukaModal(id) { document.getElementById(id).style.display = 'flex'; }
    function tutupModal(id) { document.getElementById(id).style.display = 'none'; }
    
    window.onclick = function(e) {
        if (e.target.classList.contains('modal-overlay')) e.target.style.display = 'none';
        const notifPopup = document.getElementById('notifPopup');
        const btn = document.querySelector('.btn-icon');
        if(notifPopup && !notifPopup.contains(e.target) && btn && !btn.contains(e.target)) {
            notifPopup.classList.remove('active');
        }
    }

    function switchTab(tabName, btn) {
        const allTabs = document.querySelectorAll('.tab-content');
        allTabs.forEach(tab => tab.style.display = 'none');
        const allBtns = document.querySelectorAll('.tab-btn');
        allBtns.forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + tabName).style.display = 'block';
        btn.classList.add('active');
    }

    function handleAction(action, userName) {
        tutupModal('modalBukti');
        let titleText = '', confirmText = '', iconType = '', confirmButtonColor = '', successMessage = '';

        if (action === 'warn') {
            titleText = 'Kirim Peringatan?'; confirmText = `Kirim ke ${userName}`; iconType = 'warning'; confirmButtonColor = '#f59e0b'; successMessage = 'Peringatan berhasil dikirim.';
        } else if (action === 'block') {
            titleText = 'Blokir Akun?'; confirmText = `Ya, blokir ${userName}`; iconType = 'error'; confirmButtonColor = '#dc2626'; successMessage = 'Akun berhasil diblokir.';
        } else if (action === 'reject') {
            titleText = 'Tolak Laporan?'; confirmText = 'Ya, tolak laporan'; iconType = 'question'; confirmButtonColor = '#6b7280'; successMessage = 'Laporan ditolak.';
        }

        setTimeout(() => {
            Swal.fire({
                title: titleText,
                text: "Tindakan ini akan dicatat dalam sistem.",
                icon: iconType,
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: '#111',
                confirmButtonText: confirmText,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Berhasil!', successMessage, 'success');
                }
            });
        }, 200);
    }
</script>

</body>
</html>