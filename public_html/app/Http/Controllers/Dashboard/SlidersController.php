<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class SlidersController extends Controller
{
    public function index()
    {
        $sliders = new Slider();
        $sliders = $sliders->get();
        return view('dashboard.sliders.index', compact('sliders'));
    }
    public function create()
    {
        return view('dashboard.sliders.create');
    }

    public function store(Request $request)
    {
        $slider = new Slider();

        $photo= 'images/no-image.png';
        if (isset($request->imagen)) {
            $file = $request->imagen;
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/sliders', $filename);
            $photo = 'images/sliders/'.$filename;
        }

        $slider->url= $request->input('url');
        $slider->description= $request->input('description');
        $slider->image = $photo;
        if ($slider->save()) {
            return back()->with('success', 'Slider Creado');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }
    public function edit(int $sliderId)
    {
        $slider = Slider::findOrFail($sliderId);
        return view('dashboard.sliders.edit', compact('slider'));
    }

    public function update(int $sliderId, Request $request)
    {
        $slider = Slider::findOrFail($sliderId);

        $photo= $slider->image;
        if (isset($request->imagen)) {
            $file = $request->imagen;
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/sliders', $filename);
            $photo = 'images/sliders/'.$filename;
        }

        $slider->url= $request->input('url');
        $slider->description= $request->input('description');
        $slider->image = $photo;
        if ($slider->save()) {
            return back()->with('success', 'Slider Editado');
        }
        return back()->with('Error', 'Ha ocurrido un error');

    }
    public function destroy(int $sliderId)
    {
        $slider = Slider::findOrFail($sliderId);

        if ($slider->delete()) {
            return back()->with('mensaje', 'Slider Eliminado');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }
}
