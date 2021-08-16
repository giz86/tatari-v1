<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='emp_contact' && $_GET['type']=='emp_contact'){
?>

<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_e_details_edit_contact');?></h4>
</div>
<?php $attributes = array('name' => 'e_contact_info', 'id' => 'e_contact_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/e_contact_info', $attributes, $hidden);?>
<?php
$edata_usr1 = array(
	'type'  => 'hidden',
	'id'  => 'user_id',
	'name'  => 'user_id',
	'value' => $employee_id,
);
echo form_input($edata_usr1);
?>
<?php
$edata_usr2 = array(
	'type'  => 'hidden',
	'id'  => 'e_field_id',
	'name'  => 'e_field_id',
	'value' => $contact_id,
);
echo form_input($edata_usr2);
?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label for="relation"><?php echo $this->lang->line('tat_e_details_relation');?><i class="tatari-asterisk">*</i></label>
        <select class="form-control" name="relation" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_select_one');?>">
          <option value=""><?php echo $this->lang->line('tat_select_one');?></option>
          <option value="Self" <?php if($relation=='Self'){?> selected="selected" <?php }?>><?php echo $this->lang->line('tat_self');?></option>
          <option value="Parent" <?php if($relation=='Parent'){?> selected="selected" <?php }?>><?php echo $this->lang->line('tat_parent');?></option>
          <option value="Spouse" <?php if($relation=='Spouse'){?> selected="selected" <?php }?>><?php echo $this->lang->line('tat_spouse');?></option>
          <option value="Child" <?php if($relation=='Child'){?> selected="selected" <?php }?>><?php echo $this->lang->line('tat_child');?></option>
          <option value="Sibling" <?php if($relation=='Sibling'){?> selected="selected" <?php }?>><?php echo $this->lang->line('tat_sibling');?></option>
          <option value="In Laws" <?php if($relation=='In Laws'){?> selected="selected" <?php }?>><?php echo $this->lang->line('tat_in_laws');?></option>
        </select>
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group">
        <label for="work_email" class="control-label"><?php echo $this->lang->line('dashboard_email');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_work');?>" name="work_email" type="text" value="<?php echo $work_email;?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label class="display-inline-block custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="is_primary" value="1" name="is_primary" <?php if($is_primary=='1'){?> checked="checked" <?php }?>>
          <span class="custom-control-indicator"></span> <span class="custom-control-description"><?php echo $this->lang->line('tat_e_details_pcontact');?></span> </label>
        &nbsp;
        <label class="display-inline-block custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="is_dependent" value="2" name="is_dependent" <?php if($is_dependent=='2'){?> checked="checked"<?php }?>>
          <span class="custom-control-indicator"></span> <span class="custom-control-description"><?php echo $this->lang->line('tat_e_details_dependent');?></span> </label>
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group">
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_personal');?>" name="personal_email" type="text" value="<?php echo $personal_email;?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label for="name" class="control-label"><?php echo $this->lang->line('tat_name');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_name');?>" name="contact_name" type="text" value="<?php echo $contact_name;?>">
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group" id="designation_ajax">
        <label for="address_1" class="control-label"><?php echo $this->lang->line('tat_address');?></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_address_1');?>" name="address_1" type="text" value="<?php echo $address_1;?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label for="work_phone"><?php echo $this->lang->line('tat_phone');?><i class="tatari-asterisk">*</i></label>
        <div class="row">
          <div class="col-xs-8">
            <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_work');?>" name="work_phone" type="text" value="<?php echo $work_phone;?>">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group">
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_address_2');?>" name="address_2" type="text" value="<?php echo $address_2;?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_mobile');?>" name="mobile_phone" type="text" value="<?php echo $mobile_phone;?>">
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group">
        <div class="row">
          <div class="col-xs-5">
            <input class="form-control" placeholder="<?php echo $this->lang->line('tat_city');?>" name="city" type="text" value="<?php echo $city;?>">
          </div>
          <div class="col-xs-4">
            <input class="form-control" placeholder="<?php echo $this->lang->line('tat_state');?>" name="state" type="text" value="<?php echo $state;?>">
          </div>
          <div class="col-xs-3">
            <input class="form-control" placeholder="<?php echo $this->lang->line('tat_zipcode');?>" name="zipcode" type="text" value="<?php echo $zipcode;?>">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_home');?>" name="home_phone" type="text" value="<?php echo $home_phone;?>">
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group">
        <select name="country" id="select2-demo-6" class="form-control" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_country');?>">
          <option value=""></option>
          <?php foreach($all_countries as $country) {?>
          <option value="<?php echo $country->country_id;?>" <?php if($country->country_id==$icountry){?> selected="selected" <?php }?>> <?php echo $country->country_name;?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">
$(document).ready(function(){			
	
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });
			
	/* Update contact info */
	$("#e_contact_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=5&data=e_contact_info&type=e_contact_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					// On page load: table_contacts
					 var tat_table_contact = $('#tat_table_contact').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/contacts") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_contact.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>



<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='emp_location' && $_GET['type']=='emp_location'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_edit_location');?></h4>
</div>
<?php $attributes = array('name' => 'e_location_info', 'id' => 'e_location_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/e_location_info', $attributes, $hidden);?>
<?php
$edata_usr7 = array(
	'type'  => 'hidden',
	'id'  => 'user_id',
	'name'  => 'user_id',
	'value' => $employee_id,
);
echo form_input($edata_usr7);
?>
<?php
$edata_usr8 = array(
	'type'  => 'hidden',
	'id'  => 'e_field_id',
	'name'  => 'e_field_id',
	'value' => $office_location_id,
);
echo form_input($edata_usr8);
?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="from_date"><?php echo $this->lang->line('tat_e_details_frm_date');?></label>
        <input class="form-control es_date" readonly placeholder="<?php echo $this->lang->line('tat_e_details_frm_date');?>" name="from_date" type="text" value="<?php echo $from_date;?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="to_date" class="control-label"><?php echo $this->lang->line('tat_e_details_to_date');?></label>
        <input class="form-control es_date" readonly placeholder="<?php echo $this->lang->line('tat_e_details_to_date');?>" name="to_date" type="text" value="<?php echo $to_date;?>">
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">
$(document).ready(function(){			
	
	// Date
	$('.es_date').datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat:'yy-mm-dd',
	  yearRange: '1950:' + new Date().getFullYear()
	});
			
	
	$("#e_location_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=29&data=e_location_info&type=e_location_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					// On page load:
					var tat_table_location = $('#tat_table_location').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/location") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_location.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>


<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='emp_document' && $_GET['type']=='emp_document'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_e_details_edit_document');?></h4>
</div>
<?php $attributes = array('name' => 'e_document_info', 'id' => 'e_document_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_document_info' => 'UPDATE');?>
<?php echo form_open_multipart('admin/employees/e_document_info', $attributes, $hidden);?>
<?php
            $edata_usr3 = array(
              'type'  => 'hidden',
              'id'  => 'user_id',
              'name'  => 'user_id',
              'value' => $d_employee_id,
            );
            echo form_input($edata_usr3);
            ?>
            <?php
            $edata_usr4 = array(
              'type'  => 'hidden',
              'id'  => 'e_field_id',
              'name'  => 'e_field_id',
              'value' => $document_id,
            );
            echo form_input($edata_usr4);
            ?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="relation"><?php echo $this->lang->line('tat_e_details_dtype');?><i class="tatari-asterisk">*</i></label>
        <select name="document_type_id" id="document_type_id" class="form-control" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_e_details_choose_dtype');?>">
          <option value=""></option>
          <?php foreach($all_document_types as $document_type) {?>
          <option value="<?php echo $document_type->document_type_id;?>" <?php if($document_type->document_type_id==$document_type_id) {?> selected="selected" <?php } ?>> <?php echo $document_type->document_type;?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="date_of_expiry" class="control-label"><?php echo $this->lang->line('tat_e_details_doe');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control e_date" readonly placeholder="<?php echo $this->lang->line('tat_e_details_doe');?>" name="date_of_expiry" type="text" value="<?php echo $date_of_expiry;?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="title" class="control-label"><?php echo $this->lang->line('tat_e_details_dtitle');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_dtitle');?>" name="title" type="text" value="<?php echo $title;?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="description" class="control-label"><?php echo $this->lang->line('tat_description');?></label>
        <textarea class="form-control" placeholder="<?php echo $this->lang->line('tat_description');?>" data-show-counter="1" data-limit="300" name="description" cols="30" rows="3" id="d_description"><?php echo $description;?></textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <fieldset class="form-group">
          <label for="logo"><?php echo $this->lang->line('tat_e_details_document_file');?></label>
          <input type="file" class="form-control-file" id="document_file" name="document_file">
          <small><?php echo $this->lang->line('tat_e_details_d_type_file');?></small>
          <?php if($document_file!='' && $document_file!='no file') {?>
          <br />
          <a href="<?php echo site_url('admin/download/');?>?type=document&filename=<?php echo $document_file;?>"><?php echo $document_file;?></a>
          <?php } ?>
        </fieldset>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">
$(document).ready(function(){			
	
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });

	$('.e_date').datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat:'yy-mm-dd',
	  yearRange: '1900:' + (new Date().getFullYear() + 10),
	});
			
	/* Edit document */
	$("#e_document_info").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 9);
		fd.append("type", 'e_document_info');
		fd.append("data", 'e_document_info');
		fd.append("form", action);
		e.preventDefault();
		$('.save').prop('disabled', true);
		$.ajax({
			url: e.target.action,
			type: "POST",
			data:  fd,
			contentType: false,
			cache: false,
			processData:false,
			success: function(JSON)
			{
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					// On page load: table_contacts
					var tat_table_document = $('#tat_table_document').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/documents") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_document.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			},
			error: function() 
			{
				toastr.error(JSON.error);
				$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
				$('.save').prop('disabled', false);
			} 	        
	   });
	});
});	
</script>


<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='emp_qualification' && $_GET['type']=='emp_qualification'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_e_details_edit_qualification');?></h4>
</div>
<?php $attributes = array('name' => 'e_qualification_info', 'id' => 'e_qualification_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/e_qualification_info', $attributes, $hidden);?>
<?php
$edata_usr7 = array(
	'type'  => 'hidden',
	'id'  => 'user_id',
	'name'  => 'user_id',
	'value' => $employee_id,
);
echo form_input($edata_usr7);
?>
<?php
$edata_usr8 = array(
	'type'  => 'hidden',
	'id'  => 'e_field_id',
	'name'  => 'e_field_id',
	'value' => $qualification_id,
);
echo form_input($edata_usr8);
?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name"><?php echo $this->lang->line('tat_e_details_inst_name');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_inst_name');?>" name="name" type="text" value="<?php echo $name;?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="education_level" class="control-label"><?php echo $this->lang->line('tat_e_details_edu_level');?></label>
        <select class="form-control" name="education_level" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_e_details_edu_level');?>">
          <?php foreach($all_education_level as $education_level) {?>
          <option value="<?php echo $education_level->education_level_id;?>" <?php if($education_level->education_level_id==$education_level_id) {?> selected="selected" <?php } ?>> <?php echo $education_level->name;?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="from_year" class="control-label"><?php echo $this->lang->line('tat_e_details_timeperiod');?><i class="tatari-asterisk">*</i></label>
        <div class="row">
          <div class="col-md-6">
            <input class="form-control edate" readonly="readonly" value="<?php echo $from_year;?>" placeholder="<?php echo $this->lang->line('tat_e_details_from');?>" name="from_year" type="text">
          </div>
          <div class="col-md-6">
            <input class="form-control edate" readonly="readonly" value="<?php echo $to_year;?>" placeholder="<?php echo $this->lang->line('dashboard_to');?>" name="to_year" type="text">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="language" class="control-label"><?php echo $this->lang->line('tat_e_details_language');?></label>
        <select class="form-control" name="language" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_e_details_language');?>">
          <?php foreach($all_qualification_language as $qualification_language) {?>
          <option value="<?php echo $qualification_language->language_id;?>" <?php if($qualification_language->language_id==$language_id) {?> selected="selected" <?php } ?>> <?php echo $qualification_language->name;?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="skill" class="control-label"><?php echo $this->lang->line('tat_e_details_skill');?></label>
        <select class="form-control" name="skill" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_e_details_skill');?>">
          <?php foreach($all_qualification_skill as $qualification_skill) {?>
          <option value="<?php echo $qualification_skill->skill_id?>" <?php if($qualification_skill->skill_id==$skill_id) {?> selected="selected" <?php } ?>><?php echo $qualification_skill->name?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="to_year" class="control-label"><?php echo $this->lang->line('tat_description');?></label>
        <textarea class="form-control" placeholder="<?php echo $this->lang->line('tat_description');?>" data-show-counter="1" data-limit="300" name="description" cols="30" rows="3" id="d_description"><?php echo $description;?></textarea>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">
$(document).ready(function(){			
	
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });
	
	$('.edate').datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat:'yy-mm-dd',
	yearRange: '1900:' + (new Date().getFullYear() + 15),
	beforeShow: function(input) {
		$(input).datepicker("widget").show();
	}
	});
			
	/* Edit Qualification */
          $("#e_qualification_info").submit(function(e){

          e.preventDefault();
            var obj = $(this), action = obj.attr('name');
            $('.save').prop('disabled', true);
            $.ajax({
              type: "POST",
              url: e.target.action,
              data: obj.serialize()+"&is_ajax=11&data=e_qualification_info&type=e_qualification_info&form="+action,
              cache: false,
              success: function (JSON) {
                if (JSON.error != '') {
                  toastr.error(JSON.error);
                  $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                  $('.save').prop('disabled', false);
                } else {
                  $('.edit-modal-data').modal('toggle');
                  // On page load: table_contacts
                  var tat_table_qualification = $('#tat_table_qualification').dataTable({
                    "bDestroy": true,
                    "ajax": {
                      url : "<?php echo site_url("admin/employees/qualification") ?>/"+$('#user_id').val(),
                      type : 'GET'
                    },
                    "fnDrawCallback": function(settings){
                    $('[data-toggle="tooltip"]').tooltip();          
                    }
                  });
                  tat_table_qualification.api().ajax.reload(function(){ 
                    toastr.success(JSON.result);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                  }, true);
                  $('.save').prop('disabled', false);
                }
              }
            });
          });
        });	
</script>


<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='emp_work_experience' && $_GET['type']=='emp_work_experience'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_e_details_edit_wexp');?></h4>
</div>
<?php $attributes = array('name' => 'e_work_experience_info', 'id' => 'e_work_experience_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/e_work_experience_info', $attributes, $hidden);?>
<?php
          $edata_usr7 = array(
            'type'  => 'hidden',
            'id'  => 'user_id',
            'name'  => 'user_id',
            'value' => $employee_id,
          );
          echo form_input($edata_usr7);
          ?>
          <?php
          $edata_usr8 = array(
            'type'  => 'hidden',
            'id'  => 'e_field_id',
            'name'  => 'e_field_id',
            'value' => $work_experience_id,
          );
          echo form_input($edata_usr8);
?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="company_name"><?php echo $this->lang->line('tat_company_name');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_company_name');?>" name="company_name" type="text" value="<?php echo $company_name;?>" id="company_name">
      </div>
      <div class="form-group">
        <label for="from_date"><?php echo $this->lang->line('tat_e_details_frm_date');?><i class="tatari-asterisk">*</i></label>
        <input type="text" class="form-control edate" id="e_from_date" name="from_date" placeholder="<?php echo $this->lang->line('tat_e_details_frm_date');?>" readonly value="<?php echo $from_date;?>">
      </div>
      <div class="form-group">
        <label for="to_date"><?php echo $this->lang->line('tat_e_details_to_date');?><i class="tatari-asterisk">*</i></label>
        <input type="text" class="form-control edate" id="e_to_date" name="to_date" placeholder="<?php echo $this->lang->line('tat_e_details_to_date');?>" readonly value="<?php echo $to_date;?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="post"><?php echo $this->lang->line('tat_e_details_post');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_post');?>" name="post" type="text" value="<?php echo $post;?>" id="post">
      </div>
      <div class="form-group">
        <label for="description"><?php echo $this->lang->line('tat_description');?></label>
        <textarea class="form-control" placeholder="<?php echo $this->lang->line('tat_description');?>" data-show-counter="1" data-limit="300" name="description" cols="30" rows="4" id="description"><?php echo $description;?></textarea>
        <span class="countdown"></span> </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">
        $(document).ready(function(){			
          
          $('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
          $('[data-plugin="select_tat"]').select2({ width:'100%' });
          
          $('.edate').datepicker({
          changeMonth: true,
          changeYear: true,
          dateFormat:'yy-mm-dd',
          yearRange: '1900:' + (new Date().getFullYear() + 15),
          beforeShow: function(input) {
            $(input).datepicker("widget").show();
          }
          });
              
          
          $("#e_work_experience_info").submit(function(e){
          
          e.preventDefault();
            var obj = $(this), action = obj.attr('name');
            $('.save').prop('disabled', true);
            $.ajax({
              type: "POST",
              url: e.target.action,
              data: obj.serialize()+"&is_ajax=14&data=e_work_experience_info&type=e_work_experience_info&form="+action,
              cache: false,
              success: function (JSON) {
                if (JSON.error != '') {
                  toastr.error(JSON.error);
                  $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                  $('.save').prop('disabled', false);
                } else {
                  $('.edit-modal-data').modal('toggle');
                  
                  var tat_table_work_experience = $('#tat_table_work_experience').dataTable({
                    "bDestroy": true,
                    "ajax": {
                      url : "<?php echo site_url("admin/employees/experience") ?>/"+$('#user_id').val(),
                      type : 'GET'
                    },
                    "fnDrawCallback": function(settings){
                    $('[data-toggle="tooltip"]').tooltip();          
                    }
                  });
                  tat_table_work_experience.api().ajax.reload(function(){ 
                    toastr.success(JSON.result);
                    $('input[name="csrf_tatari"]').val(JSON.csrf_hash);
                  }, true);
                  $('.save').prop('disabled', false);
                }
              }
            });
          });
        });	
</script>


<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='emp_bank_account' && $_GET['type']=='emp_bank_account'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_e_details_edit_baccount');?></h4>
</div>
<?php $attributes = array('name' => 'e_bank_account_info', 'id' => 'e_bank_account_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/e_bank_account_info', $attributes, $hidden);?>
<?php
        $edata_usr7 = array(
          'type'  => 'hidden',
          'id'  => 'user_id',
          'name'  => 'user_id',
          'value' => $employee_id,
        );
        echo form_input($edata_usr7);
        ?>
        <?php
        $edata_usr8 = array(
          'type'  => 'hidden',
          'id'  => 'e_field_id',
          'name'  => 'e_field_id',
          'value' => $bankaccount_id,
        );
        echo form_input($edata_usr8);
?>
<div class="modal-body">
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="account_title"><?php echo $this->lang->line('tat_e_details_acc_title');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_acc_title');?>" name="account_title" type="text" value="<?php echo $account_title;?>" id="account_name">
      </div>
      <div class="form-group">
        <label for="account_number"><?php echo $this->lang->line('tat_e_details_acc_number');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_acc_number');?>" name="account_number" type="text" value="<?php echo $account_number;?>" id="account_number">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="bank_name"><?php echo $this->lang->line('tat_e_details_bank_name');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_bank_name');?>" name="bank_name" type="text" value="<?php echo $bank_name;?>" id="bank_name">
      </div>
      <div class="form-group">
        <label for="bank_code"><?php echo $this->lang->line('tat_e_details_bank_code');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_bank_code');?>" name="bank_code" type="text" value="<?php echo $bank_code;?>" id="bank_code">
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        <label for="bank_branch"><?php echo $this->lang->line('tat_e_details_bank_branch');?></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_bank_branch');?>" name="bank_branch" type="text" value="<?php echo $bank_branch;?>" id="bank_branch">
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">
$(document).ready(function(){			
			
	/* Edit bank acount info */
	$("#e_bank_account_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=17&data=e_bank_account_info&type=e_bank_account_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					// On page load:
					var tat_table_bank_account = $('#tat_table_bank_account').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/bank_account") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_bank_account.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>

<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='emp_leave' && $_GET['type']=='emp_leave'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_e_details_edit_leave');?></h4>
</div>
<?php $attributes = array('name' => 'e_leave_info', 'id' => 'e_leave_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/e_leave_info', $attributes, $hidden);?>

<?php
        $edata_usr7 = array(
          'type'  => 'hidden',
          'id'  => 'user_id',
          'name'  => 'user_id',
          'value' => $employee_id,
        );
        echo form_input($edata_usr7);
        ?>
        <?php
        $edata_usr8 = array(
          'type'  => 'hidden',
          'id'  => 'e_field_id',
          'name'  => 'e_field_id',
          'value' => $leave_id,
        );
        echo form_input($edata_usr8);
?>

<div class="modal-body">
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label for="casual_leave" class="control-label"><?php echo $this->lang->line('tat_e_details_casual_leave');?></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_casual_leave');?>" name="casual_leave" type="text" value="<?php echo $casual_leave;?>">
      </div>
    </div>
    <div class="col-md-7">
      <div class="form-group">
        <label for="medical_leave" class="control-label"><?php echo $this->lang->line('tat_e_details_medical_leave');?></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_medical_leave');?>" name="medical_leave" type="text" value="<?php echo $medical_leave;?>">
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">
$(document).ready(function(){			
	
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });	
			
	/* Edit Leave Info */
	$("#e_leave_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=23&data=e_leave_info&type=e_leave_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					
					var tat_table_leave = $('#tat_table_leave').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/leave") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_leave.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>


<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='emp_shift' && $_GET['type']=='emp_shift'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_e_details_edit_shift');?></h4>
</div>
<?php $attributes = array('name' => 'e_shift_info', 'id' => 'e_shift_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/e_shift_info', $attributes, $hidden);?>
<?php
        $edata_usr7 = array(
          'type'  => 'hidden',
          'id'  => 'user_id',
          'name'  => 'user_id',
          'value' => $employee_id,
        );
        echo form_input($edata_usr7);
        ?>
        <?php
        $edata_usr8 = array(
          'type'  => 'hidden',
          'id'  => 'e_field_id',
          'name'  => 'e_field_id',
          'value' => $emp_shift_id,
        );
        echo form_input($edata_usr8);
?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="from_date"><?php echo $this->lang->line('tat_e_details_frm_date');?></label>
        <input class="form-control es_date" readonly placeholder="<?php echo $this->lang->line('tat_e_details_frm_date');?>" name="from_date" type="text" value="<?php echo $from_date;?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="to_date" class="control-label"><?php echo $this->lang->line('tat_e_details_to_date');?></label>
        <input class="form-control es_date" readonly placeholder="<?php echo $this->lang->line('tat_e_details_to_date');?>" name="to_date" type="text" value="<?php echo $to_date;?>">
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">
$(document).ready(function(){			
	
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });

	$('.es_date').datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat:'yy-mm-dd',
	  yearRange: '1950:' + new Date().getFullYear()
	});
			
	/* Edit Leave */
	$("#e_shift_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=26&data=e_shift_info&type=e_shift_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					// On page load:
					var tat_table_shift = $('#tat_table_shift').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/shift") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_shift.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>


<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='e_salary_allowance' && $_GET['type']=='e_salary_allowance'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_employee_edit_allowance');?></h4>
</div>
<?php $attributes = array('name' => 'e_allowance_info', 'id' => 'e_allowance_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/update_allowance_info', $attributes, $hidden);?>
<?php
        $edata_usr7 = array(
          'type'  => 'hidden',
          'id'  => 'user_id',
          'name'  => 'user_id',
          'value' => $employee_id,
        );
        echo form_input($edata_usr7);
        ?>
        <?php
        $edata_usr8 = array(
          'type'  => 'hidden',
          'id'  => 'e_field_id',
          'name'  => 'e_field_id',
          'value' => $allowance_id,
        );
        echo form_input($edata_usr8);
?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="is_allowance_taxable"><?php echo $this->lang->line('tat_salary_allowance_options');?><i class="tatari-asterisk">*</i></label>
        <select name="is_allowance_taxable" id="is_allowance_taxable" class="form-control" data-plugin="select_tat">
          <option value="0" <?php if($is_allowance_taxable==0):?> selected="selected" <?php endif;?>><?php echo $this->lang->line('tat_salary_allowance_non_taxable');?></option>
          <option value="1" <?php if($is_allowance_taxable==1):?> selected="selected" <?php endif;?>><?php echo $this->lang->line('tat_salary_allowance_taxable');?></option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="allowance_title"><?php echo $this->lang->line('dashboard_tat_title');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_tat_title');?>" name="allowance_title" type="text" value="<?php echo $allowance_title;?>">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="allowance_amount" class="control-label"><?php echo $this->lang->line('tat_amount');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_amount');?>" name="allowance_amount" type="text" value="<?php echo $allowance_amount;?>">
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">

$(document).ready(function(){			
			
	
	$("#e_allowance_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=29&data=e_allowance_info&type=e_allowance_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					
					var tat_table_all_allowances = $('#tat_table_all_allowances').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/salary_all_allowances") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_all_allowances.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>

<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='e_salary_loan' && $_GET['type']=='e_salary_loan'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_employee_edit_loan_title');?></h4>
</div>
<?php $attributes = array('name' => 'e_salary_loan_info', 'id' => 'e_salary_loan_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/update_loan_info', $attributes, $hidden);?>
<?php
        $edata_usr7 = array(
          'type'  => 'hidden',
          'id'  => 'user_id',
          'name'  => 'user_id',
          'value' => $employee_id,
        );
        echo form_input($edata_usr7);
        ?>
        <?php
        $edata_usr8 = array(
          'type'  => 'hidden',
          'id'  => 'e_field_id',
          'name'  => 'e_field_id',
          'value' => $loan_deduction_id,
        );
        echo form_input($edata_usr8);
?>
<div class="modal-body">
  <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                <label for="loan_options"><?php echo $this->lang->line('tat_salary_loan_options');?><i class="tatari-asterisk">*</i></label>
                <select name="loan_options" id="loan_options" class="form-control" data-plugin="select_tat">
                  <option value="1"<?php if($loan_options==1):?> selected="selected" <?php endif;?>><?php echo $this->lang->line('tat_loan_ssc_title');?></option>
                  <option value="2"<?php if($loan_options==2):?> selected="selected" <?php endif;?>><?php echo $this->lang->line('tat_loan_hdmf_title');?></option>
                  <option value="0"<?php if($loan_options==0):?> selected="selected" <?php endif;?>><?php echo $this->lang->line('tat_loan_other_sd_title');?></option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
               <label for="month_year"><?php echo $this->lang->line('dashboard_tat_title');?><i class="tatari-asterisk">*</i></label>
              <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_tat_title');?>" name="loan_deduction_title" type="text" value="<?php echo $loan_deduction_title;?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="edu_role"><?php echo $this->lang->line('tat_employee_monthly_installment_title');?><i class="tatari-asterisk">*</i></label>
              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_monthly_installment_title');?>" name="monthly_installment" type="text" id="m_monthly_installment" value="<?php echo $monthly_installment;?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
               <label for="month_year"><?php echo $this->lang->line('tat_start_date');?><i class="tatari-asterisk">*</i></label>
              <input class="form-control d_month_year" placeholder="<?php echo $this->lang->line('tat_start_date');?>" readonly="readonly" name="start_date" type="text" value="<?php echo $start_date;?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="end_date"><?php echo $this->lang->line('tat_end_date');?><i class="tatari-asterisk">*</i></label>
              <input class="form-control d_month_year" readonly="readonly" placeholder="<?php echo $this->lang->line('tat_end_date');?>" name="end_date" type="text" value="<?php echo $end_date;?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="description"><?php echo $this->lang->line('tat_reason');?></label>
              <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('tat_reason');?>" name="reason" cols="30" rows="2" id="reason2"><?php echo $reason;?></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">

$(document).ready(function(){		
	$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_tat"]').select2({ width:'100%' });

	// Month & Year
	$('.d_month_year').datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat:'yy-mm-dd',
	  yearRange: '1990:' + (new Date().getFullYear() + 10),
	});	
				
	
	$("#e_salary_loan_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=29&data=loan_info&type=loan_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					
					var tat_table_all_deductions = $('#tat_table_all_deductions').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/salary_all_deductions").'/'.$employee_id; ?>/",
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_all_deductions.api().ajax.reload(function(){ 
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


<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='emp_overtime_info' && $_GET['type']=='emp_overtime_info'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_employee_edit_allowance');?></h4>
</div>
<?php $attributes = array('name' => 'e_overtime_info', 'id' => 'e_overtime_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/update_overtime_info', $attributes, $hidden);?>
<?php
        $edata_usr7 = array(
          'type'  => 'hidden',
          'id'  => 'user_id',
          'name'  => 'user_id',
          'value' => $employee_id,
        );
        echo form_input($edata_usr7);
        ?>
        <?php
        $edata_usr8 = array(
          'type'  => 'hidden',
          'id'  => 'e_field_id',
          'name'  => 'e_field_id',
          'value' => $salary_overtime_id,
        );
        echo form_input($edata_usr8);
?>
<div class="modal-body">
  <div class="row">   
            <div class="col-md-3">
              <div class="form-group">
                <label for="overtime_type"><?php echo $this->lang->line('tat_employee_overtime_title');?><i class="tatari-asterisk">*</i></label>
                <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_overtime_title');?>" name="overtime_type" type="text" value="<?php echo $overtime_type;?>" id="overtime_type">
              </div>
            </div>
            <div class="col-md-3">  
              <div class="form-group">
                <label for="no_of_days"><?php echo $this->lang->line('tat_employee_overtime_no_of_days');?><i class="tatari-asterisk">*</i></label>
                <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_overtime_no_of_days');?>" name="no_of_days" type="text" value="<?php echo $no_of_days;?>" id="no_of_days">
              </div>
            </div>
            <div class="col-md-3">  
              <div class="form-group">
                <label for="overtime_hours"><?php echo $this->lang->line('tat_employee_overtime_hour');?><i class="tatari-asterisk">*</i></label>
                <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_overtime_hour');?>" name="overtime_hours" type="text" value="<?php echo $overtime_hours;?>" id="overtime_hours">
              </div>
            </div>
            <div class="col-md-3">  
              <div class="form-group">
                <label for="overtime_rate"><?php echo $this->lang->line('tat_employee_overtime_rate');?><i class="tatari-asterisk">*</i></label>
                <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_overtime_rate');?>" name="overtime_rate" type="text" value="<?php echo $overtime_rate;?>" id="overtime_rate">
              </div>
            </div>
           </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">

$(document).ready(function(){			

	$("#e_overtime_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=29&data=e_overtime_info&type=e_overtime_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					
					var tat_table_emp_overtime = $('#tat_table_emp_overtime').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/salary_overtime") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_emp_overtime.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>


<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='salary_commissions_info' && $_GET['type']=='salary_commissions_info'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_employee_edit_allowance');?></h4>
</div>
<?php $attributes = array('name' => 'e_salary_commissions_info', 'id' => 'e_salary_commissions_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/update_commissions_info', $attributes, $hidden);?>
<?php
      $edata_usr7 = array(
        'type'  => 'hidden',
        'id'  => 'user_id',
        'name'  => 'user_id',
        'value' => $employee_id,
      );
      echo form_input($edata_usr7);
      ?>
      <?php
      $edata_usr8 = array(
        'type'  => 'hidden',
        'id'  => 'e_field_id',
        'name'  => 'e_field_id',
        'value' => $salary_commissions_id,
      );
      echo form_input($edata_usr8);
?>

<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="title"><?php echo $this->lang->line('dashboard_tat_title');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_tat_title');?>" name="title" type="text" value="<?php echo $commission_title;?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="amount" class="control-label"><?php echo $this->lang->line('tat_amount');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_amount');?>" name="amount" type="text" value="<?php echo $commission_amount;?>">
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">

$(document).ready(function(){		
	
	$("#e_salary_commissions_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=29&data=e_salary_commissions_info&type=e_salary_commissions_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
				
					var tat_table_all_commissions = $('#tat_table_all_commissions').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/salary_all_commissions") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_all_commissions.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>


<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='salary_statutory_deductions_info' && $_GET['type']=='salary_statutory_deductions_info'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_employee_edit_allowance');?></h4>
</div>
<?php $attributes = array('name' => 'e_salary_statutory_deductions_info', 'id' => 'e_salary_statutory_deductions_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/update_statutory_deductions_info', $attributes, $hidden);?>
<?php
      $edata_usr7 = array(
        'type'  => 'hidden',
        'id'  => 'user_id',
        'name'  => 'user_id',
        'value' => $employee_id,
      );
      echo form_input($edata_usr7);
      ?>
      <?php
      $edata_usr8 = array(
        'type'  => 'hidden',
        'id'  => 'e_field_id',
        'name'  => 'e_field_id',
        'value' => $statutory_deductions_id,
      );
      echo form_input($edata_usr8);
?>
<?php $system = $this->Tat_model->read_setting_info(1);?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="statutory_options"><?php echo $this->lang->line('tat_salary_sd_options');?><i class="tatari-asterisk">*</i></label>
        <select name="statutory_options" id="statutory_options" class="form-control" data-plugin="select_tat">
          <option value="1" <?php if($statutory_options==1):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('tat_sd_ssc_title');?></option>
          <option value="2" <?php if($statutory_options==2):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('tat_sd_phic_title');?></option>
          <option value="3" <?php if($statutory_options==3):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('tat_sd_hdmf_title');?></option>
          <option value="4" <?php if($statutory_options==4):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('tat_sd_wht_title');?></option>
          <option value="0" <?php if($statutory_options==0):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('tat_sd_other_sd_title');?></option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="title"><?php echo $this->lang->line('dashboard_tat_title');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_tat_title');?>" name="title" type="text" value="<?php echo $deduction_title;?>">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="amount" class="control-label"><?php echo $this->lang->line('tat_amount');?> <?php if($system[0]->statutory_fixed!='yes'):?> (%) <?php endif;?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_amount');?>" name="amount" type="text" value="<?php echo $deduction_amount;?>">
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 
<script type="text/javascript">

$(document).ready(function(){			
	
	$("#e_salary_statutory_deductions_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=29&data=e_salary_statutory_deductions_info&type=e_salary_statutory_deductions_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					
					var tat_table_all_statutory_deductions = $('#tat_table_all_statutory_deductions').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/salary_all_statutory_deductions") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_all_statutory_deductions.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>


<?php } else if(isset($_GET['jd']) && isset($_GET['field_id']) && $_GET['data']=='salary_other_payments_info' && $_GET['type']=='salary_other_payments_info'){
?>
<div class="modal-header"> <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_edit').' '.$this->lang->line('tat_employee_set_other_payment');?></h4>
</div>
<?php $attributes = array('name' => 'e_salary_other_payments_info', 'id' => 'e_salary_other_payments_info', 'autocomplete' => 'off');?>
<?php $hidden = array('u_basic_info' => 'UPDATE');?>
<?php echo form_open('admin/employees/update_other_payment_info', $attributes, $hidden);?>
<?php
        $edata_usr7 = array(
          'type'  => 'hidden',
          'id'  => 'user_id',
          'name'  => 'user_id',
          'value' => $employee_id,
        );
        echo form_input($edata_usr7);
        ?>
        <?php
        $edata_usr8 = array(
          'type'  => 'hidden',
          'id'  => 'e_field_id',
          'name'  => 'e_field_id',
          'value' => $other_payments_id,
        );
        echo form_input($edata_usr8);
        ?>

<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="title"><?php echo $this->lang->line('dashboard_tat_title');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_tat_title');?>" name="title" type="text" value="<?php echo $payments_title;?>">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="amount" class="control-label"><?php echo $this->lang->line('tat_amount');?><i class="tatari-asterisk">*</i></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('tat_amount');?>" name="amount" type="text" value="<?php echo $payments_amount;?>">
      </div>
    </div>
  </div>
</div>
<div class="modal-footer"> <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> </div>
<?php echo form_close(); ?> 

<script type="text/javascript">
$(document).ready(function(){			
			

	$("#e_salary_other_payments_info").submit(function(e){

	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=29&data=e_salary_other_payments_info&type=e_salary_other_payments_info&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.edit-modal-data').modal('toggle');
					// On page load:
					var tat_table_all_other_payments = $('#tat_table_all_other_payments').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/employees/salary_all_other_payments") ?>/"+$('#user_id').val(),
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					tat_table_all_other_payments.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
					}, true);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>

<?php }
?>
