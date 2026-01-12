@php
    /* MOCK DATA (DATA DUMMY)
       Backend: Ganti variabel ini dengan data asli dari database.
    */
    
    $beritaList = [
        (object)[
            'id' => 1,
            'url' => 'image/img (5).jpg',
            'status' => 'published',
            'status_label' => 'Dipublikasi',
            'status_class' => 'green',
            'judul' => 'Kejuaraan Pertukangan Kayu DIY 2026 Siap Digelar di Sleman',
            'ringkasan' => 'Lomba pertukangan kayu terbesar tahun ini akan diselenggarakan pada 15 Februari 2026 dengan hadiah total puluhan juta rupiah.',
            'kategori' => 'Event & Lomba',
            'tanggal' => '07 Jan 2026',
            'wilayah' => 'Sleman'
        ],
        (object)[
            'id' => 2,
            'url' => 'image/img (6).jpg',
            'status' => 'draft',
            'status_label' => 'Draf',
            'status_class' => 'yellow',
            'judul' => 'Tips Fotografi Lanskap untuk Pemula di Musim Hujan',
            'ringkasan' => 'Musim hujan bukan halangan untuk berburu foto lanskap yang dramatis. Simak beberapa tips berikut untuk mendapatkan hasil maksimal.',
            'kategori' => 'Artikel & Tips',
            'tanggal' => '-',
            'wilayah' => 'DIY'
        ],
        (object)[
            'id' => 3,
            'url' => 'image/img (7).jpg',
            'status' => 'published',
            'status_label' => 'Dipublikasi',
            'status_class' => 'green',
            'judul' => 'Komunitas Seni Bantul Mengadakan Pameran Amal',
            'ringkasan' => 'Sebanyak 50 seniman lokal Bantul akan memamerkan karya mereka dalam acara amal untuk mendukung korban bencana alam.',
            'kategori' => 'Berita Komunitas',
            'tanggal' => '05 Jan 2026',
            'wilayah' => 'Bantul'
        ]
    ];

    // Menghitung jumlah draf dan publikasi secara dinamis
    $countAll = count($beritaList);
    $countPublished = collect($beritaList)->where('status', 'published')->count();
    $countDraft = collect($beritaList)->where('status', 'draft')->count();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Berita - ZHIB Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/lomba.css') }}"> 
  <link rel="stylesheet" href="{{ asset('css/admin-berita.css') }}">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* === PERBAIKAN TAMPILAN MODAL & FORM === */
    .form-group label {
        font-weight: 600;
        font-size: 13px;
        color: #374151;
        margin-bottom: 6px;
        display: block;
    }
    
    input[type="text"], textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        transition: all 0.2s;
        outline: none;
    }

    input[type="text"]:focus, textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .custom-select-wrapper {
        position: relative;
    }
    
    .custom-select-wrapper select {
        width: 100%;
        padding: 10px 30px 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background-color: white;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        color: #374151;
        appearance: none;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;
    }

    .custom-select-wrapper select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .select-icon {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        color: #6b7280;
        font-size: 12px;
        pointer-events: none;
    }

    .upload-dashed-area {
        border: 2px dashed #d1d5db;
        border-radius: 10px;
        padding: 30px 20px;
        text-align: center;
        background-color: #f9fafb;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .upload-dashed-area:hover {
        border-color: #2563eb;
        background-color: #eff6ff;
    }

    .upload-dashed-area i {
        font-size: 28px;
        color: #9ca3af;
        margin-bottom: 5px;
        transition: color 0.2s;
    }

    .upload-dashed-area:hover i {
        color: #2563eb;
    }

    .upload-text-main {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .upload-text-sub {
        font-size: 12px;
        color: #9ca3af;
    }

    .upload-dashed-area.has-file {
        border-style: solid;
        border-color: #d1d5db;
        background-color: white;
    }
    .upload-dashed-area.has-file p { color: #111; }

    .modal-footer-between {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        margin-top: 20px;
        border-top: 1px solid #f3f4f6;
    }

    .right-btns {
        display: flex;
        gap: 10px;
    }

    .btn-cancel {
        padding: 10px 20px;
        border: 1px solid #d1d5db;
        background: white;
        border-radius: 8px;
        font-weight: 600;
        color: #4b5563;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-cancel:hover { background: #f3f4f6; }

    .btn-outline-purple {
        padding: 10px 20px;
        border: 1px solid #d8b4fe;
        background: white;
        color: #9333ea;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-outline-purple:hover { background: #f3e8ff; }

    .btn-submit {
        padding: 10px 20px;
        background: #111;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-submit:hover { background: #333; }

  </style>
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
      <li><a href="{{ url('/admin/laporan') }}"><i class="fa-solid fa-triangle-exclamation"></i> Laporan</a></li>
      <li><a href="{{ url('/admin/berita') }}" class="active"><i class="fa-regular fa-newspaper"></i> Berita</a></li>
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
      <h1>Manajemen Berita</h1> 
      <div class="topbar-right">
        <div class="search-box"><i class="fa-solid fa-magnifying-glass"></i><input type="text" placeholder="Cari berita..."></div>
        <div class="notif-wrapper">
             <button class="btn-icon" onclick="toggleNotif()"><i class="fa-regular fa-bell"></i><span class="badge-dot"></span></button>
          <div class="notif-popup" id="notifPopup">
            <div class="popup-header">
                <div class="ph-content">
                    <div class="ph-icon-circle"><i class="fa-regular fa-bell"></i></div>
                    <div class="ph-text"><h3>Notifikasi</h3><span>3 belum dibaca</span></div>
                </div>
                <button class="ph-close-btn" onclick="toggleNotif()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="popup-body">
                <div class="p-item unread">
                    <div class="p-icon-circle green"><i class="fa-regular fa-circle-check"></i></div>
                    <div class="p-details"><h4>Pembayaran Baru Masuk</h4><p>Rizky Pratama telah mengunggah bukti.</p><small>Sekarang</small></div>
                    <div class="unread-dot"></div>
                </div>
                <div class="p-item unread">
                    <div class="p-icon-circle purple"><i class="fa-solid fa-trophy"></i></div>
                    <div class="p-details"><h4>Lomba Akan Segera Berakhir</h4><p>Kejuaraan Pertukangan Kayu DIY akan berakhir.</p><small>15 menit lalu</small></div>
                    <div class="unread-dot"></div>
                </div>
                <div class="p-item unread">
                    <div class="p-icon-circle blue"><i class="fa-solid fa-user-group"></i></div>
                    <div class="p-details"><h4>Komunitas Baru Bergabung</h4><p>Komunitas "Kreator Digital Bantul" menunggu verifikasi.</p><small>1 jam lalu</small></div>
                    <div class="unread-dot"></div>
                </div>
                <div class="p-item">
                    <div class="p-icon-circle red"><i class="fa-solid fa-circle-exclamation"></i></div>
                    <div class="p-details"><h4>Laporan Prioritas Tinggi</h4><p>Laporan baru diterima di forum Sleman.</p><small>2 jam lalu</small></div>
                </div>
            </div>
            <div class="popup-footer"><button>Tandai Semua Sudah Dibaca</button></div>
          </div>
        </div>
      </div>
    </header>

    <div class="berita-header-sec">
        <div>
            <h2>Daftar Berita & Pengumuman</h2>
            <p>Kelola informasi yang akan ditampilkan kepada pengguna</p>
        </div>
        <button class="btn-primary" onclick="bukaModal('modalBuatBerita')">
            <i class="fa-solid fa-plus"></i> Buat Berita Baru
        </button>
    </div>

    <div class="berita-tabs">
        <button class="tab-pill active" onclick="filterBerita('all', this)">Semua ({{ $countAll }})</button>
        <button class="tab-pill" onclick="filterBerita('published', this)">Dipublikasi ({{ $countPublished }})</button>
        <button class="tab-pill" onclick="filterBerita('draft', this)">Draf ({{ $countDraft }})</button>
    </div>

    <div class="berita-list-container">
        {{-- Looping Standard untuk Daftar Berita --}}
        @foreach($beritaList as $item)
        <div class="news-card" data-status="{{ $item->status }}">
            <div class="nc-image-wrapper">
                <img src="{{ asset($item->url) }}" alt="Thumbnail Berita">
                <span class="nc-badge {{ $item->status_class }}">{{ $item->status_label }}</span>
            </div>
            <div class="nc-content">
                <h3>{{ $item->judul }}</h3>
                <p>{{ $item->ringkasan }}</p>
                <div class="nc-meta">
                    <span><i class="fa-solid fa-tag"></i> {{ $item->kategori }}</span>
                    <span><i class="fa-regular fa-calendar"></i> {{ $item->tanggal }}</span>
                    <span><i class="fa-solid fa-location-dot"></i> {{ $item->wilayah }}</span>
                </div>
                <div class="nc-actions">
                    <button class="btn-outline-blue" onclick="bukaModal('modalEditBerita')"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                    <button class="btn-outline-red" onclick="bukaModal('modalHapusBerita')"><i class="fa-regular fa-trash-can"></i> Hapus</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

  </main>
</div>

{{-- MODAL BUAT BERITA --}}
<div class="modal-overlay" id="modalBuatBerita">
    <div class="modal-box medium-box">
        <div class="modal-header">
            <h3>Buat Berita Baru</h3>
            <span class="close-icon" onclick="tutupModal('modalBuatBerita')">&times;</span>
        </div>
        <form action="{{ url('/admin/berita/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Judul Berita *</label>
                    <input type="text" name="judul" placeholder="Contoh: Kejuaraan Pertukangan Kayu DIY 2026">
                </div>
                
                <div class="form-group">
                    <label>Ringkasan Singkat *</label>
                    <textarea name="ringkasan" rows="3" placeholder="Tulis 1-2 kalimat ringkasan berita..."></textarea>
                </div>
                
                <div class="form-row" style="display: flex; gap: 20px;">
                    <div class="form-col" style="flex: 1;">
                        <label>Kategori *</label>
                        <div class="custom-select-wrapper">
                            <select name="kategori">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Event">Event & Lomba</option>
                                <option value="Komunitas">Berita Komunitas</option>
                                <option value="Artikel">Artikel & Tips</option>
                                <option value="Pengumuman">Pengumuman</option>
                            </select>
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                    <div class="form-col" style="flex: 1;">
                        <label>Wilayah *</label>
                        <div class="custom-select-wrapper">
                            <select name="wilayah">
                                <option value="" disabled selected>Pilih Wilayah</option>
                                <option value="Sleman">Sleman</option>
                                <option value="Bantul">Bantul</option>
                                <option value="Kulon Progo">Kulon Progo</option>
                                <option value="Gunungkidul">Gunungkidul</option>
                                <option value="Kota Yogyakarta">Kota Yogyakarta</option>
                                <option value="DIY">Seluruh DIY</option>
                            </select>
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Gambar Sampul</label>
                    <div class="upload-dashed-area" onclick="document.getElementById('file-upload-new').click()">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p class="upload-text-main">Klik untuk unggah</p>
                        <p class="upload-text-sub">atau seret file ke sini (PNG, JPG)</p>
                        <input type="file" id="file-upload-new" name="url" style="display:none">
                    </div>
                </div>
            </div>
            
            <div class="modal-footer-between">
                <button type="button" class="btn-cancel" onclick="tutupModal('modalBuatBerita')">Batal</button>
                <div class="right-btns">
                    <button type="submit" name="status" value="draft" class="btn-outline-purple">Simpan Draf</button>
                    <button type="submit" name="status" value="published" class="btn-submit">Publikasikan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT BERITA --}}
<div class="modal-overlay" id="modalEditBerita">
    <div class="modal-box medium-box">
        <div class="modal-header">
            <h3>Edit Berita</h3>
            <span class="close-icon" onclick="tutupModal('modalEditBerita')">&times;</span>
        </div>
        <form action="{{ url('/admin/berita/update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label>Judul Berita *</label>
                    <input type="text" name="judul" value="Kejuaraan Pertukangan Kayu DIY 2026 Siap Digelar di Sleman">
                </div>
                
                <div class="form-group">
                    <label>Ringkasan Singkat *</label>
                    <textarea name="ringkasan" rows="3">Lomba pertukangan kayu terbesar tahun ini akan diselenggarakan pada 15 Februari 2026 dengan hadiah total puluhan juta rupiah.</textarea>
                </div>
                
                <div class="form-row" style="display: flex; gap: 20px;">
                    <div class="form-col" style="flex: 1;">
                        <label>Kategori *</label>
                        <div class="custom-select-wrapper">
                            <select name="kategori">
                                <option value="Event" selected>Event & Lomba</option>
                                <option value="Komunitas">Berita Komunitas</option>
                                <option value="Artikel">Artikel & Tips</option>
                                <option value="Pengumuman">Pengumuman</option>
                            </select>
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                    <div class="form-col" style="flex: 1;">
                        <label>Wilayah *</label>
                        <div class="custom-select-wrapper">
                            <select name="wilayah">
                                <option value="Sleman" selected>Sleman</option>
                                <option value="Bantul">Bantul</option>
                                <option value="Kulon Progo">Kulon Progo</option>
                                <option value="Gunungkidul">Gunungkidul</option>
                                <option value="Kota Yogyakarta">Kota Yogyakarta</option>
                                <option value="DIY">Seluruh DIY</option>
                            </select>
                            <i class="fa-solid fa-chevron-down select-icon"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Gambar Sampul</label>
                    <div class="upload-dashed-area has-file" onclick="document.getElementById('file-upload-edit').click()">
                        <i class="fa-regular fa-image" style="color: #2563eb;"></i>
                        <p class="upload-text-main">img_kejuaraan_kayu.jpg</p>
                        <p class="upload-text-sub" style="color: #6b7280; font-size: 11px;">Klik untuk mengganti gambar</p>
                        <input type="file" id="file-upload-edit" name="url" style="display:none">
                    </div>
                </div>
            </div>
            
            <div class="modal-footer-between">
                <button type="button" class="btn-cancel" onclick="tutupModal('modalEditBerita')">Batal</button>
                <div class="right-btns">
                    <button type="submit" name="status" value="draft" class="btn-outline-purple">Simpan Draf</button>
                    <button type="submit" name="status" value="published" class="btn-submit">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL HAPUS BERITA --}}
<div class="modal-overlay" id="modalHapusBerita">
    <div class="modal-box small-box">
        <div class="modal-header-simple">
            <div class="header-content-danger">
                <div class="danger-icon-soft"><i class="fa-solid fa-triangle-exclamation"></i></div>
                <h3>Hapus Berita?</h3>
            </div>
            <span class="close-icon" onclick="tutupModal('modalHapusBerita')">&times;</span>
        </div>
        <div class="modal-body">
            <p style="color:#555; line-height: 1.5; margin-top: 0;">Tindakan ini akan menghapus berita secara permanen dan tidak dapat dikembalikan. Apakah Anda yakin?</p>
        </div>
        <div class="modal-footer-simple">
            <button type="button" class="btn-cancel-wide" onclick="tutupModal('modalHapusBerita')">Batal</button>
            <form action="{{ url('/admin/berita/delete') }}" method="POST" style="flex:1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete-wide" style="width: 100%;">Ya, Hapus Berita</button>
            </form>
        </div>
    </div>
</div>

<script>
    // 1. Notifikasi
    function toggleNotif() { document.getElementById('notifPopup').classList.toggle('active'); }
    
    // 2. Modal
    function bukaModal(id) { document.getElementById(id).style.display = 'flex'; }
    function tutupModal(id) { document.getElementById(id).style.display = 'none'; }
    
    window.onclick = function(e) {
        if (e.target.classList.contains('modal-overlay')) e.target.style.display = 'none';
        const notifPopup = document.getElementById('notifPopup');
        const btn = document.querySelector('.topbar .btn-icon');
        if(notifPopup && !notifPopup.contains(e.target) && !btn.contains(e.target)) {
            notifPopup.classList.remove('active');
        }
    }

    // 3. Filter Berita (Tabs)
    function filterBerita(status, btn) {
        document.querySelectorAll('.tab-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.news-card').forEach(card => {
            const cardStatus = card.getAttribute('data-status');
            if (status === 'all' || cardStatus === status) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>