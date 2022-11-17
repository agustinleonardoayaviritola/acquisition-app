<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $fillable = [
        'person_id',
        'requesting_unit_id',
        'state',
        'slug',
    ];
    public function requestingunit()
    {
        return $this->belongsTo(RequestingUnit::class);
    }
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}