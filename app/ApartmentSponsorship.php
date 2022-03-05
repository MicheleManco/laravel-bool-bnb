<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentSponsorship extends Model
{
    protected $fillable = [

        'start_date',
        'end_date',
        'apartment_id',
        'sponsorship_id',
    ];

    public function apartments(){
        return $this->belongsTo(Apartment::class);
    }

    public function sponsorship(){
        return $this->belongsTo(Sponsorship::class);
    }
}
