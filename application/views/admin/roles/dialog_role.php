<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['role_id']) && $_GET['data']=='role'){
$role_resources_ids = explode(',',$role_resources);
?>

<div class="modal-header">
  <?php echo form_button(array('aria-label' => 'Close', 'data-dismiss' => 'modal', 'type' => 'button', 'class' => 'close', 'content' => '<span aria-hidden="true">×</span>')); ?>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('tat_role_editrole');?></h4>
</div>

<?php $attributes = array('name' => 'edit_role', 'id' => 'edit_role', 'autocomplete' => 'off','class' => '"m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', 'ext_name' => $role_name, '_token' => $role_id);?>
<?php echo form_open('admin/roles/update/'.$role_id, $attributes, $hidden);?>

  <div class="modal-body">
    <div class="row">
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="role_name"><?php echo $this->lang->line('tat_role_name');?><i class="tatari-asterisk">*</i></label>
              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_role_name');?>" name="role_name" type="text" value="<?php echo $role_name;?>">
            </div>
          </div>
        </div>
        <div class="row">
        	<input type="checkbox" name="role_resources[]" value="0" checked style="display:none;"/>
          <div class="col-md-12">
            <div class="form-group">
              <label for="role_access"><?php echo $this->lang->line('tat_role_access');?><i class="tatari-asterisk">*</i></label>
              <select class="form-control custom-select" id="role_access_modal" name="role_access" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_role_access');?>">
                <option value="">&nbsp;</option>
                <option value="1" <?php if($role_access==1):?> selected="selected" <?php endif;?>><?php echo $this->lang->line('tat_role_all_menu');?></option>
                <option value="2" <?php if($role_access==2):?> selected="selected" <?php endif;?>><?php echo $this->lang->line('tat_role_cmenu');?></option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <p><strong><?php echo $this->lang->line('tat_role_note_title');?></strong></p>
            <p><?php echo $this->lang->line('tat_role_note1');?></p>
            <p><?php echo $this->lang->line('tat_role_note2');?></p>
            </div>
          </div>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="resources"><?php echo $this->lang->line('tat_role_resource');?></label>
              <div id="all_resources">
                <div class="demo-section k-content">
                  <div>
                    <div id="treeview_m1"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <div id="all_resources">
                <div class="demo-section k-content">
                  <div>
                    <div id="treeview_m2"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <?php echo form_button(array('data-dismiss' => 'modal', 'type' => 'button', 'class' => 'btn btn-secondary', 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_close'))); ?> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_update'))); ?> 
  </div>
<?php echo form_close(); ?>

<script type="text/javascript">
 $(document).ready(function(){
		
		$('[data-plugin="select_tat"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_tat"]').select2({ width:'100%' });	 
		 $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		  checkboxClass: 'icheckbox_minimal-blue',
		  radioClass   : 'iradio_minimal-blue'
		});

		/* Edit Role Assignment */
		$("#edit_role").submit(function(e){
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&edit_type=role&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
						$('.save').prop('disabled', false);
					} else {
						
						var tat_table = $('#tat_table').dataTable({
							"bDestroy": true,
							"ajax": {
								url : "<?php echo site_url("admin/roles/role_list") ?>",
								type : 'GET'
							},
							dom: 'lBfrtip',
							"buttons": ['csv', 'excel', 'pdf', 'print'], 
							"fnDrawCallback": function(settings){
							$('[data-toggle="tooltip"]').tooltip();          
							}
						});
						tat_table.api().ajax.reload(function(){ 
							toastr.success(JSON.result);
						}, true);
						$('input[name="csrf_tatari"]').val(JSON.csrf_hash);
						$('.edit-modal-data').modal('toggle');
						$('.save').prop('disabled', false);
					}
				}
			});
		});
	});	
  </script>
  <script>

jQuery("#treeview_m1").kendoTreeView({
checkboxes: {
checkChildren: true,
template: "<label><input type='checkbox' #= item.check# class='#= item.class #' name='role_resources[]' value='#= item.value #'> #= item.text #</label>"
},
check: onCheck,
dataSource: [

	 // Organization
	 { id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_organization');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('2',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "", value:"2", items: [
	 // Company
	 { id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_company');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "5", check: "<?php if(isset($_GET['role_id'])) { if(in_array('5',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "5", check: "<?php if(isset($_GET['role_id'])) { if(in_array('5',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "246", check: "<?php if(isset($_GET['role_id'])) { if(in_array('246',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "247", check: "<?php if(isset($_GET['role_id'])) { if(in_array('247',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "248", check: "<?php if(isset($_GET['role_id'])) { if(in_array('248',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
		// Department
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_department');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "3", check: "<?php if(isset($_GET['role_id'])) { if(in_array('3',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "3", check: "<?php if(isset($_GET['role_id'])) { if(in_array('3',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "240", check: "<?php if(isset($_GET['role_id'])) { if(in_array('240',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "241", check: "<?php if(isset($_GET['role_id'])) { if(in_array('241',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "242", check: "<?php if(isset($_GET['role_id'])) { if(in_array('242',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
    // Designation
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_designation');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "4", check: "<?php if(isset($_GET['role_id'])) { if(in_array('4',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "4", check: "<?php if(isset($_GET['role_id'])) { if(in_array('4',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "243", check: "<?php if(isset($_GET['role_id'])) { if(in_array('243',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "244", check: "<?php if(isset($_GET['role_id'])) { if(in_array('244',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "245", check: "<?php if(isset($_GET['role_id'])) { if(in_array('245',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_designation').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "249",check: "<?php if(isset($_GET['role_id'])) { if(in_array('249',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},

    // Location
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_location');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "6", check: "<?php if(isset($_GET['role_id'])) { if(in_array('6',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "6", check: "<?php if(isset($_GET['role_id'])) { if(in_array('6',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "250", check: "<?php if(isset($_GET['role_id'])) { if(in_array('250',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "251", check: "<?php if(isset($_GET['role_id'])) { if(in_array('251',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "252", check: "<?php if(isset($_GET['role_id'])) { if(in_array('252',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
	]},

	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('let_staff');?>",  add_info: "", check: "<?php if(isset($_GET['role_id'])) { if(in_array('103',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", value: "103",  items: [
	// Employees
    { id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('dashboard_employees');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "13", check: "<?php if(isset($_GET['role_id'])) { if(in_array('13',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "13", check: "<?php if(isset($_GET['role_id'])) { if(in_array('13',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "201", check: "<?php if(isset($_GET['role_id'])) { if(in_array('201',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_edit');?>", value: "202", check: "<?php if(isset($_GET['role_id'])) { if(in_array('202',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_delete');?>", value: "203", check: "<?php if(isset($_GET['role_id'])) { if(in_array('203',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_view_company_emp_title');?>",  add_info: "<?php echo $this->lang->line('tat_view_company_emp_title');?>", value: "372", check: "<?php if(isset($_GET['role_id'])) { if(in_array('372',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_view_location_emp_title');?>",  add_info: "<?php echo $this->lang->line('tat_view_location_emp_title');?>", value: "373", check: "<?php if(isset($_GET['role_id'])) { if(in_array('373',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},	
    // Employee Extended
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_set_employees_salary');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "351", check: "<?php if(isset($_GET['role_id'])) { if(in_array('351',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_employees_directory');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "88", check: "<?php if(isset($_GET['role_id'])) { if(in_array('88',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_employees_last_login');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "22", check: "<?php if(isset($_GET['role_id'])) { if(in_array('22',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	//CORE HR
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_hr');?>",  add_info: "", check: "<?php if(isset($_GET['role_id'])) { if(in_array('12',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", value: "12",  items: [
	// Transfer
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_transfers');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "15", check: "<?php if(isset($_GET['role_id'])) { if(in_array('15',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "15", check: "<?php if(isset($_GET['role_id'])) { if(in_array('15',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "210", check: "<?php if(isset($_GET['role_id'])) { if(in_array('210',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "211", check: "<?php if(isset($_GET['role_id'])) { if(in_array('211',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "212", check: "<?php if(isset($_GET['role_id'])) { if(in_array('212',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_transfers').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "233", check: "<?php if(isset($_GET['role_id'])) { if(in_array('233',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
    // Resignation
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_resignations');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "16", check: "<?php if(isset($_GET['role_id'])) { if(in_array('16',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "16", check: "<?php if(isset($_GET['role_id'])) { if(in_array('16',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "213", check: "<?php if(isset($_GET['role_id'])) { if(in_array('213',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "214", check: "<?php if(isset($_GET['role_id'])) { if(in_array('214',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "215", check: "<?php if(isset($_GET['role_id'])) { if(in_array('215',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_resignations').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "234", check: "<?php if(isset($_GET['role_id'])) { if(in_array('234',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_manager_level_title').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_manager_level_title');?>", value: "406", check: "<?php if(isset($_GET['role_id'])) { if(in_array('406',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_hrd_level_title').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_hrd_level_title');?>", value: "407", check: "<?php if(isset($_GET['role_id'])) { if(in_array('407',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_gm_om_level_title').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_gm_om_level_title');?>", value: "408", check: "<?php if(isset($_GET['role_id'])) { if(in_array('408',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	// Promotion
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_promotions');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "18", check: "<?php if(isset($_GET['role_id'])) { if(in_array('18',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "18", check: "<?php if(isset($_GET['role_id'])) { if(in_array('18',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "219", check: "<?php if(isset($_GET['role_id'])) { if(in_array('219',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "220", check: "<?php if(isset($_GET['role_id'])) { if(in_array('220',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "221", check: "<?php if(isset($_GET['role_id'])) { if(in_array('221',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_promotions').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "236", check: "<?php if(isset($_GET['role_id'])) { if(in_array('236',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
    // Complaint
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_complaints');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "19", check: "<?php if(isset($_GET['role_id'])) { if(in_array('19',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "19", check: "<?php if(isset($_GET['role_id'])) { if(in_array('19',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "222", check: "<?php if(isset($_GET['role_id'])) { if(in_array('222',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "223", check: "<?php if(isset($_GET['role_id'])) { if(in_array('223',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "224", check: "<?php if(isset($_GET['role_id'])) { if(in_array('224',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_complaints').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "237", check: "<?php if(isset($_GET['role_id'])) { if(in_array('237',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
    // Warning
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_warnings');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "20", check: "<?php if(isset($_GET['role_id'])) { if(in_array('20',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "20", check: "<?php if(isset($_GET['role_id'])) { if(in_array('20',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "225", check: "<?php if(isset($_GET['role_id'])) { if(in_array('225',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "226", check: "<?php if(isset($_GET['role_id'])) { if(in_array('226',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "227", check: "<?php if(isset($_GET['role_id'])) { if(in_array('227',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_warnings').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "238", check: "<?php if(isset($_GET['role_id'])) { if(in_array('238',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
    // Termination
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_terminations');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "21", check: "<?php if(isset($_GET['role_id'])) { if(in_array('21',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "21", check: "<?php if(isset($_GET['role_id'])) { if(in_array('21',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "228", check: "<?php if(isset($_GET['role_id'])) { if(in_array('228',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "229", check: "<?php if(isset($_GET['role_id'])) { if(in_array('229',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "230", check: "<?php if(isset($_GET['role_id'])) { if(in_array('230',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_terminations').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "239", check: "<?php if(isset($_GET['role_id'])) { if(in_array('239',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]}
	]},

    // Attendance
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_attendances');?>",  add_info: "", check: "<?php if(isset($_GET['role_id'])) { if(in_array('27',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", value: "27",  items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_attendance');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "28", check: "<?php if(isset($_GET['role_id'])) { if(in_array('28',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "28", check: "<?php if(isset($_GET['role_id'])) { if(in_array('28',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_timesheet').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "397", check: "<?php if(isset($_GET['role_id'])) { if(in_array('397',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_month_timesheet_title');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "10", check: "<?php if(isset($_GET['role_id'])) { if(in_array('10',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "10", check: "<?php if(isset($_GET['role_id'])) { if(in_array('10',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('tat_month_timesheet_title').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "253",check: "<?php if(isset($_GET['role_id'])) { if(in_array('253',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
        // Calendar : if included
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_date_wise_attendance');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "29", check: "<?php if(isset($_GET['role_id'])) { if(in_array('29',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "29", check: "<?php if(isset($_GET['role_id'])) { if(in_array('29',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_date_wise_attendance').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "381", check: "<?php if(isset($_GET['role_id'])) { if(in_array('381',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_update_attendance');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "30", check: "<?php if(isset($_GET['role_id'])) { if(in_array('30',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "30", check: "<?php if(isset($_GET['role_id'])) { if(in_array('30',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "277", check: "<?php if(isset($_GET['role_id'])) { if(in_array('277',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "278", check: "<?php if(isset($_GET['role_id'])) { if(in_array('278',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "279", check: "<?php if(isset($_GET['role_id'])) { if(in_array('279',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_upd_company_attendance').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "310", check: "<?php if(isset($_GET['role_id'])) { if(in_array('310',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
    // Overtime 
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_overtime_request');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "401", check: "<?php if(isset($_GET['role_id'])) { if(in_array('401',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "401", check: "<?php if(isset($_GET['role_id'])) { if(in_array('401',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "402", check: "<?php if(isset($_GET['role_id'])) { if(in_array('402',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "403", check: "<?php if(isset($_GET['role_id'])) { if(in_array('403',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_import_attendance');?>",  add_info: "<?php echo $this->lang->line('tat_attendance_import');?>", value: "31", check: "<?php if(isset($_GET['role_id'])) { if(in_array('31',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	// Shift
    { id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_office_shifts');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "7", check: "<?php if(isset($_GET['role_id'])) { if(in_array('7',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "7", check: "<?php if(isset($_GET['role_id'])) { if(in_array('7',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "280", check: "<?php if(isset($_GET['role_id'])) { if(in_array('280',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "281", check: "<?php if(isset($_GET['role_id'])) { if(in_array('281',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "282", check: "<?php if(isset($_GET['role_id'])) { if(in_array('282',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_change_default');?>",  add_info: "<?php echo $this->lang->line('tat_role_change_default');?>", value: "2822", check: "<?php if(isset($_GET['role_id'])) { if(in_array('2822',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_office_shifts').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "311", check: "<?php if(isset($_GET['role_id'])) { if(in_array('311',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
    // Leave
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_leaves');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "46", check: "<?php if(isset($_GET['role_id'])) { if(in_array('46',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "46", check: "<?php if(isset($_GET['role_id'])) { if(in_array('46',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "287", check: "<?php if(isset($_GET['role_id'])) { if(in_array('287',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "288", check: "<?php if(isset($_GET['role_id'])) { if(in_array('288',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "289", check: "<?php if(isset($_GET['role_id'])) { if(in_array('289',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_leaves').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "290", check: "<?php if(isset($_GET['role_id'])) { if(in_array('290',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_1st_level_approval').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "286", check: "<?php if(isset($_GET['role_id'])) { if(in_array('286',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_2nd_level_approval').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "312", check: "<?php if(isset($_GET['role_id'])) { if(in_array('312',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	]},

	  // Payroll
	  { id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_payroll');?>",  add_info: "", check: "<?php if(isset($_GET['role_id'])) { if(in_array('32',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", value: "32",  items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_generate_payslip');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "36", check: "<?php if(isset($_GET['role_id'])) { if(in_array('36',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "36",check: "<?php if(isset($_GET['role_id'])) { if(in_array('36',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "313",check: "<?php if(isset($_GET['role_id'])) { if(in_array('313',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_generate_company_payslips').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_view');?>", value: "314",check: "<?php if(isset($_GET['role_id'])) { if(in_array('314',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_payment_history');?>",  add_info: "<?php echo $this->lang->line('tat_view_payslip');?>", value: "37", check: "<?php if(isset($_GET['role_id'])) { if(in_array('37',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "37", check: "<?php if(isset($_GET['role_id'])) { if(in_array('37',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo '<small>'.$this->lang->line('tat_role_view').' '.$this->lang->line('left_payment_history').'</small>';?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "391", check: "<?php if(isset($_GET['role_id'])) { if(in_array('391',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_payroll_verifier_title');?>",  add_info: "<?php echo $this->lang->line('tat_payroll_verifier_title');?>", value: "404", check: "<?php if(isset($_GET['role_id'])) { if(in_array('404',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_payroll_approver_title');?>",  add_info: "<?php echo $this->lang->line('tat_payroll_approver_title');?>", value: "405", check: "<?php if(isset($_GET['role_id'])) { if(in_array('405',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},

    // Vacancy
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_vacancy');?>",  add_info: "", check: "<?php if(isset($_GET['role_id'])) { if(in_array('48',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", value: "48",  items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_job_posts');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "49", check: "<?php if(isset($_GET['role_id'])) { if(in_array('49',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "49", check: "<?php if(isset($_GET['role_id'])) { if(in_array('49',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "291", check: "<?php if(isset($_GET['role_id'])) { if(in_array('291',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "292", check: "<?php if(isset($_GET['role_id'])) { if(in_array('292',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "293", check: "<?php if(isset($_GET['role_id'])) { if(in_array('293',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_job_candidates');?>",  add_info: "<?php echo $this->lang->line('tat_update_status_delete');?>", value: "51", check: "<?php if(isset($_GET['role_id'])) { if(in_array('51',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "51", check: "<?php if(isset($_GET['role_id'])) { if(in_array('51',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_dwn_resume');?>",  add_info: "<?php echo $this->lang->line('tat_role_dwn_resume');?>", value: "294", check: "<?php if(isset($_GET['role_id'])) { if(in_array('294',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_delete');?>", value: "295", check: "<?php if(isset($_GET['role_id'])) { if(in_array('295',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_view_own');?>",  add_info: "<?php echo $this->lang->line('tat_role_view_own');?>", value: "387", check: "<?php if(isset($_GET['role_id'])) { if(in_array('387',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	]},

	{ id: "", class: "role-checkbox-modal",text: "<?php echo $this->lang->line('tat_hr_report_title');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('110',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "",value: "110", items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_hr_reports_payslip');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "111", check: "<?php if(isset($_GET['role_id'])) { if(in_array('111',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_hr_reports_attendance_employee');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "112", check: "<?php if(isset($_GET['role_id'])) { if(in_array('112',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_hr_report_employees');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "117", check: "<?php if(isset($_GET['role_id'])) { if(in_array('117',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_hr_report_leave_report');?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "409", check: "<?php if(isset($_GET['role_id'])) { if(in_array('409',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},

]
});

jQuery("#treeview_m2").kendoTreeView({
checkboxes: {
checkChildren: true,
template: "<label><input type='checkbox' #= item.check# class='#= item.class #' name='role_resources[]' value='#= item.value #'> #= item.text #</label>"
},
check: onCheck,
dataSource: [
//

	// Ledger Accounts
{ id: "", class: "role-checkbox-modal",text: "<?php echo $this->lang->line('tat_acc_accounts');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('71',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "",value: "71",  items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_account_list');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('72',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "72",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "72", check: "<?php if(isset($_GET['role_id'])) { if(in_array('72',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "352", check: "<?php if(isset($_GET['role_id'])) { if(in_array('352',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "353", check: "<?php if(isset($_GET['role_id'])) { if(in_array('353',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "354", check: "<?php if(isset($_GET['role_id'])) { if(in_array('354',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_account_balances');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('73',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "73",},
	]},
	// Payer/Payees
	{ id: "", class: "role-checkbox-modal",text: "<?php echo $this->lang->line('tat_acc_payees_payers');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('79',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "",value: "79",  items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_payees');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('80',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "80",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "80", check: "<?php if(isset($_GET['role_id'])) { if(in_array('80',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "364", check: "<?php if(isset($_GET['role_id'])) { if(in_array('364',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "365", check: "<?php if(isset($_GET['role_id'])) { if(in_array('365',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "366", check: "<?php if(isset($_GET['role_id'])) { if(in_array('366',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_payers');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('81',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "81",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "81", check: "<?php if(isset($_GET['role_id'])) { if(in_array('81',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "367", check: "<?php if(isset($_GET['role_id'])) { if(in_array('367',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "368", check: "<?php if(isset($_GET['role_id'])) { if(in_array('368',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "369", check: "<?php if(isset($_GET['role_id'])) { if(in_array('369',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	]},
    // Transactions
	{ id: "", class: "role-checkbox-modal",text: "<?php echo $this->lang->line('tat_acc_transactions');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('74',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "",value: "74",  items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_deposit');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('75',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "75",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "75", check: "<?php if(isset($_GET['role_id'])) { if(in_array('75',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "355", check: "<?php if(isset($_GET['role_id'])) { if(in_array('355',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "356", check: "<?php if(isset($_GET['role_id'])) { if(in_array('356',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "357", check: "<?php if(isset($_GET['role_id'])) { if(in_array('357',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_expense');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('76',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "76",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "76", check: "<?php if(isset($_GET['role_id'])) { if(in_array('76',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "358", check: "<?php if(isset($_GET['role_id'])) { if(in_array('358',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "359", check: "<?php if(isset($_GET['role_id'])) { if(in_array('359',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "360", check: "<?php if(isset($_GET['role_id'])) { if(in_array('360',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_transfer');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('77',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "77",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "77", check: "<?php if(isset($_GET['role_id'])) { if(in_array('77',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_add');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "361", check: "<?php if(isset($_GET['role_id'])) { if(in_array('361',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "362", check: "<?php if(isset($_GET['role_id'])) { if(in_array('362',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "363", check: "<?php if(isset($_GET['role_id'])) { if(in_array('363',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"}
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_view_transactions');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('78',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_view');?>", value: "78",},
	]},
	

    // Invoices
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_invoices');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "87", check: "<?php if(isset($_GET['role_id'])) { if(in_array('87',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", items: [

	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_invoices_title');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "121", check: "<?php if(isset($_GET['role_id'])) { if(in_array('121',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_enable');?>",  add_info: "<?php echo $this->lang->line('tat_role_enable');?>", value: "121", check: "<?php if(isset($_GET['role_id'])) { if(in_array('121',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_create');?>",  add_info: "<?php echo $this->lang->line('tat_role_create');?>", value: "120", check: "<?php if(isset($_GET['role_id'])) { if(in_array('120',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_edit');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "328", check: "<?php if(isset($_GET['role_id'])) { if(in_array('328',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_role_delete');?>",  add_info: "<?php echo $this->lang->line('tat_role_add');?>", value: "329", check: "<?php if(isset($_GET['role_id'])) { if(in_array('329',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",}
	]},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_invoice_payments');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_view_delete_role_info');?>", value: "330", check: "<?php if(isset($_GET['role_id'])) { if(in_array('330',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",},
	]},

	// Fiscal Reports
	{ id: "", class: "role-checkbox-modal",text: "<?php echo $this->lang->line('tat_acc_reports');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('82',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "",value: "82",  items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_account_statement');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('83',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_view');?>", value: "83"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_expense_reports');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('84',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_view');?>", value: "84",},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_income_reports');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('85',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>", add_info: "<?php echo $this->lang->line('tat_view');?>", value: "85",},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_acc_transfer_report');?>", check: "<?php if(isset($_GET['role_id'])) { if(in_array('86',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",  add_info: "<?php echo $this->lang->line('tat_view');?>", value: "86",},
	]},

	// System Settings
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_system');?>",  add_info: "", check: "<?php if(isset($_GET['role_id'])) { if(in_array('57',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>",value: "57",  items: [
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_settings');?>",  add_info: "<?php echo $this->lang->line('tat_view_update');?>", value: "60", check: "<?php if(isset($_GET['role_id'])) { if(in_array('60',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_constants');?>",  add_info: "<?php echo $this->lang->line('tat_add_edit_delete_role_info');?>", value: "61", check: "<?php if(isset($_GET['role_id'])) { if(in_array('61',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('left_db_backup');?>",  add_info: "<?php echo $this->lang->line('tat_create_delete_download');?>", value: "62", check: "<?php if(isset($_GET['role_id'])) { if(in_array('62',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	]},
    // Other
	{ id: "", class: "role-checkbox-modal", text: "<?php echo $this->lang->line('tat_theme_settings');?>",  add_info: "<?php echo $this->lang->line('tat_theme_settings');?>", value: "94", check: "<?php if(isset($_GET['role_id'])) { if(in_array('94',$role_resources_ids)): echo 'checked'; else: echo ''; endif; }?>"},
	

]
});
		
// show checked node IDs on datasource change
function onCheck() {
var checkedNodes = [],
treeView = jQuery("#treeview").data("kendoTreeView"),
message;

//checkedNodeIds(treeView.dataSource.view(), checkedNodes);
jQuery("#result").html(message);
}
$(document).ready(function(){
	$("#role_access_modal").change(function(){
		var sel_val = $(this).val();
		if(sel_val=='1') {
			$('.role-checkbox-modal').prop('checked', true);
		} else {
			$('.role-checkbox-modal').prop("checked", false);
		}
	});
});
</script>
<?php }
?>
