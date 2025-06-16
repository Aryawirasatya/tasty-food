<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Tentang Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h2>Edit Tentang Kami</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.tentang.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $tentang->judul ?? '') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $tentang->deskripsi ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Tambahan</label>
                <textarea name="deskripsi_lanjutan" class="form-control">{{ old('deskripsi_lanjutan', $tentang->deskripsi_lanjutan ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Profil</label>
                <input type="file" name="gambar_profil" class="form-control">
                @if (!empty($tentang->gambar_profil))
                    <img src="{{ asset('storage/' . $tentang->gambar_profil) }}" width="100" class="mt-2">
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Judul Visi</label>
                <input type="text" name="judul_visi" class="form-control" value="{{ old('judul_visi', $tentang->judul_visi ?? '') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Visi</label>
                <textarea name="isi_visi" class="form-control">{{ old('isi_visi', $tentang->isi_visi ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul Misi</label>
                <input type="text" name="judul_misi" class="form-control" value="{{ old('judul_misi', $tentang->judul_misi ?? '') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Misi</label>
                <textarea name="isi_misi" class="form-control">{{ old('isi_misi', $tentang->isi_misi ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Visi Misi</label>
                <input type="file" name="gambar_visimisi" class="form-control">
                @if (!empty($tentang->gambar_visimisi))
                    <img src="{{ asset('storage/' . $tentang->gambar_visimisi) }}" width="100" class="mt-2">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector("form").addEventListener("submit", function(e) {
                console.log("Form disubmit");
            });
        });
    </script>
</body>
</html>
