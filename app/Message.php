<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'email', 
        'name',
        'surname',
        'text',
        'apartment_id',
    ];

    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }
}
