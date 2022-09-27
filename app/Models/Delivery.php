<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'municipality_basket_id',
        'basket_id',
        'description',
        'subgovernment_code',
        'month',
        'start_date',
        'end_date',
        'number_baskets',
        'number_baskets_total',
        'number_baskets_delivered',
        'state',
        'slug'
    ];
}
