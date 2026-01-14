<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use App\Models\Events;
use App\Models\User;
use App\Models\AnggotaKomunitas;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomunitasController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DETAIL KOMUNITAS
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $komunitas = Komunitas::with(['kota', 'kategori'])->findOrFail($id);

        $isMember = false;
        if (Auth::check()) {
            $isMember = AnggotaKomunitas::where('komunitas_id', $komunitas->id)
                ->where('user_id', Auth::id())
                ->exists();
        }

        return view('komunitas.show', compact('komunitas', 'isMember'));
    }

    /*
    |--------------------------------------------------------------------------
    | GABUNG KOMUNITAS
    |--------------------------------------------------------------------------
    */

    public function join(Request $request)
    {
        $request->validate([
            'komunitas_id' => 'required|exists:komunitas,id',
        ]);

        $userId = Auth::id();
        if (! $userId) {
            return redirect('/?login=1');
        }

        $komunitasId = $request->komunitas_id;

        // Cegah duplicate join
        $exists = AnggotaKomunitas::where('user_id', $userId)
            ->where('komunitas_id', $komunitasId)
            ->exists();

        if ($exists) {
            return back()->with('info', 'Anda sudah menjadi anggota komunitas ini.');
        }

        // Simpan ke pivot
        AnggotaKomunitas::create([
            'user_id'      => $userId,
            'komunitas_id' => $komunitasId,
            'role'         => 'member',
        ]);

        // Tambah XP join komunitas (AMAN)
        User::where('id', $userId)->increment('xp_terkini', 20);

        return back()->with('success', 'Selamat bergabung dengan komunitas!');
    }

    /*
    |--------------------------------------------------------------------------
    | DAFTAR SEMUA KOMUNITAS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $komunitas = Komunitas::withCount([
            'anggota as jumlah_anggota'
        ])->get();

        return view('komunitas.index', compact('komunitas'));
    }

    /*
    |--------------------------------------------------------------------------
    | KOMUNITAS SAYA
    |--------------------------------------------------------------------------
    */

    public function myCommunities(Request $request)
    {
        $userId = Auth::id();
        if (! $userId) {
            return redirect('/?login=1');
        }

        $q = trim($request->get('q', ''));

        $query = Komunitas::whereHas('anggota', function ($q2) use ($userId) {
            $q2->where('user_id', $userId);
        });

        if ($q !== '') {
            foreach (preg_split('/\s+/', $q) as $token) {
                $query->where(function ($qq) use ($token) {
                    $qq->where('nama', 'like', "%{$token}%")
                        ->orWhere('deskripsi', 'like', "%{$token}%");
                });
            }
        }

        $komunitas = $query->get();

        return view('komunitas-saya', compact('komunitas', 'q'));
    }

    /*
    |--------------------------------------------------------------------------
    | EVENT KOMUNITAS (INTERNAL + GLOBAL)
    |--------------------------------------------------------------------------
    */

    public function events($komunitasId)
    {
        $komunitas = Komunitas::findOrFail($komunitasId);

        // Kegiatan internal komunitas
        $internalEvents = Events::where('type', 'kegiatan')
            ->where('komunitas_id', $komunitasId)
            ->where('status', 'published')
            ->get();

        // Lomba global (kategori sama)
        $globalEvents = Events::where('type', 'lomba')
            ->where('kategori_id', $komunitas->kategori_id)
            ->where('status', 'published')
            ->get();

        $allEvents = $internalEvents
            ->merge($globalEvents)
            ->sortBy('start_date');

        return view('komunitas.events', compact('komunitas', 'allEvents'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN: LAPORAN
    |--------------------------------------------------------------------------
    */

    public function listLaporan()
    {
        $laporan = Laporan::where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.laporan', compact('laporan'));
    }
}
