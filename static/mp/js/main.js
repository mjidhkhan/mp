$(function() {
    $(document).scroll(function() {
        //var $nav = $(".navbar-fixed-top");
        // $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
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

var item_id;
var id = [];
$('select#item1, select#item2, select#item3, select#item4').on('change', function() {
    item_id = this.value;
    id.push(item_id)
});
var mealtype;
$('select#mealtype').on('change', function () {
    mealtype = this.value;
});
var mealcat;
$('select#mealcat').on('change', function () {
    mealcat = this.value;
});

$('input[type=file]').change(function () {
    console.dir(this.files[0])
    var path = (window.URL || window.webkitURL).createObjectURL(this.files[0]);
    console.log('path', path);
})
$("#create_recipe").click(function(e) {
    e.preventDefault();
    var action = 'ADD_RECPIE'
    var name = $('#rcpname').val()
    var data = { name, id }
    var filename = $('#fileToUpload').val()
    var path = document.getElementById("fileToUpload").files[0].path
    var text = $('textarea#sd').val()
    var qty_1 = $('#qty_1').val()
    var qty_2 = $('#qty_2').val()
    var qty_3 = $('#qty_3').val()
    var qty_4 = $('#qty_4').val()



    var request = $.ajax({
        url: "admin-functions.php",
        method: "POST",
        data: {
            data: data, action: action,
            filename: filename, text: text,
            mealtype: mealtype,
            path:path,
            meatcat: mealcat,
            qty_1:qty_1,
            qty_2:qty_2,
            qty_3:qty_3,
            qty_4:qty_4,
        }
    });
    request.done(function(msg) {
        $("#log").html(msg);
    });


});
$("#create_recipe2").click(function(event) {
    event.preventDefault();
    alert(1)
});
$("#fileupload").click(function (event) {
    event.preventDefault();
    alert(1)
});