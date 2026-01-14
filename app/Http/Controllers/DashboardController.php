<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Events;
use App\Models\Pembayaran;
use App\Models\Komunitas;
use App\Models\Laporan;
use App\Models\AnggotaKomunitas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DISPATCH DASHBOARD (AUTO ROLE)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();
        if (! $user) {
            return redirect('/');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('dashboard.member.index');
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN PUSAT
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'admin') {
            abort(403);
        }

        $stats = [
            'total_user'         => User::where('role', 'member')->count(),
            'pembayaran_pending' => Pembayaran::where('status', 'pending')->count(),
            'lomba_aktif'        => Events::where('type', 'lomba')->where('status', 'published')->count(),
            'laporan_baru'       => Laporan::where('status', 'pending')->count(),
        ];

        $latest_payments = Pembayaran::with(['user', 'event'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_payments'));
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD MODERATOR KOMUNITAS
    |--------------------------------------------------------------------------
    */

    public function moderatorIndex($komunitasId)
    {
        $user = Auth::user();
        if (! $user) {
            abort(403);
        }

        $isModerator = AnggotaKomunitas::where('user_id', $user->id)
            ->where('komunitas_id', $komunitasId)
            ->where('role', 'moderator')
            ->exists();

        if (! $isModerator) {
            abort(403, 'Akses ditolak. Anda bukan moderator komunitas ini.');
        }

        $komunitas = Komunitas::withCount('anggota')->findOrFail($komunitasId);

        $kegiatan_internal = Events::where('komunitas_id', $komunitasId)
            ->where('type', 'kegiatan')
            ->latest()
            ->get();

        return view('dashboard.moderator.index', compact(
            'komunitas',
            'kegiatan_internal'
        ));
    }
}
