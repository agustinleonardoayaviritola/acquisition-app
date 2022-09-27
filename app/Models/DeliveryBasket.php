<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryBasket extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'beneficiary_id',
        'delivery_point_id',
        'delivery_id',
        'date_delivery',
        'subgovernment_code',
        'municipality_id',
        'slug',
        'state',
        'state_delivery'
        ];


        public function neighborhood_communities()
        {
            return $this->belongsTo(NeighborhoodCommunity::class)->withTimestamps();
        }
}
