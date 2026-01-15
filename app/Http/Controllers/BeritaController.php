<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST BERITA (ADMIN)
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'admin') {
            abort(403);
        }

        $berita = Berita::latest()->get();

        return view('admin.berita.index', compact('berita'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH BERITA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'admin') {
            abort(403);
        }

        return view('admin.berita.create');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN BERITA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'judul'   => 'required|string|max:255',
            'konten'  => 'required|string',
            'gambar'  => 'nullable|image|max:2048',
            'status'  => 'required|in:draft,published',
        ]);

        $slug = Str::slug($request->judul);

        // Pastikan slug unik
        if (Berita::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        $data = [
            'user_id' => $user->id,
            'judul'   => $request->judul,
            'slug'    => $slug,
            'konten'  => $request->konten,
            'status'  => $request->status,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar_url'] = $request->file('gambar')
                ->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil disimpan.');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT BERITA
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'admin') {
            abort(403);
        }

        $berita = Berita::findOrFail($id);

        return view('admin.berita.edit', compact('berita'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE BERITA
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'admin') {
            abort(403);
        }

        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul'   => 'required|string|max:255',
            'konten'  => 'required|string',
            'gambar'  => 'nullable|image|max:2048',
            'status'  => 'required|in:draft,published',
        ]);

        $berita->judul  = $request->judul;
        $berita->konten = $request->konten;
        $berita->status = $request->status;

        if ($request->hasFile('gambar')) {
            $berita->gambar_url = $request->file('gambar')
                ->store('berita', 'public');
        }

        $berita->save();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS BERITA
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'admin') {
            abort(403);
        }

        Berita::destroy($id);

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    
    public function show($id)
    {
        $berita = Berita::where('status', 'published')
            ->findOrFail($id);

        return view('detail-berita', compact('berita'));
    }
}
