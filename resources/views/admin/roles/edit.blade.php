@extends("admin.layouts.app")
@php use Illuminate\Support\Str; @endphp

@section("title", "Edit Role")

@section('content')
<div class="card shadow-sm border-0 rounded-lg">
    <!-- Card Header -->
    <div class="card-header bg-primary text-white border-0 rounded-t-lg px-3 py-2">
        <h5 class="mb-0 font-semibold">Edit Role</h5>
    </div>
    <!-- Card Body -->
    <div class="card-body px-3 py-3">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Role Input -->
            <div class="mb-3">
                <label for="name" class="form-label font-semibold">Nama Role</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $role->name) }}" 
                       class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror" 
                       placeholder="Contoh: admin_galeri" 
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Permissions Checkboxes -->
            <h5 class="font-semibold mb-2">Permission:</h5>
            <div class="row g-2">
                @foreach ($permissions as $permission)
                    <div class="col-md-6 col-12">
                        <label class="flex items-center gap-2 p-2 border rounded cursor-pointer transition hover:bg-indigo-50">
                            <input type="checkbox"
                                   name="permissions[]"
                                   id="perm-{{ $permission->id }}"
                                   value="{{ $permission->id }}"
                                   class="accent-indigo-600 h-4 w-4 shrink-0 rounded focus:ring-2 focus:ring-indigo-500"
                                   {{ in_array($permission->id, $rolePermissions ?? []) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-800">
                                {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                            </span>
                        </label>
                    </div>
                @endforeach
            </div>
            @error('permissions')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror

            <!-- Form Actions -->
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary px-3 py-2 rounded">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary px-3 py-2 rounded shadow">
                    <i class="bi bi-save me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection