<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiKontak;
use Illuminate\Console\View\Components\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InformasiKontakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontak = InformasiKOntak::first();
        return view('admin.kontak.index',compact('kontak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
{
    $user = auth()->user();
    if (!$user?->isSuperAdmin() && !$user?->can('edit_kontak')) {
        abort(403);
    }

    $kontak = InformasiKontak::firstOrFail();
    return view('admin.kontak.edit', compact('kontak'));
}


    /**
     * Update the specified resource in storage.
     */
      public function update(Request $request)
{
    $user = auth()->user();
    if (!$user?->isSuperAdmin() && !$user?->can('edit_kontak')) {
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
