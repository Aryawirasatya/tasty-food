@extends('admin.layouts.app')
@section('title', 'Tambah Galeri')

@section('content')
    <h1>Tambah Galeri</h1>
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}">
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
            <div class="mt-4">
    <label class="inline-flex items-center">
        <input type="hidden" name="is_slider" value="0"> {{-- WAJIB --}}
        <input type="checkbox" name="is_slider" value="1"
            class="form-checkbox"
            {{ old('is_slider', $galeri->is_slider ?? false) ? 'checked' : '' }}>
        <span class="ml-2">Tampilkan di slider</span>
    </label>
</div>



        <button class="btn btn-success">Simpan</button>
    </form>
@endsection
