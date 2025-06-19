<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        // Slider ambil 3 gambar terbaru
        $sliderImages = Galeri::latest()->take(3)->get();

        // Galeri grid ambil semua dengan pagination
        $galeris = Galeri::latest()->paginate(8);

        return view('public.galeri.index', compact('sliderImages', 'galeris'));
    }
}
