@extends('admin.layouts.app')
@section('title', 'Daftar Berita')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Berita</h1>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($berita->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Judul</th>
                        <th>utama</th>
                        <th>Konten</th>
                        <th style="width: 120px;">Gambar</th>
                        <th style="width: 120px;">Tanggal</th>
                        <th style="width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($berita as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        
                        <td>
                            {{ $item->judul }}
                            
                        </td>
                        <td>@if($item->utama)
                                <span class="badge bg-success ms-2 text-white">UTAMA</span>
                            @endif
                        </td>

                            <td>{{ Str::limit(strip_tags($item->konten), 60) }}</td>

                            <td>
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar" width="100">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            <td>{{ $item->created_at->format('d-m-Y') }}</td>

                            <td>
                                <a href="{{ route('admin.berita.show', $item->id) }}" class="btn btn-info btn-sm mb-1">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-warning btn-sm mb-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.berita.destroy', $item->id) }}"
                                    method="POST" class="d-inline js-delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            class="btn btn-danger btn-sm js-delete-btn"
                                            data-title="{{ Str::limit($item->judul, 60) }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center">Belum ada data berita yang tersedia.</div>
    @endif
</div>
@endsection
