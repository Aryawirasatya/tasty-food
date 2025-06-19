<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar semua berita untuk pengunjung.
     */
public function index()
{
    // Ambil 1 berita terbaru sebagai featured
    $featured = Berita::latest()->first();

    // Ambil berita lain yang bukan featured
    $others = Berita::where('id', '!=', optional($featured)->id)->latest()->paginate(6);

    return view('public.berita.index', compact('featured', 'others'));
}


    /**
     * Menampilkan detail berita berdasarkan slug.
     */
    public function show($id)
{
    $berita = Berita::findOrFail($id);
    return view('public.berita.show', compact('berita'));
}

}
