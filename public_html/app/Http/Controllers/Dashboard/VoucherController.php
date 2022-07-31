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

        $printableVouchers = $this->getPrintableVouchers($vouchers->whereNotNull('payments'));


        return $printableVouchers->first();
        return view('dashboard.vouchers.index', compact('vouchers', 'printableVouchers'));
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
}
