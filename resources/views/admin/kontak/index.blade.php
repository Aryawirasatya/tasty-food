@extends('admin.layouts.app')
@section('title', 'Informasi Kontak')

@section('content')
    <h1>Informasi Kontak</h1>

    <a href="{{ route('admin.kontak.edit') }}" class="btn btn-warning mb-3">Edit Kontak</a>

    <ul class="list-group">
        <li class="list-group-item"><strong>Alamat:</strong> {{ $kontak->alamat }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $kontak->email }}</li>
        <li class="list-group-item"><strong>Telepon:</strong> {{ $kontak->telepon }}</li>
        <li class="list-group-item"><strong>Link Maps:</strong> {{ $kontak->link_maps }}</li>
        <li class="list-group-item"><strong>URL Email:</strong> {{ $kontak->url_email }}</li>
        <li class="list-group-item"><strong>URL Telepon:</strong> {{ $kontak->url_telepon }}</li>
        <li class="list-group-item"><strong>URL Alamat:</strong> {{ $kontak->url_alamat }}</li>
    </ul>
@endsection
