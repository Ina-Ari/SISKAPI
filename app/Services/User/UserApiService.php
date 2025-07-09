<?php

namespace App\Services\User;

use App\Models\Role;
use App\Services\User\UserApiServiceInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class UserApiService implements UserApiServiceInterface
{
    public function getMahasiswa(array $column): array|null
    {
        $academicYears = config('services.pnb_api.academic_years.student');
        $data = null;

        foreach ($academicYears as $year) {
            $response = $this->requestMahasiswaData($year);
            $data = $response->first(function ($item) use ($column) {
                return $this->matchesColumn($item, $column);
            });

            if ($data) {
                $data = $this->requestDetailMahasiswaData($data['nim'])->toArray();
                break;
            }
        }

        return $data ? $this->mapUserData($data, Role::MAHASISWA) : null;
    }

    private function requestMahasiswaData($year): Collection
    {
        $hashCode = strtoupper(hash('sha256', $year . config('services.pnb_api.key')));
        $response = Http::post(config('services.pnb_api.url') . '/mahasiswa', [
            'tahunAkademik' => $year,
            'HashCode' => $hashCode
        ])->collect('daftar');

        return $response;
    }

    private function requestDetailMahasiswaData(string $nim): Collection
    {
        $hashCode = strtoupper(hash('sha256', $nim . config('services.pnb_api.key')));
        $response = Http::get(config('services.pnb_api.url') . "/mahasiswa/$nim&$hashCode")->collect('profile');

        return $response;
    }

    public function getDosen(array $column): array|null
    {
        $academicYears = config('services.pnb_api.academic_years.lecturer');
        $data = null;

        foreach ($academicYears as $year) {
            $response = $this->requestDosenData($year);
            $data = $response->first(function ($item) use ($column) {
                return $this->matchesColumn($item, $column);
            });

            if ($data) {
                break;
            }
        }

        return $data ? $this->mapUserData($data, Role::KEPALA_PRODI) : null;
    }

    private function requestDosenData($year): Collection
    {
        $hashCode = strtoupper(hash('sha256', $year . config('services.pnb_api.key')));
        $response = Http::post(config('services.pnb_api.url') . '/daftardosen', [
            'tahunAkademik' => $year,
            'HashCode' => $hashCode
        ])->collect('daftar');

        return $response;
    }

    public function getPegawai(array $column): array|null
    {
        return []; // This method is not implemented yet.
    }

    private function requestPegawaiData()
    {
        // This method is not implemented yet.
    }

    public function getUserByRoleName(string $roleName, array $column): array|null
    {
        return match ($roleName) {
            Role::MAHASISWA => $this->getMahasiswa($column),
            Role::KEPALA_PRODI => $this->getDosen($column),
        };
    }

    private function matchesColumn(array $item, array $column): bool
    {
        foreach ($column as $key => $value) {
            if (!isset($item[$key]) || $item[$key] != $value) {
                return false;
            }
        }
        return true;
    }

    private function mapUserData(array $data, string $role): array
    {
        $user = [
            'nama' => $data['nama'] ?? '',
            'email' => $data['email'] ?? '',
            'telepon' => $data['telepon'] ?? '',
        ];

        $user += match ($role) {
            Role::MAHASISWA => [
                'nim' => $data['nim'] ?? null,
                'tanggal_lahir' => Carbon::createFromFormat('m/d/Y h:i:s A', $data['tglLahir'])->translatedFormat('Y-m-d') ?? null,
                'tempat_lahir' => $data['tmpLahir'] ?? null,
                'telepon' => $data['telepon'] ?? null,
                'kode_prodi' => $data['kodeProdi'] ?? null,
                'kode_jurusan' => $data['kodeJurusan'] ?? null,
                'angkatan' => $data['smtAwal'] ?? null,
            ],
            Role::KEPALA_PRODI => [
                'nip' => $data['nip'] ?? null,
                'kode_prodi' => $data['kodeProdi'] ?? null,
                'kode_jurusan' => $data['kodeJurusan'] ?? null,
                'angkatan' => $data['tahunAkademik'] ?? null,
            ],
            Role::BAAK, Role::UPAPKK => [
                'nip' => $data['nip'] ?? null,
            ],
            default => [],
        };

        return $user;
    }
}
