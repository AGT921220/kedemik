<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{


    public function store(Request $request)
    {
        if(!$request->date_payment)
        {
            return back()->with('error', 'Selecciona Fecha');
        }

        $payment = new Payment();
        $payment->date_payment = $request->date_payment;
        $payment->voucher_id = $request->voucher_id;

        if ($payment->save()) {
            return back()->with('success', 'Pago Creado');
        }
        return back()->with('error', 'Ha ocurrido un error');


    }

}
