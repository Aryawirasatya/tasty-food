@extends('admin.layouts.app')
@section('title', 'Informasi Kontak')

@section('content')
<div class="row align-items-center mb-3">
  <div class="col">
    <h1 class="h3 mb-0">Informasi Kontak</h1>
  </div>
  <div class="col-12 col-md-auto ms-md-auto mt-2 mt-md-0">
    <a href="{{ route('admin.kontak.edit') }}" class="btn btn-warning btn-sm">
      <i class="fas fa-edit"></i> Edit Kontak
    </a>
  </div>
</div>

  <div class="card shadow-sm">
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <strong>Alamat:</strong><br>
          {{ $kontak->alamat ?? '-' }}
        </li>

        <li class="list-group-item">
          <strong>Email:</strong><br>
          @php
            $email = $kontak->email ?? null;
          @endphp
          @if($email)
            <a href="mailto:{{ $email }}">{{ $email }}</a>
          @else
            <span class="text-muted">-</span>
          @endif
        </li>

        <li class="list-group-item">
          <strong>Telepon:</strong><br>
          @php
            $tel = $kontak->telepon ?? null;
            // izinkan hanya + dan angka untuk tel:
            $telHref = $tel ? preg_replace('/[^0-9+]/', '', $tel) : null;
          @endphp
          @if($tel)
            <a href="tel:{{ $telHref }}">{{ $tel }}</a>
          @else
            <span class="text-muted">-</span>
          @endif
        </li>

        <li class="list-group-item">
          <strong>Koordinat:</strong><br>
          <span>Lat: {{ $kontak->latitude ?? '-' }}</span>,
          <span>Lng: {{ $kontak->longitude ?? '-' }}</span>
        </li>
 

      @php
        // URL klik nyaman (non-embed) berbasis alamat jika ada, fallback koordinat
        $gmapsClick = !empty($kontak->alamat)
          ? 'https://www.google.com/maps/search/?api=1&query=' . urlencode($kontak->alamat)
          : ((!empty($kontak->latitude) && !empty($kontak->longitude))
              ? 'https://www.google.com/maps?q='.$kontak->latitude.','.$kontak->longitude
              : null);
 
      @endphp

      <div class="mt-3 d-flex gap-2">
        @if ($gmapsClick)
          <a href="{{ $gmapsClick }}" target="_blank" rel="noopener" class="btn btn-primary btn-sm">
            Buka di Google Maps
          </a>
        @endif

 
      </div>
    </div>
  </div>

  {{-- Preview peta Google (iframe) --}}
  @if (!empty($kontak->link_maps) || (!empty($kontak->latitude) && !empty($kontak->longitude)))
    <div class="card shadow-sm mt-3">
      <div class="card-header">Pratinjau Lokasi (Google Maps)</div>
      <div class="card-body p-0">
        <div class="ratio ratio-16x9">
          <iframe
            src="{{ !empty($kontak->link_maps)
                    ? $kontak->link_maps
                    : 'https://www.google.com/maps?q='.$kontak->latitude.','.$kontak->longitude.'&z=16&hl=id&output=embed' }}"
            style="border:0; width:100%; height:100%"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  @endif
@endsection
