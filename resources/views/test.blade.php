<!DOCTYPE html>
<html>
<head><title>Test Form</title></head>
<body>
    <form method="POST" action="{{ url('/debug-test') }}">
        @csrf
        <input type="text" name="name" placeholder="Coba ketik di sini" />
        <button type="submit">Kirim</button>
    </form>
</body>
</html>
