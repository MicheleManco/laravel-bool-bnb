<?php

namespace App\Http\Controllers;
use App\Apartment;
use App\User;
use Illuminate\Http\Request;

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
}
