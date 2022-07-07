@extends('layouts.dashboard')

@section('content')


<div class="card" style="margin: auto;text-align: center;">
        <img class="card-img-top" style="width: 250px;border-radius: 100%;height: 250px;" src="{{ $usuario->user_profile }}" alt="Card image">
        <div class="card-body">
          <h4 class="card-title">{{ $usuario->name }}</h4>
          <p class="card-text">{{ $usuario->email }}</p>
          <a href="" class="btn btn-primary">Acción</a>
        </div>
      </div>

@endsection
