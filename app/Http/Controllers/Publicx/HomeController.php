<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Tentang; // asumsikan model Tentang ada
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Data About (Tentang Kami)
        // Asumsi: ada tabel/model Tentang, ambil record pertama
        $tentang = null;
        if (class_exists(\App\Models\Tentang::class)) {
            $tentang = Tentang::latest()->first();
        }
        // Jika tidak ada model, Anda bisa gunakan teks statis di view.

        // 2. Card Makanan (features)
        // Asumsi: kita pakai 4 gambar dari Galeri terbaru.
        $features = Galeri::latest()->take(4)->get();
            

        // 3. Berita Kami
        // Ambil featured sebagai berita terbaru, sisanya ambil 4 berita berikutnya
        $featuredBerita = Berita::latest()->first();
        if ($featuredBerita) {
            $othersBerita = Berita::where('id', '!=', $featuredBerita->id)
                                ->latest()
                                ->take(4)
                                ->get();
        } else {
            $othersBerita = collect();
        }

        // 4. Galeri Kami (6 gambar)
        $galeri = Galeri::latest()->take(6)->get();

        return view('public.home.index', compact('tentang', 'features', 'featuredBerita', 'othersBerita', 'galeri'));
    }
}
