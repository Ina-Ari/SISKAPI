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
                        'prodi_name' => $this->englishName($value['kodeProdi']),
                        'jenjang' => $value['jenjang'],
                        'kode_jurusan' => $kodeJurusan
                    ]
                );
            });
        });
    }

    private function englishName(int $kodeProdi): string
    {
        return match($kodeProdi) {
            20403 => 'Electrical Engineering',
            21301 => 'Mechanical Design Engineering',
            21315 => 'Renewable Energy Engineering Technology',
            21401 => 'Mechanical Engineering',
            21405 => 'Refrigeration and Air Conditioning Engineering',
            21501 => 'Mechanical Manufacturing Engineering',
            22302 => 'Construction Project Management',
            22303 => 'Building Construction Engineering Technology',
            22305 => 'Water Building Construction Engineering Technology',
            22401 => 'Civil Engineering',
            22502 => 'Foundation, Concrete and Road Asphalting',
            36304 => 'Automation Engineering',
            54533 => 'Management of Digital Business Operations',
            56572 => 'Computer Network Administration',
            57401 => 'Informatics Management',
            58301 => 'Utility Engineering Technology',
            58302 => 'Software Engineering Technology',
            61316 => 'Digital Business',
            61503 => 'Tax Administration',
            61704 => 'Marketing, Innovation and Technology',
            62301 => 'Managerial Accounting',
            62303 => 'Tax Accounting',
            62401 => 'Accounting',
            63411 => 'Business Administration',
            63415 => 'Business Administration (Karangasem)',
            79302 => 'English for Business and Professional Communication',
            93103 => 'Tourism Planning',
            93298 => 'Tourism Business',
            93303 => 'Tourism Business Management',
            93308 => 'International Business Management',
            93401 => 'Travel agent',
            93402 => 'Hospitality',
            93410 => 'Hospitality (Lobar)',
            93411 => 'Hospitality (Karangasem)',
            93482 => 'Hospitality (Jembrana)',
        };
    }
}
