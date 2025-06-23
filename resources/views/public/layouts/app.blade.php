<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tasty Food')</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('assets/public/images/favicon.png') }}">

    {{-- Tailwind CSS & JS via Vite --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-Cis5uVHU.css') }}">
<link rel="stylesheet" href="{{ asset('build/assets/app-v-BeIiLc.css') }}">
<script src="{{ asset('build/assets/app-kSXiIrfw.js') }}" defer></script>

    <style>
    [x-cloak] { display: none !important; }

    </style>

    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body data-page="{{ request()->routeIs('home') ? 'home' : 'other' }}">

    {{-- Navbar --}}

    {{-- Navbar khusus untuk halaman home / default --}}
    @if (request()->is('/'))
        @include('public.partials.navbar_home')
    @else
        @include('public.partials.navbar')
    @endif

    {{-- Konten utama --}}
    <main class="">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('public.partials.footer')  

    {{-- Inisialisasi Swiper jika ada komponen swiper di halaman --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper !== 'undefined') {
                new Swiper(".mySwiper", {
                    loop: true,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            }
        });
    </script>
</body>
</html>
