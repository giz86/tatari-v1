$(document).ready(function() {
    var tat_table = $('#tat_table').dataTable({
        "bDestroy": true,
        "ajax": {
            url : site_url+"overtime_request/overtime_request_list/?employee_id="+$('#employee_id').val()+"&attendance_date="+$('#attendance_date').val(),
            type : 'GET'
        },
        // Disable Tooltip
        /*dom: 'lBfrtip',
        "buttons": ['csv', 'excel', 'pdf', 'print'], // colvis > if needed
        "fnDrawCallback": function(settings){
        $('[data-toggle="tooltip"]').tooltip();          
        }*/

    });
    
    // Year - Month
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
    
    
    /* Edit Attendance Report */
    $("#update_attendance_report").submit(function(e){
        e.preventDefault();
        var employee_id = $('#employee_id').val();
        var attendance_date = $('#attendance_date').val();
        var tat_table2 = $('#tat_table').dataTable({
            "bDestroy": true,
            "ajax": {
                url : site_url+"overtime_request/overtime_request_list/?employee_id="+employee_id+"&attendance_date="+attendance_date,
                type : 'GET'
            },
            //dom: 'lBfrtip',
            //"buttons": ['csv', 'excel', 'pdf', 'print'], // colvis > if needed
            "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();          
            }
        });
        $('#add_attendance_btn').show();
        toastr.success('Request Submit.');
        tat_table2.api().ajax.reload(function(){ }, true);
    });
        
    /* Delete Record */
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
            url: site_url+'overtime_request/update_attendance_add/',
            type: "GET",
            data: 'jd=1&is_ajax=9&mode=modal&data=add_attendance&type=add_attendance&employee_id='+employee_id,
            success: function (response) {
                if(response) {
                    $("#add_ajax_modal").html(response);
                }
            }
        });
    });
    
    // Update Data
    $('.edit-modal-data').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var time_request_id = button.data('time_request_id');
        var modal = $(this);
    $.ajax({
        url : site_url+"overtime_request/read/",
        type: "GET",
        data: 'jd=1&is_ajax=1&mode=modal&data=attendance&type=attendance&time_request_id='+time_request_id,
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
    $('#delete_record').attr('action',site_url+'overtime_request/delete_attendance/'+$(this).data('record-id'))+'/';
    });
    