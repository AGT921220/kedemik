$(document).ready(function() {

    var plantas = $('.select_plantas').val();
    console.log(plantas);
    inputs_plantas(plantas);

});

$(document).on("change", ".select_plantas", function() {
    var plantas = $(this).val();
    console.log(plantas);
    inputs_plantas(plantas);

});



function inputs_plantas(plantas) {


    $('.plantas_inputs').html('');
    for (var i = 1; i <= plantas; i++) {
        $('.plantas_inputs').append('<div style="border-bottom: solid black 1px; border-top: solid black 1px; margin: 2em;"> <h3>Piso '+i+'</h3>  <div class="form-group"> <label >Tiene cocina?</label> <select class="form-control" name="cocina"> <option value="si">Si</option> <option value="no">No</option> </select> </div> <div class="form-group"> <label >Tiene sala?</label> <select class="form-control" name="sala"> <option value="si">Si</option> <option value="no">No</option> </select> </div> <div class="form-group"> <label >Tiene comedor?</label> <select class="form-control" name="comedor"> <option value="si">Si</option> <option value="no">No</option> </select> </div> <div class="form-group"> <label >Tiene lavanderia?</label> <select class="form-control" name="lavanderia"> <option value="si">Si</option> <option value="no">No</option> </select> </div> <div class="form-group"> <label >Recamaras</label> <select class="form-control" name="recamaras"> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> </select> </div> <div class="form-group"> <label >Baños</label> <select class="form-control" name="baños"> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="4">4</option> <option value="5">5</option> </select> </div></div>');

    }




}