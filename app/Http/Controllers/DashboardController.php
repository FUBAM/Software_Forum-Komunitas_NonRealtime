<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Events;
use App\Models\Pembayaran;
use App\Models\Komunitas;
use App\Models\Laporan;
use App\Models\AnggotaKomunitas;
use App\Models\Grup;
use App\Models\PesanGrup;
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
    | HELPER: CEK AKSES MODERATOR
    |--------------------------------------------------------------------------
    */
    private function checkAccess($komunitasId)
    {
        $user = Auth::user();
        $isModerator = AnggotaKomunitas::where('user_id', $user->id)
            ->where('komunitas_id', $komunitasId)
            ->where('role', 'moderator')
            ->exists();

        if (!$isModerator && $user->role !== 'admin') {
            abort(403, 'Akses Ditolak. Anda bukan moderator komunitas ini.');
        }
        return $user;
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD MODERATOR (HOME)
    |--------------------------------------------------------------------------
    */
    public function moderatorIndex($komunitasId)
    {
        $this->checkAccess($komunitasId); // Pakai helper biar ringkas

        $komunitas = Komunitas::withCount('anggota')->findOrFail($komunitasId);

        $kegiatan_internal = Events::where('komunitas_id', $komunitasId)
            ->where('type', 'kegiatan')
            ->latest()
            ->get();

        return view('dashboard.moderator.index', compact('komunitas', 'kegiatan_internal'));
    }

    /*
    |--------------------------------------------------------------------------
    | MODERATOR: CHAT
    |--------------------------------------------------------------------------
    */
    public function moderatorChat($komunitasId)
    {
        $this->checkAccess($komunitasId);
        
        $komunitas = Komunitas::with('grup')->findOrFail($komunitasId);
        $grup = $komunitas->grup->first();
        
        if(!$grup) return back()->with('error', 'Grup chat belum dibuat.');

        $messages = PesanGrup::with('user')
            ->where('grup_id', $grup->id)
            ->orderBy('created_at', 'asc')
            ->get();

        // View tetap menggunakan folder moderator
        return view('moderator.chat', compact('komunitas', 'grup', 'messages'));
    }

    /*
    |--------------------------------------------------------------------------
    | MODERATOR: EVENTS
    |--------------------------------------------------------------------------
    */
    public function moderatorEvents($komunitasId)
    {
        $this->checkAccess($komunitasId);
        
        $komunitas = Komunitas::findOrFail($komunitasId);

        $kegiatan = Events::where('komunitas_id', $komunitasId)
            ->where('type', 'kegiatan')
            ->orderBy('start_date', 'asc')
            ->get();
            
        $lomba = Events::where('type', 'lomba')
            ->where('kategori_id', $komunitas->kategori_id)
            ->orderBy('start_date', 'asc')
            ->get();

        return view('moderator.events', compact('komunitas', 'kegiatan', 'lomba'));
    }
}