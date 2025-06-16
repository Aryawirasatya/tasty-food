@extends('admin.layouts.app')
@php use Illuminate\Support\Str; @endphp

@section('title', 'Tambah Role')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Card utama -->
            <div class="card shadow-sm border-0 rounded-3">
                <!-- Header -->
                <div class="card-header bg-gradient-primary text-white border-0 d-flex justify-content-between align-items-center rounded-top-3 p-4">
                    <h4 class="mb-0 fw-semibold">Tambah Role Baru</h4>
  
                </div>
                <!-- Body -->
                <div class="card-body p-4">
                    <form action="{{ route('admin.roles.store') }}" method="POST" class="">


                        @csrf

                        <!-- Nama Role -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold mb-2">Nama Role <span class="text-danger">*</span></label>
                            <input type="text" 
                                name="name" 
                                id="name" 
                                class="form-control form-control-lg rounded-2 @error('name') is-invalid @enderror" 
                                placeholder="Contoh: admin_galeri" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Permissions -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-3">Izin Akses (Permissions)</label>
                            @if($permissions->isEmpty())
                                <div class="alert alert-info p-3 rounded-2">
                                    Belum ada data permission tersedia.
                                </div>
                            @else
                                <div class="row g-3">
                                    @foreach ($permissions as $permission)
                                        @if (!Str::startsWith($permission->name, 'users.') && !Str::startsWith($permission->name, 'roles.'))
                                            <div class="col-md-6 col-12">
                                                <div class="form-check p-3 border rounded-2 hover-shadow bg-light">
                                                    <input type="checkbox"
                                                        name="permissions[]"
                                                        class="form-check-input"
                                                        id="perm-{{ $permission->id }}"
                                                        value="{{ $permission->id }}"
                                                        {{ in_array($permission->id, $rolePermissions ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-medium" for="perm-{{ $permission->id }}">
                                                        {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @error('permissions')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2 fs-5 rounded-3 shadow-lg">
                                Simpan Role
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-light btn-sm fw-medium ">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection