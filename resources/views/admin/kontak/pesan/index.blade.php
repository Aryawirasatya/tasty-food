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


                            <form action="{{ route('admin.kontak-pesan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
