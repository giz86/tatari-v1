$(document).ready(function() {
    var tat_table = $('#tat_table').dataTable({
        "bDestroy": true,
        "ajax": {
            url : site_url+"attendance/office_shift_list/",
            type : 'GET'
        },
 
    });
    $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_tat"]').select2({ width:'100%' });
    $('.clockpicker').clockpicker();
    
    var input = $('.timepicker').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    
    $(".clear-time").click(function(){
        var clear_id  = $(this).data('clear-id');
        $(".clear-"+clear_id).val('');
    });
    
    /* Delete Record */
    $("#delete_record").submit(function(e){
    
    e.preventDefault();
        var obj = $(this), action = obj.attr('name');
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize()+"&is_ajax=2&type=delete&form="+action,
            cache: false,
            success: function (JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                } else {
                    $('.delete-modal').modal('toggle');
                    tat_table.api().ajax.reload(function(){ 
                        toastr.success(JSON.result);
                    }, true);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);							
                }
            }
        });
    });
    
    // Update
    $('.edit-modal-data').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var office_shift_id = button.data('office_shift_id');
        var modal = $(this);
    $.ajax({
        url : site_url+"attendance/read_shift_record/",
        type: "GET",
        data: 'jd=1&is_ajax=1&mode=modal&data=shift&office_shift_id='+office_shift_id,
        success: function (response) {
            if(response) {
                $("#ajax_modal").html(response);
            }
        }
        });
    });
    
    /* Add data */ 
    $("#tat-form").submit(function(e){
    e.preventDefault();
        var obj = $(this), action = obj.attr('name');
        $('.save').prop('disabled', true);
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize()+"&is_ajax=1&add_type=office_shift&form="+action,
            cache: false,
            success: function (JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                    $('.save').prop('disabled', false);
                } else {
                    tat_table.api().ajax.reload(function(){ 
                        toastr.success(JSON.result);
                    }, true);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                    $('.add-form').removeClass('in');
                    $('.select2-selection__rendered').html('--Select--');
                    $('#tat-form')[0].reset(); // To reset form fields
                    $('.save').prop('disabled', false);
                }
            }
        });
    });
    });
    $( document ).on( "click", ".delete", function() {
    $('input[name=_token]').val($(this).data('record-id'));
    $('#delete_record').attr('action',site_url+'attendance/delete_shift/'+$(this).data('record-id'));
    });
    
    $( document ).on( "click", ".default-shift", function() {
        var officeshift_id = $(this).data('office_shift_id');
        $.ajax({
        type: "GET",
        url: site_url+"attendance/default_shift/?office_shift_id="+officeshift_id,
            success: function (JSON) {
                var tat_table2 = $('#tat_table').dataTable({
                    "bDestroy": true,
                    "ajax": {
                        url : site_url+"attendance/office_shift_list/",
                        type : 'GET'
                    },
                    "fnDrawCallback": function(settings){
                    $('[data-toggle="tooltip"]').tooltip();          
                    }
                });
                tat_table2.api().ajax.reload(function(){ 
                    toastr.success(JSON.result);
                }, true);
            }
        });
     });
    