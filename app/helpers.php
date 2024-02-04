<?php

use Carbon\Carbon;

function checkLotteryTime() {
    // Get the current time
    $currentTime = Carbon::now();

    // Check if it's AM or PM
    $amOrPm = $currentTime->format('A'); // 'A' format returns 'AM' or 'PM'

    return $amOrPm;

}
