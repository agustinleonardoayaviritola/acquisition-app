<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'neighborhood_community_id',
        'state',
        'slug',
        'reference_name',
        'photo',
        'file',
        'person_id',
        'profession_id',
        'country_id',
        'department_id',
        'beneficiary_state_id',
        'subgovernment_code',
    ];
    public function person()
    {
        return $this->hasOne(Person::class);
    }
    public function profession()
    {
        return $this->hasOne(Profession::class);
    }
    public function country()
    {
        return $this->hasOne(Country::class);
    }
    public function beneficiary_state()
    {
        return $this->hasOne(BeneficiaryState::class);
    }
}
