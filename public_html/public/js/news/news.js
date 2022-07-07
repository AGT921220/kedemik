$(document).on("click", ".sales_item", function() {
    let id = $(this).data('id')
    let url = 'propiedades-en-venta/'+id
    window.open(url);

});
$(document).on("click", ".appraise_item", function() {
    let id = $(this).data('id')
    let url = 'avaluos/'+id
    window.open(url);

});
$(document).on("click", ".infonavit_item", function() {
    let id = $(this).data('id')
    let url = 'temas-de-infonavit/'+id
    window.open(url);

});

$(document).on("click", ".fovissste_item", function() {
    let id = $(this).data('id')
    let url = 'temas-de-fovissste/'+id
    window.open(url);

});

$(document).on("click", ".asesoria_item", function() {
    let id = $(this).data('id')
    let url = 'asesoria-juridica/'+id
    window.open(url);

});
$(document).on("click", ".construccion_item", function() {
    let id = $(this).data('id')
    let url = 'construccion-y-remodelacion/'+id
    window.open(url);

});

