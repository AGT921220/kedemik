
$(".is_shared").change(function () {
    if (this.checked) {
        $('.is_shared_container').show()
        return
    }
    $('.is_shared_container').hide()
});