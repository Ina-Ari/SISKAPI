<?php

namespace Database\Seeders;

use App\Models\TingkatKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TingkatKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tingkatKegiatanList = [
            'BEM',
            'Donor Darah',
            'HMJ',
            'Internasional',
            'Jurusan',
            'Kabupaten',
            'MPM',
            'Nasional',
            'Pemenang Hibah Nasional',
            'Pemenang Inkubator Bisnis',
            'Pengisi Acara',
            'Peserta Hibah Nasional',
            'Peserta Inkubator Bisnis',
            'Pertukaran Pelajar',
            'Politeknik',
            'Provinsi',
            'UKM',
        ];

        foreach ($tingkatKegiatanList as $nama) {
            TingkatKegiatan::updateOrCreate(
                ['tingkat_kegiatan' => $nama]
            );
        }
    }
}
