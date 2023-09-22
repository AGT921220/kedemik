<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use App\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{

    private $maxPayments = 0;
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


        $printableVouchers = $this->getVouchersForPrint($vouchers->where('payments', '!=', null)
        ->where('payments', '!=', '[]')
        ->where('payments', '!=', []));
        $type = 'KEDEMIK';
        
        return view('dashboard.vouchers.index', compact('vouchers', 'printableVouchers','type'));
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

    private function getVouchersForPrint($vouchers)
    {
        $userPayments = $vouchers->groupBy('user_id');
        return $userPayments->map(function ($vouchers) {
            $printables = $this->getLastPaymentForVoucher($vouchers);  
            $vouchers->put('printables', $printables); 
            $vouchers->put('client', $vouchers->first()->user->name); 

            return $vouchers;
        });        
    }
    
    private function getLastPaymentForVoucher($vouchers)
    {

        return $vouchers->map(function ($voucher)
        {
            $payment = $voucher->payments->last();
            $payment->total_payments=$voucher->total_payments;
            $payment->payments=$voucher->payments->count();
            $payment->total = $voucher->total;

            $amount = $voucher->total/$voucher->total_payments;
            $payment->amount = $amount;
            $payment->new_balance = $this->getNewBalance($voucher->total, $amount, $voucher->payments->count());
            $payment->previous_balance = $payment->new_balance+$amount;
            return $payment;
        });
    }
    private function getNewBalance($total, $amount, $totalRegisterPayments)
    {
        return $total - $totalRegisterPayments*$amount;
    }
}
