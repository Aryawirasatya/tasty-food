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
    $tentang = Tentang::first(); // atau where id 1, dsb

    // Validasi jika perlu
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'deskripsi_lanjutan' => 'nullable|string',
        'judul_visi' => 'nullable|string',
        'isi_visi' => 'nullable|string',
        'judul_misi' => 'nullable|string',
        'isi_misi' => 'nullable|string',
        'gambar_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'gambar_profil_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'gambar_visimisi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'gambar_misi_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        'gambar_visimisi_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Upload & simpan jika ada gambar baru
    if ($request->hasFile('gambar_profil')) {
        $tentang->gambar_profil = $request->file('gambar_profil')->store('tentang', 'public');
    }

    if ($request->hasFile('gambar_profil_2')) {
        $tentang->gambar_profil_2 = $request->file('gambar_profil_2')->store('tentang', 'public');
    }

    if ($request->hasFile('gambar_visimisi')) {
        $tentang->gambar_visimisi = $request->file('gambar_visimisi')->store('tentang', 'public');
    }

    if ($request->hasFile('gambar_visimisi_2')) {
        $tentang->gambar_visimisi_2 = $request->file('gambar_visimisi_2')->store('tentang', 'public');
    }
    if ($request->hasFile('gambar_misi_1')) {
$tentang->gambar_misi_1 = $request->file('gambar_misi_1')->store('tentang', 'public');

    }

    // Simpan data teks
    $tentang->judul = $request->input('judul');
    $tentang->deskripsi = $request->input('deskripsi');
    $tentang->deskripsi_lanjutan = $request->input('deskripsi_lanjutan');
    $tentang->judul_visi = $request->input('judul_visi');
    $tentang->isi_visi = $request->input('isi_visi');
    $tentang->judul_misi = $request->input('judul_misi');
    $tentang->isi_misi = $request->input('isi_misi');

    $tentang->save();

    return redirect()->route('admin.tentang.index')->with('success', 'Data berhasil diperbarui.');
}

}
