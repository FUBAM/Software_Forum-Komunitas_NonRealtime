<?php

namespace App\Http\Controllers;

use App\Models\komunitas;
use App\Models\events;
use App\Models\grub;
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
    public function join($id)
    {
        $komunitas = Komunitas::findOrFail($id);
        
        // Attach user ke komunitas via pivot
        $komunitas->anggota()->attach(Auth::id(), ['role' => 'member']);
        
        // Tambah XP Join
        Auth::user()->increment('xp_terkini', 20);

        return back()->with('success', 'Selamat bergabung!');
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
}