@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Dashboard</h2>
  </div>

  {{-- KPI cards --}}
  <div class="row g-3 mb-3">
    <div class="col-sm-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="text-muted small">Total Berita</div>
          <div class="display-6 fw-semibold">{{ $totalBerita }}</div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="text-muted small">Berita Utama</div>
          <div class="display-6 fw-semibold">{{ $totalBeritaUtama }}</div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="text-muted small">Total Galeri</div>
          <div class="display-6 fw-semibold">{{ $totalGaleri }}</div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <div class="text-muted small">Total Pesan</div>
          <div class="display-6 fw-semibold">{{ $totalPesan }}</div>
        </div>
      </div>
    </div>
  </div>

  {{-- Ringkasan bulan ini --}}
  <div class="row g-3 mb-4">
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="text-muted small">Berita Bulan Ini</div>
            <div class="h3 mb-0">{{ $beritaBulanIni }}</div>
          </div>
          <i class="fas fa-newspaper fa-2x text-primary"></i>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="text-muted small">Pesan Masuk Bulan Ini</div>
            <div class="h3 mb-0">{{ $pesanBulanIni }}</div>
          </div>
          <i class="fas fa-inbox fa-2x text-success"></i>
        </div>
      </div>
    </div>
  </div>

  {{-- Grafik tren --}}
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="card-title mb-0">Tren {{ $tahun }}</h5>
        <span class="text-muted small">Per Bulan</span>
      </div>
      <canvas id="trendChart" height="90"></canvas>
    </div>
  </div>

  {{-- Recent activity --}}
  <div class="row g-3">
    <div class="col-lg-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h6 class="card-title">Berita Terbaru</h6>
          <ul class="list-group list-group-flush">
            @forelse($latestBerita as $b)
              <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="me-3">
                  <div class="fw-semibold">{{ $b->judul }}</div>
                  <div class="text-muted small">
                    {{ $b->created_at->format('d-m-Y H:i') }}
                    @if($b->utama)
                      · <span class="badge bg-primary text-white">Utama</span>
                    @endif
                  </div>
                </div>
                <div class="text-nowrap">
                  <a href="{{ route('admin.berita.edit', $b->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                </div>
              </li>
            @empty
              <li class="list-group-item text-muted">Belum ada data.</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h6 class="card-title">Pesan Terbaru</h6>
          <ul class="list-group list-group-flush">
            @forelse($latestPesan as $p)
              <li class="list-group-item">
                <div class="fw-semibold">{{ $p->subject }}</div>
                <div class="text-muted small">
                  Dari {{ $p->nama }} ({{ $p->email }}) · {{ $p->created_at->format('d-m-Y H:i') }}
                </div>
              </li>
            @empty
              <li class="list-group-item text-muted">Belum ada data.</li>
            @endforelse
          </ul>
          <div class="mt-3 text-end">
            <a href="{{ route('admin.kontak-pesan.index') }}" class="btn btn-sm btn-outline-secondary">Lihat semua</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  (function (){
    const ctx = document.getElementById('trendChart');
    const labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const dataBerita = @json($dataBerita);
    const dataPesan  = @json($dataPesan);

    new Chart(ctx, {
      type: 'line',
      data: {
        labels,
        datasets: [
          {
            label: 'Berita',
            data: dataBerita,
            fill: false,
            borderWidth: 2,
            tension: .3
          },
          {
            label: 'Pesan',
            data: dataPesan,
            fill: false,
            borderWidth: 2,
            tension: .3
          }
        ]
      },
      options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        plugins: {
          legend: { position: 'top' }
        },
        scales: {
          y: { beginAtZero: true, ticks: { precision: 0 } }
        }
      }
    });
  })();
</script>
@endsection
