<div id="container_print" class="container_print" style="    display: flex;justify-content: space-between;    width: 100%;display: flex;flex-wrap: wrap;margin: auto;">
    @foreach ($printableVouchers as $printableVoucher)
            <div class="print_modal_item col-md-3">

                    <table class="table">

                        <thead>
                            <tr width="1000" style="background-color: green">
                                <th colspan="5" style="background-color: green"> Cliente:
                                    {{ $printableVoucher[0]->user->name }}
                                </th>
                            </tr>
                            <tr style="background-color: #00800061">
                                <th style="">Fecha</th>
                                <th style="">Pago</th>
                                <th style="">Saldo Anterior</th>
                                <th style="">Monto</th>
                                <th style="">Nuevo Saldo</th>

                            </tr>
                        </thead>

                        <tbody>
                             @foreach ($printableVoucher[0]->payments as $key=>$payment)
                                <tr>
                                    <td>{{ $payment->date_payment }}</td>
                                    <td>{{$key+1}}/{{ $printableVoucher[0]->total_payments }} </td>
                                    <td>
                                        @if (count($printableVoucher[0]->payments) >= 1)
                                            ${{ number_format($printableVoucher[0]->total- (($printableVoucher[0]->total/$printableVoucher[0]->total_payments)*$key))}}
                                        @else
                                            ${{ number_format($printableVoucher[0]->total) }}
                                        @endif
                                    </td>
                                    <td>${{ number_format($printableVoucher[0]->total / $printableVoucher[0]->total_payments) }}</td>
                                    <td>
                                        ${{ number_format($printableVoucher[0]->total- (($printableVoucher[0]->total/$printableVoucher[0]->total_payments)*($key+1)))}}
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
            </div>
            <br>
    @endforeach
</div> 
