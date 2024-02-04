<?php

namespace App\Console\Commands;

use App\Models\Lottery;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateLotteryStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottery:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update lottery statuses';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        // Check if it's AM or PM
        $amOrPm = $now->format('A'); // 'A' format returns 'AM' or 'PM'

        if ($amOrPm === 'AM') {
            $data = Lottery::orderBy('id', 'desc')->where([['name', 'am'],['status','1']])->first();
            $data->update(['status' => 1]);
            $this->info("Lottery '{$data->name}' is now active.");
        } else {
            $data = Lottery::orderBy('id', 'desc')->where([['name', 'am'],['status','1']])->first();
            $data->update(['status' => 1]);
            $this->info("Lottery '{$data->name}' is now active.");
        }
    }
}
