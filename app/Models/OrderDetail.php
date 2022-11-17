<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'unit_id',
        'quantity',
        'name',
        'price',
        'subtotal',
        'description',
        'slug',
        'state',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
