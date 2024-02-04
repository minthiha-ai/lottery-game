<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDLotteryNumber extends Model
{
    use HasFactory;

    protected $fillable = ['lottery_id','user_id','name','total_numbers','total_price'];

    public function lottery()
    {
        return $this->belongsTo(ThreeDLottery::class, 'lottery_id');
    }

    public function user()
    {
        return $this->belongsTo(ThreeDUser::class, 'user_id');
    }

    public function numbers()
    {
        return $this->belongsToMany(ThreeDNumber::class, 'three_d_items', 'lottery_number_id', 'number_id');
    }

    public function items()
    {
        return $this->hasMany(ThreeDItem::class, 'lottery_number_id');
    }
}
