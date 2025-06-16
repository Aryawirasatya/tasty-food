<form action="{{ route('contact.store') }}" method="POST">
    @csrf
    <input type="text" name="nama" placeholder="Nama" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="subject" placeholder="Subjek" required>
    <textarea name="pesan" placeholder="Pesan" required></textarea>
    <button type="submit">Kirim</button>
</form>
