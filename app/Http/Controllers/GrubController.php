<?php

namespace App\Http\Controllers;

use App\Models\grub;
use App\Models\pesanGrup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrubController extends Controller
{
    // Tampilkan Chat Room
    public function chat($grupId)
    {
        $grup = Grup::with(['komunitas', 'pesan.user'])->findOrFail($grupId);
        
        // Cek akses: User harus anggota komunitas
        if (!Auth::user()->komunitas->contains($grup->komunitas_id)) {
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

        $grup = Grup::findOrFail($grupId);

        if ($grup->is_read_only) {
            // Cek apakah moderator
            if (!Auth::user()->isModeratorOf($grup->komunitas_id)) {
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