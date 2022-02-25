<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home(){
        return view('pages.home');
    }

    public function search(){
        $apartments = Apartment::all();
        return view('pages.search', compact('apartments'));
    }

    public function showApartment($id){
        $apartment = Apartment::findOrFail($id);
        return view('pages.apartmentDetails', compact('apartment'));
    }
}
