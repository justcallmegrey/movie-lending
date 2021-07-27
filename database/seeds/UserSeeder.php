<?php

use App\Models\Constants;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Constants::DEFAULT_PASSWORD,
                'role' => 'admin'
            ],
        ];

        foreach ($users as $user) {
            User::create(collect($user)->except('role')->toArray())->assignRole($user['role']);
        }
    }
}
