<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreeDUserSetting extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','sales','za','limit','t_za','p_za'];
}
