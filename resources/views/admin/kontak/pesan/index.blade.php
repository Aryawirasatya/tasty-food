@extends('admin.layouts.app')
@section('title', 'Daftar Pesan Kontak')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Pesan Kontak</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($pesan->isEmpty())
        <div class="alert alert-info">Belum ada pesan dari pengunjung.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Subjek</th>
                    <th>Dikirim Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesan as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.kontak-pesan.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                             <form action="{{ route('admin.kontak-pesan.destroy', $item->id) }}"
                                method="POST" class="d-inline js-delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        class="btn btn-danger btn-sm js-delete-btn"
                                        data-title="{{ $item->subject ?? 'Pesan dari ' . ($item->nama ?? '-') }}">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                </button>
                            </form>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
