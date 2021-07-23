<?php $result = $this->Designation_model->ajax_designation_information($department_id);?>
<?php
?>

<div class="form-group" id="designation_ajxx">
  <label for="designation"><?php echo $this->lang->line('tat_top_designation_level');?></label>
  <select class="form-control" name="top_designation_id" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_top_designation_level');?>">
    <option value="0"><?php echo $this->lang->line('tat_no');?></option>
    <?php foreach($result as $designation) {?>
    <option value="<?php echo $designation->designation_id?>"><?php echo $designation->designation_name?></option>
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
});
</script>