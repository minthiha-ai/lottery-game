<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDLottery extends Model
{
    use HasFactory;

    protected $fillable = ['name','remark','lottery_number','top_number','date','status'];

    public function lottery_numbers()
    {
        return $this->hasMany(ThreeDLotteryNumber::class, 'lottery_id');
    }

    public function hot_numbers()
    {
        return $this->hasMany(ThreeDHotNumber::class, 'lottery_id');
    }
}
