<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryNumber extends Model
{
    use HasFactory;

    protected $fillable = ['lottery_id','user_id','name','total_numbers','total_price'];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function numbers()
    {
        return $this->belongsToMany(Number::class, 'items');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
