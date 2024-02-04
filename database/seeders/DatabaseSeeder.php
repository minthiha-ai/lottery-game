<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LotteryTime;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            LotteryTimeSeeder::class,
            SettingSeeder::class,
            NumberSeeder::class,
            ThreeDUserSeeder::class,
            ThreeDNumberSeeder::class
        ]);
    }
}
