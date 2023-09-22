@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>Lista de Vales</span>
                    </div>

                    <div class="card-body" style="overflow-x:scroll">
                        <table class="table" id="datatable" style="overflow-x:scroll">
                            <thead>
                                <tr>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Pagos</th>
                                    <th scope="col">Pagado</th>
                                    <th scope="col">Anterior</th>
                                    <th scope="col">Restante</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Prestado</th>
                                    <th scope="col">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($vouchers as $voucher)
                                    <tr>
                                        <td style="border-top:1px solid #3c8dbc !important">
                                            <img style="width:50px; height:50px"
                                                src="{{ asset($voucher->user->user_profile) }}">
                                            {{ $voucher->user->name }}
                                            {{$voucher->id}}

                                        </td>
                                        <td style="border-top:1px solid #3c8dbc !important">
                                            {{ count($voucher->payments) }} de
                                            {{ $voucher->total_payments }}


                                        </td>
                                        <td>
                                            @if (count($voucher->payments) >= 1)
                                                @foreach ($voucher->payments as $value)
                                                    <p>{{ $value->date_payment }} -
                                                        ${{ number_format($voucher->total / $voucher->total_payments) }}</p>
                                                @endforeach
                                                <hr>
                                                TOTAL
                                                ${{ number_format(count($voucher->payments) * ($voucher->total / $voucher->total_payments)) }}
                                                <br>
                                                <br>
                                            @else
                                                $0
                                            @endif
                                        </td>


                                        <td>
                                            @if (count($voucher->payments) >= 1)
                                                ${{ number_format($voucher->total - (count($voucher->payments) - 1) * ($voucher->total / $voucher->total_payments)) }}
                                            @else
                                                ${{ number_format($voucher->total) }}
                                            @endif
                                        </td>
                                        <td> ${{ number_format($voucher->total - count($voucher->payments) * ($voucher->total / $voucher->total_payments)) }}
                                        </td>
                                        <td>${{ number_format($voucher->total) }}</td>
                                        <td>$10,000</td>
                                        <td style="border-top:1px solid #3c8dbc !important">

                                            <form class="col-md-10" method="POST" action="/dashboard/payments">
                                                @csrf

                                                <div>
                                                    @if (count($voucher->payments) < $voucher->total_payments)
                                                        <input type="hidden" name="voucher_id" value={{ $voucher->id }}>
                                                        <div class="form-group col-md-4">
                                                            <label>Fecha</label>
                                                            <input class="datepicker" type="date" name="date_payment">
                                                        </div>

                                                        <button class="btn btn-primary btn-block" type="submit">Agregar
                                                            Pago</button>
                                                    @else
                                                        <p>Finalizado</p>
                                                    @endif

                                                </div>

                                            </form>


                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Pagos</th>
                                    <th scope="col">Pagado</th>
                                    <th scope="col">Anterior</th>
                                    <th scope="col">Restante</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Prestado</th>
                                    <th scope="col">Acciones</th>

                                </tr>
                            </tfoot>
                        </table>

                    </div>


                    <div class="d-flex">
                        @include('dashboard.vouchers.all_payments', ['type' => $type])


                    </div>

                    <div class="d-flex">

                        <a href="/dashboard/vales/create" class="btn btn-primary btn-sm">Nuevo Vale</a>
                        <a class="btn btn-primary btn-sm show_modal ">Imprimir</a>
                    </div>

                </div>

            </div>
        </div>


        <div class="print_modal" id="print_modal" style="display: none">

  
            <div>
                <h2 class="mb-4 text-center">Comprobantes de Pago</h2>

             <a class="close_modal">Cerrar</a> 
             <a class="modal_print_btn">Imprimir</a>
             {{-- <a class="modal_print_btn">Imprimir</a>  --}}
 
    
             
             @include('dashboard.vouchers.printable', ['type' => $type])

        
        </div>



        </div>

    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
@endsection
<style>
    .switchShow {
        display: none;
    }

    tbody tr td,
    thead tr th {
        text-align: center;
    }

    .actions_table {
        justify-content: space-evenly;
    }

    .actions_table form {
        display: contents;
        margin: 1em auto;
    }

    .print_modal {
        background-color: #ffffff;
        width: 95vw;
        overflow-y: scroll;
        position: fixed;
        height: 75vh;
        top: 0;
        bottom: 0;
        z-index: 10000;
        margin: auto;
        left: 0;
        right: 0;
        border-radius: 10px;
        display: flex;
        justify-content: space-between;
        width: 100vw;
        height: 100vh;
    }

    .close_modal,.modal_print_btn {
        margin-right: 0;
        margin-top: 0;
        position: absolute;
        top: 1em;
        z-index: 1000000000;
        right: 2em;
        cursor: pointer;
        font-size: 1.5em;
    }
    .modal_print_btn{
        margin-top: 40px !important;
    }
 
    /* .print_modal_item {
        text-align: center;
        min-height: 400px;
    } */
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js" integrity="sha512-01CJ9/g7e8cUmY0DFTMcUw/ikS799FHiOA0eyHsUWfOetgbx/t6oV4otQ5zXKQyIrQGTHSmRVPIgrgLcZi/WMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/datatables.js') }}" defer></script>
<script src="{{ asset('js/kedemik.js') }}" defer></script>

<link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
