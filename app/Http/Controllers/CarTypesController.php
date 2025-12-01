<?php

namespace App\Http\Controllers;

use App\Models\CarType;

class CarTypesController extends Controller
{
    public function index() {
        $car_types= CarType::all();
        // dd($car_types);
        return view('transport.transport', compact('car_types'));
    }
}
