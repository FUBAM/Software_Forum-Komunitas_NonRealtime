<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\events;
use App\Models\pembayaran;
use App\Models\komunitas;
use App\Models\laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Dashboard Utama Admin Pusat
    public function adminIndex()
    {
        // Statistik Ringkasan
        $stats = [
            'total_user' => User::where('role', 'member')->count(),
            'pembayaran_pending' => Pembayaran::where('status', 'pending')->count(),
            'lomba_aktif' => Events::where('type', 'lomba')->where('status', 'published')->count(),
            'laporan_baru' => Laporan::where('status', 'pending')->count(),
        ];

        // 5 Pembayaran Terbaru yang butuh verifikasi
        $latest_payments = Pembayaran::with(['user', 'event'])
                            ->where('status', 'pending')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact('stats', 'latest_payments'));
    }

    // Dashboard Moderator Komunitas
    public function moderatorIndex($komunitasId)
    {
        $user = Auth::user();
        
        // Cek validasi akses moderator lokal
        if (!$user->isModeratorOf($komunitasId)) {
            abort(403, 'Akses Ditolak. Anda bukan moderator komunitas ini.');
        }

        $komunitas = Komunitas::withCount('anggota')->findOrFail($komunitasId);
        
        // Kegiatan Internal Komunitas Ini
        $kegiatan_internal = Events::where('komunitas_id', $komunitasId)
                                   ->where('type', 'kegiatan')
                                   ->latest()
                                   ->get();

        return view('moderator.dashboard', compact('komunitas', 'kegiatan_internal'));
    }
}