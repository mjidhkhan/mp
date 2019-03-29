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
$('select#mealtype').on('change', function() {
    mealtype = this.value;
});
var mealcat;
$('select#mealcat').on('change', function() {
    mealcat = this.value;
});

/*
$('input[type=file]').change(function() {
    console.dir(this.files)
    var path = (window.URL || window.webkitURL).createObjectURL(this.files[0]);
    console.log('path', path);
})
*/
/*
$("#create_recipe").click(function(e) {
    e.preventDefault();
    var action = 'ADD_RECPIE'
    var name = $('#rcpname').val()

    var filename = $('#fileToUpload').val()
    var path = document.getElementById("fileToUpload").value
    console.log(path)
    if (typeof path === 'undefined') {
        alert(1)
    }

    var text = $('textarea#sd').val()

    var qty = []
    for (var i = 1; i <= 4; i++) {
        qty.push($('#qty_' + [i]).val())
    }

    //qty.push($('#qty_2').val())
    // qty.push($('#qty_3').val())
    //qty.push($('#qty_4').val())

    var data = { name, id, qty }
    var request = $.ajax({
        url: "admin-functions.php",
        method: "POST",
        data: {
            data: data,
            action: action,
            filename: filename,
            text: text,
            mealtype: mealtype,
            path: path,
            meatcat: mealcat,
        }
    });
    request.done(function(msg) {
        $("#log").html(msg);
    });


});

*/
$("#create_recipe2").click(function(event) {
    event.preventDefault();
    alert(1)
});
$("#fileupload").click(function(event) {
    event.preventDefault();
    alert(1)
});


$("#rcpForm").on('submit', function(e) {
    e.preventDefault();
    /*var action = 'ADD_RECPIE'
    var name = $('#rcpname').val()

    var filename = $('#fileToUpload').val()
    var path = document.getElementById("fileToUpload").value
    console.log(path)
    if (typeof path === 'undefined') {
        alert(1)
    }

    var text = $('textarea#sd').val()

    var qty = []
    for (var i = 1; i <= 4; i++) {
        qty.push($('#qty_' + [i]).val())
    }

    //qty.push($('#qty_2').val())
    // qty.push($('#qty_3').val())
    //qty.push($('#qty_4').val())

    var data = { name, id, qty }
        var request = $.ajax({
             url: "admin-functions.php",
             method: "POST",
             data: {
                 data: data,
                 action: action,
                 filename: filename,
                 text: text,
                 mealtype: mealtype,
                 path: path,
                 meatcat: mealcat,
             }
         });
         request.done(function(msg) {
             $("#log").html(msg);
         });
         */

    var d = new FormData(this)
    console.log(d)
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'rcp_submit.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.submitBtn').attr("disabled", "disabled");
            $('#fupForm').css("opacity", ".5");
        },
        success: function(msg) {
            $('.statusMsg').html('');
            if (msg == 'ok') {
                $('#fupForm')[0].reset();
                $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
            } else {
                $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
            }
            $('#fupForm').css("opacity", "");
            $(".submitBtn").removeAttr("disabled");
        }
    });
});