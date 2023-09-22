<div id="container_print" class="container_print" style="    display: flex;justify-content: space-between;    width: 100%;display: flex;flex-wrap: wrap;margin: auto;">
    @foreach ($printableVouchers as $printableVoucher)
            <div class="print_modal_item col-md-3">

                    <table class="table">

                        <thead>
                            <tr width="1000" style="background-color: green">
                                <th colspan="5" style="background-color: green"> {{$type}}
                                </th>
                            </tr>

                            <tr width="1000" style="background-color: green">
                                <th colspan="5" style="background-color: green"> Cliente:
                                    {{ $printableVoucher['client'] }}
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
                             @foreach ($printableVoucher['printables'] as $printable)
                                <tr>
                                    <td>
                                        {{$printable->date_payment}}
                                    </td>
                                    <td>
                                        {{ $printable->payments}} /{{ $printable->total_payments}}
                                    </td>
                                    <td>
                                        ${{$printable->previous_balance}}
                                    </td>
                                    <td>
                                        ${{$printable->amount}}
                                    </td>
                                    <td>
                                        ${{$printable->new_balance}}
                                    </td>

                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
            </div>
            <br>
    @endforeach
</div> 
