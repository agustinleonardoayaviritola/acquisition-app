<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'code',
        'name',
        'price_amount',
        'description',
        'state',
        'subgovernment_code',
        'municipality_id',
        'slug'

    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
