<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan daftar semua mahasiswa.
     */
    public function index(): View
    {
        $mahasiswas = Mahasiswa::latest()->get();

        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Tampilkan form tambah mahasiswa.
     */
    public function create(): View
    {
        return view('mahasiswa.create');
    }

    /**
     * Simpan mahasiswa baru ke database.
     *
     * NIM wajib 8-10 digit angka. Data yang tidak valid
     * akan ditolak dengan status 422 dan pesan error.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => ['required', 'digits_between:8,10', 'unique:mahasiswas,nim'],
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:mahasiswas,email'],
            'sks' => ['required', 'integer', 'min:0', 'max:24'],
        ]);

        Mahasiswa::create($validated);

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan.');
    }
}
