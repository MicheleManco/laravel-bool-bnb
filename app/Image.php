<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'fileName', 
        'altText',
        'cover',
        'apartment_id',
    ];

    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }
}
