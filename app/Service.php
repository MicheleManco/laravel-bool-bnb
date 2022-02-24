<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Apartment;

class Service extends Model
{
    protected $fillable = [
        'name', 
    ];

    public function apartments(){
            return $this->belongsToMany(Apartment::class);
    }
}
