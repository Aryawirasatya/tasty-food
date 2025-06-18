@extends('public.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-[400px] flex items-center justify-start text-white px-10"
    style="background-image: url('{{ asset('assets/group 70@2x.png') }}');">
        <h1 class="text-4xl font-bold z-10">TENTANG KAMI</h1>
</section>


    <!-- Profil Section -->
    <section class="py-16 px-4 max-w-6xl mx-auto">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div>
                <h2 class="text-2xl font-semibold mb-4">{{ $tentang->judul }}</h2>
                <p class="mb-4">{!! nl2br(e($tentang->deskripsi)) !!}</p>
                <p>{!! nl2br(e($tentang->deskripsi_lanjutan)) !!}</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @if ($tentang->gambar_profil)
                    <img src="{{ asset('storage/' . $tentang->gambar_profil) }}" class="rounded-lg shadow-md"
                        alt="Gambar Profil">
                @endif
                @if ($tentang->gambar_profil_2)
                    <img src="{{ asset('storage/' . $tentang->gambar_profil_2) }}" class="rounded-lg shadow-md"
                        alt="Gambar Profil 2">
                @endif
            </div>
        </div>
    </section>

    <!-- Visi Section -->
    <section class="py-16 bg-gray-50 px-4">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 items-center">
            <div class="grid grid-cols-2 gap-4">
                @if ($tentang->gambar_visimisi)
                    <img src="{{ asset('storage/' . $tentang->gambar_visimisi) }}" class="rounded-lg shadow-md"
                        alt="Gambar Visi">
                @endif
                @if ($tentang->gambar_visimisi_2)
                    <img src="{{ asset('storage/' . $tentang->gambar_visimisi_2) }}" class="rounded-lg shadow-md"
                        alt="Gambar Visi 2">
                @endif
            </div>
            <div>
                <h2 class="text-2xl font-semibold mb-4">{{ $tentang->judul_visi }}</h2>
                <p>{!! nl2br(e($tentang->isi_visi)) !!}</p>
            </div>
        </div>
    </section>

    <!-- Misi Section -->
    <section class="py-16 px-4 max-w-6xl mx-auto">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div>
                <h2 class="text-2xl font-semibold mb-4">{{ $tentang->judul_misi }}</h2>
                <p>{!! nl2br(e($tentang->isi_misi)) !!}</p>
            </div>
            <div>
                @if ($tentang->gambar_misi_1)
                    <img src="{{ asset('storage/' . $tentang->gambar_misi_1) }}" class="rounded-lg shadow-md"
                        alt="Gambar Misi">
                @endif
            </div>
        </div>
    </section>
@endsection
