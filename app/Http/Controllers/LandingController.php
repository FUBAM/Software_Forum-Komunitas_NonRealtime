<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\events;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil 3 Top User untuk Hall of Fame
        $topUsers = User::orderBy('xp_terkini', 'desc')
                        ->where('role', 'member') // Hanya member biasa
                        ->take(3)
                        >get();

        // Ambil 3 Lomba Terbaru untuk section Berita/Event
        $latestEvents = Events::where('type', 'lomba')
                              ->where('status', 'published')
                              ->orderBy('created_at', 'desc')
                              ->take(3)
                              ->get();

        return view('landing', compact('topUsers', 'latestEvents'));
    }
}