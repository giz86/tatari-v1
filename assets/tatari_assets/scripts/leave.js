$(document).ready(function() {
    var tat_table = $('#tat_table').dataTable({
         "bDestroy": true,
         "ajax": {
             url : site_url+"attendance/leave_list/",
             type : 'GET'
         },
         "fnDrawCallback": function(settings){
         $('[data-toggle="tooltip"]').tooltip();          
         }
     });
         
     $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
     $('[data-plugin="select_tat"]').select2({ width:'100%' });
     jQuery("#aj_company").change(function(){
         jQuery.get(base_url+"/get_leave_employees/"+jQuery(this).val(), function(data, status){
             jQuery('#employee_ajax').html(data);
         });
     });

    //      Filter
     jQuery("#aj_companyf").change(function(){
         jQuery.get(site_url+"payroll/get_employees/"+jQuery(this).val(), function(data, status){
             jQuery('#employee_ajaxf').html(data);
         });
     });
     $('#remarks').trumbowyg();
     $("#ihr_report").submit(function(e){
        
         e.preventDefault();
              var tat_table2 = $('#tat_table').dataTable({
                 "bDestroy": true,
                 "ajax": {
                     url : site_url+"attendance/leave_list/?ihr=true&company_id="+$('#aj_companyf').val()+"&employee_id="+$('#employee_id').val()+"&status="+$('#status').val(),
                     type : 'GET'
                 },
                 "fnDrawCallback": function(settings){
                     $('[data-toggle="tooltip"]').tooltip();          
                 }
             });
             tat_table2.api().ajax.reload(function(){ }, true);
     });
     // Date Picker
     $('.date').datepicker({
       changeMonth: true,
       changeYear: true,
       dateFormat:'yy-mm-dd',
       yearRange: new Date().getFullYear() + ':' + (new Date().getFullYear() + 10),
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

        /* Insert Record */
        $("#tat-form").submit(function(e){
            var fd = new FormData(this);
            var obj = $(this), action = obj.attr('name');
            fd.append("is_ajax", 1);
            fd.append("add_type", 'leave');
            fd.append("form", action);
            e.preventDefault();
            $('.icon-spinner3').show();
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
                        $('.icon-spinner3').hide();
                        $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                        $('#tat-form')[0].reset(); 
                        $('.add-form').removeClass('in');
                        $('.select2-selection__rendered').html('--Select--');
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
     
     // Update
     $('.edit-modal-data').on('show.bs.modal', function (event) {
         var button = $(event.relatedTarget);
         var leave_id = button.data('leave_id');
         var modal = $(this);
     $.ajax({
         url : site_url+"attendance/read_leave_record/",
         type: "GET",
         data: 'jd=1&is_ajax=1&mode=modal&data=leave&leave_id='+leave_id,
         success: function (response) {
             if(response) {
                 $("#ajax_modal").html(response);
             }
         }
         });
     });
     
  

 $( document ).on( "click", ".delete", function() {
     $('input[name=_token]').val($(this).data('record-id'));
     $('#delete_record').attr('action',site_url+'attendance/delete_leave/'+$(this).data('record-id'));
 });