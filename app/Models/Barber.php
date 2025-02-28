<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $fillable = [
        "barber_name",
    ];

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
