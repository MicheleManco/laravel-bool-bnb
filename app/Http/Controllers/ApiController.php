<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getApartments() {
        $apartments = Apartment::all();
        return json_encode($apartments);
    }
}
