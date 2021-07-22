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
          <div class="col-xs-4">
            <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_phone_ext');?>" name="work_phone_extension" type="text" value="<?php echo $work_phone_extension;?>">
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
	/*Form Submit*/
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
			
	/* Update location info */
	$("#e_location_info").submit(function(e){
	/*Form Submit*/
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


<?php }
?>
