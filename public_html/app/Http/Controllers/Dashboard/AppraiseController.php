<?php

namespace App\Http\Controllers\Dashboard;

use App\Appraise;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppraiseController extends Controller
{
    public function index()
    {
        $appraises = new Appraise();
        $appraises = $appraises
        ->get();
        return view('dashboard.appraise.index', compact('appraises'));
    }
    public function create()
    {
        return view('dashboard.appraise.create');
    }

    public function store(Request $request)
    {
        $appraise = new Appraise();
        $appraise->name = $request->input('name');
        $appraise->description  = $request->input('description');
        $appraise->url = $request->input('url');
        $image= 'images/no-image.png';
        if (isset($request->imagen)) {
            $file = $request->imagen;
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/avaluos', $filename);
            $image = 'images/avaluos/'.$filename;
        }
        $appraise->image = $image;

        if ($request->news) {
            $appraise->news=1;
        }

        if ($appraise->save()) {
            return redirect('dashboard/avaluos')->with('success', 'Avalúo Creado');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }
}
