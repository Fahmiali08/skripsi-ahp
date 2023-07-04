<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'user_id' => '12457855',
                'username' => 'admin',
                'name' => 'Admin Page',
                'email' => 'admin@example.com',
                'role_id' => 1,
                'password' => bcrypt('123456'),
            ],
            [
                'user_id' => '12457145',
                'username' => 'guru',
                'name' => 'ini akun Guru (non admin)',
                'email' => 'guru@example.com',
                'role_id' => 2,
                'password' => bcrypt('123456'),
            ],
            [
                'user_id' => '12485445',
                'username' => 'siswa',
                'name' => 'ini akun Siswa (non admin)',
                'email' => 'siswa@example.com',
                'role_id' => 3,
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
