<a class="mb-4 sale_house_item" target="_blank" href="/propiedades-en-venta/{{$item->id}}">

    <div class="flex-row col-md-4 image_container_house" style="background-image: url({{$item->image}});">
    </div>

    <div class="col-md-8 container_house">
        <div class="back_house">
            <div style="    display: flex;
            align-items: center;
            justify-content: space-around;">
                <h3>{{$item->name}}</h3>
                <b>${{number_format($item->price,0)}} MXN</b>
            </div>

            <p>{{substr($item->description,0,150)}}</p>
            <div style="display:flex; justify-content:center">
                @include('news.items.icons', ['name' => "fa-ruler-combined", 'item' =>
                $item->mts_ground,'text'=>'m²'])
                @include('news.items.icons', ['name' => "fa-toilet", 'item' =>
                $item->bathrooms,'text'=>'Baño(s)'])
                @include('news.items.icons', ['name' => "fa-bed", 'item' =>
                $item->bedrooms,'text'=>'Recámara(s)'])

            </div>
        </div>

    </div>
</a>