<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

    protected $table = 'foods';

    protected $fillable = [
        'user_id',
        'store_name',
        'food_name',
        'image',
        'original_price',
        'rescue_price',
        'portions',
        'location',
        'latitude',
        'longitude',
        'expired_at',
        'status'
    ];
}
