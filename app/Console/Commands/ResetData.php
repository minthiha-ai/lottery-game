<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:lottery-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset all lottery data.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Delete all records from tables
        DB::table('items')->delete();
        DB::table('lottery_numbers')->delete();
        DB::table('lotteries')->delete();

        // Reset auto-increment IDs
        DB::statement('ALTER TABLE items AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE lottery_numbers AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE lotteries AUTO_INCREMENT = 1');

        $this->info('Data cleared and auto-increment IDs reset successfully.');
    }
}
