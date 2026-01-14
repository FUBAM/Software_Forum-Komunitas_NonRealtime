<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Events;
use App\Models\Kategori;
use App\Models\PesertaKegiatan;
use App\Models\User;
use App\Models\AnggotaKomunitas;
use App\Models\Komunitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DIREKTORI EVENT (CARI EVENT / LOMBA)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $events = Events::where('status', 'published')
            ->orderBy('start_date', 'asc')
            ->get();

        return view('events.index', compact('events'));
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL EVENT
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $event = Events::with(['pengusul', 'komunitas', 'kategori'])
            ->where('status', 'published')
            ->findOrFail($id);

        return view('events.show', compact('event'));
    }

    /*
    |--------------------------------------------------------------------------
    | KLAIM XP (SETELAH EVENT SELESAI)
    |--------------------------------------------------------------------------
    */

    public function klaimXP($id)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect('/?login=1');
        }

        $event = Events::where('status', 'finished')->findOrFail($id);

        $peserta = PesertaKegiatan::where('user_id', $user->id)
            ->where('events_id', $event->id)
            ->first();

        if (! $peserta) {
            return back()->with('error', 'Anda bukan peserta event ini.');
        }

        // Cegah klaim berulang
        if ($peserta->status === 'kehadiran' || $peserta->status === 'pemenang') {
            return back()->with('error', 'XP sudah diklaim.');
        }

        // Update status kehadiran
        $peserta->status = 'kehadiran';
        $peserta->save();

        User::where('id', $user->id)->increment('xp_terkini', 10);


        return back()->with('success', 'XP berhasil diklaim.');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM BUAT EVENT
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $user = Auth::user();
        if (! $user) abort(403);

        $isModerator = AnggotaKomunitas::where('user_id', $user->id)
            ->where('role', 'moderator')
            ->exists();

        if ($user->role !== 'admin' && ! $isModerator) {
            abort(403);
        }

        $kategori = Kategori::all();

        $komunitas_moderated = Komunitas::whereIn('id', function ($query) use ($user) {
            $query->select('komunitas_id')
                ->from('anggota_komunitas')
                ->where('user_id', $user->id)
                ->where('role', 'moderator');
        })->get();

        return view('events.create', compact('kategori', 'komunitas_moderated'));
    }



    /*
    |--------------------------------------------------------------------------
    | SIMPAN EVENT
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $user = Auth::user();
        if (! $user) abort(403);

        $request->validate([
            'judul'       => 'required|string|max:150',
            'deskripsi'   => 'required|string',
            'type'        => 'required|in:lomba,kegiatan',
            'kategori_id' => 'required|exists:kategori,id',
            'start_date'  => 'required|date',
            'harga'       => 'nullable|numeric|min:0',
            'poster'      => 'nullable|image|max:2048',
        ]);

        if ($request->type === 'lomba' && $user->role !== 'admin') {
            abort(403);
        }

        if ($request->type === 'kegiatan') {
            $request->validate([
                'komunitas_id' => 'required|exists:komunitas,id',
            ]);
        }

        $event = new Events();
        $event->judul = $request->judul;
        $event->deskripsi = $request->deskripsi;
        $event->type = $request->type;
        $event->kategori_id = $request->kategori_id;
        $event->diusulkan_oleh = $user->id;
        $event->start_date = $request->start_date;
        $event->harga = $request->harga ?? 0;
        $event->berbayar = ($event->harga > 0);
        $event->komunitas_id = $request->type === 'kegiatan'
            ? $request->komunitas_id
            : null;

        if ($request->hasFile('poster')) {
            $event->poster_url = $request->file('poster')
                ->store('posters', 'public');
        }

        $event->status = 'published';
        $event->save();

        return redirect()
            ->route('events.show', $event->id)
            ->with('success', 'Event berhasil diterbitkan.');
    }


    public function riwayat()
    {
        $user = Auth::user();
        if (! $user) {
            return redirect('/?login=1');
        }

        // Event yang akan diikuti (belum selesai)
        $upcomingEvents = Events::whereHas('participants', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->where('status', 'published')
            ->orderBy('start_date', 'asc')
            ->get();

        // Event yang sudah diikuti (selesai)
        $pastEvents = Events::whereHas('participants', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->where('status', 'finished')
            ->orderBy('start_date', 'desc')
            ->get();

        return view('events.riwayat', compact('upcomingEvents', 'pastEvents'));
    }


}
