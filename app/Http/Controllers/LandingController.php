<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Events;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil Top Users untuk Hall of Fame (urut berdasarkan jumlah badge desc, lalu level desc)
        $topUsers = User::withCount('badges')
            ->with(['badges' => function ($q) {
                $q->orderBy('badge_user.earned_at', 'desc')->limit(6);
            }])
            ->where('role', 'member') // Hanya member biasa
            ->orderByDesc('badges_count')
            ->orderByDesc('level_terkini')
            ->take(5)
            ->get();

        // Ambil 3 Lomba Terbaru untuk section Berita/Event
        $latestEvents = Events::where('type', 'lomba')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('landing', compact('topUsers', 'latestEvents'));
    }
}
