@extends('public.layouts.header')

@section('title', 'Home')

@section('content')
        
        <div class="left-content">
            <h1>healthy</h1>
            <h2>tasty food</h2>
            
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officiis soluta iusto sit necessitatibus quam provident at rem, tenetur aliquam sapiente voluptas, ipsum iste similique ut numquam ex ipsam, ducimus autem!</p>
            <button>tentang kami</button>
        </div>

        <div class="right-content">
              <img src="{{ asset('images/img-4.png') }}" alt="Gambar Tasty Food">
        </div>
@endsection
@include('public.layouts.footer')

