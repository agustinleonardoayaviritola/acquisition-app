<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeighborhoodCommunity extends Model
{
    use HasFactory;
    protected $fillable = [
        'canton_district_id',
        'name',
        'type',
        'description',
        'subgovernment_code',
        'state',
        'slug',
        
    ];
}
