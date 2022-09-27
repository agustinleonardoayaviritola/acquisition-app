<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunicipalityBasket extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'subgovernment_id',
        'management',
        'name',
        'description',
        'subgovernment_code',
        'start_date',
        'end_date',
        'number_baskets',
        'number_baskets_total',
        'number_baskets_delivered',
        'state',
        'slug'
    ];
}
