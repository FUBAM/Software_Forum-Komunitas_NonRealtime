<header
    class="navbar {{ (Request::is('profile') && (!Request::query('user') || (Auth::check() && Request::query('user') === \Illuminate\Support\Str::slug(Auth::user()->nama)))) ? 'is-own-profile' : (Request::is('profile*') ? 'is-profile-page' : '') }}">
    <div class="navbar-container">

        <nav class="nav-left">
            @guest
            <a href="#" data-auth>Home</a>

            <div class="nav-dropdown">
                <button class="nav-link" type="button">
                    Komunitas <span class="arrow">▾</span>
                </button>
                <div class="dropdown-menu">
                    <a href="#" data-auth>Komunitas Saya</a>
                    <a href="#" data-auth>Cari Komunitas</a>
                </div>
            </div>

            <div class="nav-dropdown">
                <button class="nav-link" type="button">
                    Event <span class="arrow">▾</span>
                </button>
                <div class="dropdown-menu">
                    <a href="#" data-auth>Cari Event</a>
                    <a href="#" data-auth>Riwayat Event</a>
                </div>
            </div>
            @else
            <a href="{{ url('/home') }}">Home</a>

            <div class="nav-dropdown">
                <button class="nav-link" type="button">
                    Komunitas <span class="arrow">▾</span>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ url('/komunitas-saya') }}">Komunitas Saya</a>
                    <a href="{{ url('/cari-komunitas') }}">Cari Komunitas</a>
                </div>
            </div>

            <div class="nav-dropdown">
                <button class="nav-link" type="button">
                    Event <span class="arrow">▾</span>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ url('/event') }}">Cari Event</a>
                    <a href="{{ url('/riwayat-event') }}">Riwayat Event</a>
                </div>
            </div>
            @endguest
        </nav>

        <div class="logo">ZHIB</div>

        <div class="nav-right">
            @guest
            <a href="#" onclick="openLogin()">Masuk</a>
            <span>|</span>
            <a href="#" onclick="openRegister()">Daftar</a>
            @else
            @if (!Request::is('profile*') || (Request::query('user') && Auth::check() && Request::query('user') !==
            \Illuminate\Support\Str::slug(Auth::user()->nama)))
            <div class="profile-dropdown" id="profileDropdown">
                <button class="profile-navbar" id="profileToggle">
                    <div class="profile-text">
                        <div class="profile-name">{{ Auth::user()->nama }}</div>
                        <div class="profile-level">LVL. {{ Auth::user()->level_terkini }}</div>
                    </div>
                    <img src="{{ asset(Auth::user()->foto_profil_url ?? 'image/download (13).jpg') }}"
                        class="profile-avatar" alt="Profile">
                </button>

                <div class="profile-menu">
                    <a href="{{ url('/profile') }}">Profil</a>
                    <a href="{{ url('/profile') }}?edit=true">Edit Profil</a>
                    <hr>
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf
                    </form>
                </div>
            </div>
            @else
            <div class="profile-dropdown profile-inline">
                <a href="{{ url('/profile') }}" class="profile-inline-link">Profil</a>
                <a href="{{ url('/profile') }}?edit=true" class="profile-inline-link">Edit Profil</a>
            </div>
            @endif
            @endguest
        </div>

    </div>
</header>

<script>
// Robust profile dropdown handler (delegated) — ensures menu works across pages
document.addEventListener('click', function(e) {
    // Toggle when clicking the toggle button or anything inside it
    const toggle = e.target.closest('#profileToggle');
    if (toggle) {
        e.stopPropagation();
        const dropdown = toggle.closest('.profile-dropdown');
        if (dropdown) dropdown.classList.toggle('active');
        return;
    }

    // Close any open profile dropdowns when clicking outside
    document.querySelectorAll('.profile-dropdown.active').forEach(function(dd) {
        if (!dd.contains(e.target)) dd.classList.remove('active');
    });
});

// Ensure menu links are clickable even if other overlays exist
window.addEventListener('load', function() {
    document.querySelectorAll('.profile-menu').forEach(function(m) {
        m.style.pointerEvents = 'auto';
    });
});
</script>