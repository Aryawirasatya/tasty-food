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
 
</div>



        <button class="btn btn-success">Simpan</button>
    </form>
@endsection
