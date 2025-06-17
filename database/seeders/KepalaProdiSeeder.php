<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepalaProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_id = Role::where('nama', Role::KEPALA_PRODI)->value('id');
        $user = User::updateOrCreate(
            ['username' => '000000000000000001'],
            [
                'email' => 'testkaprodi@example.com',
                'nama' => 'Test Kaprodi',
                'password' => 'testkaprodi123',
                'role_id' => $role_id,
            ]
        );
        $user->kepalaProdi()->updateOrCreate(
            ['nip' => '000000000000000001'],
            [
                'nidn' => '1234567890',
                'angkatan' => '20222',
                'kode_prodi' => '58302',
                'is_active' => true,
            ]
        );
    }
}
