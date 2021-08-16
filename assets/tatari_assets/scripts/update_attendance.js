$(document).ready(function() {
    var tat_table = $('#tat_table').dataTable({
        "bDestroy": true,
        "ajax": {
            url : site_url+"attendance/update_attendance_list/?employee_id="+$('#employee_id').val()+"&attendance_date="+$('#attendance_date').val(),
            type : 'GET'
        },

    });
    jQuery("#aj_company").change(function(){
        jQuery.get(base_url+"/get_update_employees/"+jQuery(this).val(), function(data, status){
            jQuery('#employee_ajax').html(data);
        });
    });
    
    // Date Format: Month & Year
    $('.attendance_date').datepicker({
        changeMonth: true,
        changeYear: true,
        maxDate: '0',
        dateFormat:'yy-mm-dd',
        altField: "#date_format",
        altFormat: js_date_format,
        yearRange: '1970:' + new Date().getFullYear(),
        beforeShow: function(input) {
            $(input).datepicker("widget").show();
        }
    });
    
    $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_tat"]').select2({ width:'100%' }); 
    
    
    /* Update Attendance */
    $("#update_attendance_report").submit(function(e){
       
        e.preventDefault();
        var employee_id = $('#employee_id').val();
        var attendance_date = $('#attendance_date').val();
        var tat_table2 = $('#tat_table').dataTable({
            "bDestroy": true,
            "ajax": {
                url : site_url+"attendance/update_attendance_list/?employee_id="+employee_id+"&attendance_date="+attendance_date,
                type : 'GET'
            },
            
            "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
            }
        });
        $('#add_attendance_btn').show();
        toastr.success('Request Submit.');
        tat_table2.api().ajax.reload(function(){ }, true);
    });
        
    /* Delete Records */
    $("#delete_record").submit(function(e){
   
    e.preventDefault();
        var obj = $(this), action = obj.attr('name');
        $.ajax({
            type: "POST",
            url: e.target.action,
            data: obj.serialize()+"&is_ajax=true&type=delete&form="+action,
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
    
    // Insert Attendance
    $('.add-modal-data').on('show.bs.modal', function (event) {
        var employee_id = $('#employee_id').val();
        var button = $(event.relatedTarget);
        var modal = $(this);
        $.ajax({
            url: site_url+'attendance/update_attendance_add/',
            type: "GET",
            data: 'jd=1&is_ajax=9&mode=modal&data=add_attendance&type=add_attendance&employee_id='+employee_id,
            success: function (response) {
                if(response) {
                    $("#add_ajax_modal").html(response);
                }
            }
        });
    });
    
    // Edit
    $('.edit-modal-data').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var attendance_id = button.data('attendance_id');
        var modal = $(this);
    $.ajax({
        url : site_url+"attendance/read/",
        type: "GET",
        data: 'jd=1&is_ajax=1&mode=modal&data=attendance&type=attendance&attendance_id='+attendance_id,
        success: function (response) {
            if(response) {
                $("#ajax_modal").html(response);
            }
        }
        });
    });
    });
    $( document ).on( "click", ".delete", function() {
    $('input[name=_token]').val($(this).data('record-id'));
    $('#delete_record').attr('action',site_url+'attendance/delete_attendance/'+$(this).data('record-id'))+'/';
    });
    