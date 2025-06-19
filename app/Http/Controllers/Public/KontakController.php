<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\InformasiKontak;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = InformasiKontak::first();
        return view('public.kontak.index', compact('kontak'));
    }

    public function kirimPesan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('kontak')->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
