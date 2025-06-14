@extends('admin.layouts.app')
@section('title', 'Data Role')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Role</h1>
            @if(auth()->user()?->role?->permissions->contains('name', 'roles.create'))
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Tambah Role</a>
        @endif


    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                    <td>{{ $index  + 1 }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.roles.destroy',$role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('hapus role ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Hapus</button>
                        </form>


                    </td>
                </tr>
            @empty
                <tr><td colspan="3">belum ada role</td></tr>
            @endforelse
        </tbody>
    </table>
    @endsection