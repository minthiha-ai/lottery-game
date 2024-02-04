<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Number extends Model
{
    use HasFactory;

    protected $fillable = ['number'];

    public function lottery_numbers()
    {
        return $this->belongsToMany(LotteryNumber::class, 'items');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function user_numbers()
    {
        return $this->belongsToMany(User::class, 'items');
    }
}
