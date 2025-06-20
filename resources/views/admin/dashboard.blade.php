@extends('admin.layouts.app')

@section('content')
<div style="padding: 2rem;">
  <h2>Dashboard</h2>
  <div style="display: flex; gap: 2rem; margin-bottom: 2rem;">
    <div style="flex:1; background: #f0f4ff; padding: 1rem; border-radius: 8px;">
      <h4>Total Berita</h4>
      <p style="font-size: 2rem;">{{ $totalBerita }}</p>
    </div>
    <div style="flex:1; background: #e9fcef; padding: 1rem; border-radius: 8px;">
      <h4>Total Galeri</h4>
      <p style="font-size: 2rem;">{{ $totalGaleri }}</p>
    </div>
    <div style="flex:1; background: #ffecec; padding: 1rem; border-radius: 8px;">
      <h4>Total Pesan</h4>
      <p style="font-size: 2rem;">{{ $totalPesan }}</p>
    </div>
  </div>
</div>  
@endsection
