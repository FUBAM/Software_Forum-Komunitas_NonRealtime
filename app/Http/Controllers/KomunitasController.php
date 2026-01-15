<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use App\Models\Events;
use App\Models\User;
use App\Models\AnggotaKomunitas;
use App\Models\Laporan;
use App\Models\Kota;
use App\Models\Kategori;
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
        // 1. Ambil data untuk Filter
        $kota_list = Kota::all();
        $kategori_list = Kategori::all();

        // 2. Mulai Query
        $query = Komunitas::withCount(['anggota as jumlah_anggota'])
            ->with(['kota', 'kategori']);

        // 3. 🔥 LOGIKA BARU: Sembunyikan komunitas yang user SUDAH join 🔥
        if (Auth::check()) {
            $userId = Auth::id();
            
            // "Ambil komunitas yang TIDAK PUNYA relasi anggota dengan user_id ini"
            $query->whereDoesntHave('anggota', function($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        }

        // 4. Eksekusi
        $komunitas = $query->get();

        return view('komunitas.cari-komunitas', compact('komunitas', 'kota_list', 'kategori_list'));
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

        // 🔥 TAMBAHKAN with('grup') DI SINI 🔥
        // Agar kita bisa mengambil ID grup untuk link tombol chat
        $query = Komunitas::with('grup')->whereHas('anggota', function ($q2) use ($userId) {
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

        return view('komunitas.komunitas-saya', compact('komunitas', 'q'));
    }

    /*
    |--------------------------------------------------------------------------
    | EVENT KOMUNITAS (INTERNAL + GLOBAL)
    |--------------------------------------------------------------------------
    */

    public function events($komunitasId)
    {
        $komunitas = Komunitas::with('grup')->findOrFail($komunitasId);

        // 1. Ambil Kegiatan (Khusus Internal Komunitas)
        $kegiatan = Events::where('type', 'kegiatan')
            ->where('komunitas_id', $komunitasId)
            ->where('status', 'published')
            ->orderBy('start_date', 'asc')
            ->get();

        // 2. Ambil Lomba (Global/Rekomendasi sesuai kategori komunitas)
        $lomba = Events::where('type', 'lomba')
            ->where('kategori_id', $komunitas->kategori_id)
            ->where('status', 'published')
            ->orderBy('start_date', 'asc')
            ->get();

        // Kirim variabel terpisah agar mudah diloop di view
        return view('komunitas.grup-event', compact('komunitas', 'kegiatan', 'lomba'));
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
