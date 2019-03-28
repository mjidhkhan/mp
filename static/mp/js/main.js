$(function() {
    $(document).scroll(function() {
        var $nav = $(".navbar-fixed-top");
        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    });
});

function showResponse() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });

    Toast.fire({
        type: 'success',
        title: 'Signed in successfully'
    })
}

var item;
$('select#age').on('change', function() {
    item = this.value;
});

$("#create_recipe").click(function(e) {
    e.preventDefault();
    var action = 'ADD_RECPIE'
    var name = $('#rcpname').val()
    var data = { name, item }



    var request = $.ajax({
        url: "admin-functions.php",
        method: "POST",
        data: { data: data, action: action }
    });
    request.done(function(msg) {
        $("#log").html(msg);
    });


});
$("#create_recipe2").click(function(event) {
    event.preventDefault();
    alert(1)
});