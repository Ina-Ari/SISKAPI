<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_id = Role::where('nama', Role::BAAK)->value('id');
        $user = User::updateOrCreate(
            ['username' => '000000000000000002'],
            [
                'nama' => 'Test BAAK',
                'email' => 'testbaak@example.com',
                'password' => 'testbaak123',
                'role_id' => $role_id,
            ]
        );
        $user->baak()->updateOrCreate(
            ['nip' => '000000000000000002'],
            ['is_active' => true]
        );
    }
}
