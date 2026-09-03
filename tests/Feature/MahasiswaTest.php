<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MahasiswaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Halaman daftar mahasiswa bisa diakses dan menampilkan data.
     */
    public function test_halaman_daftar_mahasiswa_bisa_diakses(): void
    {
        Mahasiswa::factory()->create(['nama' => 'Budi Santoso']);

        $response = $this->get('/mahasiswa');

        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
    }

    /**
     * Mahasiswa baru bisa disimpan dengan data yang valid.
     */
    public function test_mahasiswa_bisa_disimpan_dengan_data_valid(): void
    {
        $response = $this->post('/mahasiswa', [
            'nim' => '12345678',
            'nama' => 'Citra Dewi',
            'email' => 'citra@mail.ugm.ac.id',
            'sks' => 20,
        ]);

        $response->assertRedirect(route('mahasiswa.index'));
        $this->assertDatabaseHas('mahasiswas', ['nim' => '12345678']);
    }

    /**
     * NIM yang tidak valid (bukan 8-10 digit angka) harus ditolak.
     */
    public function test_menolak_nim_yang_tidak_valid(): void
    {
        $response = $this->post('/mahasiswa', [
            'nim' => 'ABC123',
            'nama' => 'Andi Wijaya',
            'email' => 'andi@mail.ugm.ac.id',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('nim');
        $this->assertDatabaseMissing('mahasiswas', ['nama' => 'Andi Wijaya']);
    }

    /**
     * NIM yang sudah terdaftar tidak boleh dipakai lagi.
     */
    public function test_menolak_nim_yang_sudah_terdaftar(): void
    {
        Mahasiswa::factory()->create(['nim' => '98765432']);

        $response = $this->post('/mahasiswa', [
            'nim' => '98765432',
            'nama' => 'Dewi Lestari',
            'email' => 'dewi@mail.ugm.ac.id',
        ]);

        $response->assertSessionHasErrors('nim');
    }
    
    /**
     * Data mahasiswa bisa diperbarui dengan data yang valid.
     */
    public function test_mahasiswa_bisa_diperbarui(): void
    {
        $mahasiswa = Mahasiswa::factory()->create(['nama' => 'Nama Lama']);

        $response = $this->put(route('mahasiswa.update', $mahasiswa), [
            'nim' => $mahasiswa->nim,
            'nama' => 'Nama Baru',
            'email' => $mahasiswa->email,
            'sks' => 15,
        ]);

        $response->assertRedirect(route('mahasiswa.index'));
        $this->assertDatabaseHas('mahasiswas', ['id' => $mahasiswa->id, 'nama' => 'Nama Baru']);
    }

    /**
     * Data mahasiswa bisa dihapus.
     */
    public function test_mahasiswa_bisa_dihapus(): void
    {
        $mahasiswa = Mahasiswa::factory()->create();

        $response = $this->delete(route('mahasiswa.destroy', $mahasiswa));

        $response->assertRedirect(route('mahasiswa.index'));
        $this->assertDatabaseMissing('mahasiswas', ['id' => $mahasiswa->id]);
    }
}
