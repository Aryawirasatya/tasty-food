@extends('admin.layouts.app')
@section('title', 'Manajemen User')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar User</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Superadmin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name ?? '-' }}</td>
                    <td>{{ $user->isSuperAdmin() ? 'Ya' : 'Tidak' }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @if(auth()->id() != $user->id)
                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                    method="POST" class="d-inline js-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="btn btn-danger btn-sm js-delete-btn"
                                        data-title="Hapus User"
                                        data-text="Yakin ingin menghapus <b>{{ e($user->name) }}</b>?">
                                Hapus
                                </button>
                            </form>
                        @endif


                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada user.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
