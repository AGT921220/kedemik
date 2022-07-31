@extends('layouts.dashboard')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header mb-2" style="    display: flex;justify-content: space-between;">
          <span>Agregar Vale</span>
          <a href="/dashboard/vales" class="btn btn-primary btn-sm">Volver a lista de Vales...</a>
        </div>
        <div class="card-body">

          <form method="POST" action="/dashboard/vales" enctype="multipart/form-data">
            @csrf


            <div class="form-group">
              <label>Cliente</label>
              <select class="form-control" name="user_id">
                @foreach($clients as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
              </select>
            </div>


            <div class="form-group">
              <label>Cantidad</label>
              <input type="number" step="any" name="total" placeholder="$" class="form-control mb-2" required=""
                {{ old('total') }} />
            </div>
            <div class="form-group">
              <label>Número de Pagos</label>
 
              <select class="form-control" name="payments">
                @for($i = 1; $i <= 30; $i++)
                <option value="{{$i}}">{{$i}}</option>                  
                @endfor
              </select>

  

            </div>

            <div class="form-group">
              <label>Tipo de Vale</label>
              <select class="form-control" name="type">
                <option selected="" value="regular">Regular</option>                  
                <option value="electronics">Kedemik Electronics</option>                  
              </select>
  
            </div>


            <button class="btn btn-primary btn-block" type="submit">Agregar</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }
  
  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }
  
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }
  
  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }
  
  input:checked + .slider {
    background-color: #2196F3;
  }
  
  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }
  
  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }
  
  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }
  
  .slider.round:before {
    border-radius: 50%;
  }
  </style>
<script src="{{ asset('js/registro.js') }}" defer></script>