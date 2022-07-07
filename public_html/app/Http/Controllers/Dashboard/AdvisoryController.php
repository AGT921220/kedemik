<?php

namespace App\Http\Controllers\Dashboard;

use App\Advisory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvisoryController extends Controller
{
    public function index()
    {
        $advisories = new Advisory();
        $advisories = $advisories
        ->get();
        return view('dashboard.advisory.index', compact('advisories'));
    }
    public function create()
    {
        return view('dashboard.advisory.create');
    }

    public function store(Request $request)
    {
        $advisory = new Advisory();
        $advisory->name = $request->input('name');
        $advisory->description  = $request->input('description');
        $advisory->url = $request->input('url');
        $image= 'images/no-image.png';
        if (isset($request->imagen)) {
            $file = $request->imagen;
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/asesoria', $filename);
            $image = 'images/asesoria/'.$filename;
        }
        $advisory->image = $image;

        if ($request->news) {
            $advisory->news=1;
        }

        if ($advisory->save()) {
            return redirect('dashboard/asesorias')->with('success', 'Asesoría Creada');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }
}
