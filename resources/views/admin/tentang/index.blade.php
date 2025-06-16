@extends('admin.layouts.app')
@section('title', 'Tentang Kami')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Tentang Kami</h1>
        <a href="{{ route('admin.tentang.edit') }}" class="btn btn-warning">Edit</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">{{ $tentang->judul }}</h3>
            <p class="card-text">{{ $tentang->deskripsi }}</p>

            @if ($tentang->deskripsi_lanjutan)
                <p class="card-text text-muted">{{ $tentang->deskripsi_lanjutan }}</p>
            @endif

            @if($tentang->gambar_profil)
                <div class="text-center my-3">
                    <img src="{{ asset('storage/' . $tentang->gambar_profil) }}" class="img-fluid rounded" width="250">
                </div>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $tentang->judul_visi }}</h4>
            <p class="card-text">{{ $tentang->isi_visi }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $tentang->judul_misi }}</h4>
            <p class="card-text">{{ $tentang->isi_misi }}</p>
        </div>
    </div>

    @if($tentang->gambar_visimisi)
        <div class="text-center my-3">
            <img src="{{ asset('storage/' . $tentang->gambar_visimisi) }}" class="img-fluid rounded" width="250">
        </div>
    @endif
@endsection
