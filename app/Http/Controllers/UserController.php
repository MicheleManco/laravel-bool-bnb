<?php

namespace App\Http\Controllers;
use App\Apartment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userDashboard(){
        return view('pages.userDashboard');
    }
}
