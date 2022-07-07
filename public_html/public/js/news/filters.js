$(document).on("change", ".filter_price_min", function () {
    let price_min = parseInt($('.filter_price_min').val())
    let price_max = parseInt($('.filter_price_max').val())
    if (price_min > price_max) {
        $('.filter_price_max').val(price_min)
        price_max = price_min
    }
    if (price_max == price_min) {
        $('.show_filter_price').html('Precio de $' + numberWithCommas(price_min))
        return
    }
    $('.show_filter_price').html('Entre $' + numberWithCommas(price_min) + ' y $' + numberWithCommas(price_max))
    $('.filter_price_min_tooltip').html('')
});


$(document).on("change", ".filter_price_max", function () {
    let price_min = parseInt($('.filter_price_min').val())
    let price_max = parseInt($('.filter_price_max').val())

    if (price_min > price_max) {
        $('.filter_price_min').val(price_max)
        price_min = price_max
    }

    if (price_max == price_min) {
        $('.show_filter_price').html('Precio de $' + numberWithCommas(price_min))
        return
    }

    $('.show_filter_price').html('Entre $' + numberWithCommas(price_min) + ' y $' + numberWithCommas(price_max))
    $('.filter_price_max_tooltip').html('')

});


$(document).on("input", ".filter_price_min", function () {
    $('.filter_price_min_tooltip').html("   $"+$(this).val()+"")
});

$(document).on("input", ".filter_price_max", function () {
    $('.filter_price_max_tooltip').html("   $"+$(this).val()+"")
});









function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}



$(document).on("click", ".filters_button", function () {

    let filters = getFilters()
    

    getPropertiesData("propiedades-pagination?filters=true",filters)
});

function getFilters()
{
    let price_min = parseInt($('.filter_price_min').val())
    let price_max = parseInt($('.filter_price_max').val())
    return '&min='+price_min+'&max='+price_max
}

function changePagination(option) {
    if (option != "") {
        getresult("propiedades-pagination");
    }
}

$(document).on("click", "#pagination a,#pagination span,#search_btn", function (e) {
    e.preventDefault();
    $('.page-item').removeClass('active')
    $(this).parent().addClass('active')

    var url = $(this).attr("href");
    if (!url) {
        url = '/?page=1'
    }

    var append = url.indexOf("?") == -1 ? "?" : "&";
    var finalURL = url + append + $("#searchform").serialize();
    if(!finalURL.includes('propiedades-pagination'))
    {
        finalURL = 'propiedades-pagination'+finalURL
    }
    let filters = getFilters()

    getPropertiesData(finalURL,filters)
    return false;
})


function getPropertiesData(url,parameters) {
    if(!parameters)
    {
        parameters=''
    }
    Swal.fire(
        'Cargando',
        'Cargando datos!',
        'info'
    )

    Swal.showLoading();

    $.get(url+parameters, function (data) {
        let items = data.data.data
        console.log(data)
        $('.filter_container_items').html('')
        items.forEach(function (item) {
            $('.filter_container_items').append('<a class="mb-4 sale_house_item" target="_blank" href="/propiedades-en-venta/' + item.id + '"> <div class="flex-row col-md-4" style=" display: flex; background-image: url(' + item.image + '); align-items: center; background-size: cover; width: 250px; background-repeat: no-repeat; background-position: center; height: 200px; border-radius: 10px; "> </div> <div class="col-md-8" style="    display: flex; flex-direction: column; max-width: 550px; position: relative; width: 60%; height: 200px;"> <div style="    position: absolute; left: -10px; height: 100%; z-index: 2; background: white; padding: 10px;" > <div style="    display: flex; justify-content: space-around; align-items: center;"> <h3>' + item.name + '</h3><b>$'+numberWithCommas(item.price)+' MXN</b> </div> <div style="    display: flex; justify-content: center; align-items: center;"> <p>' + item.description.substr(0,150) + '</p> </div>'
            +'<div style="display:flex; justify-content:center"> <div class="d-flex align-items-center col-md-3 mb-4 mt-2"> <span class="ml-3"><i class="fa-solid fa-ruler-combined mr-2"></i>'+Math.trunc(item.mts_ground)+' m²</span> </div><div class="d-flex align-items-center col-md-3 mb-4 mt-2"> <span class="ml-3"><i class="fa-solid fa-toilet mr-2"></i>'+Math.trunc(item.bathrooms)+' Baño(s)</span> </div><div class="d-flex align-items-center col-md-3 mb-4 mt-2"> <span class="ml-3"><i class="fa-solid fa-bed mr-2"></i>'+Math.trunc(item.bedrooms)+' Recámara(s)</span> </div> </div>'
            +' </div> </div> </a>')
        });

        $('#pagination').html(data.pagination);

        setTimeout(() => {
            Swal.close()
        }, 100);

        $("#pagination_data").html(data);
    });

}

