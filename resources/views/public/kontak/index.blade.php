@extends('public.layouts.app')
@section('title', 'Kontak Kami')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Kontak Kami</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h4>Informasi Kontak</h4>
            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Alamat:</strong> {{ $kontak->alamat }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $kontak->email }}</li>
                <li class="list-group-item"><strong>Telepon:</strong> {{ $kontak->telepon }}</li>
            </ul>

            @if($kontak->link_maps)
                <iframe src="{{ $kontak->link_maps }}" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            @endif
        </div>

        <div class="col-md-6">
            <h4>Kirim Pesan</h4>
            <form action="{{ route('kontak.kirim') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Subjek</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Pesan</label>
                    <textarea name="pesan" rows="5" class="form-control" required></textarea>
                </div>
                <button class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>
@endsection
