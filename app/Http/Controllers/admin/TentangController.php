<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TentangController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (! $user || ! $user->canAkses('akses_tentang')) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $tentang = Tentang::first();
        return view('admin.tentang.index', compact('tentang'));
    }

    public function edit()
    {
        $user = Auth::user();
        if (! $user || ! $user->canAkses('akses_tentang')) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $tentang = Tentang::firstOrFail();
        return view('admin.tentang.edit', compact('tentang'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if (! $user || ! $user->canAkses('akses_tentang')) {
            abort(403, 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $tentang = Tentang::firstOrFail();

        $validated = $request->validate([
            'judul'              => 'required|string|max:255',
            'deskripsi'          => 'required|string',
            'deskripsi_lanjutan' => 'nullable|string',
            'judul_visi'         => 'nullable|string|max:255',
            'isi_visi'           => 'nullable|string',
            'judul_misi'         => 'nullable|string|max:255',
            'isi_misi'           => 'nullable|string',
            'gambar_profil'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar_visimisi'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar_profil')) {
            $validated['gambar_profil'] = $request->file('gambar_profil')->store('tentang', 'public');
        }

        if ($request->hasFile('gambar_visimisi')) {
            $validated['gambar_visimisi'] = $request->file('gambar_visimisi')->store('tentang', 'public');
        }

        $tentang->update($validated);

        return redirect()
            ->route('admin.tentang.index')
            ->with('success', 'Data Tentang Kami berhasil diperbarui.');
    }
}
