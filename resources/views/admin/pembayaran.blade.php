@php
    /* |--------------------------------------------------------------------------
    | MOCK DATA (DATA DUMMY)
    |--------------------------------------------------------------------------
    | Backend: Ganti variabel di bawah ini dengan data asli dari database/controller.
    */
    
    $notifications = [
        (object)[
            'title' => 'Pembayaran Baru Masuk',
            'desc' => 'Rizky Pratama telah mengunggah bukti pembayaran.',
            'time' => 'Sekarang',
            'is_unread' => true,
            'color' => 'green',
            'icon' => 'fa-regular fa-circle-check'
        ],
        (object)[
            'title' => 'Lomba Akan Segera Berakhir',
            'desc' => 'Kejuaraan Pertukangan Kayu DIY akan berakhir dalam 3 hari.',
            'time' => '15 menit lalu',
            'is_unread' => true,
            'color' => 'purple',
            'icon' => 'fa-solid fa-trophy'
        ],
    ];

    $payments = [
        (object)[
            'id' => 'TRX-8821',
            'user_name' => 'Budi Santoso',
            'user_url' => 'image/download (13).jpg',
            'event_name' => 'Kejuaraan Pertukangan Kayu DIY 2026',
            'amount' => 'Rp 150.000',
            'date' => '05 Jan 2026',
            'status' => 'pending',
            'status_label' => 'Tertunda',
            'proof_url' => 'image/img (9).jpg'
        ],
        (object)[
            'id' => 'TRX-8822',
            'user_name' => 'Siti Aminah',
            'user_url' => 'image/download (13).jpg',
            'event_name' => 'Workshop UI/UX Design',
            'amount' => 'Rp 100.000',
            'date' => '06 Jan 2026',
            'status' => 'pending',
            'status_label' => 'Tertunda',
            'proof_url' => 'image/download (16).jpg'
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pembayaran - ZHIB Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-pembayaran.css') }}">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            <li><a href="{{ url('/admin/pembayaran') }}" class="active"><i class="fa-regular fa-credit-card"></i> Pembayaran</a></li>
            <li><a href="{{ url('/admin/lomba') }}"><i class="fa-solid fa-trophy"></i> Lomba</a></li>
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
            <h1>Kelola Pembayaran</h1>
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
                                <div class="ph-text">
                                    <h3>Notifikasi</h3>
                                    <span>{{ count(collect($notifications)->where('is_unread', true)) }} belum dibaca</span>
                                </div>
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
                                @if($item->is_unread)<div class="unread-dot"></div>@endif
                            </div>
                            @endforeach
                        </div>

                        <div class="popup-footer">
                            <button>Tandai Semua Sudah Dibaca</button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-wrapper">
            <div class="table-card">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Pengguna</th>
                            <th>Acara</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $item)
                        <tr>
                            <td class="tx-id">#{{ $item->id }}</td>
                            <td>
                                <div class="user-cell">
                                    <img src="{{ asset($item->user_url) }}" alt="{{ $item->user_name }}">
                                    <span>{{ $item->user_name }}</span>
                                </div>
                            </td>
                            <td>{{ $item->event_name }}</td>
                            <td class="nominal">{{ $item->amount }}</td>
                            <td>{{ $item->date }}</td>
                            <td><span class="status-pill {{ $item->status }}">{{ $item->status_label }}</span></td>
                            <td>
                                <div class="action-group">
                                    <button class="btn-view" onclick="openModalBukti('{{ asset($item->proof_url) }}', '{{ $item->user_name }}', '{{ $item->event_name }}', '{{ $item->amount }}', '{{ $item->date }}')">
                                        <i class="fa-regular fa-eye"></i> Lihat Bukti
                                    </button>
                                    
                                    <button class="btn-icon-circle check" onclick="openModalApprove('{{ $item->user_name }}', '{{ $item->event_name }}', '{{ $item->amount }}', '{{ $item->date }}')">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    
                                    <button class="btn-icon-circle cross" onclick="openModalReject('{{ $item->user_name }}', '{{ $item->event_name }}', '{{ $item->amount }}', '{{ $item->date }}')">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<div class="modal-overlay" id="modalBukti">
    <div class="modal-card modal-lg">
        <div class="modal-header">
            <h3>Verifikasi Bukti Pembayaran</h3>
            <button class="close-btn" onclick="closeModal('modalBukti')"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <div class="info-box">
                <div class="info-row">
                    <div class="icon-wrap"><i class="fa-regular fa-user"></i></div>
                    <div><small>Anggota</small><p id="viewName">-</p></div>
                </div>
                <div class="info-row">
                    <div class="icon-wrap"><i class="fa-regular fa-calendar"></i></div>
                    <div><small>Acara</small><p id="viewEvent">-</p></div>
                </div>
                <div class="info-row">
                    <div class="icon-wrap"><i class="fa-solid fa-money-bill"></i></div>
                    <div><small>Jumlah</small><p class="blue-text" id="viewAmount">-</p></div>
                </div>
                <div class="info-row">
                    <div class="icon-wrap"><i class="fa-regular fa-clock"></i></div>
                    <div><small>Tanggal</small><p id="viewDate">-</p></div>
                </div>
            </div>
            <h4 class="section-title">Bukti Transfer Bank</h4>
            <div class="proof-container">
                <img id="viewImg" src="" alt="Bukti Transfer">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-full-green" onclick="transferToApprove()"><i class="fa-solid fa-check"></i> Verifikasi Pembayaran</button>
            <button class="btn-full-red" onclick="transferToReject()"><i class="fa-solid fa-circle-xmark"></i> Tolak Pembayaran</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalApprove">
    <div class="modal-card modal-sm">
        <div class="modal-header centered">
            <div class="icon-header-green"><i class="fa-solid fa-check"></i></div>
            <h3>Konfirmasi Pembayaran</h3>
            <button class="close-absolute" onclick="closeModal('modalApprove')"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <p class="text-center">Apakah Anda yakin ingin <strong class="text-green">menyetujui</strong> pembayaran ini?</p>
            <div class="user-card-grey">
                <div class="uc-avatar">U</div>
                <div class="uc-info">
                    <h4 id="confName">-</h4>
                    <span id="confDate">-</span>
                </div>
            </div>
            <div class="event-detail-simple">
                <small>Acara</small>
                <p id="confEvent">-</p>
                <small>Jumlah</small>
                <h3 class="blue-text" id="confAmount">-</h3>
            </div>
            <div class="note-box green">
                <strong>Catatan:</strong> Setelah disetujui, peserta akan mendapat notifikasi dan dapat mengikuti acara.
            </div>
        </div>
        <div class="modal-footer split">
            <button class="btn-outline" onclick="closeModal('modalApprove')">Batal</button>
            <button class="btn-fill-green" onclick="processApprove()">Setujui Pembayaran</button>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalReject">
    <div class="modal-card modal-sm">
        <div class="modal-header centered">
            <div class="icon-header-red"><i class="fa-solid fa-xmark"></i></div>
            <h3>Tolak Pembayaran</h3>
            <button class="close-absolute" onclick="closeModal('modalReject')"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal-body">
            <p class="text-center">Anda akan <strong class="text-red">menolak</strong> pembayaran ini. Peserta akan menerima notifikasi penolakan beserta alasannya.</p>
            <div class="user-card-grey">
                <div class="uc-avatar">U</div>
                <div class="uc-info">
                    <h4 id="rejName">-</h4>
                    <span id="rejDate">-</span>
                </div>
            </div>
            <div class="event-detail-simple">
                <small>Acara</small>
                <p id="rejEvent">-</p>
                <small>Jumlah</small>
                <h3 class="blue-text" id="rejAmount">-</h3>
            </div>
            <p class="label-reason">Pilih Alasan Penolakan *</p>
            <div class="reason-list">
                <label class="reason-item"><input type="radio" name="reason"> Bukti pembayaran tidak jelas atau terpotong</label>
                <label class="reason-item"><input type="radio" name="reason"> Nominal transfer tidak sesuai</label>
                <label class="reason-item"><input type="radio" name="reason"> Transfer ke rekening yang salah</label>
                <label class="reason-item"><input type="radio" name="reason"> Bukti pembayaran palsu atau dimanipulasi</label>
                <label class="reason-item"><input type="radio" name="reason"> Lainnya (tulis alasan di bawah)</label>
            </div>
            <div class="note-box red">
                <i class="fa-solid fa-triangle-exclamation"></i> 
                <div><strong>Perhatian</strong><br>Peserta harus mengunggah ulang bukti pembayaran yang benar.</div>
            </div>
        </div>
        <div class="modal-footer split">
            <button class="btn-outline" onclick="closeModal('modalReject')">Batal</button>
            <button class="btn-fill-red" onclick="processReject()">Tolak Pembayaran</button>
        </div>
    </div>
</div>

<script>
    let currentData = {};

    function toggleNotif() {
        const popup = document.getElementById('notifPopup');
        popup.classList.toggle('active');
    }

    window.addEventListener('click', function(e) {
        const popup = document.getElementById('notifPopup');
        const btn = document.querySelector('.notif-wrapper .btn-icon');
        if (popup && btn && !popup.contains(e.target) && !btn.contains(e.target)) {
            popup.classList.remove('active');
        }
    });

    function openModalBukti(img, name, event, amount, date) {
        currentData = { name, event, amount, date };
        document.getElementById('viewImg').src = img;
        document.getElementById('viewName').innerText = name;
        document.getElementById('viewEvent').innerText = event;
        document.getElementById('viewAmount').innerText = amount;
        document.getElementById('viewDate').innerText = date;
        document.getElementById('modalBukti').classList.add('active');
    }

    function openModalApprove(name, event, amount, date) {
        if(name) currentData = { name, event, amount, date };
        document.getElementById('confName').innerText = currentData.name;
        document.getElementById('confEvent').innerText = currentData.event;
        document.getElementById('confAmount').innerText = currentData.amount;
        document.getElementById('confDate').innerText = currentData.date;
        const initials = currentData.name.split(' ').map(n=>n[0]).join('').substring(0,2).toUpperCase();
        document.querySelectorAll('#modalApprove .uc-avatar').forEach(el => el.innerText = initials);
        document.getElementById('modalApprove').classList.add('active');
    }

    function openModalReject(name, event, amount, date) {
        if(name) currentData = { name, event, amount, date };
        document.getElementById('rejName').innerText = currentData.name;
        document.getElementById('rejEvent').innerText = currentData.event;
        document.getElementById('rejAmount').innerText = currentData.amount;
        document.getElementById('rejDate').innerText = currentData.date;
        const initials = currentData.name.split(' ').map(n=>n[0]).join('').substring(0,2).toUpperCase();
        document.querySelectorAll('#modalReject .uc-avatar').forEach(el => el.innerText = initials);
        document.getElementById('modalReject').classList.add('active');
    }

    function transferToApprove() {
        closeModal('modalBukti');
        setTimeout(() => openModalApprove(), 200); 
    }

    function transferToReject() {
        closeModal('modalBukti');
        setTimeout(() => openModalReject(), 200);
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('active');
    }

    function processApprove() {
        alert("Pembayaran Disetujui!");
        closeModal('modalApprove');
    }
    
    function processReject() {
        alert("Pembayaran Ditolak!");
        closeModal('modalReject');
    }
</script>

</body>
</html>