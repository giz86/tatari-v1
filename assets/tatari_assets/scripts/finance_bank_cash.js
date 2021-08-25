$(document).ready(function() {
    var tat_table = $('#tat_table').dataTable({
         "bDestroy": true,
         "ajax": {
             url : base_url+"/bank_cash_list/",
             type : 'GET'
         },
         "fnDrawCallback": function(settings){
         $('[data-toggle="tooltip"]').tooltip();          
         }
     });
     
     $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
     $('[data-plugin="select_tat"]').select2({ width:'100%' }); 
     
     $(".add-new-form").click(function(){
         $(".add-form").slideToggle('slow');
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
         var bankcash_id = button.data('bankcash_id');
         var modal = $(this);
     $.ajax({
         url : base_url+"/read/",
         type: "GET",
         data: 'jd=1&is_ajax=1&mode=modal&data=bankcash&bankcash_id='+bankcash_id,
         success: function (response) {
             if(response) {
                 $("#ajax_modal").html(response);
             }
         }
         });
     });
     

     $("#tat-form").submit(function(e){
     e.preventDefault();
         var obj = $(this), action = obj.attr('name');
         $('.save').prop('disabled', true);
         $('.icon-spinner3').show();
         $.ajax({
             type: "POST",
             url: e.target.action,
             data: obj.serialize()+"&is_ajax=1&add_type=bankcash&form="+action,
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
                     $('#tat-form')[0].reset(); 
                     $('.save').prop('disabled', false);
                 }
             }
         });
     });
 });

 $( document ).on( "click", ".delete", function() {
     $('input[name=_token]').val($(this).data('record-id'));
     $('#delete_record').attr('action',base_url+'/delete/'+$(this).data('record-id'));
 });