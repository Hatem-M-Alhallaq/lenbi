<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class clink extends Authenticatable
{
    use HasFactory, HasRoles;

    public function getFullNameAttribute()
    {
        return $this->user->first_name;
    }

    public function user()
    {
        return $this->morphOne(User::class, 'actor', 'actor_type', 'actor_id', 'id');
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
