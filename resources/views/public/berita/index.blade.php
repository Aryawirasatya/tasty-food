@extends('public.layouts.app')

@section('title', 'Berita Kami')

@section('content')
{{-- HERO SECTION (opsional): gambar hero --}}
<section class="relative">
    <img src="{{ asset('assets/group 70@2x.png') }}" alt="Berita Hero"
         class="w-full h-[450px] object-cover brightness-50">
    <div class="absolute inset-0 flex items-center justify-start px-8 md:px-16">
        <h1 class="text-white text-4xl md:text-5xl font-bold">BERITA KAMI</h1>
    </div>
</section>


{{-- Featured hanya di halaman pertama --}}
@if(isset($featured) && $featured)
<section class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 flex flex-col md:flex-row items-center gap-8">
        {{-- Gambar featured --}}
        @if($featured->gambar)
            <div class="w-full md:w-1/2">
                <img 
                    src="{{ asset('storage/' . $featured->gambar) }}" 
                    alt="{{ $featured->judul }}" 
                    class="w-full h-[300px] md:h-[400px] object-cover rounded-2xl shadow-lg"
                >
            </div>
        @else
            <div class="w-full md:w-1/2">
                <div class="w-full h-[300px] md:h-[400px] bg-gray-200 rounded-2xl shadow-lg"></div>
            </div>
        @endif

        {{-- Teks featured --}}
        <div class="w-full md:w-1/2">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                {{ $featured->judul }}
            </h2>
            <p class="text-gray-600 mb-6">
                {{ \Illuminate\Support\Str::limit(strip_tags($featured->konten), 400, '...') }}
            </p>
            {{-- Link by ID --}}
            <a 
                href="{{ route('berita.show', $featured->id) }}" 
                class="inline-block bg-black text-white px-6 py-3 mt-5 hover:bg-gray-800 transition"
            >
                BACA SELENGKAPNYA
            </a>
        </div>
    </div>
</section>
@endif

{{-- Berita Lainnya --}}
<section class="py-12 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="w-full text-center md:text-left">
            <h3 class="text-2xl font-bold text-gray-800 mb-8">BERITA LAINNYA</h3>
    </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @if(isset($others))
                {{-- Halaman pertama: loop others --}}
                @foreach($others as $item)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col">
                        {{-- Gambar atas --}}
                        @if($item->gambar)
                            <img 
                                src="{{ asset('storage/' . $item->gambar) }}" 
                                alt="{{ $item->judul }}" 
                                class="w-full h-44 object-cover"
                            >
                        @else
                            <div class="w-full h-44 bg-gray-200"></div>
                        @endif
                        {{-- Body --}}
                        <div class="p-4 flex flex-col flex-1">
                            {{-- Judul uppercase clamp 1 line --}}
                            <h3 class="text-base font-bold text-gray-800 uppercase line-clamp-1">
                                <a href="{{ route('berita.show', $item->id) }}" class="hover:text-orange-500 transition-colors">
                                    {{ $item->judul }}
                                </a>
                            </h3>

                            {{-- Deskripsi clamp 3 lines --}}
                            <p class="text-sm text-gray-600 mt-2 line-clamp-3 flex-grow">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 200, '...') }}
                            </p>

                            {{-- Footer: link baca & ikon --}}
                            <div class="mt-4 flex items-center justify-between">
                                <a 
                                    href="{{ route('berita.show', $item->id) }}" 
                                    class="text-sm text-orange-500 hover:underline font-medium"
                                >
                                    Baca selengkapnya
                                </a>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                      <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm4 0a2 2 0 114 0 2 2 0 01-4 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Halaman >1: loop paginator $berita --}}
                @foreach($berita as $item)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col">
                        @if($item->gambar)
                            <img 
                                src="{{ asset('storage/' . $item->gambar) }}" 
                                alt="{{ $item->judul }}" 
                                class="w-full h-44 object-cover"
                            >
                        @else
                            <div class="w-full h-44 bg-gray-200"></div>
                        @endif
                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="text-base font-bold text-gray-800 uppercase line-clamp-1">
                                <a href="{{ route('berita.show', $item->id) }}" class="hover:text-orange-500 transition-colors">
                                    {{ $item->judul }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-3 flex-grow">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 100, '...') }}
                            </p>
                            <div class="mt-4 flex items-center justify-between">
                                <a 
                                    href="{{ route('berita.show', $item->id) }}" 
                                    class="text-sm text-orange-500 hover:underline font-medium"
                                >
                                    Baca selengkapnya
                                </a>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                      <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm4 0a2 2 0 114 0 2 2 0 01-4 0z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            @if(isset($others))
                {{ $others->onEachSide(1)->links() }}
            @else
                {{ $berita->onEachSide(1)->links() }}
            @endif
        </div>
    </div>
</section>
@endsection
