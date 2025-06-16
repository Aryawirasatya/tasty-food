@extends('admin.layouts.app')
@section('title', 'Detail Pesan')

@section('content')
<div class="container">
    <a href="{{ route('admin.kontak-pesan.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <h2 class="mb-3">{{ $kontak_pesan->subject }}</h2>

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Nama:</strong> {{ $kontak_pesan->nama }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $kontak_pesan->email }}</li>
        <li class="list-group-item"><strong>Dikirim:</strong> {{ $kontak_pesan->created_at->format('d M Y H:i') }}</li>
    </ul>

    <div class="card">
        <div class="card-header"><strong>Isi Pesan</strong></div>
        <div class="card-body">
            {!! nl2br(e($kontak_pesan->pesan)) !!}
        </div>
    </div>

    <form action="{{ route('admin.kontak-pesan.destroy', $kontak_pesan->id) }}" method="POST" class="mt-3" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Hapus Pesan</button>
        <a href="{{ route('admin.kontak-pesan.index') }}" class="btn btn-secondary">Batal</a>

    </form>
</div>
@endsection
