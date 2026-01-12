@php
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Events;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;

// Live metrics (backend queries). Keep queries simple and efficient.
$totalAnggota = User::count();
$pembayaranTertunda = Pembayaran::where('status', 'pending')->count();
$lombaAktif = Events::where('type', 'lomba')->where('status', 'published')->count();
$laporanTerbuka = Laporan::where('status', 'pending')->count();

// Recent activity: combine latest rows from several models (limit to 6)
$latestUsers = User::orderBy('created_at', 'desc')->take(4)->get()->map(function($u) {
return (object)['type' => 'user', 'text' => "{$u->nama} mendaftar", 'time' => $u->created_at];
});
$latestPayments = Pembayaran::orderBy('created_at', 'desc')->take(4)->get()->map(function($p) {
$name = $p->user ? $p->user->nama : 'Pengguna';
return (object)['type' => 'payment', 'text' => "Pembayaran oleh {$name}", 'time' => $p->created_at];
});
$latestEvents = Events::orderBy('created_at', 'desc')->take(4)->get()->map(function($e) {
return (object)['type' => 'event', 'text' => "Lomba: <a href='".route(' admin.kelola.lomba', ['id'=>
    $e->id])."'>{$e->judul}</a>", 'time' => $e->created_at, 'id' => $e->id];
});
$latestReports = Laporan::orderBy('created_at', 'desc')->take(4)->get()->map(function($r) {
$name = $r->pelapor ? $r->pelapor->nama : 'Pengguna';
return (object)['type' => 'report', 'text' => "Laporan oleh {$name}", 'time' => $r->created_at];
});

$activities = collect()->concat($latestUsers)->concat($latestPayments)->concat($latestEvents)->concat($latestReports)
->sortByDesc('time')
->take(6);

// Distribution per wilayah: count distinct users via anggota_komunitas -> komunitas -> kota
$wilayah = DB::table('kota')
->leftJoin('komunitas', 'kota.id', '=', 'komunitas.kota_id')
->leftJoin('anggota_komunitas', 'komunitas.id', '=', 'anggota_komunitas.komunitas_id')
->select('kota.nama as name', DB::raw('count(distinct anggota_komunitas.user_id) as users'))
->groupBy('kota.id', 'kota.nama')
->orderByDesc('users')
->get();

// Notifications: reuse the mock structure but prefer recent reports/payments for demonstration
$notifications = $latestPayments->take(3)->concat($latestReports->take(2))->map(function($n) {
return (object)[
'id' => rand(100,999),
'type' => $n->type,
'icon_class' => $n->type === 'payment' ? 'fa-regular fa-circle-check' : ($n->type === 'event' ? 'fa-solid fa-trophy' :
'fa-solid fa-triangle-exclamation'),
'color_class' => $n->type === 'payment' ? 'green' : ($n->type === 'event' ? 'purple' : 'red'),
'title' => $n->text,
'description' => '',
'time' => $n->time->diffForHumans(),
'is_unread' => true
];
});

$unreadCount = $notifications->where('is_unread', true)->count();
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard DIY - ZHIB Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="admin-container">

        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>ZHIB Admin</h2>
                <span>Regional DIY</span>
            </div>

            <ul class="sidebar-menu">
                <li><a href="{{ url('/admin/dashboard') }}" class="active"><i class="fa-solid fa-border-all"></i>
                        Dashboard</a></li>
                <li><a href="{{ url('/admin/pembayaran') }}"><i class="fa-regular fa-credit-card"></i> Pembayaran</a>
                </li>
                <li><a href="{{ url('/admin/lomba') }}"><i class="fa-solid fa-trophy"></i> Lomba</a></li>
                <li><a href="{{ url('/admin/komunitas') }}"><i class="fa-solid fa-user-group"></i> Komunitas</a></li>
                <li><a href="{{ url('/admin/laporan') }}"><i class="fa-solid fa-triangle-exclamation"></i> Laporan</a>
                </li>
                <li><a href="{{ url('/admin/berita') }}"><i class="fa-regular fa-newspaper"></i> Berita</a></li>

                <li class="spacer"></li>

                <li>
                    <form action="{{ url('/logout') }}" method="POST" style="width: 100%;">
                        @csrf
                        <button type="submit" class="logout"
                            style="background:none; border:none; width:100%; text-align:left; padding:12px 15px; font-family:inherit; font-size:16px; font-weight:500; display:flex; align-items:center; gap:12px; cursor:pointer;">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <main class="main-content">

            <header class="topbar">
                <h1>Dashboard DIY</h1>

                <div class="topbar-right">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Cari anggota, acara...">
                    </div>

                    <div class="notif-wrapper">
                        <button class="btn-icon" onclick="toggleNotif()">
                            <i class="fa-regular fa-bell"></i>
                            @if($unreadCount > 0)
                            <span class="badge-dot"></span>
                            @endif
                        </button>

                        <div class="notif-popup" id="notifPopup">
                            <div class="popup-header">
                                <div class="ph-content">
                                    <div class="ph-icon-circle"><i class="fa-regular fa-bell"></i></div>
                                    <div class="ph-text">
                                        <h3>Notifikasi</h3>
                                        <span>{{ $unreadCount }} belum dibaca</span>
                                    </div>
                                </div>
                                <button class="ph-close-btn" onclick="toggleNotif()"><i
                                        class="fa-solid fa-xmark"></i></button>
                            </div>

                            <div class="popup-body">
                                {{-- Looping Notifikasi Dinamis --}}
                                @foreach($notifications as $notif)
                                <div class="p-item {{ $notif->is_unread ? 'unread' : '' }}">
                                    <div class="p-icon-circle {{ $notif->color_class }}"><i
                                            class="{{ $notif->icon_class }}"></i></div>
                                    <div class="p-details">
                                        <h4>{{ $notif->title }}</h4>
                                        <p>{{ $notif->description }}</p>
                                        <small>{{ $notif->time }}</small>
                                    </div>
                                    @if($notif->is_unread)
                                    <div class="unread-dot"></div>
                                    @endif
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

            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Total Anggota</span>
                        <h3><a class="stat-link"
                                href="{{ route('admin.komunitas') }}">{{ number_format($totalAnggota) }}</a></h3>
                        <small class="green-text">&nbsp;</small>
                    </div>
                    <div class="stat-icon-bg blue"><i class="fa-solid fa-users"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Pembayaran Tertunda</span>
                        <h3><a class="stat-link" href="{{ route('admin.pembayaran') }}">{{ $pembayaranTertunda }}</a>
                        </h3>
                        <small>{{ App\Models\Pembayaran::whereDate('created_at', now()->toDateString())->count() }} baru
                            hari ini</small>
                    </div>
                    <div class="stat-icon-bg purple"><i class="fa-regular fa-clock"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Lomba Aktif</span>
                        <h3><a class="stat-link" href="{{ route('admin.lomba') }}">{{ $lombaAktif }}</a></h3>
                        <small
                            class="green-text">{{ App\Models\Events::where('type','lomba')->where('status','published')->where('start_date','<', now()->addDays(3))->count() }}
                            segera berakhir</small>
                    </div>
                    <div class="stat-icon-bg blue"><i class="fa-solid fa-trophy"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <span>Laporan Terbuka</span>
                        <h3><a class="stat-link" href="{{ route('admin.laporan') }}">{{ $laporanTerbuka }}</a></h3>
                        <small>{{ App\Models\Laporan::where('status','pending')->where('created_at','>=', now()->subDay())->count() }}
                            prioritas</small>
                    </div>
                    <div class="stat-icon-bg purple"><i class="fa-solid fa-circle-exclamation"></i></div>
                </div>
            </div>

            <div class="dashboard-grid">

                <div class="chart-section">
                    <div class="chart-header">
                        <h3><i class="fa-solid fa-chart-simple"></i> Distribusi Pengguna per Wilayah <span
                                class="light">DIY Yogyakarta</span></h3>
                    </div>
                    <div class="chart-container">
                        <div class="y-axis">
                            <span>{{ max(0, (int)($wilayah->max('users') ?? 0)) }}</span>
                            <span>{{ max(0, (int)round(($wilayah->max('users') ?? 1) * 0.75)) }}</span>
                            <span>{{ max(0, (int)round(($wilayah->max('users') ?? 1) * 0.5)) }}</span>
                            <span>{{ max(0, (int)round(($wilayah->max('users') ?? 1) * 0.25)) }}</span>
                            <span>0</span>
                        </div>
                        <div class="bars-wrapper">
                            @php $maxUsers = $wilayah->max('users') ?: 1; @endphp
                            @foreach($wilayah as $w)
                            @php $pct = $maxUsers ? round(($w->users / $maxUsers) * 100) : 0; @endphp
                            <div class="bar-group">
                                <div class="bar" data-height="{{ $pct }}"></div>
                                <span class="bar-label">{{ $w->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="chart-legend">
                        @foreach($wilayah as $w)
                        <div class="legend-item"><span class="dot-lg"></span>
                            <div class="l-text"><strong>{{ $w->name }}</strong><br>{{ $w->users }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="activity-section">
                    <div class="act-header">
                        <h3><i class="fa-solid fa-bolt"></i> Aktivitas Terkini</h3>
                    </div>
                    <ul class="activity-list">
                        @foreach($activities as $act)
                        @php
                        $dotClass = 'grey-dot';
                        if ($act->type === 'payment') $dotClass = 'green-dot';
                        if ($act->type === 'event') $dotClass = 'blue-dot';
                        if ($act->type === 'report') $dotClass = 'red-dot';
                        @endphp
                        <li class="act-item {{ $dotClass }}">
                            <p>{!! $act->text !!}</p>
                            <small>{{ $act->time->diffForHumans() }}</small>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </main>
    </div>

    <script>
    // Set bar heights from data attribute to avoid inline Blade in style and editor warnings
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.bars-wrapper .bar').forEach(function(el) {
            const v = el.getAttribute('data-height');
            if (v !== null) el.style.height = v + '%';
        });
    });

    function toggleNotif() {
        const popup = document.getElementById('notifPopup');
        popup.classList.toggle('active');
    }
    window.onclick = function(e) {
        const popup = document.getElementById('notifPopup');
        const btn = document.querySelector('.btn-icon');
        if (popup && !popup.contains(e.target) && btn && !btn.contains(e.target)) {
            popup.classList.remove('active');
        }
    }
    </script>

</body>

</html>