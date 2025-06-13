<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') - Tasty Food</title>
</head>
<body>
    <header>
        <h1>Tasty Food</h1>
        <nav>
            <a href="/">Home</a> |
            <a href="/tentang">Tentang</a> |
            <a href="/berita">Berita</a> |
            <a href="/galeri">Galeri</a> |
            <a href="/kontak">Kontak</a>
        </nav>
        <hr>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <hr>
        <p>&copy; {{ date('Y') }} Tasty Food. All rights reserved.</p>
    </footer>
</body>
</html>
