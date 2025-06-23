@extends('public.layouts.app')

@section('title', 'Home')
@section('page', 'home')

@section('content')

<!-- HERO SECTION -->
<section class="relative bg-[#f9f9f9] min-h-screen flex flex-col justify-center -mt-[68px] pt-[68px] overflow-hidden">
    <div class="absolute top-0 right-0 z-0 hidden md:block">
        <img src="{{ asset('assets/img-4-2000x2000.png') }}"
             alt="Healthy Tasty Food"
             class="max-w-[550px] lg:max-w-[750px] w-full h-auto object-cover rounded-full translate-x-[20%] -translate-y-[20%] drop-shadow-lg">
    </div>

    <div class="relative z-10 max-w-7xl mx-auto w-full px-4 sm:px-8 md:px-10  pl-8 md:pl-16">
        <div class="flex flex-col-reverse md:flex-row items-center justify-between py-12 gap-8">
            <div class="w-full md:w-1/2 md:pr-12 pl-2 md:pl-12">
                <div class="border-t-2 border-black w-12 mb-6"></div>
                <h2 class="text-4xl md:text-5xl font-light text-black leading-tight tracking-wide">
                    HEALTHY
                </h2>
                <h1 class="text-5xl md:text-6xl font-extrabold text-black leading-tight mb-6">
                    TASTY FOOD
                </h1>
                <p class="text-gray-700 text-base md:text-lg leading-relaxed mb-8 max-w-md">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. ...
                </p>
                <a href="{{ route('public.tentang') }}"
                   class="inline-block bg-black text-white font-bold uppercase px-6 py-3 rounded-md hover:bg-gray-800 transition">
                    Tentang Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: Tentang Kami -->
<section class="py-16 bg-white border-t border-gray-200">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tentang Kami</h2>
        <p class="text-gray-600 leading-relaxed">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus, nostrum sunt! Dicta architecto incidunt labore odio sit, tempore consectetur aperiam ipsam ab tempora voluptate laudantium omnis debitis repellat laboriosam totam!
        </p>
    </div>
</section>

<!-- FEATURES SECTION -->
<section class="relative py-20 bg-white overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/Group 70.png') }}" alt="Background" class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-white/0"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-28 gap-x-10">
            @for($i = 1; $i <= 4; $i++)
                <div class="relative bg-white rounded-2xl shadow-lg pt-20 pb-6 px-4 text-center hover:shadow-xl transition duration-300">
                    <div class="absolute -top-24 left-1/2 transform -translate-x-1/2 w-40 h-40 sm:w-44 sm:h-44 lg:w-48 lg:h-48">
                        <img src="{{ asset('assets/img-1.png') }}" alt="Fitur {{ $i }}"
                             class="w-full h-full rounded-full object-cover">
                    </div>
                    <h3 class="mt-2 font-bold text-xl text-gray-900">Judul Fitur {{ $i }}</h3>
                    <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis soluta eos, reiciendis officiis perferendis pariatur voluptatum tempora sint ut officia inventore ipsum id eveniet numquam aperiam ad voluptate. Beatae, fugiat!
                    </p>
                </div>
            @endfor
        </div>
    </div>
</section>


<!-- BERITA KAMI SECTION -->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">BERITA KAMI</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @if(isset($featuredBerita) && $featuredBerita)
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-md hover:shadow-lg overflow-hidden flex flex-col">
                    @if($featuredBerita->gambar)
                        <img src="{{ asset('storage/' . $featuredBerita->gambar) }}"
                             alt="{{ $featuredBerita->judul }}"
                             class="w-full h-80 object-cover">
                    @else
                        <div class="w-full h-80 bg-gray-300"></div>
                    @endif

                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 leading-snug mb-3">
                            <a href="{{ route('berita.show', $featuredBerita->id) }}" class="hover:text-orange-500">
                                {{ $featuredBerita->judul }}
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 flex-grow">
                            {{ \Illuminate\Support\Str::limit(strip_tags($featuredBerita->konten), 300, '...') }}
                        </p>
                        <div class="flex justify-between items-center mt-auto">
                            <a href="{{ route('berita.show', $featuredBerita->id) }}" class="text-sm text-yellow-500 hover:underline">
                                Baca selengkapnya
                            </a>
                            <span class="text-xl text-gray-400">•••</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($othersBerita->take(4) as $item)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg overflow-hidden flex flex-col">
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                 alt="{{ $item->judul }}"
                                 class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-300"></div>
                        @endif

                        <div class="p-4 flex flex-col flex-1">
                            <h4 class="text-md font-semibold text-gray-900 mb-1 leading-tight line-clamp-2">
                                <a href="{{ route('berita.show', $item->id) }}" class="hover:text-orange-500">
                                    {{ $item->judul }}
                                </a>
                            </h4>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 100, '...') }}
                            </p>
                            <div class="flex justify-between items-center mt-auto">
                                <a href="{{ route('berita.show', $item->id) }}" class="text-sm text-yellow-500 hover:underline">
                                    Baca selengkapnya
                                </a>
                                <span class="text-xl text-gray-400">•••</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- GALERI KAMI SECTION -->
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Galeri Kami</h2>

        <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            @foreach($galeri as $item)
                <div class="w-full aspect-square overflow-hidden rounded-xl shadow-md">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                             alt="{{ $item->judul }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full bg-gray-200"></div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            <a href="{{ route('public.galeri') ?? route('galeri.index') }}"
               class="inline-block bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
                Lihat Lebih Banyak
            </a>
        </div>
    </div>
</section>

@endsection
