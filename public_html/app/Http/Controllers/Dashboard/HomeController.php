<?php

namespace App\Http\Controllers\Dashboard;

class HomeController
{
    public function index()
    {
        return view('dashboard.home');

        return 'VIEW';
    }
}
