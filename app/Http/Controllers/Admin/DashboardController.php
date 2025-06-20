<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\ContactMessage;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalPesan  = ContactMessage::count();

        // Ambil jumlah berita dan pesan masuk per bulan
        $beritaPerBulan = Berita::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')->pluck('total', 'bulan')->toArray();

        $pesanPerBulan = ContactMessage::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')->pluck('total', 'bulan')->toArray();

        // Pastikan semua bulan 1-12 terisi
        $dataBerita = [];
        $dataPesan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBerita[] = $beritaPerBulan[$i] ?? 0;
            $dataPesan[] = $pesanPerBulan[$i] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalBerita', 'totalGaleri', 'totalPesan', 'dataBerita', 'dataPesan'
        ));
    }
}
