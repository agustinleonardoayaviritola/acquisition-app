<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryState extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'state',
        'slug',
    ];

    public function beneficiary()
    {
        return $this->hasOne(Beneficiary::class);
    }
}
