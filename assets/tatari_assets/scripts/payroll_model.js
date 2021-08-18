$(document).ready(function() {
    var tat_table = $('#tat_table').dataTable({
         "bDestroy": true,
         "ajax": {
             url : site_url+"payroll/model_list/",
             type : 'GET'
         },
         dom: 'lBfrtip',
         "buttons": ['csv', 'excel', 'pdf', 'print'],
         "fnDrawCallback": function(settings){
         $('[data-toggle="tooltip"]').tooltip();          
         }
     });
     
     $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
     $('[data-plugin="select_tat"]').select2({ width:'100%' }); 
         

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
     

     // Update Data
     $('.edit-modal-data').on('show.bs.modal', function (event) {
         var button = $(event.relatedTarget);
         var salary_model_id = button.data('salary_model_id');
         var modal = $(this);
     $.ajax({
         url : site_url+"payroll/model_read/",
         type: "GET",
         data: 'jd=1&is_ajax=1&mode=modal&data=payroll&salary_model_id='+salary_model_id,
         success: function (response) {
             if(response) {
                 $("#ajax_modal").html(response);
             }
         }
         });
     });
     

    //  Insert data 
     $("#tat-form").submit(function(e){
     e.preventDefault();
         var obj = $(this), action = obj.attr('name');
         $('.save').prop('disabled', true);
         $('.icon-spinner3').show();
         $.ajax({
             type: "POST",
             url: e.target.action,
             data: obj.serialize()+"&is_ajax=1&add_type=payroll&form="+action,
             cache: false,
             success: function (JSON) {
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
                     $('.add-form').removeClass('show');
                     $('#tat-form')[0].reset();
                     $('.save').prop('disabled', false);
                 }
             }
         });
     });
 });


 $( document ).on( "click", ".delete", function() {
     $('input[name=_token]').val($(this).data('record-id'));
     $('#delete_record').attr('action',site_url+'payroll/delete_model/'+$(this).data('record-id'))+'/';
 });


 $(document).on("keyup", function () {
     var sum_total = 0;
     var deduction = 0;
     var allowance = 0;
     var net_salary = 0;
     $(".salary").each(function () {
         sum_total += +$(this).val();
     });
     
     $(".deduction").each(function () {
         deduction += +$(this).val();
     });
     
     $(".allowance").each(function () {
         allowance += +$(this).val();
     });
     
     $("#total").val(sum_total);
     $("#total_deduction").val(deduction);
     $("#total_allowance").val(allowance);
     
     var net_salary = sum_total - deduction;
     $("#net_salary").val(net_salary);
 });
 