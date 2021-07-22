<?php
/* Employees view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>
<?php $role_resources_ids = $this->Tat_model->user_role_resource(); ?>
<?php $user_info = $this->Tat_model->read_user_info($session['user_id']);?>
<?php $system = $this->Tat_model->read_setting_info(1);?>
<div class="row <?php echo $get_animate;?>">
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp-tatari-4 stamp-tatari-md bg-tatari-success-4 mr-3">
                    <i class="fa fa-user"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><?php echo active_employees();?> <small><?php echo $this->lang->line('tat_employees_active');?></small></b></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp-tatari-4 stamp-tatari-md bg-tatari-danger-4 mr-3">
                    <i class="fa fa-user-times"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><?php echo inactive_employees();?> <small><?php echo $this->lang->line('tat_employees_inactive');?></small></b></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp-tatari-4 stamp-tatari-md bg-tatari-secondary mr-3">
                    <i class="fa fa-male"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><?php echo $this->Tat_model->male_employees();?>% <small><?php echo $this->lang->line('tat_gender_male');?></small></b></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp-tatari-4 stamp-tatari-md bg-tatari-warning-4 mr-3">
                    <i class="fa fa-female"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><?php echo $this->Tat_model->female_employees();?>% <small><?php echo $this->lang->line('tat_gender_female');?></small></b></h5>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if(in_array('201',$role_resources_ids)) {?>
<div class="box mb-4 <?php echo $get_animate;?>">
  <div id="accordion">
    <div class="box-header  with-border">
      <h3 class="box-title"><?php echo $this->lang->line('tat_add_new');?> <?php echo $this->lang->line('tat_employee');?></h3>
      <div class="box-tools pull-right"> <a class="text-dark collapsed" data-toggle="collapse" href="#add_form" aria-expanded="false">
        <button type="button" class="btn btn-xs btn-primary"> <span class="ion ion-md-add"></span> <?php echo $this->lang->line('tat_add_new');?></button>
        </a> </div>
    </div>
    <div id="add_form" class="collapse add-form <?php echo $get_animate;?>" data-parent="#accordion" style="">
      <div class="box-body">
        <?php $attributes = array('name' => 'add_employee', 'id' => 'tat-form', 'autocomplete' => 'off');?>
        <?php $hidden = array('_user' => $session['user_id']);?>
        <?php echo form_open_multipart('admin/employees/add_employee', $attributes, $hidden);?>
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="first_name"><?php echo $this->lang->line('tat_employee_first_name');?><i class="tatari-asterisk">*</i></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_first_name');?>" name="first_name" type="text" value="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="last_name" class="control-label"><?php echo $this->lang->line('tat_employee_last_name');?><i class="tatari-asterisk">*</i></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_last_name');?>" name="last_name" type="text" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <?php if($user_info[0]->user_role_id==1){ ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="first_name"><?php echo $this->lang->line('left_company');?><i class="tatari-asterisk">*</i></label>
                    <select class="form-control" name="company_id" id="aj_company" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_company');?>">
                      <option value=""></option>
                      <?php foreach($get_all_companies as $company) {?>
                      <option value="<?php echo $company->company_id?>"><?php echo $company->name?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <?php } else {?>
                <?php $ecompany_id = $user_info[0]->company_id;?>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="first_name"><?php echo $this->lang->line('left_company');?><i class="tatari-asterisk">*</i></label>
                    <select class="form-control" name="company_id" id="aj_company" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_company');?>">
                      <option value=""></option>
                      <?php foreach($get_all_companies as $company) {?>
						  <?php if($ecompany_id == $company->company_id):?>
                          <option value="<?php echo $company->company_id?>"><?php echo $company->name?></option>
                          <?php endif;?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <?php } ?>
                <div class="col-md-6" id="location_ajax">
                <div class="form-group">
                  <label for="name"><?php echo $this->lang->line('left_location');?><i class="tatari-asterisk">*</i></label>
                  <select disabled="disabled" name="location_id" id="location_id" class="form-control" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_location');?>">
                    <option value=""></option>
                  </select>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username"><?php echo $this->lang->line('dashboard_username');?><i class="tatari-asterisk">*</i></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_username');?>" name="username" type="text" value="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email" class="control-label"><?php echo $this->lang->line('dashboard_email');?><i class="tatari-asterisk">*</i></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_email');?>" name="email" type="text" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_of_birth"><?php echo $this->lang->line('tat_employee_dob');?><i class="tatari-asterisk">*</i></label>
                    <input class="form-control date_of_birth" readonly placeholder="<?php echo $this->lang->line('tat_employee_dob');?>" name="date_of_birth" type="text" value="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="contact_no" class="control-label"><?php echo $this->lang->line('tat_contact_number');?><i class="tatari-asterisk">*</i></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('tat_contact_number');?>" name="contact_no" type="text" value="">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="employee_id"><?php echo $this->lang->line('dashboard_employee_id');?><i class="tatari-asterisk">*</i></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_employee_id');?>" name="employee_id" type="text" value="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_of_joining" class="control-label"><?php echo $this->lang->line('tat_employee_doj');?><i class="tatari-asterisk">*</i></label>
                    <input class="form-control date_of_joining" readonly placeholder="<?php echo $this->lang->line('tat_employee_doj');?>" name="date_of_joining" type="text" value="">
                  </div>
                </div>
              </div>
              <div class="row">
              <?php $colmd=4; if($system[0]->is_active_sub_departments=='yes'){ $ncolmd = 4; } else { $ncolmd = 6;}?>
              <div class="col-md-<?php echo $ncolmd;?>">
                  <div class="form-group" id="department_ajax">
                    <label for="department"><?php echo $this->lang->line('tat_hr_main_department');?><i class="tatari-asterisk">*</i></label>
                    <select class="form-control" name="department_id" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_employee_department');?>" disabled="disabled">
                      <option value=""></option>
                    </select>
                  </div>
                </div>
                
				<?php $colmd=4; if($system[0]->is_active_sub_departments=='yes'){?>
                <div class="col-md-4" id="subdepartment_ajax">
                  <div class="form-group">
                    <label for="designation"><?php echo $this->lang->line('tat_hr_sub_department');?><i class="tatari-asterisk">*</i></label>
                    <select class="form-control" name="subdepartment_id" data-plugin="select_tat" disabled="disabled" data-placeholder="<?php echo $this->lang->line('tat_employee_department');?>">
                      <option value=""></option>
                    </select>
                  </div>
                </div>
                <?php $colmd = '4'; } else { $colmd = '6';?>
                <input type="hidden" name="subdepartment_id" value="YES" />
                <?php } ?>
                
                <div class="col-md-<?php echo $colmd;?>" id="designation_ajax">
                  <div class="form-group">
                    <label for="designation"><?php echo $this->lang->line('tat_designation');?><i class="tatari-asterisk">*</i></label>
                    <select class="form-control" name="designation_id" data-plugin="select_tat" disabled="disabled" data-placeholder="<?php echo $this->lang->line('tat_designation');?>">
                      <option value=""></option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="gender" class="control-label"><?php echo $this->lang->line('tat_employee_gender');?></label>
                    <select class="form-control" name="gender" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_employee_gender');?>">
                      <option value="Male"><?php echo $this->lang->line('tat_gender_male');?></option>
                      <option value="Female"><?php echo $this->lang->line('tat_gender_female');?></option>
                    </select>
                  </div>
                </div>
             
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tat_employee_password"><?php echo $this->lang->line('tat_employee_password');?><i class="tatari-asterisk">*</i></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_password');?>" name="password" type="text" value="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="confirm_password" class="control-label"><?php echo $this->lang->line('tat_employee_cpassword');?><i class="tatari-asterisk">*</i></label>
                    <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_cpassword');?>" name="confirm_password" type="text" value="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="role"><?php echo $this->lang->line('tat_employee_role');?><i class="tatari-asterisk">*</i></label>
                <select class="form-control" name="role" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_employee_role');?>">
                  <option value=""></option>
                  <?php foreach($all_user_roles as $role) {?>
                  <?php if($user_info[0]->user_role_id==1){?>
                  <option value="<?php echo $role->role_id?>"><?php echo $role->role_name?></option>
                  <?php } else {?>
                  	<?php if($role->role_id!=1){?>
                  	<option value="<?php echo $role->role_id?>"><?php echo $role->role_name?></option>
                    <?php } ?>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="address"><?php echo $this->lang->line('tat_employee_address');?></label>
                <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_address');?>" name="address">
              </div>
            </div>
          </div>
        </div>
        <?php $count_module_attributes = $this->Custom_fields_model->count_module_attributes();?>
        <?php $module_attributes = $this->Custom_fields_model->all_tatari_module_attributes();?>
          <!--<div class="row">
            <?php foreach($module_attributes as $mattribute):?>
            <div class="col-md-3">
              <div class="form-group">
                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                <input class="form-control" placeholder="<?php echo $mattribute->attribute_label;?>" name="<?php echo $mattribute->attribute;?>" type="text">
              </div>
            </div>
            <?php endforeach;?>
          </div>-->
          <?php if($count_module_attributes > 0):?>
          <div class="row">
			<?php foreach($module_attributes as $mattribute):?>
            <?php if($mattribute->attribute_type == 'date'){?>
            <div class="col-md-4">
              <div class="form-group">
                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                <input class="form-control date" placeholder="<?php echo $mattribute->attribute_label;?>" name="<?php echo $mattribute->attribute;?>" type="text">
              </div>
            </div>
            <?php } else if($mattribute->attribute_type == 'select'){?>
            <div class="col-md-4">
            <?php $iselc_val = $this->Custom_fields_model->get_attribute_selection_values($mattribute->custom_field_id);?>
              <div class="form-group">
                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                <select class="form-control" name="<?php echo $mattribute->attribute;?>" data-plugin="select_tat" data-placeholder="<?php echo $mattribute->attribute_label;?>">
                  <?php foreach($iselc_val as $selc_val) {?>
                  <option value="<?php echo $selc_val->attributes_select_value_id?>"><?php echo $selc_val->select_label?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <?php } else if($mattribute->attribute_type == 'multiselect'){?>
            <div class="col-md-4">
            <?php $imulti_selc_val = $this->Custom_fields_model->get_attribute_selection_values($mattribute->custom_field_id);?>
              <div class="form-group">
                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                <select multiple="multiple" class="form-control" name="<?php echo $mattribute->attribute;?>[]" data-plugin="select_tat" data-placeholder="<?php echo $mattribute->attribute_label;?>">
                  <?php foreach($imulti_selc_val as $multi_selc_val) {?>
                  <option value="<?php echo $multi_selc_val->attributes_select_value_id?>"><?php echo $multi_selc_val->select_label?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <?php } else if($mattribute->attribute_type == 'textarea'){?>
            <div class="col-md-8">
              <div class="form-group">
                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                <input class="form-control" placeholder="<?php echo $mattribute->attribute_label;?>" name="<?php echo $mattribute->attribute;?>" type="text">
              </div>
            </div>
            <?php } else if($mattribute->attribute_type == 'fileupload'){?>
            <div class="col-md-4">
              <div class="form-group">
                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                <input class="form-control-file" name="<?php echo $mattribute->attribute;?>" type="file">
              </div>
            </div>
            <?php } else { ?>
            <div class="col-md-4">
              <div class="form-group">
                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                <input class="form-control" placeholder="<?php echo $mattribute->attribute_label;?>" name="<?php echo $mattribute->attribute;?>" type="text">
              </div>
            </div>
            <?php }	?>
            <?php endforeach;?>
          </div>
          <?php endif;?>
        <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_save'))); ?> </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>
</div>
<?php }?>

<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"> List Employees </h3>
  </div>

  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="tat_table">
        <thead>
          <tr>
            <th style="width:80px;"><?php echo $this->lang->line('tat_action');?></th>
            <th width="200"><i class="fa fa-user"></i> <?php echo $this->lang->line('tat_employees_full_name');?></th>
            <th><?php echo $this->lang->line('left_company');?></th>
            <th><?php echo $this->lang->line('dashboard_contact');?></th>
            <th><?php echo $this->lang->line('tat_employee_role');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
