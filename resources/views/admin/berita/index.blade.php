@extends('admin.layouts.app')
@section('title', 'Daftar Berita')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Berita</h1>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">Tambah Berita</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($berita->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Thumbnail</th>
                    <th>Utama</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($berita as $item)
                <tr>
                    <td>{{ $item->judul }}</td>
                    <td>
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" width="100">
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>
                    <td>
                        @if($item->utama)
                            <span class="badge bg-success">YA</span>
                        @else
                            <span class="badge bg-secondary">TIDAK</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('admin.berita.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">Belum ada berita.</div>
    @endif
</div>
@endsection
