$(document).ready(function() {
    var tat_table = $('#tat_table').dataTable({
        "bDestroy": true,
        "ajax": {
            url : site_url+"attendance/attendance_list/?attendance_date="+$('#attendance_date').val(),
            type : 'GET'
        },
 
    });
    $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_tat"]').select2({ width:'100%' });
    
    $('.view-modal-data').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ipaddress = button.data('ipaddress');
        var uid = button.data('uid');
        var start_date = button.data('start_date');
        var att_type = button.data('att_type');
        var modal = $(this);
    $.ajax({
        url :  site_url+"attendance/read_map_info/",
        type: "GET",
        data: 'jd=1&is_ajax=1&mode=modal&data=view_map&type=view_map&ipaddress='+ipaddress+'&uid='+uid+'&start_date='+start_date+'&att_type='+att_type,
        success: function (response) {
            if(response) {
                $("#ajax_modal_view").html(response);
            }
        }
        });
    });
    
    
    // Date: Month - Year Format
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
    
    // Attendance Daily Report
    $("#attendance_daily_report").submit(function(e){
        
        e.preventDefault();
        var attendance_date = $('#attendance_date').val();
        var date_format = $('#date_format').val();
        if(attendance_date == ''){
            toastr.error('Please select date.');
        } else {
        $('#att_date').html(date_format);
             var tat_table2 = $('#tat_table').dataTable({
                "bDestroy": true,
                "ajax": {
                    url : site_url+"attendance/attendance_list/?attendance_date="+$('#attendance_date').val()+"&location_id="+$('#location_id').val(),
                    type : 'GET'
                },
              
            });
            tat_table2.api().ajax.reload(function(){ }, true);
        }
    });
    
    });