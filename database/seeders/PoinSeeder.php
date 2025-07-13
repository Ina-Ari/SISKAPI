<?php

namespace Database\Seeders;

use App\Models\JenisKegiatan;
use App\Models\Poin;
use App\Models\Posisi;
use App\Models\TingkatKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poinCombinationList = [
            [
                "jenis_kegiatan" => "Kegiatan Wajib",
                "data" => [
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Peserta PKKMB",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "AKSOSMA",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Keaktifan UKM/tahun",
                        "poin" => 1
                    ]
                ]
            ],
            [
                "jenis_kegiatan" => "Penelitian",
                "data" => [
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Anggota",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Anggota",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Peserta/Kolektor data",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Peserta/Kolektor data",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Anggota",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Peserta/Kolektor data",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Ketua",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Anggota",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Peserta/Kolektor data",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Ketua",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Anggota",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Peserta/Kolektor data",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Ketua",
                        "poin" => 12
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Anggota",
                        "poin" => 10
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Peserta/Kolektor data",
                        "poin" => 4
                    ]
                ]
            ],
            [
                "jenis_kegiatan" => "Seminar",
                "data" => [
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Penyaji/pemakalah",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Moderator",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Peserta",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Penyaji/pemakalah",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Moderator",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Peserta",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Penyaji/pemakalah",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Moderator",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Peserta",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Penyaji/pemakalah",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Moderator",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Peserta",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Penyaji/pemakalah",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Moderator",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Peserta",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Penyaji/pemakalah",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Moderator",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Peserta",
                        "poin" => 3
                    ]
                ]
            ],
            [
                "jenis_kegiatan" => "Pelatihan/Workshop",
                "data" => [
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Instruktur/Narasumber",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Moderator",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Peserta",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Instruktur/Narasumber",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Moderator",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Peserta",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Instruktur/Narasumber",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Moderator",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Peserta",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Instruktur/Narasumber",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Moderator",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Peserta",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Instruktur/Narasumber",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Moderator",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Peserta",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Instruktur/Narasumber",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Moderator",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Peserta",
                        "poin" => 4
                    ]
                ]
            ],
            [
                "jenis_kegiatan" => "Pengurus Organisasi Mahasiswa",
                "data" => [
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Ketua",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Wakil ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Sekretaris",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Bendahara",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Ketua Divisi",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Anggota Divisi",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "HMJ",
                        "jabatan" => "Ketua",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "HMJ",
                        "jabatan" => "Wakil ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "HMJ",
                        "jabatan" => "Sekretaris",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "HMJ",
                        "jabatan" => "Bendahara",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "HMJ",
                        "jabatan" => "Ketua Bidang",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "HMJ",
                        "jabatan" => "Sekretaris Bidang",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "HMJ",
                        "jabatan" => "Anggota",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Ketua",
                        "poin" => 7
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Wakil ketua",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Sekretaris",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Bendahara",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Ketua Bidang",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Sekretaris Bidang",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Anggota",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Ketua",
                        "poin" => 7
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Sekretaris",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Bendahara",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Ketua Komisi",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Sekretaris Komisi",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Anggota",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Ketua",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Wakil ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Sekretaris",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Bendahara",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "BPH lainnya",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Anggota",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Ketua",
                        "poin" => 7
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Wakil ketua",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Sekretaris",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Bendahara",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "BPH lainnya",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Anggota",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Ketua",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Wakil ketua",
                        "poin" => 7
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Sekretaris",
                        "poin" => 7
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Bendahara",
                        "poin" => 7
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "BPH lainnya",
                        "poin" => 7
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Anggota",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Ketua",
                        "poin" => 10
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Wakil ketua",
                        "poin" => 9
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Sekretaris",
                        "poin" => 9
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Bendahara",
                        "poin" => 9
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "BPH lainnya",
                        "poin" => 9
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Anggota",
                        "poin" => 8
                    ]
                ]
            ],
            [
                "jenis_kegiatan" => "Kepanitiaan",
                "data" => [
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Ketua",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Penanggung jawab",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Steering Commite",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Wakil Ketua",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Sekretaris",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Bendahara",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Koordinator Seksi",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Wakil Koordinator Seksi",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "BPH lainnya",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Anggota",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Wasit",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "UKM",
                        "jabatan" => "Hakim Garis",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Ketua",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Penanggung jawab",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Steering Commite",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Wakil Ketua",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Sekretaris",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Bendahara",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Koordinator Seksi",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Wakil Koordinator Seksi",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Wasit",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Anggota",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Hakim Garis",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Peninjau",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Penanggung jawab",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Steering Commite",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Wakil Ketua",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Sekretaris",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Bendahara",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Koordinator Seksi",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Wakil Koordinator Seksi",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Peninjau",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Penanggung jawab",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Steering Commite",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Wakil Ketua",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Sekretaris",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Bendahara",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Koordinator Seksi",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Wakil Koordinator Seksi",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Peninjau",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Penanggung jawab",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Steering Commite",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Wakil Ketua",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Sekretaris",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Bendahara",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Koordinator Seksi",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Wakil Koordinator Seksi",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Wasit",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Anggota",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Wasit",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Anggota",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Wasit",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Anggota",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "BEM",
                        "jabatan" => "Hakim Garis",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "MPM",
                        "jabatan" => "Hakim Garis",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Hakim Garis",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Peninjau",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Penanggung jawab",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Steering Commite",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Wakil Ketua",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Sekretaris",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Bendahara",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Koordinator Seksi",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Wakil Koordinator Seksi",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "BPH lainnya",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Wasit",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Anggota",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Hakim Garis",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Ketua",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Peninjau",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Penanggung jawab",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Steering Commite",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Wakil Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Sekretaris",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Bendahara",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Koordinator Seksi",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Wakil Koordinator Seksi",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "BPH lainnya",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Anggota",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Wasit",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Hakim Garis",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Ketua",
                        "poin" => 7
                    ],
                     [
                        "tingkat" => "Nasional",
                        "jabatan" => "Peninjau",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Penanggung jawab",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Steering Commite",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Wakil Ketua",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Sekretaris",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Bendahara",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Koordinator Seksi",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Wakil Koordinator Seksi",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "BPH lainnya",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Anggota",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Wasit",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Hakim Garis",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Ketua",
                        "poin" => 9
                    ],
                     [
                        "tingkat" => "Internasional",
                        "jabatan" => "Peninjau",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Penanggung jawab",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Steering Commite",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Wakil Ketua",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Sekretaris",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Bendahara",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Koordinator Seksi",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Wakil Koordinator Seksi",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "BPH lainnya",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Wasit",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Anggota",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Hakim Garis",
                        "poin" => 1
                    ]
                ]
            ],
            [
                "jenis_kegiatan" => "Prestasi Akademik/Non Akademik",
                "data" => [
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Juara 1",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Juara 2",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Juara 3",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Juara Harapan",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Peserta",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Juara 1",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Juara 2",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Juara 3",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Juara Harapan",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Peserta",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Juara 1",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Juara 2",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Juara 3",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Juara Harapan",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Peserta",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Juara 1",
                        "poin" => 7
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Juara 2",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Juara 3",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Juara Harapan",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Peserta",
                        "poin" => 1
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Juara 1",
                        "poin" => 9
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Juara 2",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Juara 3",
                        "poin" => 7
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Juara Harapan",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Peserta",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Juara 1",
                        "poin" => 13
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Juara 2",
                        "poin" => 12
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Juara 3",
                        "poin" => 11
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Juara Harapan",
                        "poin" => 10
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Peserta",
                        "poin" => 4
                    ]
                ]
            ],
            [
                "jenis_kegiatan" => "Pengabdian Masyarakat",
                "data" => [
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Ketua",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Ketua",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Jurusan",
                        "jabatan" => "Peserta",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Politeknik",
                        "jabatan" => "Peserta",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Ketua",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Kabupaten",
                        "jabatan" => "Peserta",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Provinsi",
                        "jabatan" => "Peserta",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Ketua",
                        "poin" => 6
                    ],
                    [
                        "tingkat" => "Nasional",
                        "jabatan" => "Peserta",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Ketua",
                        "poin" => 8
                    ],
                    [
                        "tingkat" => "Internasional",
                        "jabatan" => "Peserta",
                        "poin" => 7
                    ]
                ]
            ],
            [
                "jenis_kegiatan" => "Pendukung Lainnya",
                "data" => [
                    [
                        "tingkat" => "Peserta Hibah Nasional",
                        "jabatan" => "Ketua",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Peserta Hibah Nasional",
                        "jabatan" => "Anggota",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Peserta Inkubator Bisnis",
                        "jabatan" => "Ketua",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Peserta Inkubator Bisnis",
                        "jabatan" => "Anggota",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Pemenang Hibah Nasional",
                        "jabatan" => "Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Pemenang Hibah Nasional",
                        "jabatan" => "Anggota",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Pemenang Inkubator Bisnis",
                        "jabatan" => "Ketua",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Pemenang Inkubator Bisnis",
                        "jabatan" => "Anggota",
                        "poin" => 4
                    ],
                    [
                        "tingkat" => "Pengisi Acara",
                        "jabatan" => "Peserta",
                        "poin" => 2
                    ],
                    [
                        "tingkat" => "Donor Darah",
                        "jabatan" => "Peserta",
                        "poin" => 3
                    ],
                    [
                        "tingkat" => "Pertukaran Pelajar",
                        "jabatan" => "Nasional",
                        "poin" => 5
                    ],
                    [
                        "tingkat" => "Pertukaran Pelajar",
                        "jabatan" => "Internasional",
                        "poin" => 7
                    ]
                ]
            ]
        ];

        $tingkat = TingkatKegiatan::all();
        $jenis = JenisKegiatan::all();
        $posisi = Posisi::all();

        foreach ($poinCombinationList as $combination) {
            $jenisId = $jenis->firstWhere('jenis_kegiatan', $combination['jenis_kegiatan'])->idjenis_kegiatan;

            foreach ($combination['data'] as $item) {
                $tingkatId = optional($tingkat->firstWhere('tingkat_kegiatan', $item['tingkat']))->idtingkat_kegiatan;
                $posisiId = optional($posisi->firstWhere('nama_posisi', $item['jabatan']))->id_posisi;

                if (!$jenisId || !$tingkatId || !$posisiId) {
                    continue;
                }

                Poin::updateOrCreate(
                    [
                        'idjenis_kegiatan' => $jenisId,
                        'idtingkat_kegiatan' => $tingkatId,
                        'id_posisi' => $posisiId,
                    ],
                    [
                        'poin' => $item['poin']
                    ]
                );
            }
        }
    }
}
