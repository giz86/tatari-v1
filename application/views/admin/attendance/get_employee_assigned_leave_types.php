<?php $session = $this->session->userdata('username');?>
<?php $user = $this->Tat_model->read_user_info($employee_id); ?>
<?php $leave_categories = explode(',',$user[0]->leave_categories);?>

<div class="form-group">
   <label for="employee"><?php echo $this->lang->line('tat_leave_type');?></label>
   <select class="form-control" id="leave_type" name="leave_type" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_leave_type');?>">
    <option value=""></option>
    <?php foreach($leave_categories as $leave_cat) {?>
    <?php if($leave_cat!=0):?>
    <?php
		$remaining_leave = $this->Attendance_model->employee_count_total_leaves($leave_cat,$employee_id);
		$type = $this->Attendance_model->read_leave_type_information($leave_cat);
		if(!is_null($type)){
			$type_name = $type[0]->type_name;
			$total = $type[0]->days_per_year;
			$leave_remaining_total = $total - $remaining_leave;	
	?>
    <option value="<?php echo $leave_cat;?>"> <?php echo $type_name.' ('.$leave_remaining_total.' '.$this->lang->line('tat_remaining').')';?></option>
    <?php }  endif;?>
    <?php } ?>
  </select>  
  <span id="remaining_leave" style="display:none; font-weight:600; color:#F00;">&nbsp;</span>           
</div>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	jQuery('[data-plugin="select_tat"]').select2({ width:'100%' });

});
</script>