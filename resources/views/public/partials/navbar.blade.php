<nav
  x-data="{ open: false }"
  class="absolute top-0 left-0 w-full bg-transparent text-white z-50"
>
  <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
    {{-- Logo / Brand --}}
    <a href="{{ route('home') }}" class="text-2xl font-extrabold uppercase md:px-10 px-0">
      TASTY FOOD
    </a>

    {{-- Hamburger (mobile) --}}
    <button @click="open = !open" class="md:hidden focus:outline-none">
      <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
      <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
           viewBox="0 0 24 24" stroke="currentColor" x-cloak>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>

    {{-- Menu Desktop --}}
    <ul class="hidden md:flex space-x-8 text-sm font-medium uppercase px-16">
      <li><a href="{{ route('home') }}" class="hover:text-red-500">HOME</a></li>
      <li><a href="{{ route('public.tentang') }}" class="hover:text-red-500">TENTANG</a></li>
      <li><a href="{{ route('berita.index') }}" class="hover:text-red-500">BERITA</a></li>
      <li><a href="{{ route('public.galeri') }}" class="hover:text-red-500">GALERI</a></li>
      <li><a href="{{ route('kontak') }}" class="hover:text-red-500">KONTAK</a></li>
    </ul>
  </div>

  {{-- Menu Mobile --}}
  <div
    x-show="open"
    x-transition:enter="transition ease-out duration-310"
    x-transition:leave="transition ease-in duration-210"
    class="md:hidden px-6 pb-4text-white bg-white"
  >
    <ul class="flex flex-col space-y-4 text-black font-medium uppercase">
      <li><a @click="open = false" href="{{ route('home') }}" class="hover:text-red-500 pt">HOME</a></li>
      <li><a @click="open = false" href="{{ route('public.tentang') }}" class="hover:text-red-500">TENTANG</a></li>
      <li><a @click="open = false" href="{{ route('berita.index') }}" class="hover:text-red-500">BERITA</a></li>
      <li><a @click="open = false" href="{{ route('public.galeri') }}" class="hover:text-red-500">GALERI</a></li>
      <li><a @click="open = false" href="{{ route('kontak') }}" class="hover:text-red-500">KONTAK</a></li>
    </ul>
  </div>
</nav>
