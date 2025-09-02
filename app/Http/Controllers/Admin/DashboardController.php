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
        $user = auth()->user();

        // === SUPERADMIN: tampilkan dashboard penuh (default kamu) ===
        if ($user->isSuperAdmin()) {
            $tahun = now()->year;

            $totalBerita       = Berita::count();
            $totalGaleri       = Galeri::count();
            $totalPesan        = ContactMessage::count();
            $totalBeritaUtama  = Berita::where('utama', true)->count();

            $awalBulan   = Carbon::now()->startOfMonth();
            $akhirBulan  = Carbon::now()->endOfMonth();
            $beritaBulanIni = Berita::whereBetween('created_at', [$awalBulan, $akhirBulan])->count();
            $pesanBulanIni  = ContactMessage::whereBetween('created_at', [$awalBulan, $akhirBulan])->count();

            $beritaPerBulan = Berita::whereYear('created_at', $tahun)
                ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
                ->groupBy('bulan')->pluck('total', 'bulan')->toArray();

            $pesanPerBulan = ContactMessage::whereYear('created_at', $tahun)
                ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
                ->groupBy('bulan')->pluck('total', 'bulan')->toArray();

            $dataBerita = [];
            $dataPesan  = [];
            for ($i = 1; $i <= 12; $i++) {
                $dataBerita[] = $beritaPerBulan[$i] ?? 0;
                $dataPesan[]  = $pesanPerBulan[$i] ?? 0;
            }

            $latestBerita = Berita::latest()->take(5)->get(['id','judul','utama','created_at']);
            $latestPesan  = ContactMessage::latest()->take(5)->get(['id','nama','email','subject','created_at']);

            return view('admin.dashboard', compact(
                'totalBerita','totalGaleri','totalPesan',
                'totalBeritaUtama','beritaBulanIni','pesanBulanIni',
                'dataBerita','dataPesan','latestBerita','latestPesan','tahun'
            ));
        }

        // === ADMIN BIASA: dashboard sesuai permission ===
        return $this->adminDashboard();
    }

    private function adminDashboard()
    {
        $u = auth()->user();

        // mapping permission paket:
        $can = [
            'berita' => $u->canAkses('akses_berita'),
            'galeri' => $u->canAkses('akses_galeri'),
            'kontak' => $u->canAkses('akses_kontak'), // info kontak (tentang alamat, dll.)
            'pesan'  => $u->canAkses('akses_pesan'),  // pesan masuk dari pengunjung
            'tentang'=> $u->canAkses('akses_tentang'),
        ];

        // siapkan data SECARA KONDISIONAL (hindari kebocoran)
        $totalBerita      = $can['berita'] ? Berita::count() : null;
        $totalGaleri      = $can['galeri'] ? Galeri::count() : null;
        $totalPesan       = $can['pesan']  ? ContactMessage::count() : null;
        $totalBeritaUtama = $can['berita'] ? Berita::where('utama', true)->count() : null;

        $tahun = now()->year;
        $awalBulan  = now()->startOfMonth();
        $akhirBulan = now()->endOfMonth();

        $beritaBulanIni = $can['berita']
            ? Berita::whereBetween('created_at', [$awalBulan, $akhirBulan])->count()
            : null;

        $pesanBulanIni = $can['pesan']
            ? ContactMessage::whereBetween('created_at', [$awalBulan, $akhirBulan])->count()
            : null;

        // dataset tren hanya yang diizinkan
        $dataBerita = $can['berita'] ? $this->seriesTahunan(Berita::class, $tahun) : [];
        $dataPesan  = $can['pesan']  ? $this->seriesTahunan(ContactMessage::class, $tahun) : [];

        $latestBerita = $can['berita']
            ? Berita::latest()->take(5)->get(['id','judul','utama','created_at'])
            : collect();

        $latestPesan  = $can['pesan']
            ? ContactMessage::latest()->take(5)->get(['id','nama','email','subject','created_at'])
            : collect();

        return view('admin.dashboard_admin', [
            'can' => $can,
            'tahun' => $tahun,
            'totalBerita' => $totalBerita,
            'totalGaleri' => $totalGaleri,
            'totalPesan' => $totalPesan,
            'totalBeritaUtama' => $totalBeritaUtama,
            'beritaBulanIni' => $beritaBulanIni,
            'pesanBulanIni' => $pesanBulanIni,
            'dataBerita' => $dataBerita,
            'dataPesan' => $dataPesan,
            'latestBerita' => $latestBerita,
            'latestPesan' => $latestPesan,
        ]);
    }

    private function seriesTahunan(string $model, int $tahun): array
    {
        $byMonth = $model::whereYear('created_at', $tahun)
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')->pluck('total', 'bulan')->toArray();

        $result = [];
        for ($i = 1; $i <= 12; $i++) $result[] = $byMonth[$i] ?? 0;
        return $result;
    }
}
