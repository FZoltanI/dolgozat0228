<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barber extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        "barber_name",
    ];

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
