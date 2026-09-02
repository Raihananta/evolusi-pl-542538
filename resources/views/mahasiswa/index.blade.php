<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <a href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a>

    <table border="1" cellpadding="8" style="margin-top: 16px; border-collapse: collapse;">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswas as $mahasiswa)
                <tr>
                    <td>{{ $mahasiswa->nim }}</td>
                    <td>{{ $mahasiswa->nama }}</td>
                    <td>{{ $mahasiswa->email }}</td>
                    <td>{{ $mahasiswa->sks }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada data mahasiswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
