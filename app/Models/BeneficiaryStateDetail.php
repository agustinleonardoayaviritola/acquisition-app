<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryStateDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'beneficiary_state_id',
        'description',
        'state',
        'slug',
    ];


}
