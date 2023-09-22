<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::where('id', '!=', User::ADMIN_USER_ID)->get();
        return view('dashboard.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name=$request->name;
        $countUsers = User::count();
        $user->email="cliente$countUsers@kedemik.com";


        $imageProfile ='/images/profile-empty.png';

        if (isset($request->image)) {
            $file = $request->image;
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/profiles', $filename);
            $imageProfile = '/images/profiles/'.$filename;
        }
        $user->user_profile= $imageProfile;
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->creation_date = $request->input('creation_date');

        $user->password =Hash::make('cliente');

        if ($user->save()) {
            return back()->with('success', 'Cliente Creado');
        }
        return back()->with('Error', 'Ha ocurrido un error');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
