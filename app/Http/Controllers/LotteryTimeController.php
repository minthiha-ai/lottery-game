<?php

namespace App\Http\Controllers;

use App\Models\Lottery;
use App\Models\ThreeDLottery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LotteryTimeController extends Controller
{
    public function updateTime($time) {
        // return $time;
        if ($time == 'am') {
            $data = Lottery::where('name', 'am')->latest()->first();
        } else {
            $data = Lottery::where('name', 'pm')->latest()->first();
        }
        $data->update(['status' => 'off']);

        return response()->json(['data' => $data]);
    }

    public function threeDupdateTime($time)
    {
        // return $time;
        if ($time == 'am') {
            $data = ThreeDLottery::where('name', 'am')->latest()->first();
        }
        if($time == 'pm'){
            $data = ThreeDLottery::where('name', 'pm')->latest()->first();
        }
        $data->update(['status' => 'off']);

        return response()->json(['data' => $data]);
    }


}
