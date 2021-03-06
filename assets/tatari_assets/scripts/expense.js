$(document).ready(function() {
    var tat_table = $('#tat_table').dataTable({
        "bDestroy": true,
        "ajax": {
            url : base_url+"/expense_list/",
            type : 'GET'
        },

    });
    
    $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_tat"]').select2({ width:'100%' }); 
    
    jQuery("#aj_company").change(function(){
        jQuery.get(base_url+"/get_employees/"+jQuery(this).val(), function(data, status){
            jQuery('#employee_ajax').html(data);
        });
    });

    $("#delete_record").submit(function(e){
    e.preventDefault();
        var obj = $(this), action = obj.attr('name');
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize()+"&is_ajax=2&form="+action,
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
    

    $('.edit-modal-data').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var expense_id = button.data('expense_id');
        var modal = $(this);
    $.ajax({
        url : base_url+"/read/",
        type: "GET",
        data: 'jd=1&is_ajax=1&mode=modal&data=expense&expense_id='+expense_id,
        success: function (response) {
            if(response) {
                $("#ajax_modal").html(response);
            }
        }
        });
    });
    
    $('.view-modal-data').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var expense_id = button.data('expense_id');
        var modal = $(this);
    $.ajax({
        url : base_url+"/read/",
        type: "GET",
        data: 'jd=1&is_ajax=1&mode=modal&data=view_expense&expense_id='+expense_id,
        success: function (response) {
            if(response) {
                $("#ajax_modal_view").html(response);
            }
        }
        });
    });
    

    $("#tat-form").submit(function(e){
        var fd = new FormData(this);
        var obj = $(this), action = obj.attr('name');
        $('.icon-spinner3').show();
        fd.append("is_ajax", 1);
        fd.append("add_type", 'expense');
        fd.append("form", action);
        e.preventDefault();
        $('.save').prop('disabled', true);
        $.ajax({
            url: e.target.action,
            type: "POST",
            data:  fd,
            contentType: false,
            cache: false,
            processData:false,
            success: function(JSON)
            {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                    $('.save').prop('disabled', false);
                    $('.icon-spinner3').hide();
                } else {
                    tat_table.api().ajax.reload(function(){ 
                        toastr.success(JSON.result);
                    }, true);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                    $('.icon-spinner3').hide();
                    $('.add-form').removeClass('in');
                    $('.select2-selection__rendered').html('--Select--');
                    $('#tat-form')[0].reset();
                    $('.save').prop('disabled', false);
                }
            },
            error: function() 
            {
                toastr.error(JSON.error);
                $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                $('.icon-spinner3').hide();
                $('.save').prop('disabled', false);
            } 	        
       });
    });
    });
    $( document ).on( "click", ".delete", function() {
    $('input[name=_token]').val($(this).data('record-id'));
    $('#delete_record').attr('action',base_url+'/delete/'+$(this).data('record-id'));
    });