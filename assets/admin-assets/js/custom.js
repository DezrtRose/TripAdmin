// site url
var base_url = window.location.origin+'/';
if(base_url == 'http://localhost/') {
    base_url = 'http://localhost/driverjob/';
} /*else {
    base_url = 'http://mpire.uk.com/';
}*/

$(document).ready(function(){
    $('#has-ckeditor').on('click', function(){
        for(var i in CKEDITOR.instances) {
            CKEDITOR.instances[i].updateElement();
        }
    });
    $('.forms').validate({
        ignore: [],
        rules: {
            password2: {
                equalTo: '#password'
            }
        }
    });
});

function get(what, value) {
    if(what === 'sub_cat') {
        if(value == '') {
            value = $('#cat').val();
        }
        $.ajax({
            data: 'id='+value,
            type: 'post',
            url: base_url+'admin/product/get_subcat',
            success: function(res) {
                $('#brand')
                    .html('')
                    .html("<select disabled class='form-control'><option value=''>-- select category and sub category first --</option></select>");
                $('#sub-cat')
                    .html('')
                    .html(res);
            }
        });
    } else if(what === 'brand') {
        if(value == '') {
            value = $('#subcat').val();
        }
        $.ajax({
            data: 'id='+value,
            type: 'post',
            url: base_url+'admin/product/get_brand',
            success: function(res) {
                $('#brand')
                    .html('')
                    .html(res);
            }
        });
    }
}

function save_driver_status(status, driver_id) {
    $.ajax({
        data: 'status='+status+'&driver_id='+driver_id,
        type: 'post',
        url: base_url+'admin/driver/save_driver_status',
        success: function() {
            $('.msgabove').prepend('<div class="alert alert-info alert-dismissible fade in" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' +
                'Profile updated' +
                '</div>');
        }
    })
}

function check_lead(value) {
    if(value == 'Fixed') {
        $('#fixed-price').html('<br><input type="text" class="form-control required" name="lead_price" placeholder="Enter fixed lead price">');
        $('#lead-type').removeAttr('name');
    } else {
        $('#fixed-price').html('');
        $('#lead-type').attr('name', 'lead_price');
    }
}

$(function() {
    var scntDiv = $('#p_scents');
    var i = $('#p_scents tr').size() + 1;

    $('#addScnt').live('click', function() {
        $('<tr><td><input class="form-control small-input" type="text" id="p_scnt" name="caption[]" placeholder="Enter banner caption '+i+'" /><a href="#" id="remScnt"><i class="fa fa-times-circle"></i></a></td></tr>').appendTo(scntDiv);
        i++;
        return false;
    });

    $('#remScnt').live('click', function() {
        if( i > 2 ) {
            $(this).parents('tr').remove();
            i--;
        }
        return false;
    });

    $('body').on('focus',".departure-datepicker", function(){
        $(this).datepicker();
    });

    // clone departure date
    $('body').on('click', '.add-departure', function(e){
        e.preventDefault();
        var newElm1 = "<tr>" +
            "<td>" +
            "<label>From Date</label>" +
            "<input type='text' class='form-control departure-datepicker required' name='date_from[]'>" +
            "</td>" +
            "<td>" +
            "<label>To Date</label>" +
            "<input type='text' class='form-control departure-datepicker required' name='date_to[]'>" +
            "</td>" +
            "<td>" +
            "<label>Price</label>" +
            "<input type='text' class='form-control required' name='price[]'>" +
            "</td>" +
            "<td>" +
            "<label>Status</label>" +
            "<select name='type[]' class='form-control required'>" +
            "<option value='Guaranteed'>Guaranteed</option>" +
            "<option value='Limited'>Limited</option>" +
            "</select>" +
            "</td>" +
            "</tr>";
        $('#departure-table').append(newElm1);
    });

    $('body').on('click', '.delete-departure', function(e) {
        e.preventDefault();
        $(this).parents('tr').remove();
    })
});