@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/cari-komunitas.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
<!-- header removed: using shared header partial instead -->
<!-- footer removed: using shared footer partial instead -->
<main class="comm-page">
    <div class="comm-container">

        <div class="search-bar-wrapper">
            <button class="btn-filter" onclick="openFilter()">
                <i class="fa-solid fa-sliders"></i> Filters
            </button>

            <div class="search-input-group">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" id="searchInput" placeholder="Search" onkeyup="searchCommunity()">
            </div>
        </div>

        <div class="community-list" id="communityList">

            <div class="comm-card" data-prov="diy" data-kota="jogja" data-cat="tech">
                <div class="comm-img">
                    <img src="{{ asset('image/img (2).jpg') }}" alt="Komunitas">
                </div>
                <div class="comm-content">
                    <h2 class="comm-title">Komunitas Indonesia Belajar</h2>
                    <p class="comm-desc">
                        Indonesia Belajar adalah komunitas nasional yang fokus pada pengembangan diri dan literasi
                        belajar sepanjang hayat. Eventnya meliputi diskusi daring, kelas pengembangan skill, dan
                        berbagi insight edukatif dengan suasana inklusif dan tidak memaksa interaksi aktif.
                    </p>
                    <span class="comm-stat">100 orang masuk di komunitas ini</span>
                </div>
                <div class="comm-action">
                    <button class="btn-join"
                        onclick="openJoinPopup('Komunitas Indonesia Belajar', 1)">Bergabung</button>
                </div>
            </div>

            <div class="comm-card" data-prov="diy" data-kota="sleman" data-cat="art">
                <div class="comm-img">
                    <img src="{{ asset('image/img (9).jpg') }}" alt="Komunitas">
                </div>
                <div class="comm-content">
                    <h2 class="comm-title">Komunitas Desain Indonesia (KDI)</h2>
                    <p class="comm-desc">
                        Komunitas Desain Indonesia mewadahi desainer grafis, UI/UX, dan ilustrator dari seluruh
                        Indonesia untuk berbagi karya, berdiskusi, serta belajar bersama. Interaksi lebih banyak
                        berbasis karya sehingga cocok bagi anggota yang tidak terlalu suka komunikasi verbal intens.
                    </p>
                    <span class="comm-stat">200 orang masuk di komunitas ini</span>
                </div>
                <div class="comm-action">
                    <button class="btn-join"
                        onclick="openJoinPopup('Komunitas Desain Indonesia (KDI)', 2)">Bergabung</button>
                </div>
            </div>

            <div class="comm-card" data-prov="jateng" data-kota="jogja" data-cat="tech">
                <div class="comm-img">
                    <img src="{{ asset('image/img (9).jpg') }}" alt="Komunitas">
                </div>
                <div class="comm-content">
                    <h2 class="comm-title">Indonesia Linux Community (ILC)</h2>
                    <p class="comm-desc">
                        Indonesia Linux Community adalah komunitas nasional bagi pengguna dan pengembang Linux serta
                        open-source. Eventnya meliputi diskusi teknis, berbagi tutorial, dan kolaborasi proyek
                        secara online maupun offline dengan pendekatan komunitas yang tenang dan berbasis minat.
                    </p>
                    <span class="comm-stat">200 orang masuk di komunitas ini</span>
                </div>
                <div class="comm-action">
                    <button class="btn-join"
                        onclick="openJoinPopup('Indonesia Linux Community (ILC)', 3)">Bergabung</button>
                </div>
            </div>

        </div>

    </div>
</main>

<div class="modal-overlay" id="filterModal">
    <div class="modal-box custom-filter-box">

        <button class="close-filter-btn" onclick="closeModals()">×</button>

        <form action="" method="GET">
            <div class="filter-container">

                <div class="filter-column">
                    <div class="filter-header-pill">Provinsi <span>▾</span></div>
                    <div class="filter-options-card">
                        <label class="checkbox-item">
                            <input type="checkbox" name="prov[]" value="jateng">
                            <span>Jawa Tengah</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="prov[]" value="diy" checked>
                            <span>Daerah Istimewa Yogyakarta</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="prov[]" value="kaltim">
                            <span>Kalimantan Timur</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="prov[]" value="papua">
                            <span>Papua Barat</span>
                        </label>
                        <div class="more-options">+ More</div>
                    </div>
                </div>

                <div class="filter-column">
                    <div class="filter-header-pill">Kota <span>▾</span></div>
                    <div class="filter-options-card">
                        <label class="checkbox-item">
                            <input type="checkbox" name="kota[]" value="jogja">
                            <span>Yogyakarta</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="kota[]" value="sleman" checked>
                            <span>Sleman</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="kota[]" value="bantul">
                            <span>Bantul</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="kota[]" value="kulonprogo">
                            <span>Kulon Progo</span>
                        </label>
                    </div>
                </div>

                <div class="filter-column">
                    <div class="filter-header-pill">Kategori <span>▾</span></div>
                    <div class="filter-options-card">
                        <label class="checkbox-item">
                            <input type="checkbox" name="cat[]" value="gaming">
                            <span>Gaming & E-sport</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="cat[]" value="tech" checked>
                            <span>Teknologi & Coding</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="cat[]" value="art">
                            <span>Seni & Desain</span>
                        </label>
                        <label class="checkbox-item">
                            <input type="checkbox" name="cat[]" value="health">
                            <span>Kesehatan Mental</span>
                        </label>
                        <div class="more-options">+ More</div>
                    </div>
                </div>

            </div>

            <div class="filter-footer-custom">
                <button type="submit" class="btn-black-filter">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="joinModal">
    <div class="modal-box join-box-custom">

        <h3>Yakin mau gabung<br>Komunitas ini dek !?!</h3>

        <div class="join-buttons">
            <button class="btn-pill" onclick="closeModals()">Gajadi Bg</button>
            <button class="btn-pill" onclick="confirmJoin()">Yakin Bg</button>
        </div>
    </div>
</div>

<!-- Hidden join form -->
<form id="joinForm" method="POST" action="{{ route('komunitas.join') }}" style="display:none;">
    @csrf
    <input type="hidden" name="komunitas_id" id="joinKomunitasId" value="">
</form>

</div>
</main>
@endsection

@section('scripts')
<script>
// ================= 1. DROPDOWN NAVBAR =================
// Handled by header partial; header script toggles `#profileDropdown` and closes other nav dropdowns


// ================= 2. MODAL & LOGIC GABUNG (UPDATED) =================
const filterModal = document.getElementById('filterModal');
const joinModal = document.getElementById('joinModal');

// Variabel Global
let selectedCommunity = {};

function closeModals() {
    if (filterModal) filterModal.classList.remove('active');
    if (joinModal) joinModal.classList.remove('active');
}

function openFilter() {
    if (filterModal) filterModal.classList.add('active');
}

// --- FUNGSI JOIN ---
function openJoinPopup(name, id) {
    selectedCommunity = {
        name: name,
        id: id
    };
    const popupTitle = document.querySelector('.join-box-custom h3');
    if (popupTitle) {
        popupTitle.innerHTML = `Yakin mau gabung<br>${name} dek !?!`;
    }
    joinModal.classList.add('active');
}

// --- FUNGSI KONFIRMASI (YAKIN BG) ---
function confirmJoin() {
    // Set hidden form value and submit
    const form = document.getElementById('joinForm');
    const input = document.getElementById('joinKomunitasId');
    if (!form || !input || !selectedCommunity.id) return closeModals();
    input.value = selectedCommunity.id;
    form.submit();
}

// Tutup modal jika klik di luar kotak
window.onclick = function(event) {
    if (event.target == filterModal) closeModals();
    if (event.target == joinModal) closeModals();
}

// ================= 3. FUNGSI SEARCH & FILTER =================
function getSelectedFilters() {
    function valuesOf(name) {
        return Array.from(document.querySelectorAll(`#filterModal input[name="${name}"]:checked`)).map(i => i.value);
    }
    return {
        prov: valuesOf('prov[]'),
        kota: valuesOf('kota[]'),
        cat: valuesOf('cat[]')
    };
}

function searchCommunity() {
    // Ambil input, hilangkan whitespace ujung, ubah ke lower case
    const raw = document.getElementById('searchInput').value || '';
    const input = raw.trim().toLowerCase();

    // Tokenize search (AND semantics): semua token harus ada di title/desc
    const tokens = input === '' ? [] : input.split(/\s+/).filter(Boolean);

    // Ambil filter yang dipilih
    const filters = getSelectedFilters();

    const cards = document.getElementsByClassName('comm-card');
    let anyVisible = false;

    for (let i = 0; i < cards.length; i++) {
        const titleEl = cards[i].getElementsByClassName('comm-title')[0];
        const descEl = cards[i].getElementsByClassName('comm-desc')[0];
        const title = titleEl ? titleEl.textContent.toLowerCase() : '';
        const desc = descEl ? descEl.textContent.toLowerCase() : '';
        const hay = (title + ' ' + desc);

        // cek token pencarian
        const tokenMatch = tokens.length === 0 ? true : tokens.every(t => hay.includes(t));

        // cek filters (jika tidak ada pilihan di group, anggap match)
        const prov = cards[i].dataset.prov || '';
        const kota = cards[i].dataset.kota || '';
        const cat = cards[i].dataset.cat || '';

        const provMatch = (filters.prov.length === 0) ? true : filters.prov.includes(prov);
        const kotaMatch = (filters.kota.length === 0) ? true : filters.kota.includes(kota);
        const catMatch = (filters.cat.length === 0) ? true : filters.cat.includes(cat);

        const match = tokenMatch && provMatch && kotaMatch && catMatch;

        cards[i].style.display = match ? 'flex' : 'none';
        if (match) anyVisible = true;
    }

    // Jika tidak ada hasil, kita tetap tidak menampilkan pesan baru (behaviour sebelumnya)
}

// Hook form submit agar tidak reload halaman, cukup apply filter client-side dan tutup modal
const filterForm = document.querySelector('#filterModal form');
if (filterForm) {
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        searchCommunity();
        closeModals();
    });
}

// Pastikan input pencarian memicu kombinasi search + filters
const searchInputEl = document.getElementById('searchInput');
if (searchInputEl) {
    searchInputEl.addEventListener('input', function() {
        searchCommunity();
    });
}
</script>
@endsection