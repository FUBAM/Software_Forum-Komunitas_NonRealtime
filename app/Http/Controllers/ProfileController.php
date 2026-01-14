<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $viewedUser = null;

        if ($slug = $request->query('user')) {
            $viewedUser = User::whereRaw(
                'LOWER(REPLACE(nama, " ", "-")) = ?',
                [Str::slug($slug)]
            )->first();
        }

        return view('profile', compact('viewedUser'));
    }
}
