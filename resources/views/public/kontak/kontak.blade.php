@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('kontak.kirim') }}" method="POST">
    @csrf
    <input type="text" name="subject" placeholder="Subjek" required><br>
    <input type="text" name="nama" placeholder="Nama" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <textarea name="pesan" placeholder="Pesan" required></textarea><br>
    <button type="submit">Kirim Pesan</button>
</form>
