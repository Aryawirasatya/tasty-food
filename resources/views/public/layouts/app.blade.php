<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Tasty Food')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tambahkan Tailwind atau Bootstrap jika kamu pakai -->
    <link rel="stylesheet" href="{{ asset('assets/public/css/style.css') }}">
</head>
<body>
    <!-- Header atau Navbar -->
    <header class="bg-primary text-white p-3">
        <div class="container">
            <h1 class="mb-0">Tasty Food</h1>
        </div>
    </header>

    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <small>&copy; {{ date('Y') }} Tasty Food</small>
    </footer>
</body>
</html>
