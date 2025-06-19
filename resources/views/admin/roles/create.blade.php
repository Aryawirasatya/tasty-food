@extends('admin.layouts.app')
@php use Illuminate\Support\Str; @endphp

@section('title', 'Tambah Role')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Kartu Utama -->
            <div class="card shadow-sm border-0 rounded-lg">
                <!-- Header -->
                <div class="card-header bg-primary text-white border-0 rounded-t-lg px-3 py-2">
                    <h5 class="mb-0 font-semibold">Tambah Role Baru</h5>
                </div>

                <!-- Body Form -->
                <div class="card-body px-3 py-3">
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf

                        <!-- Nama Role -->
                        <div class="mb-3">
                            <label for="name" class="form-label font-semibold">Nama Role <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                   placeholder="Contoh: admin_galeri"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Permissions -->
                        <div class="mb-3">
                            <label class="form-label font-semibold">Izin Akses (Permissions)</label>

                            @if ($groupedPermissions->flatten()->isEmpty())
                                <div class="alert alert-info rounded mt-1">
                                    Belum ada data permission tersedia.
                                </div>
                            @else
                                @foreach ($groupedPermissions as $fitur => $permissions)
                                    <div class="mb-3 p-2 border rounded bg-light">
                                        <h6 class="font-bold text-capitalize mb-2 border-b pb-1">
                                            {{ str_replace('_', ' ', $fitur) }}
                                        </h6>
                                        <div class="row g-2">
                                            @foreach ($permissions as $permission)
                                                <div class="col-md-6 col-12">
                                                    <label class="flex items-center gap-2 p-2 border rounded cursor-pointer transition hover:bg-indigo-50">
                                                        <input type="checkbox"
                                                               name="permissions[]"
                                                               id="perm-{{ $permission->id }}"
                                                               value="{{ $permission->id }}"
                                                               class="accent-indigo-600 h-4 w-4 shrink-0 rounded focus:ring-2 focus:ring-indigo-500">
                                                        <span class="text-sm font-medium text-gray-800">
                                                            {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                                        </span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            @error('permissions')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary px-3 py-2 rounded">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary px-3 py-2 rounded shadow">
                                <i class="bi bi-save me-1"></i> Simpan Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Kartu Utama -->
        </div>
    </div>
</div>
@endsection
