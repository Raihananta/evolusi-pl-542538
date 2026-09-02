<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
</head>
<body>
    <h1>Tambah Mahasiswa</h1>

    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('mahasiswa.store') }}">
        @csrf

        <label for="nim">NIM (8-10 digit angka)</label><br>
        <input type="text" id="nim" name="nim" value="{{ old('nim') }}"><br><br>

        <label for="nama">Nama</label><br>
        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"><br><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}"><br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('mahasiswa.index') }}">Kembali ke daftar</a>
</body>
</html>
