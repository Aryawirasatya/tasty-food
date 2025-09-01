@extends('admin.layouts.app')
@section('title', 'Galeri')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Galeri</h1>
    <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">Tambah Galeri</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($galeri as $item)
        <tr>
            <td>{{ $item->judul }}</td>
            <td><img src="{{ asset('storage/' . $item->gambar) }}" width="100"></td>
            <td>
                <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.galeri.destroy', $item->id) }}"
                        method="POST"
                        class="d-inline js-confirm-delete"
                        data-title="Hapus Berita"
                        data-text="Yakin ingin menghapus <b>{{ Str::limit($item->judul, 60) }}</b>?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
