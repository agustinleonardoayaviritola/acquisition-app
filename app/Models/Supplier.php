<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
    'person_id',
    'supplier_category_id',
    'name',
    'email',
    'address',
    'state',
    'slug',
    ];

    public function supplier_category()
    {
        return $this->hasOne(supplier_category::class);
    }

}
