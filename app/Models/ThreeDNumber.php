<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDNumber extends Model
{
    use HasFactory;

    protected $fillable = ['number'];

    public function lottery_numbers()
    {
        return $this->belongsToMany(ThreeDLotteryNumber::class, 'three_d_items', 'number_id', 'lottery_number_id');
    }

    public function items()
    {
        return $this->hasMany(ThreeDItem::class, 'number_id');
    }

    public function user_numbers()
    {
        return $this->belongsToMany(ThreeDUser::class, 'three_d_items', 'user_id', 'lottery_number_id');
    }
}
