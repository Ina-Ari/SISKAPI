<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Kepala Prodi', 'BAAK', 'UPAPKK', 'Mahasiswa'] as $name) {
            Role::updateOrCreate(['nama' => $name]);
        }
    }
}
