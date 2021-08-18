<?php $result = $this->Department_model->ajax_location_departments_information($location_id);?>
<?php $system = $this->Tat_model->read_setting_info(1);?>

<div class="form-group" id="ajx_department">
  <label for="designation"><?php echo $this->lang->line('left_department');?></label>
  <select class="select2" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_department');?>" name="department_id" id="aj_subdepartments" >
    <option value="0"><?php echo $this->lang->line('tat_acc_all');?></option>
    <?php foreach($result as $deparment) {?>
    <option value="<?php echo $deparment->department_id?>"><?php echo $deparment->department_name?></option>
    <?php } ?>
  </select>
</div>

<script type="text/javascript">
$(document).ready(function(){

jQuery("#aj_subdepartments").change(function(){
	jQuery.get(base_url+"/get_department_pdesignations/"+jQuery(this).val(), function(data, status){
		jQuery('#designation_ajax').html(data);
	});
});
$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });
});
</script>
<?php /*?><?php } ?><?php */?>