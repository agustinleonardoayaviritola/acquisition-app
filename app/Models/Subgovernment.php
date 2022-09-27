<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgovernment extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'user_id',
        'photo',
        'municipality_id',
        'description',
        'state',
        'slug'
    ];
}
