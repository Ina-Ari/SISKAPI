<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpapkkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_id = Role::where('nama', Role::UPAPKK)->value('id');
        $user = User::updateOrCreate(
            ['username' => '000000000000000003'],
            [
                'nama' => 'Test UPAPKK',
                'email' => 'testupapkk@example.com',
                'password' => 'testupapkk123',
                'role_id' => $role_id,
            ]
        );
        $user->upapkk()->updateOrCreate(
            ['nip' => '000000000000000003'],
            ['is_active' => true]
        );
    }
}
