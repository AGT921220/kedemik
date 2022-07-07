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
        return view('welcome');
        return 'index';
    }
}
