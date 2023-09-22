<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Payment;
use App\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BulkPaymentController extends Controller
{

    public function store(Request $request)
    {
        $type = $request->input('type') == Voucher::KEDEMIK ? Voucher::TYPE_REGULAR : Voucher::TYPE_ELECTRONICS;
        $vouchers = $this->getIncompleteVouchers($type);

        try {
            $this->bulkInsert($vouchers, $request->input('date_payment_bulk'));
            return back()->with('success', 'Pagos Agregados');
        } catch (\Throwable $th) {
            return back()->with('Error', 'Ha ocurrido un error');
        }
    }

    private function bulkInsert(array $vouchers, string $date): void
    {

        $timeStamps = Carbon::now();

        $dataToInsert = array_map(function ($voucher) use ($date, $timeStamps) {
            return [
                'date_payment' => $date, 'voucher_id' => $voucher['id'],
                'created_at' => $timeStamps,
                'updated_at' => $timeStamps,
            ];
        }, $vouchers);

        Payment::insert($dataToInsert);
    }

    private function getIncompleteVouchers(string $type): array
    {
        $vouchers = Voucher::select(
            'id',
            'payments',
            'total',
            DB::raw('(SELECT count(*) FROM payments WHERE voucher_id = vouchers.id) as count_payments')
        )
            ->where('vouchers.type', $type)
            ->get();

        $vouchers = $vouchers->map(function ($voucher) {
            if ($voucher->payments > $voucher->count_payments) {
                $voucher->amount = $voucher->total / $voucher->payments;
                return $voucher;
            }
        })->filter();
        return $vouchers->toArray();
    }
}
