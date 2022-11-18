<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'order_type_id',
        'code',
        'applicant_id',
        'application_number',
        'issue_date',
        'delivery_time',
        'observation',
        'total',
        'slug',
        'state',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function ordercode()
    {
        return $this->belongsTo(OrderCode::class);
    }
    public function ordertype()
    {
        return $this->belongsTo(OrderType::class);
    }
    public function requestingunit()
    {
        return $this->belongsTo(RequestingUnit::class);
    }
}
