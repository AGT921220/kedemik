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
        $vouchers = Voucher::select('user_id', 'vouchers.id', 'vouchers.payments as total_payments', 'vouchers.total')
            ->with('payments')
            ->with('user')
            ->where('vouchers.type', 'regular')
            ->get();

        $vouchers = $vouchers->map(function ($voucher) {
            $voucher->available = false;
            if (count($voucher->payments) < $voucher->total_payments) {
                $voucher->available = true;
            }

            return $voucher;
        });


        $vouchers = $vouchers->where('available', true);

        $printableVouchers = $vouchers->whereNotNull('payments');

        $printableVouchers = $printableVouchers->map(function ($voucher) {
            $voucher->payments_count = count($voucher->payments);
            $voucher->last_payment_date = ($voucher->payments->last()) ? $voucher->payments->last()->date_payment : false;
            return $voucher;
        });

        $printableVouchers = $printableVouchers->where('last_payment_date', '!=',false)->groupBy('user_id');

         return $printableVouchers;

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
        $voucher->user_id = $request->user_id;
        $voucher->payments = $request->payments;
        $voucher->type = $request->type;
        $voucher->total = $request->total;
        if ($voucher->save()) {
            return back()->with('success', 'Vale Creado');
        }
        return back()->with('Error', 'Ha ocurrido un error');
    }

    public function history()
    {
        $vouchers = Voucher::select('user_id', 'vouchers.id', 'vouchers.payments as total_payments', 'vouchers.total')
            ->with('payments')
            ->with('user')
            ->where('vouchers.type', 'regular')
            ->get();

        $vouchers = $vouchers->map(function ($voucher) {
            $voucher->available = false;
            if (count($voucher->payments) < $voucher->total_payments) {
                $voucher->available = true;
            }

            return $voucher;
        });

        $vouchers = $vouchers->where('available', false);
        return view('dashboard.history.index', compact('vouchers'));
    }

    public function historyElectronics()
    {
        $vouchers = Voucher::select('user_id', 'vouchers.id', 'vouchers.payments as total_payments', 'vouchers.total')
            ->with('payments')
            ->with('user')
            ->where('vouchers.type', 'electronics')
            ->get();

        $vouchers = $vouchers->map(function ($voucher) {
            $voucher->available = false;
            if (count($voucher->payments) < $voucher->total_payments) {
                $voucher->available = true;
            }

            return $voucher;
        });

        $vouchers = $vouchers->where('available', false);
        return view('dashboard.history.index', compact('vouchers'));
    }
}
