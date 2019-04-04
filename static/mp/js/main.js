//var $nav = $(".navbar-fixed-top");
// $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());




var count = 0;
$(document).ready(function() {
    $('#create_recipe').hide();
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

        var $target = $(e.target);
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function(e) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);


    });
    $(".prev-step").click(function(e) {
        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);


    });
});

function nextTab(elem) {
    console.log(elem)
    count++;
    console.log(count)
    if (count == 5) {
        $('#create_recipe').show();
        count = 0
    }
    $(elem).next().find('a[data-toggle="tab"]').click();
}

function prevTab(elem) {
    count--;
    console.log(count)
    if (count < 5 && count < 0) {
        $('#create_recipe').hide();
        count = 0
    }
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

/*
function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}

function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
*/
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
    e.stopImmediatePropagation();

    var d = new FormData(this)
    console.log(d)

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


//add_newitem

$("#add_newitem").on('submit', function(e) {
    e.preventDefault();
    // e.stopImmediatePropagation();
    $.ajax({
        type: 'POST',
        url: 'admin-functions.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            // $('#add_newitem').attr("disabled", "disabled");
            // $('#add_newitem').css("opacity", ".5");
        },
        success: function(msg) {
            var item = $('#item-name').val();
            Swal.fire({
                title: item,
                text: "Added in stock successfully!",
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    $('form').get(0).reset()
                }
            })
        }
    });
    return false;
});



function deleteStock(name, id) {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success spacer-right',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't to delete " + name + " .",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: 'admin-functions.php',
                data: { action: 'DELETE_ITEM', id: id },
                success: function(msg) {
                    if (msg == true) {
                        $('#' + id).hide();
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }

                },

            })

        } else if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'You have canceled the process.',
                'error'
            )
        }
    })
}

var ID = null;
var item = null;

function updateStock(id) {
    ID = id;
    item = "item-" + id;
    if ($('#btn-' + id).hasClass('fa-edit')) {
        $('#type-' + id).removeClass('btn-primary');
        $('#type-' + id).addClass('btn-warning');
        $(".mp-item").on("click", switchToInputBox);
        console.log('yes - ' + ID)
    } else {
        console.log('item-' + id)
        var data = [];
        $("#item-" + id).each(function() {

            var current_row = $(this);
            data.push(current_row.find("td:eq(0)").text());
            data.push(current_row.find("td:eq(1)").text());
            data.push(current_row.find("td:eq(2)").text());
            data.push(current_row.find("td:eq(3)").text());
            data.push(current_row.find("td:eq(4)").text());
        });

        // do update 
        processUpdate(data)

    }
}

/**
 * Switch table cell to input box.
 */
var switchToInputBox = function() {
    var itemID = $(this).closest('tr').attr('id');
    if (itemID == item) {
        var $input = $("<input>", {
            val: $(this).text(),
            type: "text",
        });
        $input.addClass("form-control");
        $(this).replaceWith($input);
        $input.on("blur", switchToTableCell);
        $('#btn-' + ID).removeClass('fa-edit');
        $('#type-' + ID).removeClass('btn-warning');
        $('#type-' + ID).addClass('btn-success');
        $('#btn-' + ID).addClass('fa-save');
        $input.select();
    }
};
/**
 * Switch back to table cell
 */
var switchToTableCell = function() {
    var $cell = $("<td>", {
        text: $(this).val()
    });
    $cell.removeClass("form-control");
    $cell.addClass("inpt-item");
    $(this).replaceWith($cell);

    $cell.on("click", switchToInputBox);
}

//$(".mp-item").on("click", switchToInputBox);


function processUpdate(data) {
    console.log(data)

    $.ajax({
        type: 'POST',
        url: 'admin-functions.php',
        data: { action: 'UPDATE_ITEM', data: data },
        success: function(msg) {
            if (msg == true) {
                $('#' + id).hide();
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }

        },

    })
}