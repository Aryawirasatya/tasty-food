@extends('admin.layouts.app')
@section('title', 'Edit Galeri')

@section('content')
    <h1>Edit Galeri</h1>
    <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri->judul) }}">
        </div>

        <div class="mb-3">
            <label>Gambar Baru (kosongkan jika tidak diubah)</label>
            <input type="file" name="gambar" class="form-control">
            @if ($galeri->gambar)
                <img src="{{ asset('storage/' . $galeri->gambar) }}" width="120" class="mt-2">
            @endif
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
