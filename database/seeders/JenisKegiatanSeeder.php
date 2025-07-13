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
            'organisasi' => ['Pengurus Organisasi Mahasiswa'],
            'aktivitas' => [
                'Kegiatan Wajib',
                'Penelitian',
                'Prestasi Akademik/Non Akademik',
                'Kepanitiaan',
                'Pengabdian Masyarakat',
                'Pendukung Lainnya'
            ],
            'pelatihan' => [
                'Pelatihan/Workshop',
                'Seminar'
            ],
            'kerja' => ['Pengalaman Kerja'],
        ];

        foreach ($jenisKegiatanList as $kategori => $jenisList) {
            foreach ($jenisList as $jenis) {
                JenisKegiatan::updateOrCreate([
                    'jenis_kegiatan' => $jenis,
                    'kategori_skpi' => $kategori,
                ]);
            }
        }
    }
}
