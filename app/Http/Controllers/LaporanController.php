<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST LAPORAN (ADMIN)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'admin') {
            abort(403);
        }

        $laporan = Laporan::where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.laporan.index', compact('laporan'));
    }

    /*
    |--------------------------------------------------------------------------
    | SELESAIKAN LAPORAN
    |--------------------------------------------------------------------------
    */

    public function resolve(Request $request, $id)
    {
        $admin = Auth::user();
        if (! $admin || $admin->role !== 'admin') {
            abort(403);
        }

        $laporan = Laporan::findOrFail($id);

        if ($laporan->status === 'resolved') {
            return back()->with('info', 'Laporan sudah diselesaikan.');
        }

        // Jika target adalah peserta, turunkan trust score
        if ($laporan->tipe_target === 'peserta') {
            $targetUser = User::find($laporan->target_id);

            if ($targetUser) {
                User::where('id', $targetUser->id)
                    ->decrement('skor_kepercayaan', 5);
            }
        }

        $laporan->status = 'resolved';
        $laporan->save();

        return back()->with('success', 'Laporan berhasil diselesaikan.');
    }
}
