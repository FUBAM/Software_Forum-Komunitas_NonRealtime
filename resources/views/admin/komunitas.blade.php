@php
    /* |--------------------------------------------------------------------------
    | MOCK DATA (DATA DUMMY)
    |--------------------------------------------------------------------------
    | Backend: Ganti variabel di bawah ini dengan data asli dari Controller.
    */
    
    $komunitas_list = [
        (object)[
            'id' => 1,
            'slug' => 'literasi-sleman',
            'nama' => 'Komunitas Baca Sleman',
            'moderator_count' => 3,
            'kategori' => 'Literasi & Penulisan',
            'wilayah' => 'sleman',
            'wilayah_label' => 'Sleman',
            'total_anggota' => 847,
            'aktivitas' => 'Tinggi',
            'icon_class' => 'fa-book-open',
            'color_class' => 'blue'
        ],
        (object)[
            'id' => 2,
            'slug' => 'seni-bantul',
            'nama' => 'Seniman Muda Bantul',
            'moderator_count' => 2,
            'kategori' => 'Seni & Desain',
            'wilayah' => 'bantul',
            'wilayah_label' => 'Bantul',
            'total_anggota' => 623,
            'aktivitas' => 'Tinggi',
            'icon_class' => 'fa-palette',
            'color_class' => 'purple'
        ],
        (object)[
            'id' => 3,
            'slug' => 'dev-kota',
            'nama' => 'Jogja Developer Circle',
            'moderator_count' => 4,
            'kategori' => 'Teknologi & Coding',
            'wilayah' => 'kota',
            'wilayah_label' => 'Kota YK',
            'total_anggota' => 512,
            'aktivitas' => 'Sedang',
            'icon_class' => 'fa-code',
            'color_class' => 'blue'
        ],
        (object)[
            'id' => 4,
            'slug' => 'solo-living',
            'nama' => 'Solo Living Sleman',
            'moderator_count' => 2,
            'kategori' => 'Gaya Hidup Solo',
            'wilayah' => 'sleman',
            'wilayah_label' => 'Sleman',
            'total_anggota' => 298,
            'aktivitas' => 'Sedang',
            'icon_class' => 'fa-house-chimney',
            'color_class' => 'purple'
        ],
    ];

    $notifications = [
        (object)['title' => 'Pembayaran Baru Masuk', 'desc' => 'Rizky Pratama telah mengunggah bukti.', 'time' => 'Sekarang', 'color' => 'green', 'icon' => 'fa-circle-check'],
        (object)['title' => 'Lomba Akan Segera Berakhir', 'desc' => 'Kejuaraan Pertukangan Kayu DIY akan berakhir.', 'time' => '15 menit lalu', 'color' => 'purple', 'icon' => 'fa-trophy'],
        (object)['title' => 'Komunitas Baru Bergabung', 'desc' => 'Komunitas "Kreator Digital Bantul" menunggu verifikasi.', 'time' => '1 jam lalu', 'color' => 'blue', 'icon' => 'fa-user-group'],
    ];

    $stats = (object)[
        'total_komunitas' => 8,
        'moderator_aktif' => 24,
        'total_anggota' => '4,157'
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Moderasi Komunitas - ZHIB Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/lomba.css') }}"> 
  <link rel="stylesheet" href="{{ asset('css/komunitas.css') }}">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    .custom-select-wrapper { position: relative; width: 100%; }
    .custom-select-wrapper select {
        width: 100%; padding: 10px 35px 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;
        background-color: #fff; font-family: 'Inter', sans-serif; font-size: 14px; color: #374151;
        outline: none; appearance: none; -webkit-appearance: none; cursor: pointer; transition: border-color 0.2s;
    }
    .custom-select-wrapper select:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
    .select-icon { position: absolute; top: 50%; right: 12px; transform: translateY(-50%); pointer-events: none; font-size: 12px; color: #6b7280; }
    .form-row { display: flex; gap: 20px; margin-bottom: 20px; }
    .form-col { flex: 1; }
  </style>
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
      <li><a href="{{ url('/admin/lomba') }}"><i class="fa-solid fa-trophy"></i> Lomba</a></li>
      <li><a href="{{ url('/admin/komunitas') }}" class="active"><i class="fa-solid fa-user-group"></i> Komunitas</a></li>
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
      <h1>Moderasi Komunitas</h1> 
      <div class="topbar-right">
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Cari anggota, acara...">
        </div>
        
        <div class="notif-wrapper">
          <button class="btn-icon" onclick="toggleNotif()"><i class="fa-regular fa-bell"></i><span class="badge-dot"></span></button>
          <div class="notif-popup" id="notifPopup">
            <div class="popup-header">
                <div class="ph-content">
                    <div class="ph-icon-circle"><i class="fa-regular fa-bell"></i></div>
                    <div class="ph-text"><h3>Notifikasi</h3><span>{{ count($notifications) }} belum dibaca</span></div>
                </div>
                <button class="ph-close-btn" onclick="toggleNotif()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="popup-body">
                @foreach($notifications as $notif)
                <div class="p-item unread">
                    <div class="p-icon-circle {{ $notif->color }}"><i class="fa-regular {{ $notif->icon }}"></i></div>
                    <div class="p-details"><h4>{{ $notif->title }}</h4><p>{{ $notif->desc }}</p><small>{{ $notif->time }}</small></div>
                    <div class="unread-dot"></div>
                </div>
                @endforeach
            </div>
            <div class="popup-footer"><button>Tandai Semua Sudah Dibaca</button></div>
          </div>
        </div>
      </div>
    </header>

    <div class="komunitas-header">
        <div class="text-content">
            <h2>Moderasi Komunitas</h2>
            <p>Kelola komunitas di seluruh wilayah DIY di Yogyakarta</p>
        </div>
        <button class="btn-primary" onclick="bukaModal('modalTambah')">
            <i class="fa-solid fa-plus"></i> Tambah Komunitas Baru
        </button>
    </div>

    <div class="filter-wilayah">
        <button class="pill active" onclick="filterTabel('all', this)">Semua Wilayah</button>
        <button class="pill" onclick="filterTabel('sleman', this)">Sleman</button>
        <button class="pill" onclick="filterTabel('bantul', this)">Bantul</button>
        <button class="pill" onclick="filterTabel('kulonprogo', this)">Kulon Progo</button>
        <button class="pill" onclick="filterTabel('gunungkidul', this)">Gunungkidul</button>
        <button class="pill" onclick="filterTabel('kota', this)">Kota Yogyakarta</button>
    </div>

    <div class="card-tabel">
        <table class="table-komunitas">
            <thead>
                <tr>
                    <th>NAMA KOMUNITAS</th>
                    <th>KATEGORI</th>
                    <th>WILAYAH</th>
                    <th>TOTAL ANGGOTA</th>
                    <th>AKTIVITAS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody id="tabelBody">
                @foreach($komunitas_list as $item)
                <tr data-wilayah="{{ $item->wilayah }}">
                    <td>
                        <div class="komunitas-info">
                            <div class="icon-box {{ $item->color_class }}"><i class="fa-solid {{ $item->icon_class }}"></i></div>
                            <div><strong>{{ $item->nama }}</strong><br><small>{{ $item->moderator_count }} moderator</small></div>
                        </div>
                    </td>
                    <td><span class="badge-pill {{ $item->color_class }}">{{ $item->kategori }}</span></td>
                    <td><i class="fa-solid fa-location-dot" style="color:#A3AED0; margin-right:5px;"></i> {{ $item->wilayah_label }}</td>
                    <td><b>{{ number_format($item->total_anggota) }}</b></td>
                    <td><span class="badge-pill {{ $item->aktivitas == 'Tinggi' ? 'green-soft' : 'yellow-soft' }}">{{ $item->aktivitas }}</span></td>
                    <td>
                        <div class="action-group">
                            <button class="btn-icon-sq edit" onclick="bukaModal('modalEdit')"><i class="fa-regular fa-pen-to-square"></i></button>
                            <a href="{{ url('/admin/kelola-moderator/'.$item->id) }}" class="btn-moderator"><i class="fa-solid fa-shield-halved"></i> Kelola Moderator</a>
                            <button class="btn-icon-sq delete" onclick="bukaModal('modalHapus')"><i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-icon"><i class="fa-solid fa-users-rectangle"></i></div>
            <div><span class="stat-label">Total Komunitas</span><h3>{{ $stats->total_komunitas }}</h3><small class="green">Semua wilayah tercakup</small></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon"><i class="fa-solid fa-shield-cat"></i></div>
            <div><span class="stat-label">Moderator Aktif</span><h3>{{ $stats->moderator_aktif }}</h3><small>Di seluruh komunitas</small></div>
        </div>
        <div class="stat-box">
            <div class="stat-icon"><i class="fa-solid fa-user-plus"></i></div>
            <div><span class="stat-label">Total Anggota</span><h3>{{ $stats->total_anggota }}</h3><small class="green">+15% bulan ini</small></div>
        </div>
    </div>
  </main>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal-overlay" id="modalTambah">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Tambah Komunitas Baru</h3>
            <span class="close-icon" onclick="tutupModal('modalTambah')">&times;</span>
        </div>
        <form action="{{ url('/admin/komunitas/store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Komunitas *</label>
                    <input type="text" name="nama" placeholder="Contoh: Komunitas Baca Sleman" required>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <label>Kategori *</label>
                        <div class="custom-select-wrapper">
                            <select name="kategori_id" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="literasi">Literasi & Penulisan</option>
                                <option value="seni">Seni & Desain</option>
                                <option value="teknologi">Teknologi & Coding</option>
                                <option value="olahraga">Olahraga</option>
                            </select>
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                    <div class="form-col">
                        <label>Wilayah *</label>
                        <div class="custom-select-wrapper">
                            <select name="wilayah" required>
                                <option value="" disabled selected>Pilih Wilayah</option>
                                <option value="sleman">Kabupaten Sleman</option>
                                <option value="bantul">Kabupaten Bantul</option>
                                <option value="kulonprogo">Kabupaten Kulon Progo</option>
                                <option value="gunungkidul">Kabupaten Gunungkidul</option>
                                <option value="kota">Kota Yogyakarta</option>
                            </select>
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>ID Komunitas (URL Friendly)</label>
                    <input type="text" name="slug" placeholder="Contoh: literasi-sleman">
                </div>
                <div class="form-group">
                    <label>Deskripsi Komunitas</label>
                    <textarea name="deskripsi" rows="3" placeholder="Jelaskan tentang komunitas ini..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="tutupModal('modalTambah')">Batal</button>
                <button type="submit" class="btn-submit"><i class="fa-regular fa-floppy-disk"></i> Tambah Komunitas</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Edit Komunitas</h3>
            <span class="close-icon" onclick="tutupModal('modalEdit')">&times;</span>
        </div>
        <form action="{{ url('/admin/komunitas/update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Komunitas *</label>
                    <input type="text" name="nama" value="Komunitas Baca Sleman" required>
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <label>Kategori *</label>
                        <div class="custom-select-wrapper">
                            <select name="kategori_id">
                                <option value="literasi" selected>Literasi & Penulisan</option>
                                <option value="seni">Seni & Desain</option>
                                <option value="teknologi">Teknologi & Coding</option>
                            </select>
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                    <div class="form-col">
                        <label>Wilayah *</label>
                        <div class="custom-select-wrapper">
                            <select name="wilayah">
                                <option value="sleman" selected>Kabupaten Sleman</option>
                                <option value="bantul">Kabupaten Bantul</option>
                            </select>
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group"><label>ID Komunitas</label><input type="text" name="slug" value="literasi-sleman"></div>
                <div class="form-group"><label>Deskripsi Komunitas</label><textarea name="deskripsi" rows="3">Deskripsi...</textarea></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="tutupModal('modalEdit')">Batal</button>
                <button type="submit" class="btn-submit"><i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal-box small-box"> 
        <div class="modal-header-danger">
            <div class="header-danger-left">
                <div class="danger-icon-circle"><i class="fa-solid fa-triangle-exclamation"></i></div>
                <h3>Hapus Komunitas</h3>
            </div>
            <span class="close-icon" onclick="tutupModal('modalHapus')">&times;</span>
        </div>
        <div class="modal-body">
            <p style="color:#555; line-height:1.6; margin-top:0;">Apakah Anda yakin ingin menghapus komunitas ini?<br>Semua data anggota dan aktivitas akan hilang.<br>Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer no-border">
            <button type="button" class="btn-cancel" onclick="tutupModal('modalHapus')">Batal</button>
            <form action="{{ url('/admin/komunitas/delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete-solid">Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleNotif() { document.getElementById('notifPopup').classList.toggle('active'); }
    function bukaModal(id) { document.getElementById(id).style.display = 'flex'; }
    function tutupModal(id) { document.getElementById(id).style.display = 'none'; }

    window.onclick = function(e) { 
        if (e.target.classList.contains('modal-overlay')) { e.target.style.display = 'none'; }
        const notifPopup = document.getElementById('notifPopup');
        const notifBtn = document.querySelector('.btn-icon');
        if (notifPopup && notifBtn && !notifPopup.contains(e.target) && !notifBtn.contains(e.target)) {
            notifPopup.classList.remove('active');
        }
    }

    function filterTabel(wilayah, tombol) {
        const semuaTombol = document.querySelectorAll('.filter-wilayah .pill');
        semuaTombol.forEach(btn => btn.classList.remove('active'));
        tombol.classList.add('active');

        const semuaBaris = document.querySelectorAll('#tabelBody tr');
        semuaBaris.forEach(baris => {
            const dataWilayah = baris.getAttribute('data-wilayah');
            if (wilayah === 'all' || dataWilayah === wilayah) {
                baris.style.display = 'table-row';
            } else {
                baris.style.display = 'none';
            }
        });
    }
</script>
</body>
</html>