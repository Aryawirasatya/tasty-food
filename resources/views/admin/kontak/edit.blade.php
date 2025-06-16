@extends('admin.layouts.app')
@section('title', 'Edit Informasi Kontak')

@section('content')
<h1>Edit Informasi Kontak</h1>

<form action="{{ route('admin.kontak.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $kontak->alamat) }}">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $kontak->email) }}">
    </div>

    <div class="mb-3">
        <label>Telepon</label>
        <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $kontak->telepon) }}">
    </div>

    <div class="mb-3">
        <label>Link Maps</label>
        <input type="url" name="link_maps" class="form-control" value="{{ old('link_maps', $kontak->link_maps) }}">
    </div>

    <div class="mb-3">
        <label>URL Email</label>
        <input type="text" name="url_email" class="form-control" value="{{ old('url_email', $kontak->url_email) }}">
    </div>

    <div class="mb-3">
        <label>URL Telepon</label>
        <input type="text" name="url_telepon" class="form-control" value="{{ old('url_telepon', $kontak->url_telepon) }}">
    </div>

    <div class="mb-3">
        <label>URL Alamat</label>
        <input type="text" name="url_alamat" class="form-control" value="{{ old('url_alamat', $kontak->url_alamat) }}">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
