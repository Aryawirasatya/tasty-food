@extends('admin.layouts.app')
@section('title', 'Informasi Kontak')

@section('content')
 
  <div class="row mb-3 align-items-center">
    <div class="col-12 col-md-6">
      <h1 class="h3 mb-0">Informasi Kontak</h1>
    </div>
    <div class="col-12 col-md-6 text-md-end mt-2 mt-md-0">
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
          {{ $kontak->alamat }}
        </li>
        <li class="list-group-item">
          <strong>Email:</strong><br>
          <a href="mailto:{{ $kontak->email }}">{{ $kontak->email }}</a>
        </li>
        <li class="list-group-item">
          <strong>Telepon:</strong><br>
          <a href="tel:{{ $kontak->telepon }}">{{ $kontak->telepon }}</a>
        </li>
        <li class="list-group-item">
          <strong>Koordinat:</strong><br>
          <span>Lat: {{ $kontak->latitude ?? '-' }}</span>,
          <span>Lng: {{ $kontak->longitude ?? '-' }}</span>
        </li>
        <li class="list-group-item">
          <strong>Link Maps (embed):</strong><br>
          @if ($kontak->link_maps)
            <a href="{{ $kontak->link_maps }}" target="_blank" rel="noopener">{{ $kontak->link_maps }}</a>
          @else
            <span class="text-muted">Belum tersedia</span>
          @endif
        </li>
        <li class="list-group-item">
          <strong>URL Email:</strong><br>
          <a href="{{ $kontak->url_email }}" target="_blank" rel="noopener">{{ $kontak->url_email }}</a>
        </li>
        <li class="list-group-item">
          <strong>URL Telepon:</strong><br>
          <a href="{{ $kontak->url_telepon }}" target="_blank" rel="noopener">{{ $kontak->url_telepon }}</a>
        </li>
        <li class="list-group-item">
          <strong>URL Alamat:</strong><br>
          <a href="{{ $kontak->url_alamat }}" target="_blank" rel="noopener">{{ $kontak->url_alamat }}</a>
        </li>
      </ul>

      @php
        // URL klik nyaman (non-embed) berbasis alamat jika ada, jika tidak fallback koordinat
        $gmapsClick = $kontak->alamat
          ? 'https://www.google.com/maps/search/?api=1&query=' . urlencode($kontak->alamat)
          : (($kontak->latitude && $kontak->longitude) ? 'https://www.google.com/maps?q='.$kontak->latitude.','.$kontak->longitude : null);
      @endphp

      @if ($gmapsClick)
        <a href="{{ $gmapsClick }}" target="_blank" rel="noopener" class="btn btn-primary btn-sm mt-3">
          Lihat di Google Maps
        </a>
      @endif
    </div>
  </div>

  {{-- Preview peta Google (iframe) --}}
  @if ($kontak->link_maps || ($kontak->latitude && $kontak->longitude))
    <div class="card shadow-sm mt-3">
      <div class="card-header">Pratinjau Lokasi (Google Maps)</div>
      <div class="card-body p-0">
        <div class="ratio ratio-16x9">
          <iframe
            src="{{ $kontak->link_maps ?: 'https://www.google.com/maps?q='.$kontak->latitude.','.$kontak->longitude.'&z=16&hl=id&output=embed' }}"
            style="border:0; width:100%; height:100%"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  @endif
@endsection
