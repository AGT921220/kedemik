<?php

namespace App\Http\Controllers\Dashboard;

use App\Fovissste;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FovisssteController extends Controller
{
    public function index()
    {
        $fovissstes = new Fovissste();
        $fovissstes = $fovissstes
        ->get();
        return view('dashboard.fovissste.index', compact('fovissstes'));
    }
    public function create()
    {
        return view('dashboard.fovissste.create');
    }

    public function store(Request $request)
    {
        $fovissste = new Fovissste();
        $fovissste->name = $request->input('name');
        $fovissste->description  = $request->input('description');
        $fovissste->url = $request->input('url');
        $image= 'images/defaults/fovissste.jpeg';
        if (isset($request->imagen)) {
            $file = $request->imagen;
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/fovissste', $filename);
            $image = 'images/fovissste/'.$filename;
        }
        $fovissste->image = $image;

        if ($request->news) {
            $fovissste->news=1;
        }

        if ($fovissste->save()) {
            return redirect('dashboard/fovissste')->with('success', 'Fovissste Creado');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }
}
