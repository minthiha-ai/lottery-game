<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Admin

        User::create([
            'username' => 'Admin',
            'name' => 'Kyee Pwar',
            'email' => 'admin@gmail.com',
            'phone' => '09123456789',
            'password' => Hash::make('password'),
            'roles' => 1
        ]);

        // Agent Or User

        User::create([
            'username' => 'User1',
            'name' => 'Mg Mg',
            'email' => 'user1@gmail.com',
            'phone' => '09123456788',
            'password' => Hash::make('password'),
            'roles' => 0
        ]);

        User::create([
            'username' => 'User2',
            'name' => 'Kyaw Kyaw',
            'email' => 'user2@gmail.com',
            'phone' => '09123456787',
            'password' => Hash::make('password'),
            'roles' => 0
        ]);

        UserSetting::create([
            'user_id' => 1
        ]);

        UserSetting::create([
            'user_id' => 2
        ]);

        UserSetting::create([
            'user_id' => 3
        ]);
    }
}
