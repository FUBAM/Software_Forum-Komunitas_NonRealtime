<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Events;
use App\Models\PesertaKegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM PEMBAYARAN (MEMBER)
    |--------------------------------------------------------------------------
    */

    public function create($eventId)
    {
        if (!Auth::check()) {
            return redirect('/?login=1');
        }

        $event = Events::where('berbayar', true)
            ->where('status', 'published')
            ->findOrFail($eventId);

        return view('events.payment', compact('event'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN BUKTI PEMBAYARAN (MEMBER)
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, $eventId)
    {
        if (!Auth::check()) {
            return redirect('/?login=1');
        }

        $request->validate([
            'bukti_transfer' => 'required|image|max:2048',
            'jumlah_bayar'   => 'required|numeric|min:0',
        ]);

        // Cegah pembayaran ganda
        $exists = Pembayaran::where('user_id', Auth::id())
            ->where('events_id', $eventId)
            ->whereIn('status', ['pending', 'lunas'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah mengirim pembayaran untuk event ini.');
        }

        $path = $request->file('bukti_transfer')
            ->store('bukti_bayar', 'public');

        Pembayaran::create([
            'user_id'       => Auth::id(),
            'events_id'     => $eventId,
            'jumlah_bayar'  => $request->jumlah_bayar,
            'bukti_url'     => $path,
            'status'        => 'pending',
        ]);

        return redirect()
            ->route('events.show', $eventId)
            ->with('success', 'Bukti pembayaran terkirim. Menunggu verifikasi admin.');
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI PEMBAYARAN (ADMIN)
    |--------------------------------------------------------------------------
    */

    public function verify(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            abort(403);
        }

        $pembayaran = Pembayaran::findOrFail($id);

        // Cegah verifikasi ulang
        if ($pembayaran->status !== 'pending') {
            return back()->with('error', 'Pembayaran sudah diproses.');
        }

        if ($request->action === 'approve') {

            $pembayaran->update([
                'status'            => 'lunas',
                'diverifikasi_oleh' => $user->id,
            ]);

            // Cegah duplikasi peserta
            $exists = PesertaKegiatan::where('user_id', $pembayaran->user_id)
                ->where('events_id', $pembayaran->events_id)
                ->exists();

            if (! $exists) {
                PesertaKegiatan::create([
                    'user_id'   => $pembayaran->user_id,
                    'events_id' => $pembayaran->events_id,
                    'status'    => 'tertarik',
                ]);
            }

            return back()->with('success', 'Pembayaran berhasil diverifikasi.');
        }

        if ($request->action === 'reject') {

            $request->validate([
                'alasan' => 'required|string|max:255',
            ]);

            $pembayaran->update([
                'status'             => 'ditolak',
                'alasan_penolakan'   => $request->alasan,
                'diverifikasi_oleh'  => $user->id,
            ]);

            return back()->with('error', 'Pembayaran ditolak.');
        }

        abort(400);
    }
}
