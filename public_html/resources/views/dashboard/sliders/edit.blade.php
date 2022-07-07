@extends('layouts.dashboard')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header mb-2" style="    display: flex;justify-content: space-between;">
          <span>Editar sliders</span>
          <a href="/dashboard/sliders" class="btn btn-primary btn-sm">Volver a lista de sliders...</a>
        </div>
        <div class="card-body">

          <form method="POST" action="/dashboard/sliders/{{$slider->id}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
              <label>Descripción</label>
              <input type="text" name="description" value="{{$slider->description}}" placeholder="Descripción" class="form-control mb-2" required="" {{
                old('description') }} />
            </div>

            <div class="form-group">
              <label>Url</label>
              <input type="text" name="url" value="{{$slider->url}}" placeholder="Url" class="form-control mb-2"
                {{ old('url') }} />
            </div>
            <div class="form-group">
              <label>Imágen Principal</label>
              <div class="form-group image_container"
                style="justify-content: center;text-align: center;align-items: center;display: flex;flex-direction: column;margin: auto;">
                <img class="profile_image_show" style="width:100px;" src="{{ asset(($slider->image)?$slider->image:'images/no-image.png') }}">

                <label for="imagen_profile" style="cursor:pointer;">Seleccionar imágen</label>
                <input style="display: none;" type="file" name="imagen" id="imagen_profile"
                  accept="image/x-png,image/gif,image/jpeg">
              </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Editar</button>
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