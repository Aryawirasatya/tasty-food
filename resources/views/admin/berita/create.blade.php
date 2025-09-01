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

  <form id="form-berita" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="mb-3">
              <label for="judul" class="form-label fw-semibold">Judul</label>
              <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="form-control" required>
              @error('judul') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
              <label for="konten" class="form-label fw-semibold">Konten</label>
              <textarea name="konten" id="konten" rows="10" class="form-control">{{ old('konten') }}</textarea>
              @error('konten') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <input type="hidden" name="utama" value="0">
            <div class="form-check form-switch mb-4">
              <input class="form-check-input" type="checkbox" id="utama" name="utama" value="1" {{ old('utama') ? 'checked' : '' }}>
              <label class="form-check-label" for="utama">Tandai sebagai <strong>berita utama</strong></label>
            </div>

            <div class="d-flex gap-2">
              <button id="btn-submit" type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Simpan
              </button>
              <a href="{{ route('admin.berita.index') }}" class="btn btn-light border">Batal</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <label for="gambar" class="form-label fw-semibold">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/jpeg,image/png">
            <div class="form-text">JPG/PNG, maks. 2MB.</div>
            @error('gambar') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

            <div class="mt-3">
              <img id="img-preview" src="" class="img-fluid rounded d-none" alt="Preview gambar">
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
  (function () {
    // Preview gambar
    const fileInput = document.getElementById('gambar');
    const preview   = document.getElementById('img-preview');
    if (fileInput && preview) {
      fileInput.addEventListener('change', function () {
        const f = this.files && this.files[0];
        if (f) {
          preview.src = URL.createObjectURL(f);
          preview.classList.remove('d-none');
        } else {
          preview.src = '';
          preview.classList.add('d-none');
        }
      });
    }

    const form     = document.getElementById('form-berita');
    const textarea = document.getElementById('konten');
    const btn      = document.getElementById('btn-submit');

    ClassicEditor.create(textarea, {
      toolbar: ['heading','|','bold','italic','link','bulletedList','numberedList','blockQuote','|','undo','redo']
    }).then(function (ed) {
      ed.ui.view.editable.element.style.minHeight = '280px';

      form.addEventListener('submit', function (e) {
        const html = ed.getData() || '';
        const text = html.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();
        if (!text) {
          e.preventDefault();
          alert('Konten tidak boleh kosong.');
          ed.editing.view.focus();
          return;
        }
        textarea.value = html;           // pastikan data CKEditor terkirim
        btn.disabled = true;             // cegah double submit
      });
    }).catch(console.error);
  })();
</script>
@endsection
