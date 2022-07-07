<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Propertie;
use App\PropertiesType;
use Illuminate\Http\Request;

/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class PropertiesController extends Controller
{
    public function index()
    {
        $properties = new Propertie();
        $properties = $properties
        ->select('properties.*', 'properties_types.name as type')
        ->join('properties_types', 'properties_types.id', 'properties.propertie_type')
        ->get();
        return view('dashboard.properties.index', compact('properties'));
    }
    public function create()
    {
        $publicationTypes = new PropertiesType();
        $publicationTypes = $publicationTypes->all();
        return view('dashboard.properties.create', compact('publicationTypes'));
    }

    public function store(Request $request)
    {
        $propertie = $this->setValues($request);
        if ($propertie->save()) {
            return back()->with('success', 'Publicación Creada');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }
    public function edit(int $propertieId)
    {
        $propertie = Propertie::findOrFail($propertieId);
        $publicationTypes = new PropertiesType();
        $publicationTypes = $publicationTypes->all();
        return view('dashboard.properties.edit', compact('propertie', 'publicationTypes'));
    }
    public function update(int $propertieId, Request $request)
    {
        $propertie = Propertie::findOrFail($propertieId);
        $propertie = $this->setValues($request, $propertie);
        if ($propertie->save()) {
            return back()->with('success', 'Publicación Editada');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }
    private function setValues(Request $request, Propertie $propertie):Propertie
    {
        $propertie = ($propertie)? $propertie:$propertie = new Propertie();

        $photo= ($propertie) ? $propertie->image:'images/no-image.png';
        if (isset($request->image)) {
            $file = $request->image;
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/propiedades', $filename);
            $photo = 'images/propiedades/'.$filename;
        }

        $propertie->name= $request->input('name');
        $propertie->propertie_type= $request->input('type');
        $propertie->price= $request->input('price');
        $propertie->description= $request->input('description');
        $propertie->image = $photo;
        $propertie->sale_rent = $request->input('sale_rent');

        $propertie->mts_construction= ($request->input('mts_construction')>=1)?$request->input('mts_construction'):0;
        $propertie->mts_ground= ($request->input('mts_ground')>=1)?$request->input('mts_ground'):0;
        $propertie->bedrooms= ($request->input('bedrooms')>=1)?$request->input('bedrooms'):0;
        $propertie->lounge= ($request->input('lounge')>=1)?$request->input('lounge'):0;
        $propertie->dining_room= ($request->input('dining_room')>=1)?$request->input('dining_room'):0;
        $propertie->kitchen= ($request->input('kitchen')>=1)?$request->input('kitchen'):0;
        $propertie->living= ($request->input('living')>=1)?$request->input('living'):0;
        $propertie->house_plants= ($request->input('house_plants')>=1)?$request->input('house_plants'):1;
        $propertie->bathrooms= ($request->input('bathrooms')>=1)?$request->input('bathrooms'):0;
        $propertie->half_bathrooms= ($request->input('half_bathrooms')>=1)?$request->input('half_bathrooms'):0;
        $propertie->terrace= ($request->input('terrace')>=1)?$request->input('terrace'):0;
        $propertie->garage= ($request->input('garage')>=1)?$request->input('garage'):0;
        $propertie->porch= ($request->input('porch')>=1)?$request->input('porch'):0;
        $propertie->yard= ($request->input('yard')>=1)?$request->input('yard'):0;
        $propertie->laundry= ($request->input('laundry')>=1)?$request->input('laundry'):0;
        $propertie->alternate_construction= $request->input('alternate_construction');
        $propertie->state_of_use= $request->input('state_of_use');
        $propertie->location= $request->input('location');
        $propertie->suburb= $request->input('suburb');
        $propertie->city= $request->input('city');
        $propertie->state= $request->input('state');
        $propertie->phone= $request->input('phone');
        $propertie->offices= ($request->input('offices')>=1)?$request->input('offices'):0;
        $propertie->cubicles= ($request->input('cubicles')>=1)?$request->input('cubicles'):0;
        $propertie->lobby= ($request->input('lobby')>=1)?$request->input('lobby'):0;
        $propertie->elevator= ($request->input('elevator')>=1)?$request->input('elevator'):0;
        $propertie->stairs= ($request->input('stairs')>=1)?$request->input('stairs'):0;
        $propertie->is_shared= ($request->input('is_shared')>=1)?$request->input('is_shared'):0;
        $propertie->seller_name= ($request->input('seller_name')>=1)?$request->input('seller_name'):null;
        $propertie->seller_phone= ($request->input('seller_phone')>=1)?$request->input('seller_phone'):null;

        
        if ($request->news) {
            $propertie->news=1;
        }
        return $propertie;
    }
    public function destroy(int $propertieId)
    {
        $propertie = Propertie::findOrFail($propertieId);

        if ($propertie->delete()) {
            return back()->with('mensaje', 'Propiedad Eliminada');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }
}
