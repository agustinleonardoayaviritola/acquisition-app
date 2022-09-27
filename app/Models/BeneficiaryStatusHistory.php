<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryStatusHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'beneficiary_id',
        'beneficiary_state_detail_id',
        'description',
        'slug',
    ];
}
