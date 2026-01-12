<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator Event - ZHIB</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/moderator-kegiatan.css') }}">
</head>
<body>

    <nav class="chat-navbar">
        <div class="nav-left">
            <a href="{{ url('/moderator/chat') }}" class="nav-item">Chat</a>
            <a href="{{ url('/moderator/events') }}" class="nav-item active">Events</a>
        </div>
        
        <div class="nav-center">
            <h1>KOMUNITAS DESAIN INDONESIA</h1>
        </div>

        <div class="nav-right">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search">
            </div>
        </div>
    </nav>

    <main class="event-dashboard">
        
        <div class="section-header">
            <h2>KEGIATAN MENDATANG</h2>
            <button class="btn-tambah" onclick="openModal()">+ Tambah Kegiatan</button>
        </div>

        <div class="kegiatan-grid">
            <div class="card-kegiatan">
                <h3>Acara Buka Bersama</h3>
                <div class="card-info">
                    <i class="fa-regular fa-calendar"></i>
                    <span>7 Maret 2026</span>
                </div>
                <div class="card-info">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Bento Kopi JCM, Yogyakarta</span>
                </div>
            </div>

            <div class="card-kegiatan">
                <h3>Nonton Bareng Avatar 3</h3>
                <div class="card-info">
                    <i class="fa-regular fa-calendar"></i>
                    <span>2 Januari 2026</span>
                </div>
                <div class="card-info">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Jogja City Mall</span>
                </div>
            </div>

            <div class="card-kegiatan">
                <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
                <div class="card-info">
                    <i class="fa-regular fa-calendar"></i>
                    <span>15 Desember 2025</span>
                </div>
                <div class="card-info">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Bento Kopi JCM, Yogyakarta</span>
                </div>
            </div>

            <div class="card-kegiatan">
                <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
                <div class="card-info">
                    <i class="fa-regular fa-calendar"></i>
                    <span>15 Desember 2025</span>
                </div>
                <div class="card-info">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Bento Kopi JCM, Yogyakarta</span>
                </div>
            </div>
        </div>

        <div class="section-header center-title" style="margin-top: 60px;">
            <h2>LOMBA MENDATANG</h2>
            <div class="nav-arrows">
                <button class="arrow-btn"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="arrow-btn"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="lomba-grid">
            <div class="card-lomba">
                <img src="{{ asset('image/img (4).jpg') }}" alt="Poster"> 
                <div class="lomba-content">
                    <h4>Kompetisi Offline Mobile Legend</h4>
                    <div class="lomba-info"><i class="fa-regular fa-calendar"></i> 7 Januari 2026</div>
                    <div class="lomba-info"><i class="fa-solid fa-location-dot"></i> Yogyakarta</div>
                </div>
            </div>

            <div class="card-lomba">
                <img src="{{ asset('image/img (3).jpg') }}" alt="Poster">
                <div class="lomba-content">
                    <h4>Kompetisi Offline Mobile Legend</h4>
                    <div class="lomba-info"><i class="fa-regular fa-calendar"></i> 7 Januari 2026</div>
                    <div class="lomba-info"><i class="fa-solid fa-location-dot"></i> Sleman</div>
                </div>
            </div>

            <div class="card-lomba">
                <img src="{{ asset('image/img (10).jpg') }}" alt="Poster">
                <div class="lomba-content">
                    <h4>Kompetisi Offline Mobile Legend</h4>
                    <div class="lomba-info"><i class="fa-regular fa-calendar"></i> 7 Januari 2026</div>
                    <div class="lomba-info"><i class="fa-solid fa-location-dot"></i> Bantul</div>
                </div>
            </div>

             <div class="card-lomba">
                <img src="{{ asset('image/img (3).jpg') }}" alt="Poster">
                <div class="lomba-content">
                    <h4>Kompetisi Offline Mobile Legend</h4>
                    <div class="lomba-info"><i class="fa-regular fa-calendar"></i> 7 Januari 2026</div>
                    <div class="lomba-info"><i class="fa-solid fa-location-dot"></i> Bantul</div>
                </div>
            </div>
        </div>

    </main>

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

    <div id="modalAdd" class="modal-overlay">
        <div class="modal-content">
            <form>
                <div class="modal-group">
                    <label>Nama Acara</label>
                    <input type="text" placeholder="Ketik di sini">
                </div>
                
                <div class="modal-group">
                    <label>Lokasi</label>
                    <input type="text" placeholder="Ketik di sini">
                </div>

                <div class="modal-group">
                    <label>Tanggal</label>
                    <input type="text" placeholder="Pilih Tanggal" onfocus="(this.type='date')" onblur="(this.type='text')">
                </div>

                <button type="button" class="btn-modal-submit" onclick="closeModal()">Tambahkan</button>
            </form>
        </div>
    </div>

    <script>
        // Logic Modal
        const modal = document.getElementById('modalAdd');

        function openModal() {
            modal.style.display = 'flex';
        }

        function closeModal() {
            // Simulasi submit
            // alert("Kegiatan berhasil ditambahkan!");
            modal.style.display = 'none';
        }

        // Tutup jika klik di luar box putih
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>