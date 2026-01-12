@php
    /* |--------------------------------------------------------------------------
    | MOCK DATA (DATA DUMMY)
    |--------------------------------------------------------------------------
    | Backend: Ganti variabel ini dengan data asli dari database.
    */
    
    $notifications = [
        (object)[
            'id' => 1, 'title' => 'Pembayaran Lomba Masuk', 'desc' => 'Budi Santoso telah membayar pendaftaran.', 
            'time' => 'Baru saja', 'is_unread' => true, 'color' => 'green', 'icon' => 'fa-regular fa-circle-check'
        ],
        (object)[
            'id' => 2, 'title' => 'Batas Waktu Segera Habis', 'desc' => 'Pendaftaran "Lomba Foto Merapi" tutup dalam 2 jam.', 
            'time' => '15 menit lalu', 'is_unread' => true, 'color' => 'purple', 'icon' => 'fa-solid fa-trophy'
        ]
    ];

    $lombaList = [
        (object)[
            'id' => 101, 'judul' => 'Kejuaraan Pertukangan Kayu DIY', 'url' => 'image/img (5).jpg', 
            'lokasi_singkat' => 'Sleman', 'kategori' => 'Teknologi & Kayu', 'icon_kategori' => 'fa-code', 
            'tanggal' => '2026-02-15', 'harga' => '150,000'
        ],
        (object)[
            'id' => 102, 'judul' => 'Pameran Kerajinan Regional', 'url' => 'image/img (6).jpg', 
            'lokasi_singkat' => 'Bantul', 'kategori' => 'Seni & Desain', 'icon_kategori' => 'fa-palette', 
            'tanggal' => '2026-03-10', 'harga' => '100,000'
        ]
    ];

    $unreadCount = collect($notifications)->where('is_unread', true)->count();
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

  <style>
    /* FIX MODAL SCROLL & LAYOUT */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .modal-overlay.active { display: flex; }

    .modal-box {
        background: #fff;
        width: 100%;
        max-width: 600px;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        max-height: 90vh; /* Membatasi tinggi agar tidak tembus layar */
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .modal-header { padding: 20px; border-bottom: 1px solid #eee; flex-shrink: 0; }
    
    .modal-body { 
        padding: 20px; 
        overflow-y: auto; /* Kunci agar konten di dalam bisa di-scroll */
        flex-grow: 1; 
    }

    .modal-footer { 
        padding: 20px; 
        border-top: 1px solid #eee; 
        background: #f9fafb; 
        display: flex; 
        gap: 12px; 
        flex-shrink: 0; 
    }

    .modal-footer button { flex: 1; padding: 12px; border-radius: 8px; font-weight: 600; cursor: pointer; }
    .btn-cancel { background: #fff; border: 1px solid #ddd; color: #444; }
    .btn-submit { background: #4f46e5; border: none; color: #fff; }

    /* Dropdown Styling */
    select {
        width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;
        font-family: inherit; font-size: 14px; appearance: none;
        background: white url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") no-repeat right 10px center / 16px;
    }
  </style>
</head>
<body>

<div class="admin-container">
  <aside class="sidebar">
    <div class="sidebar-header"><h2>ZHIB Admin</h2><span>Regional DIY</span></div>
    <ul class="sidebar-menu">
      <li><a href="{{ url('/admin/dashboard') }}"><i class="fa-solid fa-border-all"></i> Dashboard</a></li>
      <li><a href="{{ url('/admin/pembayaran') }}"><i class="fa-regular fa-credit-card"></i> Pembayaran</a></li>
      <li><a href="{{ url('/admin/lomba') }}" class="active"><i class="fa-solid fa-trophy"></i> Lomba</a></li>
      <li><a href="{{ url('/admin/komunitas') }}"><i class="fa-solid fa-user-group"></i> Komunitas</a></li>
      <li><a href="{{ url('/admin/laporan') }}"><i class="fa-solid fa-triangle-exclamation"></i> Laporan</a></li>
      <li><a href="{{ url('/admin/berita') }}"><i class="fa-regular fa-newspaper"></i> Berita</a></li>
      <li class="spacer"></li>
      <li>
        <form action="{{ url('/logout') }}" method="POST">
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
      <h1>Pengelola Lomba</h1> 
      <div class="topbar-right">
        <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" placeholder="Cari lomba..."></div>
        <div class="notif-wrapper">
          <button class="btn-icon" onclick="toggleNotif()"><i class="fa-regular fa-bell"></i>@if($unreadCount > 0)<span class="badge-dot"></span>@endif</button>
          <div class="notif-popup" id="notifPopup">
            <div class="popup-header"><h3>Notifikasi</h3><button class="ph-close-btn" onclick="toggleNotif()">&times;</button></div>
            <div class="popup-body">
                @foreach($notifications as $notif)
                <div class="p-item {{ $notif->is_unread ? 'unread' : '' }}">
                    <div class="p-icon-circle {{ $notif->color }}"><i class="{{ $notif->icon }}"></i></div>
                    <div class="p-details"><h4>{{ $notif->title }}</h4><p>{{ $notif->desc }}</p><small>{{ $notif->time }}</small></div>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="page-action-header">
        <div class="text-content"><h2>Lomba Resmi (Official)</h2><p>Kelola lomba DIY regional</p></div>
        <button class="btn-primary" onclick="togglePopup(true)"><i class="fa-solid fa-plus"></i> Buat Lomba Baru</button>
    </div>

    <div class="lomba-grid" id="lombaContainer">
        @foreach($lombaList as $item)
        <div class="card-lomba">
            <div class="card-img-wrapper">
                <img src="{{ asset($item->url) }}" alt="Lomba">
                <span class="badge-lokasi">{{ $item->lokasi_singkat }}</span>
            </div>
            <div class="card-body">
                <h3>{{ $item->judul }}</h3>
                <span class="tag-kategori"><i class="fa-solid {{ $item->icon_kategori }}"></i> {{ $item->kategori }}</span>
                <div class="card-meta"><span><i class="fa-regular fa-calendar"></i> {{ $item->tanggal }}</span><span class="price">Rp {{ $item->harga }}</span></div>
                <a href="{{ url('/admin/kelola-lomba/'.$item->id) }}" class="btn-kelola">Kelola Lomba</a>
            </div>
        </div>
        @endforeach
    </div>
  </main>
</div>

<div class="modal-overlay" id="popupLomba">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Buat Lomba Baru</h3>
            <span class="close-icon" onclick="togglePopup(false)">&times;</span>
        </div>
        
        <form action="{{ url('/admin/lomba/store') }}" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Judul Lomba</label>
                    <input type="text" name="judul" required placeholder="Contoh: Kejuaraan Pertukangan...">
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="3" placeholder="Jelaskan lomba..."></textarea>
                </div>

                <div class="form-group">
                    <label>Kategori Wilayah (DIY)</label>
                    <select name="wilayah" required>
                        <option value="" disabled selected>Pilih Wilayah...</option>
                        <option value="Kota Yogyakarta">Kota Yogyakarta</option>
                        <option value="Kabupaten Sleman">Kabupaten Sleman</option>
                        <option value="Kabupaten Bantul">Kabupaten Bantul</option>
                        <option value="Kabupaten Kulon Progo">Kabupaten Kulon Progo</option>
                        <option value="Kabupaten Gunungkidul">Kabupaten Gunungkidul</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Lokasi Detail</label>
                    <input type="text" name="lokasi" placeholder="Contoh: Alun-Alun Utara / GOR UNY">
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label>Jam Mulai</label>
                        <input type="time" name="jam_mulai">
                    </div>
                    <div class="form-col">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai">
                    </div>
                </div>

                <div class="form-group">
                    <label>Biaya Pendaftaran (Rp)</label>
                    <input type="text" name="harga" placeholder="150,000">
                </div>

                <div class="form-group">
                    <label>Poster Lomba</label>
                    <div class="upload-area" onclick="document.getElementById('filePoster').click()" style="border: 2px dashed #ddd; padding: 20px; text-align: center; border-radius: 8px; cursor: pointer;">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <p style="margin:0; font-weight:600; color:#333;">Klik untuk unggah</p>
                        <input type="file" name="url" id="filePoster" style="display:none" onchange="updateFileName(this)">
                        <small id="fileNameDisplay">Hanya file PNG, JPG (Maks 2MB)</small>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="togglePopup(false)">Batal</button>
                <button type="submit" class="btn-submit">Buat Lomba</button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePopup(show) {
        const modal = document.getElementById('popupLomba');
        if(show) modal.classList.add('active');
        else modal.classList.remove('active');
    }

    function toggleNotif() { document.getElementById('notifPopup').classList.toggle('active'); }

    function updateFileName(input) {
        const display = document.getElementById('fileNameDisplay');
        if (input.files.length > 0) display.innerText = "Terpilih: " + input.files[0].name;
    }

    window.onclick = function(e) {
        const modal = document.getElementById('popupLomba');
        if (e.target == modal) togglePopup(false);
    }
</script>
</body>
</html>