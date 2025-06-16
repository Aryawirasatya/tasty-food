<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->get();
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
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
    return view('admin.berita.edit', compact('berita'));
}

    public function update(Request $request, Berita $berita)
{
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
    $berita->delete();
    return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
}

    public function show(Berita $berita)
{
    return view('admin.berita.show', compact('berita'));
}
}
