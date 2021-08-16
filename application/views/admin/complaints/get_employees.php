<?php $result = $this->Department_model->ajax_company_employee_info($company_id);?>
<?php $role_resources_ids = $this->Tat_model->user_role_resource(); ?>
<?php $session = $this->session->userdata('username');?>
<?php $user_info = $this->Tat_model->read_user_info($session['user_id']);?>
<?php if($user_info[0]->user_role_id==1){ ?>
<div class="form-group">
  <label for="tat_department_head"><?php echo $this->lang->line('tat_complaint_from');?></label>
   <select name="employee_id" id="select2-demo-6" class="form-control" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_choose_an_employee');?>">
    <option value=""></option>
    <?php foreach($result as $employee) {?>
    <option value="<?php echo $employee->user_id;?>"> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
    <?php } ?>
  </select>             
</div>
<?php } else { ?>
<div class="form-group">
  <label for="tat_department_head"><?php echo $this->lang->line('tat_complaint_from');?></label>
   <select name="employee_id" id="select2-demo-6" class="form-control" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_choose_an_employee');?>">
    <option value=""></option>
    <?php foreach($result as $employee) {?>
		<?php if($session['user_id'] == $employee->user_id):?>
        	<option value="<?php echo $employee->user_id;?>"> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
        <?php endif;?>
    <?php } ?>
  </select>             
</div>
<?php } ?>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });
});
</script>