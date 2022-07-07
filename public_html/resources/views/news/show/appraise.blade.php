@extends('layouts.news')

@section('content')

<div class="container-fluid mt-5 mb-3 pt-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="section-title border-right-0 mb-0" style="width: 180px;">
                        <h4 class="m-0 text-uppercase font-weight-bold">{{$appraise->name}}</h4>
                    </div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center bg-white border border-left-0"
                        style="width: calc(100% - 180px); padding-right: 100px;">
                        <div class="text-truncate"><a
                                class="text-secondary text-uppercase font-weight-semi-bold">{{$appraise->description}}</a>
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
                    <img class="img-fluid w-100" src="/{{$appraise->image}}" style="object-fit: cover;">
                    <div class="bg-white border border-top-0 p-4">
                        <div class="mb-3">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2">TEXTO</a>
                            <a class="text-body">{{date_format($appraise->updated_at,"d-m-Y")}}</a>
                        </div>
                        <h1 class="mb-3 text-secondary text-uppercase font-weight-bold">{{$appraise->name}}</h1>
                        <p>{{$appraise->description}}</p>



                    </div>
           
        

                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                        <div class="d-flex align-items-center">

                        </div>
                        <div class="d-flex align-items-center">
                            <span class="ml-3"><i class="far fa-eye mr-2"></i>{{$appraise->count}}</span>
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