<?php

namespace App\Http\Controllers\Dashboard;

use App\Construction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstructionController extends Controller
{
    public function index()
    {
        $constructions = new Construction();
        $constructions = $constructions
        ->get();
        return view('dashboard.construction.index', compact('constructions'));
    }
    public function create()
    {
        return view('dashboard.construction.create');
    }

    public function store(Request $request)
    {
        $construction = new Construction();
        $construction->name = $request->input('name');
        $construction->description  = $request->input('description');
        $construction->url = $request->input('url');
        $image= 'images/no-image.png';
        if (isset($request->imagen)) {
            $file = $request->imagen;
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/construccion', $filename);
            $image = 'images/construccion/'.$filename;
        }
        $construction->image = $image;

        if ($request->news) {
            $construction->news=1;
        }

        if ($construction->save()) {
            return redirect('dashboard/construccion-y-remodelacion')->with('success', 'Construcción Creada');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }
}
