<footer class="bg-black text-white py-12 px-6">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10">
        {{-- Kolom 1: Logo dan Deskripsi --}}
        <div>
            <h2 class="text-2xl font-extrabold mb-4">Tasty Food</h2>
            <p class="text-gray-400 mb-4">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
            <div class="flex space-x-4">
                <a href="#"><img src="{{ asset('assets/001-facebook.png') }}" alt="Facebook" class="w-7 h-7"></a>
                <a href="#"><img src="{{ asset('assets/002-twitter.png') }}" alt="Twitter" class="w-7 h-7"></a>
            </div>
        </div>

        {{-- Kolom 2: Useful Links --}}
        <div>
            <h3 class="text-xl font-semibold mb-4">Useful Links</h3>
            <ul class="space-y-2 text-gray-300">
                <li><a href="#" class="hover:text-white transition duration-200">Blog</a></li>
                <li><a href="#" class="hover:text-white transition duration-200">Hewan</a></li>
                <li><a href="{{ route('public.galeri') }}" class="hover:text-white transition duration-200">Galeri</a></li>
                <li><a href="#" class="hover:text-white transition duration-200">Testimonial</a></li>
            </ul>
        </div>

        {{-- Kolom 3: Privacy --}}
        <div>
            <h3 class="text-xl font-semibold mb-4">Privacy</h3>
            <ul class="space-y-2 text-gray-300">
                <li><a href="#" class="hover:text-white transition duration-200">Karir</a></li>
                <li><a href="{{ route('public.tentang') }}" class="hover:text-white transition duration-200">Tentang Kami</a></li>
                <li><a href="{{ route('kontak') }}" class="hover:text-white transition duration-200">Kontak Kami</a></li>
                <li><a href="#" class="hover:text-white transition duration-200">Servis</a></li>
            </ul>
        </div>

        {{-- Kolom 4: Kontak --}}
        <div>
            <h3 class="text-xl font-semibold mb-4">Contact Info</h3>
            @php
                if (!isset($kontak)) {
                    $kontak = \App\models\InformasiKontak::query()->first();
                }

                $email      = $kontak->email ?? 'tastyfood@gmail.com';
                $emailHref  = $kontak->url_email ?: ('mailto:' . $email);

                $tel        = $kontak->telepon ?? '+62 812 3456 7890';
                $telHref    = $kontak->url_telepon ?: ('tel:' . preg_replace('/[^0-9+]/', '', $tel));

                $alamatTxt  = $kontak->alamat ?? 'Kota Bandung, Jawa Barat';

                $addrHref = $kontak->url_alamat
                    ?: ($kontak->link_maps
                        ?: ($kontak->alamat
                            ? ('https://www.google.com/maps/search/?api=1&query=' . urlencode($kontak->alamat))
                            : (($kontak->latitude && $kontak->longitude)
                                ? ('https://www.google.com/maps?q=' . $kontak->latitude . ',' . $kontak->longitude)
                                : '#')));
            @endphp

            <ul class="space-y-3 text-gray-300 text-sm">
                <li class="flex items-center gap-3">
                <img src="{{ asset('assets/ic_markunread_24px.png') }}" alt="Email" class="w-3 h-3">
                <a href="{{ $emailHref }}" class="hover:text-white transition">{{ $email }}</a>
                </li>
                <li class="flex items-center gap-3">
                <img src="{{ asset('assets/ic_call_24px.png') }}" alt="Phone" class="w-3 h-3">
                <a href="{{ $telHref }}" class="hover:text-white transition">{{ $tel }}</a>
                </li>
                <li class="flex items-center gap-3">
                <img src="{{ asset('assets/ic_place_24px.png') }}" alt="Location" class="w-3 h-4">
                <a href="{{ $addrHref }}" target="_blank" rel="noopener" class="hover:text-white transition">
                    {{ $alamatTxt }}
                </a>
                </li>
            </ul>
        </div>

    </div>

    {{-- Bawah --}}
    <div class="mt-12 border-t border-gray-700 pt-6 text-center text-gray-400 text-sm">
        &copy; 2025 Tasty Food. All rights reserved.
    </div>
</footer>
