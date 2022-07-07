@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>Lista de Propiedades</span>
                </div>

                <div class="card-body" style="overflow-x:scroll">
                    <table class="table" id="datatable" style="overflow-x:scroll">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Tipo de Propiedad</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Imágen</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $saleRent=
                            ['sale'=>'Venta',
                            'rent'=>'Renta'];
                            @endphp
                            @foreach ($properties as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>${{ number_format($item->price,2) }}</td>
                                <td>{{ $item->type }} en {{$saleRent[$item->sale_rent]}}</td>
                                <td>{{ $item->description }}</td>


                                <td>
                                    <img style="width:50px; height:50px" src="{{ asset($item->image) }}">
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="/dashboard/propiedades/{{$item->id}}/edit">Editar</a>
                                    <form action="/dashboard/propiedades/{{$item->id}}" class="d-inline" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>                                </td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Tipo de Propiedad</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Imágen</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </tfoot>
                    </table>

                    {{-- fin card body --}}
                </div>

                <a href="/dashboard/propiedades/create" class="btn btn-primary btn-sm">Nueva Propiedad</a>
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