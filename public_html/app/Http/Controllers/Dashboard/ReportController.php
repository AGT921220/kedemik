<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Voucher;

class ReportController extends Controller
{
    public function index()
    {
        $data = Voucher::
        select('user_id','vouchers.id','vouchers.payments as total_payments','vouchers.total')
        ->with('payments')
        ->with('user')
        ->get();

        $total = 0.00;
        $totalQuincena = 0.00;
        foreach($data as $voucher)
        {            
            if(count($voucher->payments)<$voucher->total_payments)
            {
                $porQuincena =$voucher->total/$voucher->total_payments;
                $totalQuincena += $porQuincena;
                $total += $porQuincena*($voucher->total_payments-count($voucher->payments));
            }
        }

        return view('dashboard.reports.index', compact('total', 'totalQuincena'));
    }
}
