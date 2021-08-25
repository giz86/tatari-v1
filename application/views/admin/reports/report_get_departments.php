<?php $result = $this->Company_model->ajax_company_departments_info($company_id);?>

<div class="form-group">
  <label for="designation"><?php echo $this->lang->line('tat_department');?></label>
  <select class="select2" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_select_department');?>" name="department_id" id="aj_department" >
    <option value="0"><?php echo $this->lang->line('tat_acc_all');?></option>
    <?php foreach($result as $deparment) {?>
    <option value="<?php echo $deparment->department_id?>"><?php echo $deparment->department_name?></option>
    <?php } ?>
  </select>
</div>

<script type="text/javascript">
$(document).ready(function(){

jQuery("#aj_department").change(function(){
	jQuery.get(base_url+"/designation/"+jQuery(this).val(), function(data, status){
		jQuery('#designation_ajax').html(data);
	});
});
$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });
});
</script>