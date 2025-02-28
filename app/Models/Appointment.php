<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        "name",
        "barber_id",
        "appointment",
    ];

    public function barber(){
        return $this->belongsTo(Barber::class);
    }
}
