@extends('admin.layouts.app')
@section('title', 'Detail Berita')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $berita->judul }}</h1>



    <div class="mb-3">
        <strong>Tanggal Dibuat:</strong>
        @if ($berita->created_at)
            {{ $berita->created_at->format('d-m-Y H:i') }}
        @else
            <em class="text-muted">Tidak diketahui</em>
        @endif
    </div>

    <div class="mb-3">
        <strong>Konten:</strong><br>
        <div class="border p-3">{!! nl2br(e($berita->konten)) !!}</div>
    </div>

    <div class="mb-3">
        <strong>Gambar:</strong><br>
        @if ($berita->gambar)
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" width="400">
        @else
            <p class="text-muted">Tidak ada gambar</p>
        @endif
    </div>

    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
@endsection
