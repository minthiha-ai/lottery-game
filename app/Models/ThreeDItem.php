<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDItem extends Model
{
    use HasFactory;

    protected $fillable = ['lottery_id', 'lottery_number_id', 'number_id', 'user_id', 'price'];

    public function lottery_number()
    {
        return $this->belongsTo(ThreeDLotteryNumber::class, 'lottery_number_id');
    }

    public function number()
    {
        return $this->belongsTo(ThreeDNumber::class, 'number_id');
    }

    public function user()
    {
        return $this->belongsTo(ThreeDUser::class, 'user_id');
    }

    public function lottery() {
        return $this->belongsTo(ThreeDLottery::class, 'lottery_id');
    }
}
