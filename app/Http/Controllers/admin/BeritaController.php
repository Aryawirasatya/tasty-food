<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

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

    // Upload gambar jika ada
    if ($request->hasFile('gambar')) {
        $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
    }

    // Ubah checkbox 'utama' jadi boolean true/false
    $validated['utama'] = $request->has('utama');

    // Tambahkan slug ke dalam array validated
    $validated['slug'] = Str::slug($validated['judul']);

    // Simpan data
    Berita::create($validated);

    return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
}

    public function edit($id)
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'utama' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $validated['utama'] = $request->has('utama');
        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        $berita = Berita::findOrFail($id);

        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function show($id)
    {
        if (!auth()->user()->canAkses('akses_berita')) {
            abort(403);
        }

        $berita = Berita::findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }   
}
