@extends("admin.layouts.app")
@php use Illuminate\Support\Str; @endphp

@section("title", "Edit Role")

@section('content')
    <h1>Edit Role</h1>

    <form action="{{ route ('admin.roles.update',$role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Role</label>
            <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="form-control" required>
            @error('permissions')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <h4>Permission:</h4>
            <div class="row g-3">
    @foreach ($permissions as $permission)
        <div class="col-md-6 col-12">
            <div class="form-check p-2 border rounded bg-light">
                <input type="checkbox"
                    name="permissions[]"
                    class="form-check-input"
                    id="perm-{{ $permission->id }}"
                    value="{{ $permission->id }}"
                    {{ in_array($permission->id, $rolePermissions ?? []) ? 'checked' : '' }}>
                <label class="form-check-label" for="perm-{{ $permission->id }}">
                    {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                </label>
            </div>
        </div>
    @endforeach
</div>




        <button type="submit" class="btn btn-primary"> update</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection