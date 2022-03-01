<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;

class ApiController extends Controller
{
    public function getApartments(){

        $apartments = Apartment::all();

        return json_encode($apartments);
    }
}
