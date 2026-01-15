@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('content')

<section class="hero">
    <img src="{{ asset('image/img (8).jpg') }}" alt="">
    <div class="hero-overlay">
        <h1>Temukan Teman Satu Frekuensi</h1>
        <p>Ribuan komunitas dan event seru menantimu.</p>
    </div>
</section>

<section class="section">
    <div class="section-container">
        <h2 class="section-title">REKOMENDASI BERITA</h2>

        <div class="grid-3">
            @forelse($berita as $item)
            <a href="{{ route('berita.detail', $item->id) }}" class="news-card" @guest
                onclick="openLogin(); return false;" @endguest>

                <div class="news-image-frame">
                    <img src="{{ asset($item->gambar_url ?? 'image/default-news.jpg') }}">
                </div>

                <p style="text-align: center;">{{ Str::limit($item->judul, 80) }}</p>
            </a>
            @empty
            <p style="padding-left: 550px; text-align: center;">Tidak ada berita</p>
            @endforelse
        </div>
    </div>
</section>

<section class="communities" id="event">
    <h2>PILIHAN EVENT</h2>
    <p class="communities-subtitle">
        Daftar Event terpilih untuk menambah<br>
        pengalaman, relasi, dan koleksi lencana
    </p>

    <div class="slider-container">
        <div class="scroll-wrapper" id="event-list">
            @foreach($events as $event)
            <div class="community-card">
                <div class="event-image">
                    <img src="{{ asset($event->poster_url ?? 'image/default-event.jpg') }}">
                </div>

                <div class="card-content">
                    <h3>{{ Str::limit($event->judul, 60) }}</h3>

                    <a href="{{ route('events.show', $event->id) }}" class="card-link" @guest
                        onclick="openLogin(); return false;" @endguest>
                        Lihat Detail &gt;
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="section-container">
        <h2 class="section-title">HALL OF FAME</h2>
        <h6 class="section-subtitle">
            Mereka yang telah mengukir jejak terbaik di bulan ini
        </h6>
        @include('partials.hall-of-fame', ['users' => $hallOfFame])
    </div>
</section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Inisialisasi Slider
    initCustomSlider('event-list', 'event-prev', 'event-next', 300);
    // Note: Saya ubah scrollAmount jadi 300 agar pergeseran lebih terasa (lebar card + gap)
});

function initCustomSlider(containerId, prevBtnId, nextBtnId, scrollAmount) {
    const container = document.getElementById(containerId);
    const prevBtn = document.getElementById(prevBtnId);
    const nextBtn = document.getElementById(nextBtnId);

    // Debugging: Cek apakah elemen ditemukan
    if (!container || !prevBtn || !nextBtn) {
        console.error("Slider elements not found:", {
            container,
            prevBtn,
            nextBtn
        });
        return;
    }

    // Event Listener Tombol NEXT
    nextBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah perilaku default button
        console.log('Next clicked'); // Cek di Console browser

        // Gunakan scrollLeft langsung agar lebih reliable daripada scrollBy
        container.scrollLeft += scrollAmount;
    });

    // Event Listener Tombol PREV
    prevBtn.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('Prev clicked');

        container.scrollLeft -= scrollAmount;
    });
}
</script>

@guest
<!-- Auth overlays & modals (only for guests) -->


<script>
// 1. Definisikan Elemen
const overlay = document.getElementById('authOverlay');
const loginModal = document.getElementById('loginModal');
const registerModal = document.getElementById('registerModal');

// 2. Helper: Hapus pesan error/success di modal auth
function clearAuthErrors() {
    // Hapus pesan error/success yang di-render server
    loginModal.querySelectorAll('.error-message, .success-message').forEach(el => el.remove());
    registerModal.querySelectorAll('.error-message, .success-message').forEach(el => el.remove());

    // Update helper dataset agar tidak auto-open lagi pada runtime
    const bladeHelpers = document.getElementById('blade-helpers');
    if (bladeHelpers) {
        bladeHelpers.dataset.hasErrors = '0';
        bladeHelpers.dataset.registerErrors = '0';
    }
}

// 5. Fungsi Buka Lupa Password


// 6. Fungsi Pindah dari Login ke Register (YANG HILANG TADI)
function switchToRegister() {
    // bersihkan pesan sebelum pindah
    clearAuthErrors();
    loginModal.style.display = 'none';
    registerModal.style.display = 'block';
}

// 7. Fungsi Pindah dari Register ke Login (YANG HILANG TADI)
function switchToLogin() {
    // bersihkan pesan sebelum pindah
    clearAuthErrors();
    registerModal.style.display = 'none';
    loginModal.style.display = 'block';
}



document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);

    if (params.get('login') === '1') {
        openLogin();
    }

    const __hasErrors = document.getElementById('blade-helpers')?.dataset.hasErrors === '1';
    if (__hasErrors) {
        openLogin();
    }
});

function registerSuccess() {
    // simulasi register berhasil
    closeAuth(); // tutup semua modal
    openLogin(); // buka popup login
}

// 9. Event Listener untuk klik Overlay (Klik luar modal = tutup)
overlay.addEventListener('click', (e) => {
    if (e.target === overlay) {
        closeAuth();
    }
});

// 10. Cek URL Parameter (Opsional, untuk auto open register)
document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    if (params.get('register') === '1') {
        openRegister();
    }

    const regErr = document.getElementById('blade-helpers')?.dataset.registerErrors === '1';
    if (regErr) {
        openRegister();
    }
});

/* ===============================
   GUEST NAVBAR INTERCEPT
=============================== */
document.addEventListener('DOMContentLoaded', () => {
    const guestLinks = document.querySelectorAll('[data-auth]');

    guestLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            openLogin();
        });
    });
});
</script>

@endguest

@endsection