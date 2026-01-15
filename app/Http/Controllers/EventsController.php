<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Events;
use App\Models\Kota;
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

    public function index(Request $request)
    {
        // 1. Ambil Data Master untuk Filter (Dropdown/Checkbox)
        $kategori_list = Kategori::all();
        $kota_list = Kota::all();

        // 2. Query Dasar: Hanya yang Published & Tipe Lomba
        $query = Events::with(['kategori', 'kota']) // Eager load relasi
            ->where('status', 'published')
            ->where('type', 'lomba'); // SYARAT WAJIB: Hanya Lomba

        // 3. Logika Filter Kategori (Jika ada yang dicentang)
        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->whereIn('kategori_id', $request->kategori);
        }

        // 4. Logika Filter Wilayah/Kota (Jika ada yang dipilih)
        if ($request->has('kota') && !empty($request->kota)) {
            // Asumsi: Tabel events punya kolom 'kota_id'
            $query->whereIn('kota_id', $request->kota);
        }

        // 5. Eksekusi Query
        $events = $query->orderBy('start_date', 'asc')->get();

        return view('events.event', compact('events', 'kategori_list', 'kota_list'));
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

        return view('events.detail-lomba', compact('event'));
    }

    /*
    |--------------------------------------------------------------------------
    | KLAIM XP & UPLOAD BUKTI
    |--------------------------------------------------------------------------
    */
    public function klaimXP(Request $request, $id)
    {
        $user = Auth::user();
        $event = Events::findOrFail($id);

        // 1. Cek apakah event sudah selesai
        // Asumsi: Event dianggap selesai jika waktu sekarang > start_date
        // Atau jika Anda punya kolom 'end_date', gunakan itu.
        if (now() < $event->start_date) {
            return back()->with('error', 'Event belum dimulai/selesai.');
        }

        // 2. Cari data kepesertaan
        $peserta = PesertaKegiatan::where('user_id', $user->id)
            ->where('events_id', $event->id)
            ->first();

        if (!$peserta) {
            return back()->with('error', 'Anda belum terdaftar di event ini.');
        }

        // 3. Cek apakah sudah pernah klaim (Status tidak null)
        if ($peserta->status !== null) {
            return back()->with('error', 'Anda sudah mengklaim XP untuk event ini.');
        }

        // 4. LOGIKA XP
        $xpGained = 0;
        $pesan = '';

        // Validasi input foto (opsional)
        $request->validate([
            'bukti_foto' => 'nullable|image|max:2048',
            'review'     => 'nullable|string|max:500'
        ]);

        // SKENARIO A: Upload Bukti (XP BESAR)
        if ($request->hasFile('bukti_foto')) {
            $path = $request->file('bukti_foto')->store('public/bukti_event');
            $peserta->bukti_url = str_replace('public/', 'storage/', $path);
            
            $xpGained = 50; // XP Besar
            $pesan = "Bukti diterima! Anda dapat +$xpGained XP.";
        } 
        // SKENARIO B: Tanpa Bukti (XP KECIL)
        else {
            $xpGained = 10; // XP Kecil
            $pesan = "Kehadiran tercatat. Anda dapat +$xpGained XP.";
        }

        // 5. Simpan Data
        $peserta->status = 'hadir'; // Set otomatis jadi hadir
        $peserta->review_text = $request->review;
        $peserta->save();

        // 6. Tambah XP ke User & Update Level
        $user->tambahXP($xpGained);

        return back()->with('success', $pesan);
    }

    /*
    |--------------------------------------------------------------------------
    | FORM PENDAFTARAN LOMBA (STEP 1 SEBELUM BAYAR)
    |--------------------------------------------------------------------------
    */
    public function showRegisterForm($id)
    {
        $event = Events::where('status', 'published')->findOrFail($id);
        
        // Cek apakah user sudah terdaftar
        $exists = PesertaKegiatan::where('user_id', Auth::id())
            ->where('events_id', $id)
            ->exists();

        if ($exists) {
            return redirect()->route('events.show', $id)
                ->with('error', 'Anda sudah terdaftar di event ini.');
        }

        return view('events.form-lomba', compact('event'));
    }

    public function storeRegistration(Request $request, $id)
    {
        // 1. Validasi Input
        $request->validate([
            'no_wa'     => 'required|string|max:20',
            'nickname'  => 'nullable|string|max:50',
            'game_id'   => 'nullable|string|max:50',
        ]);

        $event = Events::findOrFail($id);
        $user = Auth::user();

        // 2. CEK APAKAH GRATIS ATAU BERBAYAR?
        if (!$event->berbayar) {
            
            // SKENARIO GRATIS: Langsung Daftarkan Peserta
            
            // Cek duplikasi dulu biar aman
            $exists = PesertaKegiatan::where('user_id', $user->id)
                ->where('events_id', $id)
                ->exists();

            if (!$exists) {
                PesertaKegiatan::create([
                    'user_id'   => $user->id,
                    'events_id' => $id,
                    'status'    => null, // Status null artinya belum hadir/klaim
                    // Simpan data tambahan jika perlu (misal di kolom lain/tabel lain)
                ]);
            }

            return redirect()->route('events.show', $id)
                ->with('success', 'Pendaftaran berhasil! Anda telah terdaftar di event ini.');

        } else {

            // SKENARIO BERBAYAR: Redirect ke Halaman Upload Bukti
            
            // Simpan data sementara di session untuk dipakai nanti (opsional)
            session([
                'temp_registration_data' => [
                    'user_id'   => $user->id,
                    'event_id'  => $id,
                    'no_wa'     => $request->no_wa,
                    'nickname'  => $request->nickname,
                    'game_id'   => $request->game_id,
                ]
            ]);

            return redirect()->route('pembayaran.create', $id);
        }
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

        return view('events.riwayat-event', compact('upcomingEvents', 'pastEvents'));
    }


}
