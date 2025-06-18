@extends('public.layouts.app')

@section('title', 'Galeri Kami')

@section('content')
    {{-- SECTION: HERO BANNER --}}
    <div class="relative w-full h-[400px] overflow-hidden">
        <img src="{{ asset('assets/group 70@2x.png') }}"
             class="object-cover w-full h-full transform scale-[1.1]" alt="Hero Galeri">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="absolute top-1/2 left-6 sm:left-10 transform -translate-y-1/2 text-white z-10">
            <h1 class="text-3xl sm:text-5xl font-extrabold">GALERI KAMI</h1>
        </div>
    </div>

    {{-- SECTION: SLIDER --}}
    <div class="bg-white py-12 px-4 sm:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($sliderImages as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $image->gambar) }}"
                                 alt="Slider"
                                 class="w-full h-[300px] object-cover rounded-xl">
                        </div>
                    @endforeach
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>

    {{-- SECTION: GRID --}}
    <section class="bg-gray-100 py-16 px-4 sm:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($galeris as $galeri)
                    <div class="overflow-hidden rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}"
                             class="w-full h-60 object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            @if ($galeris->hasPages())
                <div class="mt-12 flex justify-center">
                    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center space-x-1">
                        {{-- Previous Page Link --}}
                        @if ($galeris->onFirstPage())
                            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">‹</span>
                        @else
                            <a href="{{ $galeris->previousPageUrl() }}"
                               class="px-3 py-1 bg-white border rounded hover:bg-gray-100">‹</a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($galeris->getUrlRange(1, $galeris->lastPage()) as $page => $url)
                            @if ($page == $galeris->currentPage())
                                <span class="px-3 py-1 bg-red-500 text-white font-bold rounded">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                   class="px-3 py-1 bg-white border rounded hover:bg-gray-100">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($galeris->hasMorePages())
                            <a href="{{ $galeris->nextPageUrl() }}"
                               class="px-3 py-1 bg-white border rounded hover:bg-gray-100">›</a>
                        @else
                            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">›</span>
                        @endif
                    </nav>
                </div>
            @endif
        </div>
    </section>
@endsection
