
$(document).on("click", ".close_modal", function () {
    $('.print_modal').hide();
});

$(document).on("click", ".show_modal", function () {
    $('.print_modal').show();
});


$(document).on("click", ".show_modal_", function () {
    var node = document.getElementById('print_modal');

    domtoimage.toPng(node)
        .then(function (dataUrl) {
            var img = new Image();
            img.src = dataUrl;
            img.id="asds"
            console.log(img.src)

            // $('#print_modal').html(img)

            var a = document.createElement("a"); //Create <a>
            a.href = img.src; //Image Base64 Goes here
            a.download = "kedemik.png"; //File name Here
            a.click(); //Downloaded file
        })
        .catch(function (error) {
            console.error('oops, something went wrong!', error);
        });


});

