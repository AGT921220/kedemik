<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\Propertie;
use Illuminate\Http\Request;
use App\Propiedad;
use App\Publication;
use App\Slider;
use App\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $users = User::all();
        // dd($users->toArray());
        $properties = new Propertie();
        $properties = $properties
        ->select('properties.*', 'properties_types.name as type')
        ->join('properties_types', 'properties_types.id', 'properties.propertie_type')
        ->where('properties.news', 1)
        ->get();
        $types = Propertie::SALE_RENT;

        $rents = $properties->where('sale_rent', 'rent');
        $sales = $properties->where('sale_rent', 'sale');

        $sliders = new Slider();
        $sliders = $sliders->get();
        return view('news.home', compact('sliders', 'types','sales','rents'));
    }
}
