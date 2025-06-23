@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">Dashboard</h2>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card text-white bg-primary h-100">
        <div class="card-body">
          <h5 class="card-title">Total Berita</h5>
          <p class="card-text display-6">{{ $totalBerita }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-success h-100">
        <div class="card-body">
          <h5 class="card-title">Total Galeri</h5>
          <p class="card-text display-6">{{ $totalGaleri }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-danger h-100">
        <div class="card-body">
          <h5 class="card-title">Total Pesan</h5>
          <p class="card-text display-6">{{ $totalPesan }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
