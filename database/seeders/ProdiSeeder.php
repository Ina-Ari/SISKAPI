<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusan = Jurusan::all();

        $jurusan->each(function($jurusan) {
            $kodeJurusan = $jurusan->kode_jurusan;

            $hashCode = strtoupper(hash('sha256', $kodeJurusan . config('services.pnb_api.key')));

            $response = Http::post(config('services.pnb_api.url') . '/daftarprogramstudi', [
                'kodeJur' => $kodeJurusan,
                'HashCode' => $hashCode,
            ]);

            if (!$response->successful()) {
                $this->command->warn("Gagal mengambil data prodi untuk jurusan {$kodeJurusan}");
                return;
            }

            $prodiList = $response->collect('daftar');

            $prodiList->each(function($value) use($kodeJurusan) {
                Prodi::updateOrCreate(
                    ['kode_prodi' => $value['kodeProdi']],
                    [
                        'nama_prodi' => $value['namaProdi'],
                        'jenjang' => $value['jenjang'],
                        'kode_jurusan' => $kodeJurusan
                    ]
                );
            });
        });
    }
}
