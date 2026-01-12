<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use App\Models\Events;
use App\Models\Grub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomunitasController extends Controller
{
    // Halaman Detail Komunitas
    public function show($id)
    {
        $komunitas = Komunitas::with(['kota', 'kategori', 'grup'])->findOrFail($id);

        // Cek apakah user sudah join
        $isMember = false;
        if (Auth::check()) {
            $isMember = $komunitas->anggota()->where('user_id', Auth::id())->exists();
        }

        return view('komunitas.show', compact('komunitas', 'isMember'));
    }

    // Aksi Gabung Komunitas
    public function join(\Illuminate\Http\Request $request)
    {
        $komunitasId = $request->input('komunitas_id');
        $komunitas = Komunitas::findOrFail($komunitasId);

        // Cegah duplicate attach
        $userId = Auth::id();
        if ($komunitas->anggota()->where('user_id', $userId)->exists()) {
            return back()->with('info', 'Anda sudah menjadi anggota komunitas ini.');
        }

        // Attach user ke komunitas via pivot
        $komunitas->anggota()->attach($userId, ['role' => 'member']);

        // Tambah XP Join
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if ($user) {
            $user->increment('xp_terkini', 20);
        }

        return back()->with('success', 'Selamat bergabung!');
    }

    // Daftar komunitas
    public function index()
    {
        $komunitas = Komunitas::withCount('members')->get();
        return view('komunitas.index', compact('komunitas'));
    }

    // Daftar komunitas milik user (dengan pencarian)
    public function myCommunities(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            // Redirect guests to landing (or login) — preserve UX
            return redirect('/?login=1');
        }

        $q = trim($request->get('q', ''));
        $query = Komunitas::whereHas('anggota', function ($q2) use ($user) {
            $q2->where('user_id', $user->id);
        });

        if ($q !== '') {
            $tokens = preg_split('/\s+/', $q);
            foreach ($tokens as $t) {
                $t = trim($t);
                if ($t === '') continue;
                $query->where(function ($qq) use ($t) {
                    $qq->where('nama', 'like', "%{$t}%")
                        ->orWhere('deskripsi', 'like', "%{$t}%");
                });
            }
        }

        $komunitas = $query->get();

        return view('komunitas-saya', compact('komunitas', 'q'));
    }

    // Halaman "Grup Events" (Filter Otomatis)
    public function events($komunitasId)
    {
        $komunitas = Komunitas::findOrFail($komunitasId);

        // 1. Kegiatan Internal (Dibuat moderator sini)
        $internalEvents = Events::where('type', 'kegiatan')
            ->where('komunitas_id', $komunitasId)
            ->where('status', 'published')
            ->get();

        // 2. Lomba Global (Dibuat admin, kategori sama)
        $globalContests = Events::where('type', 'lomba')
            ->where('kategori_id', $komunitas->kategori_id)
            ->where('status', 'published')
            ->get();

        // Gabung & Urutkan berdasarkan tanggal
        $allEvents = $internalEvents->merge($globalContests)->sortBy('start_date');

        return view('komunitas.events', compact('komunitas', 'allEvents'));
    }

    // Admin: list laporan (route admin.laporan)
    public function listLaporan()
    {
        $laporan = \App\Models\Laporan::where('status', 'pending')->latest()->get();
        return view('admin.laporan', compact('laporan'));
    }
}
