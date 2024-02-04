<?php

namespace Database\Seeders;

use App\Models\ThreeDNumber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThreeDNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($number = 0; $number < 1000; $number++) {
            $numStr = str_pad($number, 3, '0', STR_PAD_LEFT); // Convert number to 2-digit format
            $data[] = $numStr;
        }

        foreach ($data as $value) {
            ThreeDNumber::create(['number' => $value]);
        }
    }
}
