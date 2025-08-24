@extends('public.layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative z-[10] bg-cover bg-center h-96" style="background-image: url('{{ asset('assets/Group 70@2x.png') }}');">
  <div class="bg-black bg-opacity-50 w-full h-full flex items-center justify-start px-10">
    <div class="w-full text-center md:text-left px-6">
      <h1 class="text-white text-5xl font-bold">KONTAK KAMI</h1>
    </div>
  </div>
</section>

<!-- Main Content -->
<section class="max-w-5xl mx-auto py-16 px-6">
  @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
      <ul class="list-disc ml-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
      {{ session('success') }}
    </div>
  @endif

  <h3 class="text-lg mt-10 ml-8 font-bold">Kontak Kami</h3>

  <form action="{{ route('kontak.kirim') }}" method="POST" class="bg-white p-8 rounded-lg">
    @csrf

    <div class="grid md:grid-cols-2 gap-8">
      <!-- Kolom Kiri -->
      <div class="space-y-6">
        <div>
          <label for="subject" class="block text-gray-700 font-semibold mb-2">Subject</label>
          <input type="text" name="subject" id="subject" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Masukkan subjek">
        </div>
        <div>
          <label for="nama" class="block text-gray-700 font-semibold mb-2">Name</label>
          <input type="text" name="nama" id="nama" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Nama Anda">
        </div>
        <div>
          <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
          <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Email Anda">
        </div>
      </div>

      <!-- Kolom Kanan (Pesan) -->
      <div>
        <label for="pesan" class="block text-gray-700 font-semibold mb-2">Message</label>
        <textarea name="pesan" id="pesan" rows="9" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Pesan Anda"></textarea>
      </div>
    </div>

    {{-- Tombol Kirim --}}
    <div class="mt-10">
      <input type="hidden" name="recaptcha_token" id="recaptcha_token">
      <button id="btn-kirim" type="submit" class="w-full bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300" disabled>
        KIRIM
      </button>
    </div>
  </form>

 {{-- Info Kontak (no-box hover) --}}
<div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-12 text-center text-gray-800">

  {{-- Email --}}
  <div class="flex flex-col items-center group">
    <div class="h-16 w-16 rounded-full flex items-center justify-center mb-4 overflow-hidden transition-transform duration-300 group-hover:scale-110">
      <img src="{{ asset('assets/Group 66.png') }}" alt="Email Icon"
           class="h-10 w-10 object-contain opacity-90 transition-opacity duration-300 group-hover:opacity-100">
    </div>
    <h4 class="font-bold uppercase text-sm tracking-wider transition-colors duration-300 group-hover:text-red-600">Email</h4>
    <a href="mailto:{{ $kontak->email ?? 'tastyfood@gmail.com' }}"
       class="text-sm mt-1 hover:underline transition-colors duration-200 group-hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-400 rounded">
      {{ $kontak->email ?? 'tastyfood@gmail.com' }}
    </a>
  </div>

  {{-- Phone --}}
  <div class="flex flex-col items-center group">
    <div class="h-16 w-16 rounded-full flex items-center justify-center mb-4 overflow-hidden transition-transform duration-300 group-hover:scale-110">
      <img src="{{ asset('assets/Group 67.png') }}" alt="Phone Icon"
           class="h-10 w-10 object-contain opacity-90 transition-opacity duration-300 group-hover:opacity-100">
    </div>
    <h4 class="font-bold uppercase text-sm tracking-wider transition-colors duration-300 group-hover:text-red-600">Phone</h4>
    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $kontak->telepon ?? '+6281234567890') }}"
       class="text-sm mt-1 hover:underline transition-colors duration-200 group-hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-400 rounded">
      {{ $kontak->telepon ?? '+62 812 3456 7890' }}
    </a>
  </div>

  {{-- Location --}}
  @php
    $clickUrl = $kontak->alamat
      ? 'https://www.google.com/maps/search/?api=1&query=' . urlencode($kontak->alamat)
      : (!empty($kontak->latitude) && !empty($kontak->longitude)
          ? 'https://www.google.com/maps?q='.$kontak->latitude.','.$kontak->longitude
          : '#');
  @endphp
  <div class="flex flex-col items-center group">
    <a href="{{ $clickUrl }}" target="_blank" rel="noopener"
       class="h-16 w-16 rounded-full flex items-center justify-center mb-4 overflow-hidden transition-transform duration-300 group-hover:scale-110 focus:outline-none focus:ring-2 focus:ring-red-400">
      <img src="{{ asset('assets/Group 68.png') }}" alt="Location Icon"
           class="h-10 w-10 object-contain opacity-90 transition-opacity duration-300 group-hover:opacity-100">
    </a>
    <h4 class="font-bold uppercase text-sm tracking-wider transition-colors duration-300 group-hover:text-red-600">Location</h4>
    <p class="text-sm mt-1 text-center px-2 transition-colors duration-200 group-hover:text-red-500">
      {{ $kontak->alamat ?? 'Alamat belum tersedia' }}
    </p>
  </div>

</div>

</section>

{{-- Map Section: pakai link_maps (dibentuk dari alamat), fallback ke lat/lng --}}
@if(!empty($kontak->link_maps) || (!empty($kontak->latitude) && !empty($kontak->longitude)))
<section class="w-full bg-gray-100 py-12">
  <div class="max-w-4xl mx-auto px-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Lokasi Kami</h2>
    <div class="rounded-xl overflow-hidden shadow-lg">
      <div class="relative pb-[56.25%] h-0">
        <iframe
          src="{{ $kontak->link_maps ?: 'https://www.google.com/maps?q='.$kontak->latitude.','.$kontak->longitude.'&z=16&hl=id&output=embed' }}"
          class="absolute top-0 left-0 w-full h-full border-0"
          allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>
@endif

{{-- reCAPTCHA v3 --}}
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    grecaptcha.ready(function () {
      grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'kontak' })
        .then(function (token) {
          document.getElementById('recaptcha_token').value = token;
          const btn = document.getElementById('btn-kirim');
          if (btn) btn.disabled = false;
        });
    });

    const form = document.querySelector('form[action="{{ route('kontak.kirim') }}"]');
    form.addEventListener('submit', function (e) {
      if (!document.getElementById('recaptcha_token').value) {
        e.preventDefault();
        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'kontak' })
          .then(function (token) {
            document.getElementById('recaptcha_token').value = token;
            form.submit();
          });
      }
    });
  });
</script>

@endsection
