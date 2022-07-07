<div class="col-md-3">
    <div class="mb-3">
        <div class="section-title mb-0">
            <h4 class="m-0 text-uppercase font-weight-bold">Filtros</h4>
        </div>
        <div class="bg-white border border-top-0 p-3">
            <h3>Precio:</h3>
            <div style="position: relative;">
                <div style="display: flex">
                <label>Mínimo</label>
                <p class="filter_price_min_tooltip" ></p>
            </div>
                <input type="range" min="{{$min}}" max="{{$max}}" value="{{$min}}" class="filter_price filter_price_min"
                    name="price_min">
            </div>

            <div>
                <div style="display: flex">
                    <label>Máximo</label>
                    <p class="filter_price_max_tooltip" ></p>
                </div>
    
                <input type="range" min="{{$min}}" max="{{$max}}" value="{{$max}}" class="filter_price filter_price_max"
                    name="price_max">

            </div>

            <p class="show_filter_price">Entre ${{number_format($min, 0, '', ',')}} y $ {{number_format($max, 0, '',
                ',')}}</p>
        </div>
        <a class="btn btn-primary filters_button">Aplicar</a>
    </div>
</div>

<style>
.range-value{
  position: absolute;
  top: -50%;
}
</style>