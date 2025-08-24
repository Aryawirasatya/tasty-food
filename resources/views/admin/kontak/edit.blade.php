@extends('admin.layouts.app')
@section('title', 'Edit Informasi Kontak')

@section('content')
<h1 class="h3 mb-4">Edit Informasi Kontak</h1>

<form action="{{ route('admin.kontak.update') }}" method="POST">
  @csrf
  @method('PUT')

  {{-- Cari lokasi (autocomplete) --}}
  <div class="mb-3">
    <label class="form-label">Cari Lokasi (ketik nama tempat)</label>
    <div class="position-relative">
      <input type="text" id="searchBox" class="form-control" placeholder="Contoh: Gedung Sate Bandung" autocomplete="off">
      <ul id="suggestions" class="list-group position-absolute w-100" style="z-index: 1030;"></ul>
    </div>
    <div class="form-text">Ketik minimal 3 karakter, lalu pilih dari saran untuk mengisi alamat & koordinat otomatis.</div>
  </div>

  {{-- Alamat + kontak utama --}}
  <div class="mb-3">
    <label class="form-label">Alamat</label>
    <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat', $kontak->alamat) }}">
  </div>

  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $kontak->email) }}">
    </div>
    <div class="col-md-6">
      <label class="form-label">Telepon</label>
      <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $kontak->telepon) }}">
    </div>
  </div>

  {{-- Peta untuk memilih titik (Leaflet) --}}
  <div class="mb-3 mt-3">
    <label class="form-label d-block">Pilih Titik di Peta</label>
    <div id="map" style="height: 320px;" class="rounded border"></div>

    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $kontak->latitude) }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $kontak->longitude) }}">

    <div class="small text-muted mt-2">
      Klik peta untuk mengganti titik. Koordinat otomatis tersimpan ke field tersembunyi.
    </div>
  </div>

  {{-- Link Maps: otomatis dari Alamat (readonly) --}}
  <div class="mb-3">
    <label class="form-label">Link Maps (Google) — otomatis dari Alamat</label>
    <input type="url" name="link_maps" id="link_maps" class="form-control" value="{{ old('link_maps', $kontak->link_maps) }}" readonly>
    <div class="form-text">Dibentuk dari <b>Alamat</b>. Jika perlu override manual, hapus atribut readonly ini.</div>
  </div>

  {{-- Preview Google Maps dari link_maps --}}
  <div class="card mt-4">
    <div class="card-header">Pratinjau Maps (Google)</div>
    <div class="card-body p-0">
      <div class="ratio ratio-16x9">
        <iframe id="gmapsPreview"
                src="{{ $kontak->link_maps ?: ($kontak->latitude && $kontak->longitude ? 'https://www.google.com/maps?q='.$kontak->latitude.','.$kontak->longitude.'&z=16&hl=id&output=embed' : '') }}"
                style="border:0;width:100%;height:100%"
                allowfullscreen loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.kontak.index') }}" class="btn btn-outline-secondary">Batal</a>
  </div>
</form>

{{-- Styles untuk suggestions --}}
<style>
  #suggestions { max-height: 220px; overflow-y: auto; }
  #suggestions li { cursor: pointer; }
</style>

{{-- Leaflet (hanya untuk memilih titik) --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
(function() {
  // Helper buat embed URL dari alamat
  function buildEmbedFromAddress(alamat) {
    if (!alamat) return '';
    return 'https://www.google.com/maps?q=' + encodeURIComponent(alamat) + '&z=16&hl=id&output=embed';
  }

  function updatePreview() {
    const src = document.getElementById('link_maps').value;
    document.getElementById('gmapsPreview').setAttribute('src', src || 'about:blank');
  }

  // Init map (Leaflet) untuk pilih titik
  const latInput = document.getElementById('latitude');
  const lngInput = document.getElementById('longitude');

  const lat0 = latInput.value ? parseFloat(latInput.value) : -6.914744;
  const lng0 = lngInput.value ? parseFloat(lngInput.value) : 107.609810;

  const map = L.map('map').setView([lat0, lng0], 14);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  let marker = null;
  if (latInput.value && lngInput.value) {
    marker = L.marker([parseFloat(latInput.value), parseFloat(lngInput.value)]).addTo(map);
  }

  map.on('click', function(e) {
    const lat = e.latlng.lat;
    const lng = e.latlng.lng;
    if (marker) map.removeLayer(marker);
    marker = L.marker([lat, lng]).addTo(map);
    latInput.value = lat;
    lngInput.value = lng;
    // Link maps tetap mengikuti alamat (sumber kebenaran), jadi tidak diubah saat klik peta
  });

  // Autocomplete (Nominatim)
  const searchBox = document.getElementById('searchBox');
  const suggestions = document.getElementById('suggestions');
  let typingTimer = null;

  searchBox.addEventListener('input', function() {
    clearTimeout(typingTimer);
    const q = this.value.trim();
    suggestions.innerHTML = '';
    if (q.length < 3) return;

    typingTimer = setTimeout(() => {
      fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(q)}`)
        .then(r => r.json())
        .then(list => {
          suggestions.innerHTML = '';
          list.slice(0, 10).forEach(item => {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.textContent = item.display_name;
            li.onclick = () => selectLocation(item);
            suggestions.appendChild(li);
          });
        })
        .catch(() => { suggestions.innerHTML = ''; });
    }, 350);
  });

  function selectLocation(item) {
    const lat = parseFloat(item.lat);
    const lng = parseFloat(item.lon);

    // pindah marker & simpan koordinat
    if (marker) map.removeLayer(marker);
    marker = L.marker([lat, lng]).addTo(map);
    map.setView([lat, lng], 16);
    latInput.value = lat;
    lngInput.value = lng;

    // isi alamat + kotak cari
    document.getElementById('alamat').value = item.display_name;
    searchBox.value = item.display_name;
    suggestions.innerHTML = '';

    // bentuk link_maps dari alamat + update preview
    document.getElementById('link_maps').value = buildEmbedFromAddress(item.display_name);
    updatePreview();
  }

  // Saat alamat diketik manual → link_maps & preview ikut (debounce)
  let addrTimer = null;
  document.getElementById('alamat').addEventListener('input', function() {
    clearTimeout(addrTimer);
    addrTimer = setTimeout(() => {
      document.getElementById('link_maps').value = buildEmbedFromAddress(this.value.trim());
      updatePreview();
    }, 400);
  });
})();
</script>
@endsection
