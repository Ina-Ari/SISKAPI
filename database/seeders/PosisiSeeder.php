<?php

namespace Database\Seeders;

use App\Models\Posisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posisiList = [
            'Peserta PKKMB',
            'AKSOSMA',
            'Keaktifan UKM/tahun',
            'Ketua',
            'Anggota',
            'Peserta',
            'Penyaji/pemakalah',
            'Moderator',
            'Instruktur/Narasumber',
            'Sekretaris',
            'Bendahara',
            'Ketua Divisi',
            'Wakil ketua',
            'Ketua Bidang',
            'Sekretaris Bidang',
            'Ketua Komisi',
            'Sekretaris Komisi',
            'Penanggung Jawab',
            'Steering Commite',
            // 'Wakil Ketua Panitia',
            // 'Sekretaris Panitia',
            // 'Bendaraha Panitia',
            'Koordinator Seksi',
            'Wakil Koordinator Seksi',
            'Wasit',
            'Hakim Garis',
            'BPH lainnya',
            'Juara 1',
            'Juara 2',
            'Juara 3',
            'Juara Harapan',
            'Nasional',
            'Internasional',
        ];

        foreach ($posisiList as $nama) {
            Posisi::updateOrCreate(
                ['nama_posisi' => $nama]
            );
        }
    }
}
