<?php $result = $this->Company_model->ajax_company_departments_info($company_id);?>

<div class="form-group">
  <label for="designation"><?php echo $this->lang->line('tat_transfer_to_department');?></label>
  <select class="select2" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_select_department');?>" name="transfer_department">
    <option value=""></option>
    <?php foreach($result as $deparment) {?>
    <option value="<?php echo $deparment->department_id?>"><?php echo $deparment->department_name?></option>
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