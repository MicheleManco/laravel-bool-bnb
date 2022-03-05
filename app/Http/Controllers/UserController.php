<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use App\Apartment;
use App\Category;
use App\Service;
use App\Image;
Use App\Sponsorship;
use App\ApartmentSponsorship;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Carbon;
Use Carbon\Carbon;

class UserController extends Controller
{
    // costruttore dell'autorizzazione (login)
    public function __construct()
    {
        $this->middleware('auth');
    }

    // mostra la pagina di dashboard dell'utente con la lista dei suoi appartamenti
    public function userDashboard(){
        $apartments = Apartment::all();
        return view('pages.userDashboard',compact('apartments'));
    }

    // ----------------------------------------------------------------------------------------------------
    // crea nuovo appartamento
    public function apartmentCreate(){
        $categories = Category::all();
        $services = Service::all();
        return view('pages.apartmentCreate', compact('categories', 'services'));
    }
    // salva nuovo appartamento
    public function apartmentStore(Request $request){
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'cap' => 'required|string',
            'sqmeters' => 'required|numeric',
            'rooms' => 'required|numeric',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $user = Auth::user();
        $data['user_id'] = $user->id;
        
        $apartment = Apartment::make($data);
        
        $category = Category::findOrFail($request->get('category'));
        $apartment->category()->associate($category);
        $apartment->save();
        
        $services = []; //salva i servizi in un array vuoto
        if ($request->has('services')) { //controlla se l'appartamento ha servizi
            $services = Service::findOrFail($request->get('services'));
        }
        $apartment->services()->attach($services);
        $apartment->save();

        // caricamento immagini nel database

        $files = $request->file('images'); //file è un'immagine
        if($request->hasFile('images')) {  //immagini ciclate e salvate
            $data = [];
            foreach($files as $file) {
                $file->store('apartments/'. $apartment->id . '/images');
                $data[] = [
                    'fileName' => $file->getClientOriginalName(), 
                    'altText' => 'prova img 1',
                    'cover' => true
                ];
            }
            $apartment->images()->createMany($data);
        }
                
        return redirect()->route('userDashboard');
    }
    // modifica appartamento
    public function apartmentEdit($id){
        $categories = Category::all();
        $services = Service::all();        
        $apartment = Apartment::findOrFail($id);
        return view('pages.apartmentEdit', compact('categories', 'services', 'apartment'));
    }
    // salva le modifiche dell'appartamento
    public function apartmentUpdate(Request $request, $id){

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'cap' => 'required|string',
            'sqmeters' => 'required|numeric',
            'rooms' => 'required|numeric',
            'beds' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $apartment = Apartment::findOrFail($id);
        $apartment->update($data);
        $category = Category::findOrFail($request->get('category'));
        $apartment->category()->associate($category);
        $apartment->save();
        
        $services = [];
        if ($request->has('services')) {
            $services = Service::findOrFail($request->get('services'));
        }
        $apartment->services()->sync($services);
        $apartment->save();
        
        return redirect()->route('userDashboard');
    }
    // elimina appartamento
    public function apartmentDelete($id) {
        $apartment = Apartment::findOrFail($id);

        $apartment->services()->sync([]);
        $apartment->save();        

        $apartment->delete();
        return redirect()->route('userDashboard');
        
    }



    public function sponsor($id){
        $apartment = Apartment::findOrFail($id);
        $sponsorship = Sponsorship::all();
        $apartmentSponsorship = ApartmentSponsorship::all();
    
        return view('pages.sponsorship', compact('apartment', 'sponsorship', 'apartmentSponsorship'));
    }

    public function sponsorStore($apartment_id, $sponsor_id) {

        return view('pages.payment',compact("apartment_id","sponsor_id"));
    }

    // public function payment(){
       

    //     return view('pages.payment');
    // }

    public function paymentStore(Request $request, $apartment_id,$sponsor_id){
       
        $data = $request->validate([             
            'start_date' => 'required|date',             
            'end_date' => 'required|date',         
        ]);                  
        
        $apartmentSponsorship= ApartmentSponsorship::make($data);          
        $apartment = Apartment::findOrFail($apartment_id);                  
        $apartmentSponsorship->apartments()->associate($apartment);                   
        $apartmentSponsorship->save();                    
        $sponsorship = Sponsorship::findOrFail($sponsor_id);    
        $apartmentSponsorship->sponsorship()->associate($sponsorship);           
        $apartmentSponsorship->save();
        



        // $dateNow = Carbon::now();

        // $apartmentSponsorship['start_date'] = $dateNow;

        // $apartmentSponsorship['end_date'];
        
        return view('pages.sponsorship');
    }
}
