<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin1',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('123'),
                'is_admin' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
