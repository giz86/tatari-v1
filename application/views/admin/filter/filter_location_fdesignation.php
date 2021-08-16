<?php $system = $this->Tat_model->read_setting_info(1);?>
<?php $result = $this->Designation_model->ajax_is_designation_information($department_id);?>

<div class="form-group" id="designation_ajaxflt">
  <label for="designation"><?php echo $this->lang->line('tat_designation');?></label>
  <select class="form-control" name="designation_id" id="filter_designation" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_designation');?>">
    <option value="0"><?php echo $this->lang->line('tat_acc_all');?></option>
    <?php foreach($result as $designation) {?>
    <option value="<?php echo $designation->designation_id?>"><?php echo $designation->designation_name?></option>
    <?php } ?>
  </select>
</div>
<script type="text/javascript">
$(document).ready(function(){	
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });
});
</script>