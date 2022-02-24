<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
        'name', 
        'duration',
        'price',
    ];

    public function apartments(){
        return $this->belongsToMany(Apartment::class);
    }
}
