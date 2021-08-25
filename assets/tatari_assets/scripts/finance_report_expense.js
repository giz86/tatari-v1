$(document).ready(function() {
    var from_date = $('#from_date').val();
     var to_date = $('#to_date').val();
     var type_id = $('#type_id').val();
     var company_id = $('#aj_company').val();
     var tat_table = $('#tat_table').dataTable({
         "bDestroy": true,
         "ajax": {
             url : site_url+"finance/report_expense_list/?from_date="+from_date+"&to_date="+to_date+"&type_id="+type_id+"&company_id="+company_id,
             type : 'GET'
         },
         dom: 'lBfrtip',
         "buttons": [{
             extend: 'csv',
             exportOptions: {
                 columns: [ 1, 2, 3, 4]
             }
         }, {
             extend: 'excel',
             exportOptions: {
                 columns: [ 1, 2, 3, 4]
             }
         }, {
             extend: 'pdfHtml5',
             exportOptions: {
                 columns: [ 1, 2, 3, 4]
             }
         },], 
         "fnDrawCallback": function(settings){
         $('[data-toggle="tooltip"]').tooltip();          
         }
     });
     
     $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
     $('[data-plugin="select_tat"]').select2({ width:'100%' });
     jQuery("#aj_company").change(function(){
         jQuery.get(base_url+"/get_expense_types/"+jQuery(this).val(), function(data, status){
             jQuery('#expense_type_ajax').html(data);
         });
     });

     // Month & Year
     $('.date').datepicker({
         changeMonth: true,
         changeYear: true,
         maxDate: '0',
         dateFormat:'yy-mm-dd',
         altField: "#date_format",
         altFormat: js_date_format,
         yearRange: '1900:' + new Date().getFullYear(),
         beforeShow: function(input) {
             $(input).datepicker("widget").show();
         }
     });
     

     $("#tat-form").submit(function(e){
         e.preventDefault();
         var from_date = $('#from_date').val();
         var to_date = $('#to_date').val();
         var type_id = $('#type_id').val();
         var company_id = $('#aj_company').val();
         jQuery.get(base_url+"/get_expense_footer/?from_date="+from_date+"&to_date="+to_date+"&type_id="+type_id+"&company_id="+company_id, function(data, status){
             jQuery('#get_footer').html(data);
         });
         var tat_table2 = $('#tat_table').dataTable({
             "bDestroy": true,
             "ajax": {
                 url : site_url+"finance/report_expense_list/?from_date="+from_date+"&to_date="+to_date+"&type_id="+type_id+"&company_id="+company_id,
                 type : 'GET'
             },
             dom: 'lBfrtip',
             "buttons": [{
                 extend: 'csv',
                 exportOptions: {
                     columns: [ 1, 2, 3, 4]
                 }
             }, {
                 extend: 'excel',
                 exportOptions: {
                     columns: [ 1, 2, 3, 4]
                 }
             }, {
                 extend: 'pdfHtml5',
                 exportOptions: {
                     columns: [ 1, 2, 3, 4]
                 }
             },], 
             "fnDrawCallback": function(settings){
             $('[data-toggle="tooltip"]').tooltip();          
             }
         });
     });
 });