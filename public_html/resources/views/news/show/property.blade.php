@extends('layouts.news')

@section('content')

<div class="container-fluid mt-5 mb-3 pt-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="section-title border-right-0 mb-0" style="width: 180px;">
                        <h4 class="m-0 text-uppercase font-weight-bold">{{$property->name}}</h4>
                    </div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center bg-white border border-left-0"
                        style="width: calc(100% - 180px); padding-right: 100px;">
                        <div class="text-truncate"><a
                                class="text-secondary text-uppercase font-weight-semi-bold">{{$property->description}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- News Detail Start -->
                <div class="position-relative mb-3">
                    <img class="img-fluid w-100" src="/{{$property->image}}" style="object-fit: cover;">
                    <div class="bg-white border border-top-0 p-4">
                        <div class="mb-3">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2">{{$property->type}}
                                en {{$types[$property->sale_rent]}}</a>
                            <a class="text-body">{{date_format($property->updated_at,"d-m-Y")}}</a>
                        </div>
                        <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">{{$property->name}}</h1>
                        <p>{{$property->description}}</p>



                    </div>
                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4"
                        style="display: flex !important; flex-wrap:wrap">
                        @include('news.items.icons', ['name' => "fa-person-digging", 'item' =>
                        $property->mts_construction,'text'=>'m² de Construcción'])
                        @include('news.items.icons', ['name' => "fa-ruler-combined", 'item' =>
                        $property->mts_ground,'text'=>'m² de Terreno'])
                        @include('news.items.icons', ['name' => "fa-toilet", 'item' =>
                        $property->bathrooms,'text'=>'Baño(s)'])
                        @include('news.items.icons', ['name' => "fa-bed", 'item' =>
                        $property->bedrooms,'text'=>'Recámara(s)'])
                        @include('news.items.icons', ['name' => "fa-couch", 'item' =>
                        $property->bedrooms,'text'=>'Sala(s)'])
                        @include('news.items.icons', ['name' => "fa-utensils", 'item' =>
                        $property->dining_room,'text'=>'Comedor(es)'])
                        @include('news.items.icons', ['name' => "fa-kitchen-set", 'item' =>
                        $property->kitchen,'text'=>'Cocina(s)'])
                        @include('news.items.icons', ['name' => "fa-people-roof", 'item' =>
                        $property->living,'text'=>'Estancia(s)'])
                        @include('news.items.icons', ['name' => "fa-layer-group", 'item' =>
                        $property->house_plants,'text'=>'Planta(s)'])

                        @if($property->terrace>=1)
                        @include('news.items.icons', ['name' => "fa-bridge", 'item' =>
                        $property->terrace,'text'=>'Terraza'])
                        @endif

                        @if($property->garage>=1)
                        @include('news.items.icons', ['name' => "fa-warehouse", 'item' =>
                        $property->garage,'text'=>'Cochera(s)'])
                        @endif

                        @if($property->porch>=1)
                        @include('news.items.icons', ['name' => "fa-house", 'item' =>
                        $property->garage,'text'=>'Porche'])
                        @endif
                        @if($property->yard>=1)
                        @include('news.items.icons', ['name' => "fa-xmarks-lines", 'item' =>
                        $property->yard,'text'=>'Patio(s)'])
                        @endif

                        @if($property->laundry>=1)
                        @include('news.items.icons', ['name' => "fa-jug-detergent", 'item' =>
                        $property->laundry,'text'=>'Lavandería'])
                        @endif

                        @if(!!$property->alternate_construction)
                        @include('news.items.icons', ['name' => "fa-person-digging", 'item'
                        =>1,'text'=>$property->alternate_construction])
                        @endif

                        @if($property->offices>=1)
                        @include('news.items.icons', ['name' => "fa-briefcase", 'item'
                        =>$property->offices,'text'=>'Oficina(s)'])
                        @endif

                        @if($property->cubbicles>=1)
                        @include('news.items.icons', ['name' => "fa-cube", 'item'
                        =>$property->cubbicles,'text'=>'Cubículo(s)'])
                        @endif

                        @if($property->lobby>=1)
                        @include('news.items.icons', ['name' => "fa-spa", 'item' =>$property->lobby,'text'=>'Lobby'])
                        @endif

                        @if($property->stairs>=1)
                        @include('news.items.icons', ['name' => "fa-stairs", 'item' =>
                        $property->stairs,'text'=>'Escalera(s)'])
                        @endif

                        @if($property->elevator>=1)
                        @include('news.items.icons', ['name' => "fa-elevator", 'item' =>
                        $property->elevator,'text'=>'Elevador'])
                        @endif



                    </div>

                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4"
                        style="flex-wrap: wrap">
                        <div class="d-flex align-items-center col-md-4">
                            <p><b>Estado: </b>{{$property->state}}</p>
                        </div>
                        <div class="d-flex align-items-center col-md-4">
                            <p><b>Ciudad: </b>{{$property->city}}</p>
                        </div>
                        <div class="d-flex align-items-center col-md-4">
                            <p><b>Colonia: </b>{{$property->suburb}}</p>
                        </div>
                        <div class="d-flex align-items-center col-md-4">
                            <p><b>Antiguedad: </b>{{ucwords($property->state_of_use)}}</p>
                        </div>
                        <div class="d-flex align-items-center col-md-4">
                            <p><b>Precio: </b>${{number_format($property->price,0)}} MXN</p>
                        </div>

                    </div>

                    <iframe style="width: 100%" src="{{$property->location}}" width="600" height="450" frameborder="0"
                        allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>


                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                        <div class="d-flex align-items-center">

                        </div>
                        <div class="d-flex align-items-center">
                            <span class="ml-3"><i class="far fa-eye mr-2"></i>{{$property->count}}</span>
                        </div>
                    </div>
                </div>
                <!-- News Detail End -->

            </div>


            @include('news.items.follows')

        </div>
    </div>
</div>

@endsection