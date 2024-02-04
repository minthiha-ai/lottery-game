<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Setting();
        $data->title = "အများဆုံးထိုးနိုင်မည့် ပမာဏကို ထိန်းချုပ်ခြင်း";
        $data->status = 0;
        $data->save();

        $data = new Setting();
        $data->title = "ထိပ်ပိတ်ဂဏန်းများကို ကော်စားများအား ပြသခြင်း";
        $data->status = 1;
        $data->save();
    }
}
