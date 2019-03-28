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



$("#create_recipe").click(function(event) {
    event.preventDefault();
    alert(1)
});
$("#create_recipe2").click(function(event) {
    event.preventDefault();
    alert(1)
});