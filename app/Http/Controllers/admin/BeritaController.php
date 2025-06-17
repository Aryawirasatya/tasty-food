<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        $berita = Berita::latest()->get();
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'utama' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $validated['utama'] = $request->has('utama');
        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'utama' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $validated['utama'] = $request->has('utama');
        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function show(Berita $berita)
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        return view('admin.berita.show', compact('berita'));
    }
}
