<?php

namespace Database\Seeders;

use App\Models\Number;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($number = 0; $number < 100; $number++) {
            $numStr = str_pad($number, 2, '0', STR_PAD_LEFT); // Convert number to 2-digit format
            $data[] = $numStr;
        }

        foreach ($data as $value) {
            Number::create(['number'=>$value]);
        }
    }
}
