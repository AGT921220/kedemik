<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use App\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::
        select('user_id','vouchers.id','vouchers.payments as total_payments','vouchers.total')
        ->with('payments')
        ->with('user')
        ->get();

        // dd($vouchers->toArray());
        return view('dashboard.vouchers.index', compact('vouchers'));

    }

    public function create()
    {
        $clients = User::where('id', '!=', User::ADMIN_USER_ID)->get();
        return view('dashboard.vouchers.create', compact('clients'));
    }

    public function store(Request $request)
    {

        $voucher = new Voucher();
        $voucher->user_id=$request->user_id;
        $voucher->payments=$request->payments;

        $voucher->total=$request->total;
        if ($voucher->save()) {
            return back()->with('success', 'Vale Creado');
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
