@extends('admin.layouts.app')
@section('title', 'Tambah Berita')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Tambah Berita</h1>
    <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">
      <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <div class="fw-semibold mb-2">Periksa kembali inputan kamu:</div>
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">
      {{-- Kolom kiri: konten utama --}}
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-body">
            {{-- Judul --}}
            <div class="mb-3">
              <label for="judul" class="form-label fw-semibold">Judul</label>
              <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="form-control js-editor" required>
              @error('judul')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            {{-- Konten --}}
            <div class="mb-4">
              <label for="konten" class="form-label fw-semibold">Konten</label>
              <textarea name="konten" id="konten" rows="10" class="form-control js-editor" required>{{ old('konten') }}</textarea>
              @error('konten')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            {{-- Opsi & tombol --}}
            <div class="form-check form-switch mb-4">
              <input class="form-check-input" type="checkbox" id="utama" name="utama" {{ old('utama') ? 'checked' : '' }}>
              <label class="form-check-label" for="utama">Tandai sebagai <strong>berita utama</strong></label>
            </div>

            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Simpan
              </button>
              <a href="{{ route('admin.berita.index') }}" class="btn btn-light border">Batal</a>
            </div>
          </div>
        </div>
      </div>

      {{-- Kolom kanan: gambar --}}
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <label for="gambar" class="form-label fw-semibold">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/png,image/jpeg">
            <div class="form-text">Format: JPG/PNG, maks. 2MB.</div>
            @error('gambar')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            <div class="mt-3">
              <img id="img-preview" src="" class="img-fluid rounded d-none" alt="Preview gambar">
            </div>
          </div>
        </div>
      </div>
    </div> {{-- /row --}}
  </form>
</div>

{{-- Preview gambar sederhana (inline agar tidak tergantung @stack) --}}
<script>
  (function () {
    const input = document.getElementById('gambar');
    const preview = document.getElementById('img-preview');
    if (!input || !preview) return;

    input.addEventListener('change', function () {
      const file = this.files && this.files[0];
      if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
      } else {
        preview.src = '';
        preview.classList.add('d-none');
      }
    });
  })();
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.js-editor').forEach(function (el) {
      ClassicEditor.create(el, {
        toolbar: [
          'heading','|','bold','italic','link',
          'bulletedList','numberedList','blockQuote','|',
          'undo','redo'
        ]
      }).then(ed => {
        // opsional: tinggi minimum
        ed.ui.view.editable.element.style.minHeight = '280px';
      }).catch(console.error);
    });
  });
</script>

@endsection
