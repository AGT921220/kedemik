@extends('layouts.news')

@section('content')

<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">{{(!$advisories->count())?'No hay Elementos':'Asesoría Jurídica'}}</h4>
        </div>
        <div class="owl-carousel news-carousel carousel-item-4 position-relative">
            @foreach($advisories as $item)

            <div class="position-relative overflow-hidden asesoria_item"  data-id="{{$item->id}}" style="height: 300px;">
                <img class="img-fluid h-100" src="{{$item->image}}" style="object-fit: cover;">
                <div class="overlay">
                    <div class="mb-2">
                    </div>
                    <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold">{{$item->name}}</a>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>@endsection
