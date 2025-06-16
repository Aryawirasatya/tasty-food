@extends('admin.layouts.app')
@section('title', 'Data Role')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Role</h1>

        {{-- Tombol Tambah Role hanya untuk superadmin atau admin yang punya permission --}}
        @if(auth()->user()?->isSuperAdmin() || auth()->user()?->role?->permissions->contains('name', 'roles.create'))
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Tambah Role</a>
        @endif
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $index => $role)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @if($role->name === 'superadmin')
                            <span class="text-muted">Aksi tidak tersedia</span>
                        @else
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus role ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada role</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
