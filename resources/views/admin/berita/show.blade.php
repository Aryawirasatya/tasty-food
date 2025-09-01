@extends('admin.layouts.app')
@section('title', 'Detail Berita')

@section('content')
<div class="container">

  {{-- Bar atas: tombol kembali + badge (jika utama) --}}
  <div class="d-flex align-items-center gap-2 mb-3">
    <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary btn-sm">
      <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>

  </div>

  <h1 class="h3 mb-2">{{ $berita->judul }}</h1>

  @php
    $created = optional($berita->created_at)->timezone('Asia/Jakarta');
    $updated = optional($berita->updated_at)->timezone('Asia/Jakarta');
  @endphp
  <div class="text-muted small mb-3">
    Dibuat:
    @if ($created)
      <time datetime="{{ $created->toIso8601String() }}">{{ $created->format('d-m-Y H:i') }}</time> WIB
    @else
      <em>Tidak diketahui</em>
    @endif

    @if ($updated)
      <span class="mx-2">•</span>
      Diperbarui:
      <time datetime="{{ $updated->toIso8601String() }}">{{ $updated->format('d-m-Y H:i') }}</time> WIB
    @endif
  </div>

  @if ($berita->gambar)
    <div class="mb-4">
      <img
        src="{{ asset('storage/' . $berita->gambar) }}"
        alt="Gambar Berita"
        class="img-fluid rounded border shadow-sm berita-cover">
    </div>
  @endif

  {{-- Konten --}}
  <div class="card shadow-sm">
    <div class="card-body berita-content">
      {!! $berita->konten !!}
    </div>
  </div>

</div>

<style>
  .berita-cover{
    width: 100%;
    max-height: 320px;
    object-fit: cover;
  }
  .berita-content img{
    max-width: 100%;
    height: auto;
  }
</style>
@endsection
