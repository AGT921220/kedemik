@extends('layouts.news')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 px-0">
            <div class="owl-carousel main-carousel position-relative">
                @if($sliders->count()>=1)
                @foreach($sliders as $item)
                <div class="position-relative overflow-hidden" style="height: 500px;">
                    <img class="img-fluid h-100" src="{{$item->image}}" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-2">
                            <a
                            style="cursor: pointer"
                            href="{{$item->url}}"
                                class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2">{{$item->description}}</a>
                            {{-- <a class="text-white">{{date_format($item->updated_at,"d-m-Y")}}</a> --}}
                        </div>
                        {{-- <a class="h2 m-0 text-white text-uppercase font-weight-bold">{{substr($item->description,0,
                            50)}}...</a> --}}
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>


        {{-- <div class="col-lg-5 px-0">
            <div class="row mx-0">
                <div class="col-md-6 px-0">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        <img class="img-fluid w-100 h-100" src="img/news-700x435-1.jpg" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a
                                    class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2">Business</a>
                                <a class="text-white"><small>Jan 01, 2045</small></a>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold">Lorem ipsum dolor sit amet
                                elit...</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        <img class="img-fluid w-100 h-100" src="img/news-700x435-2.jpg" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a
                                    class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2">Business</a>
                                <a class="text-white"><small>Jan 01, 2045</small></a>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold">Lorem ipsum dolor sit amet
                                elit...</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        <img class="img-fluid w-100 h-100" src="img/news-700x435-3.jpg" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a
                                    class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2">Business</a>
                                <a class="text-white"><small>Jan 01, 2045</small></a>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold">Lorem ipsum dolor sit amet
                                elit...</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        <img class="img-fluid w-100 h-100" src="img/news-700x435-4.jpg" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a
                                    class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2">Business</a>
                                <a class="text-white"><small>Jan 01, 2045</small></a>
                            </div>
                            <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold">Lorem ipsum dolor sit amet
                                elit...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>


<!-- Breaking News Start -->
{{-- <div class="container-fluid bg-dark py-3 mb-3">
    <div class="container">
        <div class="row align-items-center bg-dark">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">Breaking
                        News</div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                        style="width: calc(100% - 170px); padding-right: 90px;">
                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold">Lorem
                                ipsum dolor sit amet elit. Proin interdum lacus eget ante tincidunt, sed faucibus nisl
                                sodales</a></div>
                        <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold">Lorem
                                ipsum dolor sit amet elit. Proin interdum lacus eget ante tincidunt, sed faucibus nisl
                                sodales</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Breaking News End -->

@include('news.sliders.sales')
@include('news.sliders.rent')



@endsection