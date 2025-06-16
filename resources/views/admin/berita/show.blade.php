@extends('admin.layouts.app')
@section('title', $berita->judul)

@section('content')
<div class="container">
    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <h1>{{ $berita->judul }}</h1>
<p class="text-muted">
    Dibuat pada: {{ $berita->created_at ? $berita->created_at->format('d M Y') : 'Tanggal tidak tersedia' }}
</p>


    @if($berita->gambar)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-fluid" style="max-width:400px;">
        </div>
    @endif

    <div>
        {!! nl2br(e($berita->konten)) !!}
    </div>

    <hr>
    <strong>Berita Utama:</strong> {{ $berita->utama ? 'YA' : 'TIDAK' }}
</div>
@endsection
