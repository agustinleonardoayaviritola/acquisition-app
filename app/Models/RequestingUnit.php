<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RequestingUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'location_id',
        'name',
        'state',
        'slug',
    ];
}
