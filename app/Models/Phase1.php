<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase1 extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'company_number',
        'bank_name',
        'application_id',
        'submit_date',

    ];
}
