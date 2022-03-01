<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Category;
use App\Service;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getCategories() {
        $categories = Category::all();
        return json_encode($categories);
    }
    public function getServices() {
        $services = Service::all();
        return json_encode($services);
    }

    public function getFilteredApartments(Request $request) {
        
    }
}
