<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use App\Voucher;
use Illuminate\Http\Request;

class VoucherElectronicsController extends Controller
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
        ->where('vouchers.type', 'electronics')
        ->get();
        $vouchers = $vouchers->where('available', true);

        return view('dashboard.vouchers.index', compact('vouchers'));

    }
}
