<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['lottery_id', 'lottery_number_id', 'number_id', 'user_id', 'price'];

    public function lottery_number()
    {
        return $this->belongsTo(LotteryNumber::class);
    }

    public function number()
    {
        return $this->belongsTo(Number::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }

}
