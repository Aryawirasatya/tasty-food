@extends('public.layouts.app')

@section('title', $berita->judul)

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $berita->judul }}</h1>
        <p class="text-sm text-gray-500 mb-6">
            <i class="bi bi-calendar-event"></i> {{ $berita->created_at->format('d M Y') }}
        </p>

        @if ($berita->gambar)
            <img 
                src="{{ asset('storage/' . $berita->gambar) }}" 
                alt="{{ $berita->judul }}" 
                class="w-full h-[400px] object-cover rounded-2xl shadow mb-6"
            >
        @endif

        <article class="prose max-w-none mb-8">
            {!! $berita->konten !!}
        </article>

        <a href="{{ route('berita.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 transition">
            <i class="bi bi-arrow-left mr-2"></i> Kembali ke Daftar Berita
        </a>
    </div>
</section>
@endsection
