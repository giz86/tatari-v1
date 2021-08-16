<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['leave_id']) && $_GET['data']=='leave'){
?>

<?php $session = $this->session->userdata('username');?>
<?php $user_info = $this->Tat_model->read_user_info($session['user_id']);?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_edit_leave');?></h4>
</div>
<?php $attributes = array('name' => 'edit_leave', 'id' => 'edit_leave', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', '_token' => $leave_id, 'ext_name' => $leave_id);?>
<?php echo form_open('admin/attendance/edit_leave/'.$leave_id, $attributes, $hidden);?>
<?php $session = $this->session->userdata('username');?>
<?php $user = $this->Tat_model->read_employee_info($session['user_id']);?>

  <div class="modal-body">
    <div class="row">       
      <div class="col-md-12">
        <div class="form-group">
          <label for="description"><?php echo $this->lang->line('tat_remarks');?></label>
          <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('tat_remarks');?>" name="remarks" cols="30" rows="3"><?php echo $remarks;?></textarea>
        </div>
      </div>
    <div class="col-md-12">
        <div class="form-group">
          <label for="reason"><?php echo $this->lang->line('tat_leave_reason');?></label>
          <textarea class="form-control" placeholder="<?php echo $this->lang->line('tat_leave_reason');?>" name="reason" cols="30" rows="3" id="reason"><?php echo $reason;?></textarea>
        </div>
    </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('tat_close');?></button>
    <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('tat_update');?></button>
  </div>
<?php echo form_close(); ?>


<script type="text/javascript">
 $(document).ready(function(){
			
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });
	jQuery("#ajx_company").change(function(){
		jQuery.get(base_url+"/get_update_employees/"+jQuery(this).val(), function(data, status){
			jQuery('#employee_ajx').html(data);
		});
	});
	$('#remarks2').trumbowyg();	

	// Date
	$('.e_date').datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat:'yy-mm-dd',
	  yearRange: '1900:' + (new Date().getFullYear() + 15),
	});

	/* Edit*/
	$("#edit_leave").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=2&edit_type=leave&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					var tat_table = $('#tat_table').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/attendance/leave_list") ?>",
							type : 'GET'
						},
						dom: 'lBfrtip',
						"buttons": ['csv', 'excel', 'pdf', 'print'], // colvis > if needed
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>

<?php } else if(isset($_GET['jd']) && isset($_GET['leave_id']) && $_GET['data']=='view_leave'){
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_view');?> <?php echo $this->lang->line('left_leave');?></h4>
</div>
<form class="m-b-1">
  <div class="modal-body">
    <table class="footable-details table table-striped table-hover toggle-circle">
      <tbody>
        <tr>
          <th><?php echo $this->lang->line('module_company_title');?></th>
          <td style="display: table-cell;"><?php foreach($get_all_companies as $company) {?>
            <?php if($company_id==$company->company_id):?>
            <?php echo $company->name;?>
            <?php endif;?>
            <?php } ?></td>
        </tr>
        <?php $employee = $this->Tat_model->read_user_info($employee_id); ?>
			<?php if(!is_null($employee)):?><?php $eName = $employee[0]->first_name. ' '.$employee[0]->last_name;?>
			<?php else:?><?php $eName='';?><?php endif;?>
        <tr>
          <th><?php echo $this->lang->line('tat_employee');?></th>
          <td style="display: table-cell;"><?php echo $eName;?></td>
        </tr>    
        <tr>
          <th><?php echo $this->lang->line('tat_leave_type');?></th>
          <td style="display: table-cell;"><?php foreach($all_leave_types as $type) {?>
            <?php if($type->leave_type_id==$leave_type_id):?> <?php echo $type->type_name;?> <?php endif;?>
            <?php } ?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('tat_start_date');?></th>
          <td style="display: table-cell;"><?php echo $this->Tat_model->set_date_format($from_date);?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('tat_end_date');?></th>
          <td style="display: table-cell;"><?php echo $this->Tat_model->set_date_format($to_date);?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('tat_remarks');?></th>
          <td style="display: table-cell;"><?php echo html_entity_decode($remarks);?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('tat_leave_reason');?></th>
          <td style="display: table-cell;"><?php echo html_entity_decode($reason);?></td>
        </tr>
        <?php if($status=='1'):?> <?php $status_lv = $this->lang->line('tat_pending');?> <?php endif; ?>
        <?php if($status=='2'):?> <?php $status_lv = $this->lang->line('tat_approved');?> <?php endif; ?>
        <?php if($status=='3'):?> <?php $status_lv = $this->lang->line('tat_rejected');?> <?php endif; ?>
        <tr>
          <th><?php echo $this->lang->line('dashboard_tat_status');?></th>
          <td style="display: table-cell;"><?php echo $status_lv;?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('tat_close');?></button>
  </div>

<?php echo form_close(); ?>
<?php }?>
