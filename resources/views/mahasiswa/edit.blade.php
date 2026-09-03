<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
</head>
<body>
    <h1>Edit Mahasiswa</h1>

    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}">
        @csrf
        @method('PUT')

        <label for="nim">NIM (8-10 digit angka)</label><br>
        <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}"><br><br>

        <label for="nama">Nama</label><br>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}"><br><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" value="{{ old('email', $mahasiswa->email) }}"><br><br>

        <label for="sks">Jumlah SKS (0-24)</label><br>
        <input type="number" id="sks" name="sks" value="{{ old('sks', $mahasiswa->sks) }}"><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="{{ route('mahasiswa.index') }}">Kembali ke daftar</a>
</body>
</html>