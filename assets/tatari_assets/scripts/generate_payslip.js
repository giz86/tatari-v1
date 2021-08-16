// Generate Payslips - PDF javascript running:

$(document).ready(function() {
    var employee_id = jQuery('#employee_id').val();
    var month_year = jQuery('#month_year').val();
    var company_id = jQuery('#aj_company').val();
    var tat_table = $('#tat_table').dataTable({
    "bDestroy": true,
    "ajax": {
        url : site_url+"payroll/payslip_list/?employee_id="+employee_id+"&company_id="+company_id+"&month_year="+month_year,
        type : 'GET'
    },
    "fnDrawCallback": function(settings){
    $('[data-toggle="tooltip"]').tooltip();          
    }
    });
    
    $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
    $('[data-plugin="select_tat"]').select2({ width:'100%' }); 
    jQuery("#aj_company").change(function(){
        jQuery.get(base_url+"/get_employees/"+jQuery(this).val(), function(data, status){
            jQuery('#employee_ajax').html(data);
        });
    });

    jQuery("#aj_companyx").change(function(){
        jQuery.get(escapeHtmlSecure(base_url+"/get_company_plocations/"+jQuery(this).val()), function(data, status){
            jQuery('#location_ajax').html(data);
        });
    });

    // Month-Year
    $('.month_year').datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat:'yy-mm',
    yearRange: '1970:' + new Date().getFullYear(),
    beforeShow: function(input) {
    $(input).datepicker("widget").addClass('hide-calendar');
    },
    onClose: function(dateText, inst) {
    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
    $(this).datepicker('setDate', new Date(year, month, 1));
    $(this).datepicker('widget').removeClass('hide-calendar');
    $(this).datepicker('widget').hide();
    }
    
    });
    
    /* Delete Records */
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
            } else {
                $('.delete-modal').modal('toggle');
                tat_table.api().ajax.reload(function(){ 
                    toastr.success(JSON.result);
                }, true);							
            }
        }
    });
    });
    

    $('.payroll_model_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var employee_id = button.data('employee_id');
    var modal = $(this);
    $.ajax({
        url: site_url+'payroll/payroll_model_read/',
        type: "GET",
        data: 'jd=1&is_ajax=11&mode=not_paid&data=payroll_model&type=payroll_model&employee_id='+employee_id,
        success: function (response) {
            if(response) {
                $("#ajax_modal_payroll").html(response);
            }
        }
    });
    });
    
   
    $('.hourlywages_model_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var employee_id = button.data('employee_id');
    var payment_date = $('#month_year').val();
    var company_id = button.data('company_id');
    var modal = $(this);
    $.ajax({
        url: site_url+'payroll/hourlywage_model_read/',
        type: "GET",
        data: 'jd=1&is_ajax=11&mode=not_paid&data=hourly_payslip&type=read_hourly_payment&employee_id='+employee_id+'&pay_date='+payment_date+'&company_id='+company_id,
        success: function (response) {
            if(response) {
                $("#ajax_modal_hourlywages").html(response);
            }
        }
    });
    });



    $('.detail_modal_data').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var employee_id = button.data('employee_id');
    var pay_id = button.data('pay_id');
    var company_id = button.data('company_id');
    var modal = $(this);
    $.ajax({
        url: site_url+'payroll/make_payment_view/',
        type: "GET",
        data: 'jd=1&is_ajax=11&mode=modal&data=pay_payment&type=pay_payment&emp_id='+employee_id+'&pay_id='+pay_id+'&company_id='+company_id,
        success: function (response) {
            if(response) {
                $("#ajax_modal_details").html(response);
            }
        }
    });
    });
    
    

    $('.emo_monthly_pay').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var employee_id = button.data('employee_id');
    var payment_date = $('#month_year').val();
    var company_id = button.data('company_id');
    var modal = $(this);
    $.ajax({
        url: site_url+'payroll/pay_salary/',
        type: "GET",
        data: 'jd=1&is_ajax=11&data=payment&type=monthly_payment&employee_id='+employee_id+'&pay_date='+payment_date+'&company_id='+company_id,
        success: function (response) {
            if(response) {
                $("#emo_monthly_pay_aj").html(response);
            }
        }
    });
    });
    

    $('.emo_hourly_pay').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var employee_id = button.data('employee_id');
    var payment_date = $('#month_year').val();
    var company_id = button.data('company_id');
    var modal = $(this);
    $.ajax({
        url: site_url+'payroll/pay_hourly/',
        type: "GET",
        data: 'jd=1&is_ajax=11&data=hourly_payment&type=fhourly_payment&employee_id='+employee_id+'&pay_date='+payment_date+'&company_id='+company_id,
        success: function (response) {
            if(response) {
                $("#emo_hourly_pay_aj").html(response);
            }
        }
    });
    });


    // Bulk Payment Processing
    $("#bulk_payment").submit(function(e){
    e.preventDefault();
    var obj = $(this), action = obj.attr('name');
    $('.save').prop('disabled', true);
    $('.icon-spinner3').show();
    var employee_id = jQuery('#employee_id').val();
    var bmonth_year = jQuery('#bmonth_year').val();
    var company_id = jQuery('#aj_company').val()
    $.ajax({
        type: "POST",
        url: e.target.action,
        data: obj.serialize()+"&is_ajax=1&add_type=payroll&form="+action,
        cache: false,
        success: function (JSON) {
            if (JSON.error != '') {
                toastr.error(JSON.error);
                $('.save').prop('disabled', false);
                $('.icon-spinner3').hide();
            } else {
                var tat_table3 = $('#tat_table').dataTable({
                    "bDestroy": true,
                    "ajax": {
                        url : site_url+"payroll/payslip_list/?employee_id="+employee_id+"&company_id="+company_id+"&month_year="+bmonth_year,
                        type : 'GET'
                    },
                    "fnDrawCallback": function(settings){
                    $('[data-toggle="tooltip"]').tooltip();          
                    }
                });
                tat_table3.api().ajax.reload(function(){ 
                    toastr.success(JSON.result);
                }, true);
                $('.icon-spinner3').hide();
                $('.save').prop('disabled', false);
            }
        }
    });
    });



    // Insert Record Salary: model
    $("#user_salary_model").submit(function(e){
    e.preventDefault();
    var obj = $(this), action = obj.attr('name');
    $('.save').prop('disabled', true);
    $('.icon-spinner3').show();
    $.ajax({
        type: "POST",
        url: e.target.action,
        data: obj.serialize()+"&is_ajax=1&edit_type=payroll&form="+action,
        cache: false,
        success: function (JSON) {
            if (JSON.error != '') {
                toastr.error(JSON.error);
                $('.save').prop('disabled', false);
                $('.icon-spinner3').hide();
            } else {
                tat_table.api().ajax.reload(function(){ 
                    toastr.success(JSON.result);
                }, true);
                $('.icon-spinner3').hide();
                $('.save').prop('disabled', false);
            }
        }
    });
    });
    

    $("#set_salary_details").submit(function(e){
    e.preventDefault();
    var obj = $(this), action = obj.attr('name');
    var employee_id = jQuery('#employee_id').val();
    var month_year = jQuery('#month_year').val();
    var company_id = jQuery('#aj_company').val();

    $('#p_month').html(month_year);
    var tat_table2 = $('#tat_table').dataTable({
        "bDestroy": true,
        "ajax": {
            url : site_url+"payroll/payslip_list/?employee_id="+employee_id+"&company_id="+company_id+"&month_year="+month_year,
            type : 'GET'
        },
        "fnDrawCallback": function(settings){
        $('[data-toggle="tooltip"]').tooltip();          
        }
    });
    tat_table2.api().ajax.reload(function(){ 
    }, true);
    });
    });
    $( document ).on( "click", ".delete", function() {
    $('input[name=_token]').val($(this).data('record-id'));
    $('#delete_record').attr('action',base_url+'/payslip_delete/'+$(this).data('record-id'))+'/';
    });
    