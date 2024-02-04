<?php

namespace Database\Seeders;

use App\Models\LotteryTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LotteryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = new LotteryTime();
        $time->type = 0;
        $time->time = 'am';
        $time->save();

        $time = new LotteryTime();
        $time->type = 1;
        $time->time = 'pm';
        $time->save();
    }
}
