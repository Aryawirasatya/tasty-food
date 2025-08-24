@extends('admin.layouts.app')
@section('title', 'Edit Berita')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Edit Berita</h1>
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

  <form method="POST" action="{{ route('admin.berita.update', $berita->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
      {{-- Kolom kiri: konten utama + opsi + tombol (diseragamkan) --}}
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-body">
            {{-- Judul --}}
            <div class="mb-3">
              <label for="judul" class="form-label fw-semibold">Judul</label>
              <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" class="form-control js-editor" required>
              @error('judul')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            {{-- Konten --}}
            <div class="mb-4">
              <label for="konten" class="form-label fw-semibold">Konten</label>
              <textarea name="konten" id="konten" rows="10" class="form-control js-editor " required>{{ old('konten', $berita->konten) }}</textarea>
              @error('konten')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            {{-- Opsi: berita utama --}}
            <div class="form-check form-switch mb-4">
              <input class="form-check-input" type="checkbox" id="utama" name="utama" {{ old('utama', $berita->utama) ? 'checked' : '' }}>
              <label class="form-check-label" for="utama">Tandai sebagai <strong>berita utama</strong></label>
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-between">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Update
              </button>
              <a href="{{ route('admin.berita.index') }}" class="btn btn-light border">Batal</a>
            </div>
          </div>
        </div>
      </div>

      {{-- Kolom kanan: gambar (sama seperti tambah, tapi tampilkan gambar saat ini) --}}
      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <label for="gambar" class="form-label fw-semibold">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/png,image/jpeg">
            <div class="form-text">Upload untuk mengganti gambar. Format: JPG/PNG, maks. 2MB.</div>
            @error('gambar')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            <div class="mt-3">
              @if ($berita->gambar)
                <img id="img-current" src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid rounded mb-2" alt="Gambar saat ini">
              @endif
              <img id="img-preview" src="" class="img-fluid rounded d-none" alt="Preview gambar baru">
            </div>
          </div>
        </div>
      </div>
    </div> {{-- /row --}}
  </form>
</div>

{{-- Preview gambar sederhana (inline agar konsisten) --}}
<script>
  (function () {
    const input   = document.getElementById('gambar');
    const preview = document.getElementById('img-preview');
    const current = document.getElementById('img-current');

    if (!input || !preview) return;

    input.addEventListener('change', function () {
      const file = this.files && this.files[0];
      if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
        if (current) current.classList.add('d-none');
      } else {
        preview.src = '';
        preview.classList.add('d-none');
        if (current) current.classList.remove('d-none');
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
        ed.ui.view.editable.element.style.minHeight = '280px';
      }).catch(console.error);
    });
  });
</script>

@endsection
