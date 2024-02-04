<?php

namespace Database\Seeders;

use App\Models\ThreeDUser;
use App\Models\ThreeDUserSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ThreeDUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin

        ThreeDUser::create([
            'username' => 'Admin',
            'name' => 'Kyee Pwar',
            'email' => 'admin@gmail.com',
            'phone' => '09123456789',
            'password' => Hash::make('password'),
            'roles' => 1
        ]);

        // Agent Or User

        ThreeDUser::create([
            'username' => 'User1',
            'name' => 'Mg Mg',
            'email' => 'user1@gmail.com',
            'phone' => '09123456788',
            'password' => Hash::make('password'),
            'roles' => 0
        ]);

        ThreeDUser::create([
            'username' => 'User2',
            'name' => 'Kyaw Kyaw',
            'email' => 'user2@gmail.com',
            'phone' => '09123456787',
            'password' => Hash::make('password'),
            'roles' => 0
        ]);

        ThreeDUserSetting::create([
            'user_id' => 1
        ]);

        ThreeDUserSetting::create([
            'user_id' => 2
        ]);

        ThreeDUserSetting::create([
            'user_id' => 3
        ]);
    }
}
