<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use App\Apartment;
use App\Category;
use App\Service;
use App\User;
// use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userDashboard(){
        $apartments = Apartment::all();
        return view('pages.userDashboard',compact('apartments'));
    }
    public function apartmentCreate(){
        $categories = Category::all();
        $services = Service::all();
        return view('pages.apartmentCreate', compact('categories', 'services'));
    }
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
        dd($category);
        $apartment->category()->associate($category);
        $apartment->save();

        $services = Service::findOrFail($request->get('services'));
        $apartment->services()->attach($services);
        $apartment->save();
        
        return redirect()->route('userDashboard');
    }
}
