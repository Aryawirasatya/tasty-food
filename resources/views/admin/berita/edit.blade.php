@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Edit Berita</h1>

    <form method="POST" action="{{ route('admin.berita.update', $berita->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" class="w-full border border-gray-300 p-2 rounded">
            @error('judul')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konten --}}
        <div class="mb-4">
            <label for="konten" class="block text-gray-700 font-semibold mb-2">Konten</label>
            <textarea name="konten" id="konten" rows="6" class="w-full border border-gray-300 p-2 rounded">{{ old('konten', $berita->konten) }}</textarea>
            @error('konten')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label for="gambar" class="block text-gray-700 font-semibold mb-2">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="w-full border border-gray-300 p-2 rounded">
            @if ($berita->gambar)
                <p class="text-sm mt-2">Gambar Saat Ini:</p>
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="h-32 mt-1">
            @endif
            @error('gambar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <div class="flex justify-end">
            <a href="{{ route('admin.berita.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded mr-2">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>
@endsection
