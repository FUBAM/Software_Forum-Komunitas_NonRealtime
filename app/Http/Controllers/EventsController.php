<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Kategori;
use App\Models\Komunitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    // Menampilkan direktori "Cari Lomba" (Publik)
    public function index()
    {
        $lomba = Events::where('type', 'lomba')
            ->where('status', '!=', 'finished')
            ->orderBy('start_date', 'asc')
            ->get();

        return view('events.index', compact('lomba'));
    }

    // Klaim XP (mis: route events.klaim)
    public function klaimXP($id)
    {
        $event = Events::findOrFail($id);
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        // Jika user belum join atau belum mengikuti event, abort
        $isParticipant = \App\Models\PesertaKegiatan::where('user_id', $user->id)
            ->where('events_id', $event->id)
            ->exists();

        if (!$isParticipant) {
            return back()->with('error', 'Anda bukan peserta kegiatan ini.');
        }

        // Tambah XP dan tandai klaim (nyederhana)
        $user->increment('xp_terkini', 5);

        return back()->with('success', 'XP berhasil diklaim.');
    }
    public function show($id)
    {
        $event = Events::with(['pengusul', 'komunitas', 'kategori'])->findOrFail($id);
        return view('events.show', compact('event'));
    }

    // Form Tambah Event (Bisa Lomba oleh Admin, atau Kegiatan oleh Moderator)
    public function create()
    {
        $kategori = Kategori::all();
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        // Load komunitas dimana user menjadi moderator
        $komunitas_moderated = $user->komunitas()
            ->wherePivot('role', 'moderator')
            ->get();

        return view('events.create', compact('kategori', 'komunitas_moderated'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:150',
            'type' => 'required|in:lomba,kegiatan',
            'start_date' => 'required|date',
            'poster' => 'nullable|image|max:2048'
        ]);

        $event = new Events();
        $event->judul = $request->judul;
        $event->deskripsi = $request->deskripsi;
        $event->type = $request->type;
        $event->kategori_id = $request->kategori_id;
        $event->diusulkan_oleh = Auth::id();
        $event->start_date = $request->start_date;

        // Harga tiket
        $event->harga = $request->harga ?? 0;
        $event->berbayar = ($request->harga > 0);

        // Upload Poster
        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $event->poster_url = $path;
        }

        // Logika Community ID
        if ($request->type == 'kegiatan') {
            // Wajib pilih komunitas jika ini kegiatan internal
            $request->validate(['komunitas_id' => 'required|exists:komunitas,id']);
            $event->komunitas_id = $request->komunitas_id;
        } else {
            // Lomba Global (Admin)
            $event->komunitas_id = null;
        }

        $event->status = 'published';
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event berhasil diterbitkan!');
    }
}