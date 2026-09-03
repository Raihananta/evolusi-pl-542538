# evolusi-pl-NIM

Aplikasi web sederhana **Manajemen Data Mahasiswa** berbasis Laravel, dibuat untuk tugas mata kuliah Konstruksi & Evolusi Perangkat Lunak — Pertemuan 2 (Manajemen GitHub & Prinsip CI).

## Fitur

- Menampilkan daftar mahasiswa
- Menambahkan data mahasiswa baru
- Mengedit data mahasiswa yang sudah ada
- Menghapus data mahasiswa
- Validasi NIM (wajib 8-10 digit angka, unik) dan email (format valid, unik)
- Mencatat jumlah SKS mahasiswa (0-24) dengan validasi batas maksimal

## Menjalankan secara lokal

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Buka `http://localhost:8000` di browser.

## Menjalankan test

```bash
php artisan test
```

## Alur branch

Proyek ini menggunakan alur tiga tingkat:

```
main  (selalu siap rilis, dilindungi branch protection)
 └── dev  (integrasi fitur, dilindungi branch protection)
      └── feature/crud-mahasiswa  (pengembangan fitur)
```

Perubahan mengalir: `feature/crud-mahasiswa` → PR ke `dev` → PR ke `main`. Tidak ada push langsung ke `main` atau `dev`.

## CI/CD

Setiap push dan Pull Request ke `main` atau `dev` memicu GitHub Actions (`.github/workflows/ci.yml`) dengan dua job berurutan:

1. **lint** — memeriksa gaya penulisan kode dengan Laravel Pint.
2. **test** — menyiapkan database SQLite, menjalankan migrasi, lalu menjalankan seluruh test PHPUnit (termasuk test validasi NIM).

Job `test` baru berjalan jika `lint` lulus (`needs: lint`).
