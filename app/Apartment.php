<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title', 
        'description',
        'address',
        'city',
        'cap',
        'sqmeters',
        'rooms',
        'beds',
        'bathrooms',
        'price',
        'latitude',
        'longitude',
        'n_sponsorships',
        'user_id',
        'category_id',
    ];
}
