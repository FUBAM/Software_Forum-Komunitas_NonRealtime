<?php

namespace App\Http\Controllers;

use App\Models\Grub;
use App\Models\PesanGrup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrubController extends Controller
{
    // Tampilkan Chat Room
    public function chat($grupId)
    {
        $grup = Grub::with(['komunitas', 'pesan.user'])->findOrFail($grupId);

        // Cek akses: User harus anggota komunitas
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if (!$user || !$user->komunitas->contains('id', $grup->komunitas_id)) {
            return redirect()->route('komunitas.show', $grup->komunitas_id)
                ->with('error', 'Anda harus bergabung dulu.');
        }

        return view('grup.chat', compact('grup'));
    }

    // Kirim Pesan Baru
    public function sendMessage(Request $request, $grupId)
    {
        $request->validate([
            'pesan' => 'required|string',
            'lampiran' => 'nullable|image|max:1024'
        ]);

        $grup = Grub::findOrFail($grupId);

        if ($grup->is_read_only) {
            // Cek apakah moderator
            /** @var \App\Models\User|null $user */
            $user = Auth::user();
            if (!$user || !$user->isModeratorOf($grup->komunitas_id)) {
                return back()->with('error', 'Grup ini hanya baca.');
            }
        }

        $msg = new PesanGrup();
        $msg->grup_id = $grupId;
        $msg->user_id = Auth::id();
        $msg->pesan = $request->pesan;

        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('chat_files', 'public');
            $msg->lampiran_url = $path;
        }

        $msg->save();

        return back(); // Refresh halaman (Non-Realtime)
    }
}
