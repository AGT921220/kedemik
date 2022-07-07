@extends('layouts.dashboard')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header mb-2" style="    display: flex;justify-content: space-between;">
          <span>Editar Propiedad</span>
          <a href="/dashboard/propiedades" class="btn btn-primary btn-sm">Volver a lista de propiedades...</a>
        </div>
        <div class="card-body">

          <form method="POST" action="/dashboard/propiedades/{{$propertie->id}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf


             @php
               $isChecked = ($propertie->is_shared)?'checked=""':'';
             @endphp
             
            <div class="form-group" style="justify-content: center;
            align-items: center;
            display: flex;
            flex-direction: column;">
              <label>Es Compartida?</label>
              <label class="switch">
                <input type="checkbox" name="is_shared" {{$isChecked}} value="{{$propertie->is_shared}}" class="is_shared">
                <span class="slider round"></span>
              </label>
              
            </div>

             @php
                $displayIsShared=($propertie->is_shared)?'':'none';
             @endphp

            <div class="is_shared_container"  style="display:{{$displayIsShared}}">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="seller_name" value="{{$propertie->seller_name}}" placeholder="Nombre de Vendedor" class="form-control mb-2" 
                  {{ old('seller_name') }} />
              </div>
  
            <div class="form-group">
              <label>Telefono</label>
              <input type="text" name="seller_phone" value="{{$propertie->seller_phone}}" placeholder="Telefono de Vendedor" class="form-control mb-2" 
                {{ old('seller_phone') }} />
            </div>
            <hr>
          </div>

            <div class="form-group col-md-6">
              <label>Nombre</label>
              <input type="text" name="name" value="{{$propertie->name}}" placeholder="Nombre de Propiedad" class="form-control mb-2" required=""
                {{ old('name') }} />
            </div>

            <div class="form-group col-md-6">
              <label>Tipo</label>
              <select class="form-control" name="type" value="{{$propertie->propertie_type}}">
                @foreach($publicationTypes as $item)
                <option {{($propertie->propertie_type==$item->id)? 'selected=""':''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach

              </select>
            </div>

            <div class="form-group">
              <label>Precio</label>
              <input type="number" step="any" name="price" value="{{$propertie->price}}" placeholder="$" class="form-control mb-2" required=""
                {{ old('price') }} />
            </div>

            <div class="form-group">
              <label>Descripción</label>
              <input type="text" name="description" value="{{$propertie->description}}" placeholder="Descripción" class="form-control mb-2" required="" {{
                old('description') }} />
            </div>

            <div class="form-group">
              <label>Imágen Principal</label>
              <div class="form-group image_container"
                style="justify-content: center;text-align: center;align-items: center;display: flex;flex-direction: column;margin: auto;">
                <img class="profile_image_show" style="width:100px;" src="{{ asset($propertie->image) }}">
                <label for="imagen_profile" style="cursor:pointer;">Seleccionar imágen</label>
                <input style="display: none;" type="file" name="image" id="imagen_profile"
                  accept="image/x-png,image/gif,image/jpeg">
              </div>
            </div>


            <div class="form-group" style="justify-content: center;
            align-items: center;
            display: flex;
            flex-direction: column;">
              <label>Mostrar en News?</label>
              <label class="switch">
                <input type="checkbox" value="{{$propertie->news}}" {{($propertie->news)?'checked=""':''}} name="news">
                <span class="slider round"></span>
              </label>
              
            </div>
            <div class="form-group">
              <label>Venta / Renta</label>
          <select name="sale_rent" value="{{$propertie->sale_rent}}" class="form-control">
            <option {{($propertie->sale_rent=='sale')? 'selected=""':''}} value="sale">Venta</option>
            <option {{($propertie->sale_rent=='rent')? 'selected=""':''}} value="rent">Renta</option>
          </select>              
            </div>
            

            {{-- CAMPOS --}}
            <div class="form-group col-md-3">
              <label>Mts Construcción</label>
              <input type="number" name="mts_construction" value="{{$propertie->mts_construction}}" placeholder="Mts de Construcción" class="form-control mb-2"
              {{old('mts_construction')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Mts Terreno</label>
              <input type="number" name="mts_ground" value="{{$propertie->mts_ground}}" placeholder="Mts Terreno" class="form-control mb-2"
              {{old('mts_ground')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Recámaras</label>
              <input type="number" name="bedrooms" value="{{$propertie->bedrooms}}" placeholder="Recámaras" class="form-control mb-2"
              {{old('bedrooms')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Sala</label>
              <input type="number" name="lounge" value="{{$propertie->lounge}}" placeholder="Sala" class="form-control mb-2"
              {{old('lounge')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Comedor</label>
              <input type="number" name="dining_room" value="{{$propertie->dining_room}}" placeholder="Comedor" class="form-control mb-2"
              {{old('dining_room')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Cocina</label>
              <input type="number" name="kitchen" value="{{$propertie->kitchen}}" placeholder="Cocina" class="form-control mb-2"
              {{old('kitchen')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Estancia</label>
              <input type="number" name="living" value="{{$propertie->living}}" placeholder="Estancia" class="form-control mb-2"
              {{old('living')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Plantas</label>
              <input type="number" name="house_plants" value="{{$propertie->house_plants}}" placeholder="Plantas" class="form-control mb-2"
              {{old('house_plants')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Baños</label>
              <input type="number" name="bathrooms" value="{{$propertie->bathrooms}}" placeholder="Baños" class="form-control mb-2"
              {{old('bathrooms')}}>
            </div>
            <div class="form-group col-md-3">
              <label>1/2 Baños</label>
              <input type="number" name="half_bathrooms" value="{{$propertie->half_bathrooms}}" placeholder="1/2 Baños" class="form-control mb-2"
              {{old('half_bathrooms')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Terraza</label>
              <input type="number" name="terrace" value="{{$propertie->terrace}}" placeholder="Terraza" class="form-control mb-2"
              {{old('terrace')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Cochera</label>
              <input type="number" name="garage" value="{{$propertie->garage}}" placeholder="Cochera" class="form-control mb-2"
              {{old('garage')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Porche</label>
              <input type="number" name="porch" value="{{$propertie->porch}}" placeholder="Porche" class="form-control mb-2"
              {{old('porch')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Patio</label>
              <input type="number" name="yard" value="{{$propertie->yard}}" placeholder="Patio" class="form-control mb-2"
              {{old('yard')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Lavandería</label>
              <input type="number" name="laundry" value="{{$propertie->laundry}}" placeholder="Lavandería" class="form-control mb-2"
              {{old('laundry')}}>
            </div>

            <div class="form-group col-md-3">
              <label>Oficinas</label>
              <input type="number" name="offices" value="{{$propertie->offices}}" placeholder="Oficinas" class="form-control mb-2"
              {{old('offices')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Cubiculos</label>
              <input type="number" name="cubicles" value="{{$propertie->cubicles}}" placeholder="Cubiculos" class="form-control mb-2"
              {{old('cubicles')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Lobby</label>
              <input type="number" name="lobby" value="{{$propertie->lobby}}" placeholder="Lobby" class="form-control mb-2"
              {{old('lobby')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Elevador</label>
              <input type="number" name="elevator" value="{{$propertie->elevator}}" placeholder="Elevador" class="form-control mb-2"
              {{old('elevator')}}>
            </div>
            <div class="form-group col-md-3">
              <label>Escaleras</label>
              <input type="number" name="stairs" value="{{$propertie->stairs}}" placeholder="Escaleras" class="form-control mb-2"
              {{old('stairs')}}>
            </div>


            <div class="form-group col-md-12">
              <label>Colonia</label>
              <input type="string" name="suburb" value="{{$propertie->suburb}}" placeholder="Colonia" class="form-control mb-2"
              {{old('suburb')}}>
            </div>
            <div class="form-group col-md-12">
              <label>Ciudad</label>
              <input type="string" name="city" value="{{$propertie->city}}" placeholder="Ciudad" class="form-control mb-2"
              {{old('city')}}>
            </div>
            <div class="form-group col-md-12">
              <label>Estado</label>
              <input type="string" name="state" value="{{$propertie->state}}" placeholder="Estado" class="form-control mb-2"
              {{old('state')}}>
            </div>
            <div class="form-group col-md-12">
              <label>Telefono</label>
              <input type="number" name="phone" value="{{$propertie->phone}}" placeholder="Telefono" class="form-control mb-2"
              {{old('phone')}}>
            </div>

            <div class="form-group col-md-12">
              <label>Construcción Alternativa</label>
              <input type="string" name="alternate_construction" value="{{$propertie->alternate_construction}}" placeholder="Construcción Alternativa" class="form-control mb-2"
              {{old('alternate_construction')}}>
            </div>
            <div class="form-group col-md-12">
              <label>Estado de uso</label>
              <input type="string" name="state_of_use" value="{{$propertie->state_of_use}}" placeholder="Estado de uso" class="form-control mb-2"
              {{old('state_of_use')}}>
            </div>
            <div class="form-group col-md-12">
              <label>Ubicación</label>
              <input type="string" name="location" value="{{$propertie->location}}" placeholder="Ubicación" class="form-control mb-2"
              {{old('location')}}>
            </div>
            {{-- CAMPOS --}}








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
<script src="{{ asset('js/dashboard/propiedades.js') }}" defer></script>

