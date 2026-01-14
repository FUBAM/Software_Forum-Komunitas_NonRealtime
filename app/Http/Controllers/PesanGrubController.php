<?php

namespace App\Http\Controllers;

use App\Models\Grup;
use App\Models\PesanGrup;
use App\Models\AnggotaKomunitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanGrupController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN CHAT ROOM (NON-REALTIME)
    |--------------------------------------------------------------------------
    */

    public function chat($grupId)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect('/?login=1');
        }

        $grup = Grup::with(['komunitas', 'pesanGrup.user'])
            ->findOrFail($grupId);

        // Cek apakah user anggota komunitas
        $isMember = AnggotaKomunitas::where('user_id', $user->id)
            ->where('komunitas_id', $grup->komunitas_id)
            ->exists();

        if (! $isMember) {
            return redirect()
                ->route('komunitas.show', $grup->komunitas_id)
                ->with('error', 'Anda harus bergabung dengan komunitas terlebih dahulu.');
        }

        return view('grup.chat', compact('grup'));
    }

    /*
    |--------------------------------------------------------------------------
    | KIRIM PESAN BARU (NON-REALTIME)
    |--------------------------------------------------------------------------
    */

    public function sendMessage(Request $request, $grupId)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect('/?login=1');
        }

        $request->validate([
            'pesan'    => 'required|string',
            'lampiran' => 'nullable|image|max:1024',
        ]);

        $grup = Grup::findOrFail($grupId);

        // Cek apakah user anggota komunitas
        $anggota = AnggotaKomunitas::where('user_id', $user->id)
            ->where('komunitas_id', $grup->komunitas_id)
            ->first();

        if (! $anggota) {
            return back()->with('error', 'Anda bukan anggota komunitas ini.');
        }

        // Jika grup read-only → hanya moderator
        if ($grup->is_read_only && $anggota->role !== 'moderator') {
            return back()->with('error', 'Grup ini hanya bisa dibaca.');
        }

        $pesan = new PesanGrup();
        $pesan->grup_id = $grupId;
        $pesan->user_id = $user->id;
        $pesan->pesan = $request->pesan;

        if ($request->hasFile('lampiran')) {
            $pesan->lampiran_url = $request->file('lampiran')
                ->store('chat_files', 'public');
        }

        $pesan->save();

        return back(); // refresh halaman (non-realtime)
    }
}
