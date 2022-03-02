<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Category;
use App\Service;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // mostra la view home
    public function home(){

        $apartments = Apartment::all();

        return view('pages.home', compact('apartments'));
    }

    public function pageRegister(){

        return view('pages.register');
    }

    public function pageLogin(){

        return view('pages.login');
    }

    // mostra la pagina di ricerca avanzata
    public function search(){
        $apartments = Apartment::all();
        $categories = Category::all();
        $services = Service::all();
        return view('pages.search', compact('apartments', 'categories', 'services'));
    }

    // mostra la pagina di dettaglio del singolo appartamento
    public function showApartment($id){
        $apartment = Apartment::findOrFail($id);
        return view('pages.apartmentDetails', compact('apartment'));
    }

    public function salvataggioimmagine($idAppartamento, Request $request){
       
    }
}
