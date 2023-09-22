<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use App\Voucher;
use Illuminate\Http\Request;

class VoucherElectronicsController extends Controller
{

    private $maxPayments = 0;

    public function index()
    {
        $vouchers = Voucher::
        select('user_id','vouchers.id','vouchers.payments as total_payments','vouchers.total')
        ->with('payments')
        ->with('user')
        ->where('vouchers.type', 'electronics')
        ->get();
        // $vouchers = $vouchers->where('available', true);

        $vouchers = $vouchers->map(function ($voucher) {
            $voucher->available = false;
            if (count($voucher->payments) < $voucher->total_payments) {
                $voucher->available = true;
            }

            return $voucher;
        });


        $vouchers = $vouchers->where('available', true);

        // $printableVouchers = $this->getPrintableVouchers($vouchers->whereNotNull('payments'));

        $printableVouchers = $this->getVouchersForPrint($vouchers->where('payments', '!=', null)
        ->where('payments', '!=', '[]')
        ->where('payments', '!=', []));

        $type = 'KEDEMIK ELECTRONICS';
        return view('dashboard.vouchers.index', compact('vouchers','printableVouchers', 'type'));

    }

    private function getPrintableVouchers($printableVouchers)
    {
        $printableVouchers = $printableVouchers->transform(function ($voucher) {
            $voucher->payments_count = count($voucher->payments);
            $voucher->last_payment_date = ($voucher->payments->last()) ? $voucher->payments->last()->date_payment : false;
            if ($voucher->payments_count > $this->maxPayments) {
                $this->maxPayments = $voucher->payments_count;
            }

            return $voucher;
        });

        $this->maxPayments--;
        $printableVouchers = $printableVouchers->transform(function ($voucher) {

            $payments = $voucher->payments->toArray();
            $printables = [];
            for ($i = 0; $i <= $this->maxPayments; $i++) {

                $item = (isset($payments[$i])) ? $payments[$i]['date_payment'] : '';
          
                $printables[] = $item;
            }
            $voucher->printables = $printables;
            return $voucher;
        });


        return $printableVouchers->where('last_payment_date', '!=', false)->groupBy('user_id');
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
