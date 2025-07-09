<?php

namespace Database\Seeders;

use App\Models\JenisKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisKegiatanList = [
            'Kegiatan Wajib',
            'Penelitian',
            'Seminar',
            'Pelatihan/Workshop',
            'Pengurus Organisasi Mahasiswa',
            'Kepanitiaan',
            'Prestasi Akademik/Non Akademik',
            'Pengabdian Masyarakat',
            'Pendukung Lainnya',
        ];

        foreach ($jenisKegiatanList as $nama) {
            JenisKegiatan::updateOrCreate(
                ['jenis_kegiatan' => $nama]
            );
        }
    }
}
