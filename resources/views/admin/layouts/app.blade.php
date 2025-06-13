<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel')</title>

    <!-- Bootstrap CSS (dari CDN atau local asset admin) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
</head>
<body>

    {{-- Header / Navbar admin --}}
    @include('admin.layouts.header')

    {{-- Main content --}}
    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS (dari CDN atau local asset admin) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>
</body>
</html>
