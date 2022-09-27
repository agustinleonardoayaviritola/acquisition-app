<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPoint extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'name',
        'description',
        'slug',
        'subgovernment_code',
        'municipality_id',
        'state'

    ];
}
