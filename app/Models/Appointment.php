<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        "name",
        "barber_id",
        "appointment",
    ];

    public function barber(){
        return $this->belongsTo(Barber::class);
    }
}
