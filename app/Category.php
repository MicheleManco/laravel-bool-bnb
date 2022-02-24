<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Apartment;

class Category extends Model
{
    protected $fillable = [
        'name', 
    ];

    public function apartments(){
        return $this->hasMany(Apartment::class);
    }
}
