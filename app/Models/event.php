<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'start', 'end','user_id', 'clink_id'
    ];
    public function member(){
        return $this->belongsTo(Member::class);
    }
}
