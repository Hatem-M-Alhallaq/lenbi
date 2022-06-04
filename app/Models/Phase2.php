<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase2 extends Model
{
    use HasFactory;
    protected $fillable = [
        'app_id',
        'full_namme',
        'id_number',
        'owner_precentage',
        'dab',
        'spouse_name',
        'spouse_id',
        'spouse_ocupation',
        'address',
        'email',
        'phone',
        'is_owned_house',
        'amount',

    ];
}
