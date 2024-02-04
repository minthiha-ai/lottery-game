<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetThreedData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:threed-lottery-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset all 3D lottery data.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Delete all records from tables
        DB::table('three_d_items')->delete();
        DB::table('three_d_lottery_numbers')->delete();
        DB::table('three_d_lotteries')->delete();

        // Reset auto-increment IDs
        DB::statement('ALTER TABLE three_d_items AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE three_d_lottery_numbers AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE three_d_lotteries AUTO_INCREMENT = 1');

        $this->info('Data cleared and auto-increment IDs reset successfully.');
    }
}
