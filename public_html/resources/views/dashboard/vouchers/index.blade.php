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
                                    <th scope="col">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($vouchers as $item)
                                    <tr>
                                        <td style="border-top:1px solid #3c8dbc !important">
                                            <img style="width:50px; height:50px"
                                                src="{{ asset($item->user->user_profile) }}">
                                            {{ $item->user->name }}

                                        </td>
                                        <td style="border-top:1px solid #3c8dbc !important">
                                            {{ count($item->payments) }} de
                                            {{ $item->total_payments }}


                                        </td>
                                        <td>
                                            @if (count($item->payments) >= 1)
                                                @foreach ($item->payments as $value)
                                                    <p>{{ $value->date_payment }} -
                                                        ${{ number_format($item->total / $item->total_payments) }}</p>
                                                @endforeach
                                                <hr>
                                                TOTAL
                                                ${{ number_format(count($item->payments) * ($item->total / $item->total_payments)) }}
                                                <br>
                                                <br>                                                  
                                                @else
                                                $0
                                            @endif
                                        </td>


                                        <td>   ${{ number_format($item->total - (count($item->payments)-1) * ($item->total / $item->total_payments)) }}</td>
                                        <td>   ${{ number_format($item->total - count($item->payments) * ($item->total / $item->total_payments)) }}</td>
                                        <td>${{ number_format($item->total) }}</td>
                                        <td style="border-top:1px solid #3c8dbc !important">

                                            <form class="col-md-10" method="POST" action="/dashboard/payments">
                                                @csrf

                                                <div>

                                                    <input type="hidden" name="voucher_id" value={{ $item->id }}>
                                                    <div class="form-group col-md-4">
                                                        <label>Fecha</label>
                                                        <input class="datepicker" type="date" name="date_payment">
                                                    </div>


                                                    <button class="btn btn-primary btn-block" type="submit">Agregar
                                                        Pago</button>
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
                                    <th scope="col">Acciones</th>

                                </tr>
                            </tfoot>
                        </table>

                        {{-- fin card body --}}
                    </div>

                    <a href="/dashboard/clientes/create" class="btn btn-primary btn-sm">Nuevo Cliente</a>
                </div>
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
</style>

<script src="{{ asset('js/datatables.js') }}" defer></script>
<link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
