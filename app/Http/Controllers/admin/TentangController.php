<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tentang = Tentang::first();
        return view('admin.tentang.index', compact('tentang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // Ambil user
        $user = Auth::user();

        // Cek permission atau superadmin
        if (! $user->can('edit_tentang') && ! $user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        $tentang = Tentang::firstOrFail();
        return view('admin.tentang.edit', compact('tentang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Ambil user
        $user = Auth::user();

        // Cek permission atau superadmin lagi (opsional)
        if (! $user->can('edit_tentang') && ! $user->isSuperAdmin()) {
            abort(403, 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $tentang = Tentang::firstOrFail();

        // Validasi
        $validated = $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'required|string',
            'deskripsi_lanjutan'=> 'nullable|string',
            'judul_visi'        => 'nullable|string|max:255',
            'isi_visi'          => 'nullable|string',
            'judul_misi'        => 'nullable|string|max:255',
            'isi_misi'          => 'nullable|string',
            'gambar_profil'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gambar_visimisi'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan file jika ada
        if ($request->hasFile('gambar_profil')) {
            $validated['gambar_profil'] = $request
                ->file('gambar_profil')
                ->store('tentang', 'public');
        }
        if ($request->hasFile('gambar_visimisi')) {
            $validated['gambar_visimisi'] = $request
                ->file('gambar_visimisi')
                ->store('tentang', 'public');
        }

        // Update
        $tentang->update($validated);

        return redirect()
            ->route('admin.tentang.index')
            ->with('success', 'Data Tentang Kami berhasil diperbarui.');
    }
}
