@extends('public.layouts.app')

@section('title', 'Galeri Kami')

@section('content')

<style>
    /* hilangkan ikon default Swiper */
.swiper-button-prev::after,
.swiper-button-next::after { content: none !important; }

/* gaya umum tombol */
.nav-btn{
  position:absolute; top:50%; transform:translateY(-50%);
  width:24px; height:24px; display:grid; place-items:center;
  border-radius:9999px; color:#fff; cursor:pointer; z-index:20;
  background:rgba(17,24,39,.55); /* hitam kebiruan transparan */
  border:1px solid rgba(255,255,255,.18);
  box-shadow:0 8px 24px rgba(0,0,0,.25);
  backdrop-filter:blur(6px);
  transition:background .2s ease, transform .18s ease, box-shadow .2s ease, opacity .2s;
  pointer-events:auto;
}
.swiper-button-prev{ left:12px; }
.swiper-button-next{ right:12px; }

.nav-btn:hover{
  background:rgba(17,24,39,.8);
  transform:translateY(-50%) scale(1.06);
  box-shadow:0 12px 28px rgba(0,0,0,.35);
}
.nav-btn:active{ transform:translateY(-50%) scale(.98); }
.nav-btn:focus-visible{
  outline:0;
  box-shadow:
    0 0 0 3px rgba(255,255,255,.35),
    0 8px 24px rgba(0,0,0,.3);
}

/* responsive: sedikit lebih besar di md+ */
@media (min-width:768px){
  .nav-btn{ width:58px; height:58px; }
  .swiper-button-prev{ left:16px; }
  .swiper-button-next{ right:16px; }
}

/* state disabled (kalau loop:false & ujung) */
.nav-btn[aria-disabled="true"]{
  opacity:.45; pointer-events:none;
}

</style>
    {{-- SECTION: HERO BANNER --}}
    <div class="relative w-full h-[400px] overflow-hidden">
        <img src="{{ asset('assets/Group 70@2x.png') }}"
             class="object-cover w-full h-full transform scale-[1.1]" alt="Hero Galeri">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="absolute top-1/2 left-6 sm:left-10 transform -translate-y-1/2 text-white z-10">
        <div class="w-full text-center md:text-left px-6">
            <h1 class="text-3xl sm:text-5xl font-extrabold">GALERI KAMI</h1>
        </div>
        </div>
    </div>

{{-- SECTION: SLIDER --}}
<div class="bg-white py-12 px-4 sm:px-8">
    <div class="max-w-5xl mx-auto relative">
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

            <!-- Tombol prev -->
            <button type="button" aria-label="Slide sebelumnya"
                    class="nav-btn swiper-button-prev">
            <!-- ikon panah kiri -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                width="24" height="24" fill="currentColor" aria-hidden="true">
                <path d="M15.5 19.5a1 1 0 0 1-.7-.3l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 1 1 1.4 1.4L9.9 12l6.3 6.3a1 1 0 0 1-.7 1.2z"/>
            </svg>
            </button>

            <!-- Tombol next -->
            <button type="button" aria-label="Slide berikutnya"
                    class="nav-btn swiper-button-next">
            <!-- ikon panah kanan -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                width="24" height="24" fill="currentColor" aria-hidden="true">
                <path d="M8.5 19.5a1 1 0 0 1-.7-1.7L14.1 12 7.8 5.7a1 1 0 1 1 1.4-1.4l7 7a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-.7.3z"/>
            </svg>
            </button>

        </div>
    </div>
</div>


    {{-- SECTION: GRID --}}
    <section class="bg-gray-100 py-16 px-4 sm:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-   cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
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
