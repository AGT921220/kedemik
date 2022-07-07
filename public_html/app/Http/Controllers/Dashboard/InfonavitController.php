<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Infonavit;
use Illuminate\Http\Request;

class InfonavitController extends Controller
{
    public function index()
    {
        $infonavits = new Infonavit();
        $infonavits = $infonavits
        ->get();
        return view('dashboard.infonavit.index', compact('infonavits'));
    }
    public function create()
    {
        return view('dashboard.infonavit.create');
    }

    public function store(Request $request)
    {
        $infonavit = new infonavit();
        $infonavit->name = $request->input('name');
        $infonavit->description  = $request->input('description');
        $infonavit->url = $request->input('url');
        $image= 'images/no-image.png';
        if (isset($request->imagen)) {
            $file = $request->imagen;
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/infonavit', $filename);
            $image = 'images/infonavit/'.$filename;
        }
        $infonavit->image = $image;
        if ($request->news) {
            $infonavit->news=1;
        }

        if ($infonavit->save()) {
            return redirect('dashboard/infonavit')->with('success', 'Infonavit Creado');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }
}
