@extends('layouts.news')

@section('content')



@include('news.sliders.sales')
@include('news.sliders.rent')



<div class="container mt-5" style="display:flex;flex-wrap: wrap; padding:0;">
    @include('news.items.house_filters')

    <div class="col-md-9">
        <div class="filter_container_items">

            @foreach ($paginated as $item)
            @include('news.items.house_sale')
            @endforeach
        </div>

        <div id="pagination">
            {!! $paginated->links() !!}
        </div>
    </div>


</div>






@endsection