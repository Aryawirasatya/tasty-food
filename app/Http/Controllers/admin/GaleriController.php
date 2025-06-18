<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user || !$user->canAkses('akses_galeri')) {
            abort(403);
        }
        
        $galeri = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user || !$user->canAkses('akses_galeri')) {
            abort(403);
        }

        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user || !$user->canAkses('akses_galeri')) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');
        
        Galeri::create([
            'judul' => $validated['judul'],
            'gambar' => $path,
            'is_slider' => $request->has('is_slider'), // <-- tambah ini
        ]);
                

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        $user = auth()->user();
        if (!$user || !$user->canAkses('akses_galeri')) {
            abort(403);
        }

        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $user = auth()->user();
        if (!$user || !$user->canAkses('akses_galeri')) {
            abort(403);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }
        $validated['is_slider'] = $request->has('is_slider');

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        $user = auth()->user();
        if (!$user || !$user->canAkses('akses_galeri')) {
            abort(403);
        }

        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
