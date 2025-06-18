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
        <div class="mt-4">
    <label class="inline-flex items-center">
        <input type="hidden" name="is_slider" value="0"> {{-- WAJIB --}}
        <input type="checkbox" name="is_slider" value="1"
            class="form-checkbox"
            {{ old('is_slider', $galeri->is_slider ?? false) ? 'checked' : '' }}>
        <span class="ml-2">Tampilkan di slider</span>
    </label>
</div>



        <button class="btn btn-primary">Update</button>
    </form>
@endsection
