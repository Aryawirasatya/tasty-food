<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\ContactMessage;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = now()->year;

        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalPesan  = ContactMessage::count();
        $totalBeritaUtama = Berita::where('utama', true)->count();

        // Bulan ini
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();

        $beritaBulanIni = Berita::whereBetween('created_at', [$awalBulan, $akhirBulan])->count();
        $pesanBulanIni  = ContactMessage::whereBetween('created_at', [$awalBulan, $akhirBulan])->count();

        // Grup per bulan untuk tahun berjalan
        $beritaPerBulan = Berita::whereYear('created_at', $tahun)
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')->pluck('total', 'bulan')->toArray();

        $pesanPerBulan = ContactMessage::whereYear('created_at', $tahun)
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')->pluck('total', 'bulan')->toArray();

        // Pastikan semua bulan 1-12 terisi
        $dataBerita = [];
        $dataPesan  = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBerita[] = $beritaPerBulan[$i] ?? 0;
            $dataPesan[]  = $pesanPerBulan[$i] ?? 0;
        }

        // Recent activity
        $latestBerita = Berita::latest()->take(5)->get(['id','judul','utama','created_at']);
        $latestPesan  = ContactMessage::latest()->take(5)->get(['id','nama','email','subject','created_at']);

        return view('admin.dashboard', compact(
            'totalBerita', 'totalGaleri', 'totalPesan',
            'totalBeritaUtama', 'beritaBulanIni', 'pesanBulanIni',
            'dataBerita', 'dataPesan', 'latestBerita', 'latestPesan', 'tahun'
        ));
    }
}
