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
                            <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                method="POST"
                                class="d-inline js-confirm-delete"
                                data-title="Hapus Role"
                                data-text="Yakin ingin menghapus <b>{{ e($role->name) }}</b>?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
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
    <script>
        (function () {
  // Intersep submit untuk semua form .js-confirm-delete
  document.addEventListener('submit', function (e) {
    const form = e.target.closest('.js-confirm-delete');
    if (!form) return;

    e.preventDefault(); // tahan submit

    const title = form.dataset.title || 'Hapus data?';
    const html  = form.dataset.text  || 'Tindakan ini tidak bisa dibatalkan.';

    // Jika SweetAlert2 tidak ada, fallback ke confirm()
    if (typeof Swal === 'undefined') {
      if (confirm((title + '\n\n' + html.replace(/<[^>]+>/g,'')).trim())) {
        form.submit();
      }
      return;
    }

    Swal.fire({
      title,
      html,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal',
      reverseButtons: true,
      focusCancel: true
    }).then(r => { if (r.isConfirmed) form.submit(); });
  }, false);
})();

    </script>
@endsection
