<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiKontak;
use Illuminate\Http\Request;

class InformasiKontakController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user || !$user->canAkses('akses_kontak')) {
            abort(403);
        }

        $kontak = InformasiKontak::first();
        return view('admin.kontak.index', compact('kontak'));
    }

    public function edit()
    {
        $user = auth()->user();
        if (!$user || !$user->canAkses('akses_kontak')) {
            abort(403);
        }

        $kontak = InformasiKontak::firstOrFail();
        return view('admin.kontak.edit', compact('kontak'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        if (!$user || !$user->canAkses('akses_kontak')) {
            abort(403);
        }

        $validated = $request->validate([
            'alamat' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required|string',
            'link_maps' => 'nullable|url',
            'url_email' => 'nullable|string',
            'url_telepon' => 'nullable|string',
            'url_alamat' => 'nullable|string',
        ]);

        $kontak = InformasiKontak::firstOrFail();
        $kontak->update($validated);

        return redirect()->route('admin.kontak.index')->with('success', 'Informasi kontak berhasil diperbarui.');
    }

    // Optional methods (tidak dipakai)
    public function create() {}
    public function store(Request $request) {}
    public function show(string $id) {}
    public function destroy(string $id) {}
}
