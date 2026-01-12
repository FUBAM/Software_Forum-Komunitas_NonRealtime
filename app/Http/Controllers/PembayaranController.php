<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Events;
use App\Models\PesertaKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // Tampilkan Halaman Bayar
    public function create($eventId)
    {
        $event = Events::findOrFail($eventId);
        return view('pembayaran.create', compact('event'));
    }

    // User Mengirim Bukti Transfer
    public function store(Request $request, $eventId)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|max:2048',
            'jumlah_bayar' => 'required|numeric'
        ]);

        $path = $request->file('bukti_transfer')->store('bukti_bayar', 'public');

        Pembayaran::create([
            'user_id' => Auth::id(),
            'events_id' => $eventId,
            'jumlah_bayar' => $request->jumlah_bayar,
            'bukti_url' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('events.show', $eventId)
            ->with('success', 'Bukti terkirim. Menunggu verifikasi admin.');
    }

    // Admin: Verifikasi Pembayaran
    public function verify(Request $request, $id)
    {
        // Hanya admin yang boleh akses (cek middleware di route)
        $pembayaran = Pembayaran::findOrFail($id);

        if ($request->action == 'approve') {
            $pembayaran->status = 'lunas';
            $pembayaran->diverifikasi_oleh = Auth::id();
            $pembayaran->save();

            // Masukkan user ke tabel peserta_kegiatan
            PesertaKegiatan::create([
                'user_id' => $pembayaran->user_id,
                'events_id' => $pembayaran->events_id,
                'status' => 'kehadiran',
                'bukti_url' => null,
                'review_text' => null
            ]);

            // Tambah XP (Gamifikasi)
            $user = $pembayaran->user;
            $user->increment('xp_terkini', 10);
            $user->increment('skor_kepercayaan', 5);

            return back()->with('success', 'Pembayaran diterima.');
        } else if ($request->action == 'reject') {
            $pembayaran->status = 'ditolak';
            $pembayaran->alasan_penolakan = $request->alasan;
            $pembayaran->diverifikasi_oleh = Auth::id();
            $pembayaran->save();

            return back()->with('error', 'Pembayaran ditolak.');
        }
    }
}
