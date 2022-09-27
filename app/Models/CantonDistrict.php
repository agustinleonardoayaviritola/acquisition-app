<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CantonDistrict extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'municipality_id',
        'type',
        'name',
        'description',
        'subgovernment_code',
        'state',
        'slug',
    ];
    public function neighborhoodcommunitiess()
    {
        return $this->hasOne(NeighborhoodCommunity::class)->withDefault();
    }
}
