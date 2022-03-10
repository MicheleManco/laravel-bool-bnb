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
        'views',
        'user_id',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class);
    }

    public function sponsorships(){
        return $this->belongsToMany(Sponsorship::class);
    }

}
