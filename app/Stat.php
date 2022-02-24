<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        'n_views', 
        'n_messages',
        'apartment_id',
    ];
}
