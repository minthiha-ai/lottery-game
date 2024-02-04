<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;

    protected $fillable = ['name','remark','lottery_number','top_number','date','status'];

    public function lottery_numbers()
    {
        return $this->hasMany(LotteryNumber::class);
    }

    public function hot_numbers()
    {
        return $this->hasMany(HotNumber::class);
    }

}
