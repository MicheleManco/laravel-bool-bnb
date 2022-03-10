<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Category;
use App\Service;
use App\ApartmentSponsorship;    
use App\Message;
use App\Stat;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // mostra la view home
    public function home(){

        $apartments = Apartment::all();
        $apartmentSponsorship = ApartmentSponsorship::all();

        $filterSponsor = array();

        foreach ($apartmentSponsorship as $apartmentSponsor) {
            foreach ($apartments as $apartment) {
            if ($apartmentSponsor->apartment_id == $apartment->id) {
                array_push($filterSponsor, $apartmentSponsorship);
            }
            }
            
        }

        return view('pages.home', compact('apartments', 'apartmentSponsorship', 'filterSponsor'));
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
        // $apartment->views+=1;
        // $apartment->save();

        $stats = Stat::all();
        foreach ($stats as $stat) {
            if ($stat->apartment_id == $id) {
                $stat -> n_views += 1;
            }
            
            $stat->save();
        }

        $messages= Message::all();
        $messages->apartment_id = $apartment->id;

   
        // $stats->save();
    
        return view('pages.apartmentDetails', compact('apartment', 'stats'));
    }

    public function messages(Request $request, $id){
        $data= $request-> validate ([
           'name' => 'required|string|min:3', 
           'surname' => 'string',
           'email' => 'required|string',
           'text' => 'min:6|string'

        ]);
        $message = Message::make($data);
        $apartment = Apartment::findOrFail($id);
        $message->apartment_id = $apartment->id;
        $message->save();

        $stats = Stat::all();
        foreach ($stats as $stat) {
            if ($stat->apartment_id == $id) {
                $stat -> n_messages += 1;
            }
            
            $stat->save();
        }

        return view('pages.apartmentDetails', compact('apartment'));
    }
}
