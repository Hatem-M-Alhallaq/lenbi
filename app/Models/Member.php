<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Member extends Authenticatable
{
    use HasApiTokens , HasFactory, HasRoles;

    public function clink()
    {
        return $this->belongsTo(clink::class);
    }
}
