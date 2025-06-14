@extends('admin.layouts.app')

@section('title', 'Tambah Role')

@section('content')
    <h1>Tambah Role Baru</h1>

    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Role</label>

            <input type="text" name="name" id="name" class="form-control" required>
            @error('permissions')
                <div class="text-danger">{{ $message }}</div>
                
            @enderror
        </div>

        <h4>Permission:</h4>
        @foreach ($permissions as $permission)
        <div>
            <label>
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                {{ $permission->name }}
            </label>
        </div>
    @endforeach

        <button type="submit" class="btn btn-primary">Simpan Role</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
    @endsection