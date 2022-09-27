<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'product_id',
        'basket_id',
        'amount',
        'state',
        'subgovernment_code',
        'slug'

    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }


}
