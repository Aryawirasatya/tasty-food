<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
 
public function index()
{
    $featured = \App\Models\Berita::where('utama', true)->latest()->first();

    if (!$featured) {
        $featured = \App\Models\Berita::latest()->first();
    }

    // Berita lainnya (kecuali featured bila ada)
    $othersQuery = \App\Models\Berita::query();
    if ($featured) {
        $othersQuery->where('id', '!=', $featured->id);
    }
    $others = $othersQuery->latest()->paginate(8);

    return view('public.berita.index', compact('featured', 'others'));
}
 
    public function show($id)
{
    $berita = Berita::findOrFail($id);
    return view('public.berita.show', compact('berita'));
}

}
