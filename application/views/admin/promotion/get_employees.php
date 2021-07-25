<?php $result = $this->Department_model->ajax_company_employee_info($company_id);?>
<div class="form-group">
  <label for="tat_department_head"><?php echo $this->lang->line('tat_promotion_for');?></label>
   <select name="employee_id" id="employee_id" class="form-control" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_choose_an_employee');?>">
    <option value=""></option>
    <?php foreach($result as $employee) {?>
    <option value="<?php echo $employee->user_id;?>"> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
    <?php } ?>
  </select>             
</div>
<?php
//}
?>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });
	jQuery("#employee_id").change(function(){
		jQuery.get(base_url+"/get_employee_designations/"+jQuery(this).val(), function(data, status){
			jQuery('#ajx_designation').html(data);
		});
	});
});
</script>