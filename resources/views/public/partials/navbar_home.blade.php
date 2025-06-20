<nav x-data="{ open: false }" class="absolute top-0 left-0 w-full bg-transparent text-white z-50">
  <div class="max-w-7xl mx-auto pl-8 md:pl-16 py-6 flex items-center relative">

    {{-- Logo / Brand --}}
    <a href="{{ route('home') }}" class="text-2xl text-black font-extrabold uppercase ml-12">
      TASTY FOOD
    </a>

    {{-- Menu Desktop --}}
    <ul class="hidden md:flex space-x-8 text-sm font-medium uppercase text-black ml-16">
      <li><a href="{{ route('home') }}" class="hover:text-red-500">HOME</a></li>
      <li><a href="{{ route('public.tentang') }}" class="hover:text-red-500">TENTANG</a></li>
      <li><a href="{{ route('berita.index') }}" class="hover:text-red-500">BERITA</a></li>
      <li><a href="{{ route('public.galeri') }}" class="hover:text-red-500">GALERI</a></li>
      <li><a href="{{ route('kontak') }}" class="hover:text-red-500">KONTAK</a></li>
    </ul>

    {{-- Hamburger (Mobile only) --}}
    <div class="ml-auto pr-6 md:hidden z-50">
      <button @click="open = !open" class="focus:outline-none">
        <svg x-show="!open" x-cloak class="h-6 w-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <svg x-show="open" x-cloak class="h-6 w-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
  </div>

  {{-- Mobile Menu (dropdown) --}}
  <div
       x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-5"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-5"
    class="md:hidden bg-white text-black shadow-lg rounded-b-xl px-6 py-6"
       
       >
    <ul class="flex flex-col space-y-4 text-sm font-medium uppercase">
      <li><a @click="open = false" href="{{ route('home') }}" class="hover:text-red-500">HOME</a></li>
      <li><a @click="open = false" href="{{ route('public.tentang') }}" class="hover:text-red-500">TENTANG</a></li>
      <li><a @click="open = false" href="{{ route('berita.index') }}" class="hover:text-red-500">BERITA</a></li>
      <li><a @click="open = false" href="{{ route('public.galeri') }}" class="hover:text-red-500">GALERI</a></li>
      <li><a @click="open = false" href="{{ route('kontak') }}" class="hover:text-red-500">KONTAK</a></li>
    </ul>
  </div>
</nav>
