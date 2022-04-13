<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoFactor extends Model
{
    use HasFactory;

    public $table = "two_factor_user_codes";

    protected $fillable = [
        'user_id',
        'code',
    ];
}
