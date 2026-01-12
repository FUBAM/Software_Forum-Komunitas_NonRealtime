@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<main class="profile-page">

    @guest
    @if(!request()->get('user'))
    <section class="profile-card guest-prompt">
        <div class="guest-msg">
            <h2>Anda belum masuk</h2>
            <p>Silakan masuk atau daftar untuk melihat dan mengedit profil Anda.</p>
            <div class="guest-actions">
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Daftar</a>
            </div>
        </div>
    </section>
    @endif
    @endguest

    <section id="profileViewOwn" class="profile-card">

        <div class="profile-header-own">
            <div class="profile-avatar-section">
                @auth
                <img class="profile-avatar"
                    src="{{ asset(Auth::user()->foto_profil_url ?? 'image/download (13).jpg') }}" alt="Avatar">
                @else
                <img class="profile-avatar" src="{{ asset('image/download (13).jpg') }}" alt="Avatar">
                @endauth
                <div class="profile-level-box">
                    <span class="level-text">LVL. {{ auth()->check() ? Auth::user()->level_terkini : 999 }}</span>
                    <div class="level-bar">
                        <div class="level-progress"></div>
                    </div>
                </div>
            </div>

            <div class="profile-info-own">
                <h2>
                    @auth
                    {{ Auth::user()->nama }}
                    @else
                    Windah Batubara
                    @endauth
                </h2>

                <div class="profile-badges">
                    <img src="{{ asset('image/badges/badge (1).png') }}" alt="Badge 1" class="badge">
                    <img src="{{ asset('image/badges/badge (2).png') }}" alt="Badge 2" class="badge">
                    <img src="{{ asset('image/badges/badge (3).png') }}" alt="Badge 3" class="badge">
                    <img src="{{ asset('image/badges/badge (4).png') }}" alt="Badge 4" class="badge">
                    <img src="{{ asset('image/badges/badge (5).png') }}" alt="Badge 5" class="badge">
                </div>

                <p class="profile-bio">
                    @auth
                    {{ Auth::user()->bio ?? 'Belum ada bio.' }}
                    @else
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                    of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                    but also the leap into electronic typesetting, remaining essentially unchanged.
                    @endauth
                </p>

                <p class="join-date-text">
                    <strong>Bergabung Sejak:</strong>
                    {{ auth()->check() ? Auth::user()->created_at->format('d F Y') : '01 Desember 1961' }}
                </p>
            </div>

            @auth
            <button id="btnEditProfile" class="btn-edit">
                Edit Profil
            </button>
            @endauth
        </div>

        <div class="profile-content-full">
            <div class="profile-box-transparent">
                <h3 class="center-title">Aktivitas Terakhir</h3>
                <div class="activity-grid">
                    <img src="{{ asset('image/img (5).jpg') }}" alt="Activity 1">
                    <img src="{{ asset('image/img (2).jpg') }}" alt="Activity 2">
                    <img src="{{ asset('image/img (3).jpg') }}" alt="Activity 3">
                </div>
            </div>
        </div>
    </section>

    @auth
    <section id="profileEdit" class="profile-card hidden">

        <h2 class="section-title-center">Edit Profil</h2>

        <div class="edit-profile-top">
            <div class="edit-avatar">
                @auth
                <img src="{{ asset(Auth::user()->foto_profil_url ?? 'image/download (13).jpg') }}" alt="Avatar">
                @else
                <img src="{{ asset('image/download (13).jpg') }}" alt="Avatar">
                @endauth
                <button class="btn-change-photo">Ganti Foto</button>
            </div>

            <div class="edit-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" value="{{ auth()->check() ? Auth::user()->nama : '' }}">
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" value="{{ auth()->check() ? (Auth::user()->no_telepon ?? '') : '' }}">
                    </div>
                </div>

                <div class="form-row">

                    <div class="left-column-inputs">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" value="{{ auth()->check() ? Auth::user()->nama : '' }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="{{ auth()->check() ? Auth::user()->email : '' }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Bio / Tentang Saya</label>
                        <textarea
                            style="height: 100%;">{{ auth()->check() ? (Auth::user()->bio ?? '') : '' }}</textarea>
                    </div>

                </div>
            </div>
        </div>

        <h2 class="section-title-center">Atur Password</h2>

        <div class="edit-password">
            <div class="password-group">
                <label>Password Lama</label>
                <input type="password" placeholder="yanto123">
            </div>
            <div class="password-group">
                <label>Password Baru</label>
                <input type="password" placeholder="yanto1234">
            </div>
            <div class="password-group">
                <label>Konfirmasi Password</label>
                <input type="password" placeholder="yanto1234">
            </div>
        </div>

        <h2 class="section-title-center">Badge & Pencapaian</h2>

        <div class="badge-section">
            <p class="badge-section-title">Badge Aktif (Ditampilkan)</p>
            <div class="badge-list" id="activeBadges">
                <div class="badge-item-edit selected" data-badge="1">
                    <img src="{{ asset('image/badges/badge (1).png') }}" alt="Badge 1">
                </div>
                <div class="badge-item-edit selected" data-badge="2">
                    <img src="{{ asset('image/badges/badge (2).png') }}" alt="Badge 2">
                </div>
                <div class="badge-item-edit selected" data-badge="3">
                    <img src="{{ asset('image/badges/badge (3).png') }}" alt="Badge 3">
                </div>
                <div class="badge-item-edit selected" data-badge="4">
                    <img src="{{ asset('image/badges/badge (4).png') }}" alt="Badge 4">
                </div>
                <div class="badge-item-edit selected" data-badge="5">
                    <img src="{{ asset('image/badges/badge (5).png') }}" alt="Badge 5">
                </div>
            </div>

            <p class="badge-section-title">Badge yang Dimiliki</p>
            <div class="badge-list large" id="allBadges">
                <div class="badge-item-edit" data-badge="1">
                    <img src="{{ asset('image/badges/badge (1).png') }}" alt="Badge 1">
                </div>
                <div class="badge-item-edit" data-badge="2">
                    <img src="{{ asset('image/badges/badge (2).png') }}" alt="Badge 2">
                </div>
                <div class="badge-item-edit" data-badge="3">
                    <img src="{{ asset('image/badges/badge (3).png') }}" alt="Badge 3">
                </div>
                <div class="badge-item-edit" data-badge="4">
                    <img src="{{ asset('image/badges/badge (4).png') }}" alt="Badge 4">
                </div>
                <div class="badge-item-edit" data-badge="5">
                    <img src="{{ asset('image/badges/badge (5).png') }}" alt="Badge 5">
                </div>
                <div class="badge-item-edit" data-badge="6">
                    <img src="{{ asset('image/badges/badge (6).png') }}" alt="Badge 6">
                </div>
            </div>
        </div>

        <div class="edit-actions">
            <button id="btnCancel" class="btn-cancel"> Batal </button>
            <button class="btn-save">Simpan</button>
        </div>

    </section>

    @endauth

    <section id="profileViewOther" class="profile-card {{ isset($viewedUser) ? '' : 'hidden' }}">

        <h2 class="section-title-center">Profil Pengguna</h2>

        @if(isset($viewedUser) && $viewedUser)
        <div class="profile-header-other">
            <div class="profile-avatar-section-center">
                <img class="profile-avatar" src="{{ asset($viewedUser->foto_profil_url ?? 'image/download (13).jpg') }}"
                    alt="Avatar">
            </div>

            <div class="profile-info-center">
                <h2>{{ $viewedUser->nama }}</h2>

                <p class="profile-bio-center">
                    {{ $viewedUser->bio ?? 'Belum ada bio.' }}
                </p>

                <div class="badge-title">Badge & Pencapaian</div>
                <div class="profile-badges-center">
                    @foreach($viewedUser->badges ?? [] as $badge)
                    <img src="{{ asset($badge->image_url ?? 'image/badges/badge (1).png') }}" alt="Badge" class="badge">
                    @endforeach
                </div>

                <div class="join-date">Bergabung sejak
                    {{ $viewedUser->created_at ? $viewedUser->created_at->format('F Y') : '-' }}
                </div>
            </div>
        </div>

        <div class="profile-single-box">
            <h3>Aktivitas Terakhir</h3>
            <div class="activity-grid">
                <img src="{{ asset('image/img (5).jpg') }}" alt="Activity 1">
                <img src="{{ asset('image/img (2).jpg') }}" alt="Activity 2">
                <img src="{{ asset('image/img (3).jpg') }}" alt="Activity 3">
            </div>
        </div>
        @else
        <div class="profile-header-other">
            <div class="profile-avatar-section-center">
                <img class="profile-avatar" src="{{ asset('image/download (13).jpg') }}" alt="Avatar">
            </div>

            <div class="profile-info-center">
                <h2>Profil tidak ditemukan</h2>

                <p class="profile-bio-center">
                    Pengguna yang Anda cari tidak ditemukan atau belum memiliki profil publik.
                </p>
            </div>
        </div>
        @endif

    </section>

</main>

@endsection

@section('scripts')
<script>
    const profileViewOwn = document.getElementById('profileViewOwn');
    const profileEdit = document.getElementById('profileEdit');
    const profileViewOther = document.getElementById('profileViewOther');

    const btnEdit = document.getElementById('btnEditProfile');
    const btnCancel = document.getElementById('btnCancel');

    const params = new URLSearchParams(window.location.search);
    const viewedUser = params.get('user');
    const isEdit = params.get('edit') === 'true';

    // ======================
    // PROFIL PUBLIK
    // ======================
    if (viewedUser) {
        profileViewOwn.classList.add('hidden');
        profileEdit.classList.add('hidden');
        profileViewOther.classList.remove('hidden');
    }

    // ======================
    // PROFIL SENDIRI
    // ======================
    else {
        profileViewOther.classList.add('hidden');

        if (isEdit) {
            profileViewOwn.classList.add('hidden');
            profileEdit.classList.remove('hidden');
        } else {
            profileViewOwn.classList.remove('hidden');
            profileEdit.classList.add('hidden');
        }
    }

    // ======================
    // BUTTON ACTION
    // ======================
    if (btnEdit) {
        btnEdit.onclick = () => {
            // Menggunakan Laravel URL
            window.location.href = "{{ url('/profile') }}?edit=true";
        };
    }

    if (btnCancel) {
        btnCancel.onclick = () => {
            // Menggunakan Laravel URL
            window.location.href = "{{ url('/profile') }}";
        };
    }

    // Profile dropdown handled by header partial (deduplicated)
    // Header script toggles `#profileDropdown` and closes other nav dropdowns when needed
</script>
@endsection