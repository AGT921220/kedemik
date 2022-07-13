@extends('layouts.dashboard')

@section('content')

<h1>Bienvenido</h1>

<input type="hidden" id="csrf_token" value="{{ csrf_token() }}">


<div class=" col-md-offset-5 card col-md-4">
    


<ul class="sidebar-menu" data-widget="tree">


  @include('layouts.menu.clients')
  @include('layouts.menu.vouchers')


    {{-- @switch(auth()->user()->type)
    @case('admin')
    @include('layouts.menu.sliders')
    @include('layouts.menu.propiedades')
    @include('layouts.menu.avaluos')
    @include('layouts.menu.infonavit')
    @include('layouts.menu.fovissste')
    @include('layouts.menu.asesoria')
    @include('layouts.menu.construccion')

    @break
    @case('avaluos')
    @include('layouts.menu.avaluos')
    @break
    @case('infonavit')
    @include('layouts.menu.infonavit')
    @break
    @case('fovissste')
    @include('layouts.menu.fovissste')
    @break
    @case('asesoria')
    @include('layouts.menu.asesoria')
    @break
    @case('construccion')
    @include('layouts.menu.construccion')
    @break

    @default

    @endswitch --}}

    </li>

  </ul>

</div>

@endsection

