<?php
/* Employee Details view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $system = $this->Tat_model->read_setting_info(1);?>
<?php //$default_currency = $this->Tat_model->read_currency_con_info($system[0]->default_currency_id);?>
<?php
$eid = $this->uri->segment(4);
$eresult = $this->Employees_model->read_employee_information($eid);
?>
<?php
$ar_sc = explode('- ',$system[0]->default_currency_symbol);
$sc_show = $ar_sc[1];
$leave_user = $this->Tat_model->read_user_info($eid);
?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>
<?php 
// $leave_categories_ids = explode(',',$leave_categories);
?>
<?php $view_companies_ids = explode(',',$view_companies_id);?>
<?php $user_info = $this->Tat_model->read_user_info($session['user_id']);?>
<?php $role_resources_ids = $this->Tat_model->user_role_resource(); ?>
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom mb-4">
      <ul class="nav nav-tabs">
        <li class="nav-item active"> <a class="nav-link active show" data-toggle="tab" href="#tat_general">General</a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tat_profile_picture">Profile Picture</a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="">Tab 3</a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="">Tab 4</a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="">Tab 5</a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="">Tab 6</a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="">Tab 7</a> </li>      
     </ul>
      <div class="tab-content">
        <div class="tab-pane <?php echo $get_animate;?> active" id="tat_general">
          <div class="card-body">
            <div class="card overflow-hidden">
              <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                  <div class="list-group list-group-flush account-settings-links"> 
                  <a class="list-group-item list-group-item-action  nav-tabs-link active" data-toggle="list" href="javascript:void(0);" data-profile="1" data-profile-block="user_basic_info" aria-expanded="true" id="user_profile_1"><?php echo $this->lang->line('tat_e_details_basic');?></a> 
              
                   <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="3" data-profile-block="contacts" aria-expanded="true" id="user_profile_3"><?php echo $this->lang->line('tat_employee_emergency_contacts');?></a> 

                   <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="9" data-profile-block="change-password" aria-expanded="true" id="user_profile_9"><?php echo $this->lang->line('tat_e_details_cpassword');?></a>

                   <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="5" data-profile-block="" aria-expanded="true" id="user_profile_5">Item 4</a>
                    <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="6" data-profile-block="" aria-expanded="true" id="user_profile_6">Item 5</a> 
                    <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="7" data-profile-block="" aria-expanded="true" id="user_profile_7">Item 6</a> 
                    <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="8" data-profile-block="" aria-expanded="true" id="user_profile_8">Item 7</a>
                     <a class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="12" data-profile-block="" aria-expanded="true" id="user_profile_12">Item 8</a>
                     <a  class="list-group-item list-group-item-action nav-tabs-link" data-toggle="list" href="javascript:void(0);" data-profile="13" data-profile-block="" aria-expanded="true" id="user_profile_13">Item 9 </a> </div>
                </div>
                <div class="col-md-9">
                  <div class="tab-content">
                    <div class="tab-pane active current-tab <?php echo $get_animate;?>" id="user_basic_info">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('tat_e_details_basic_info');?> </h3>
                      </div>
                      <div class="box-body">
                        <?php $attributes = array('name' => 'basic_info', 'id' => 'basic_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('user_id' => $user_id, 'u_basic_info' => 'UPDATE');?>
                        <?php echo form_open_multipart('admin/employees/basic_info', $attributes, $hidden);?>
                        <div class="bg-white">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="first_name"><?php echo $this->lang->line('tat_employee_first_name');?><i class="tatari-asterisk">*</i></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_first_name');?>" name="first_name" type="text" value="<?php echo $first_name;?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="last_name" class="control-label"><?php echo $this->lang->line('tat_employee_last_name');?><i class="tatari-asterisk">*</i></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_last_name');?>" name="last_name" type="text" value="<?php echo $last_name;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="employee_id"><?php echo $this->lang->line('dashboard_employee_id');?><i class="tatari-asterisk">*</i></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_employee_id');?>" name="employee_id" type="text" value="<?php echo $employee_id;?>">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="username"><?php echo $this->lang->line('dashboard_username');?><i class="tatari-asterisk">*</i></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_username');?>" name="username" type="text" value="<?php echo $username;?>">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="email" class="control-label"><?php echo $this->lang->line('dashboard_email');?><i class="tatari-asterisk">*</i></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_email');?>" name="email" type="text" value="<?php echo $email;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                          <?php if($user_info[0]->user_role_id==1){ ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="first_name"><?php echo $this->lang->line('left_company');?><i class="tatari-asterisk">*</i></label>
                                <select class="form-control" name="company_id" id="aj_company" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_company');?>">
                                  <option value=""></option>
                                  <?php foreach($get_all_companies as $company) {?>
                                  <option value="<?php echo $company->company_id?>" <?php if($company_id==$company->company_id):?> selected="selected"<?php endif;?>><?php echo $company->name?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } else {?>
                            <?php $ecompany_id = $user_info[0]->company_id;?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="first_name"><?php echo $this->lang->line('left_company');?><i class="tatari-asterisk">*</i></label>
                                <select class="form-control" name="company_id" id="aj_company" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_company');?>">
                                  <option value=""></option>
                                  <?php foreach($get_all_companies as $company) {?>
									  <?php if($ecompany_id == $company->company_id):?>
                                      <option value="<?php echo $company->company_id?>" <?php if($company_id==$company->company_id):?> selected="selected"<?php endif;?>><?php echo $company->name?></option>
                                      <?php endif; ?>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } ?>

                                          <?php $colmd=4;
                              if($system[0]->is_active_sub_departments=='yes'){
                                $colmd=4;
                                $is_id= 'aj_subdepartments';
                              } else {
                                $colmd=4;
                                $is_id= 'is_aj_subdepartments';
                              }?>
                            <?php //$eall_departments = $this->Company_model->ajax_company_departments_info($company_id);?>
                            <?php $el_result = $this->Department_model->ajax_company_location_information($company_id);?>
                            <?php $eall_departments = $this->Department_model->ajax_location_departments_information($location_id);?>
                            <div class="col-md-4" id="location_ajax">
                            <div class="form-group">
                              <label for="name"><?php echo $this->lang->line('left_location');?><i class="tatari-asterisk">*</i></label>
                              <select name="location_id" id="location_id" class="form-control" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_location');?>">
                                <?php foreach($el_result as $location) {?>
                                <option value="<?php echo $location->location_id?>" <?php if($location_id == $location->location_id):?> selected="selected"<?php endif;?>><?php echo $location->location_name?></option>
                                <?php } ?>
                              </select>
                            </div>
                            </div>
                            
                            <div class="col-md-<?php echo $colmd;?>">
                              <div class="form-group" id="department_ajax">
                                <label for="department"><?php echo $this->lang->line('tat_employee_department');?><i class="tatari-asterisk">*</i></label>
                                <select class="form-control" name="department_id" id="<?php echo $is_id;?>" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_employee_department');?>">
                                  <option value=""></option>
                                  <?php foreach($eall_departments as $department) {?>
                                  <option value="<?php echo $department->department_id?>" <?php if($department_id==$department->department_id):?> selected <?php endif;?>><?php echo $department->department_name?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            
                          </div>
                          <?php if($system[0]->is_active_sub_departments=='yes'){?>
                          	<?php $eall_designations = $this->Designation_model->ajax_designation_information($sub_department_id);?>
                          <?php } else {?>
                          	<?php $eall_designations = $this->Designation_model->ajax_is_designation_information($department_id);?>
                          <?php } ?>
                          <div class="row">
                            <?php $colmd=3; if($system[0]->is_active_sub_departments=='yes'){ $ncolmd = 3; } else { $ncolmd = 4;}?>
                            <?php if($system[0]->is_active_sub_departments=='yes'){?>
                            <div class="col-md-<?php echo $ncolmd;?>" id="subdepartment_ajax">
                            <?php $depid = $eresult[0]->department_id; ?>
                            <?php if(!isset($depid)): $depid = 1; else: $depid = $depid; endif;?>
                            <?php $subresult = get_sub_departments($depid);?>
                              <div class="form-group">
                                <label for="designation"><?php echo $this->lang->line('tat_hr_sub_department');?><i class="tatari-asterisk">*</i></label>
                                <select class="form-control" name="subdepartment_id" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_employee_department');?>" id="aj_subdepartment">
                                  <option value=""></option>
                                  <?php foreach($subresult as $sbdeparment) {?>
                                  <option value="<?php echo $sbdeparment->sub_department_id;?>" <?php if($sub_department_id==$sbdeparment->sub_department_id):?> selected <?php endif;?>><?php echo $sbdeparment->department_name;?></option>
								  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } else {?>
                            <input type="hidden" name="subdepartment_id" value="0" />
                            <?php } ?>
                            <div class="col-md-<?php echo $ncolmd;?>">
                              <div class="form-group" id="designation_ajax">
                                <label for="designation"><?php echo $this->lang->line('tat_designation');?><i class="tatari-asterisk">*</i></label>
                                <select class="form-control" name="designation_id" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_designation');?>">
                                  <option value=""></option>
                                  <?php foreach($eall_designations as $designation) {?>
                                  <option value="<?php echo $designation->designation_id?>" <?php if($designation_id==$designation->designation_id):?> selected <?php endif;?>><?php echo $designation->designation_name?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-<?php echo $ncolmd;?>">
                              <div class="form-group">
                                <label for="date_of_joining" class="control-label"><?php echo $this->lang->line('tat_employee_doj');?><i class="tatari-asterisk">*</i></label>
                                <input class="form-control date" readonly placeholder="<?php echo $this->lang->line('tat_employee_doj');?>" name="date_of_joining" type="text" value="<?php echo $date_of_joining;?>">
                              </div>
                            </div>
                            <div class="col-md-<?php echo $ncolmd;?>">
                              <div class="form-group">
                                <label for="date_of_leaving" class="control-label"><?php echo $this->lang->line('tat_employee_dol');?></label>
                                <input class="form-control date" readonly placeholder="<?php echo $this->lang->line('tat_employee_dol');?>" name="date_of_leaving" type="text" value="<?php echo $date_of_leaving;?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="role"><?php echo $this->lang->line('tat_employee_role');?><i class="tatari-asterisk">*</i></label>
                                <select class="form-control" name="role" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_employee_role');?>">
                                  <option value=""></option>
                                  <?php foreach($all_user_roles as $role) {?>
                                  <?php if($user_info[0]->user_role_id==1){?>
                                  <option value="<?php echo $role->role_id?>" <?php if($user_role_id==$role->role_id):?> selected <?php endif;?>><?php echo $role->role_name?></option>
                                  <?php } else {?>
									          <?php if($role->role_id!=1){?>
                                    <option value="<?php echo $role->role_id?>" <?php if($user_role_id==$role->role_id):?> selected <?php endif;?>><?php echo $role->role_name?></option>
                                    <?php } ?>
                                  <?php } ?>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="gender" class="control-label"><?php echo $this->lang->line('tat_employee_gender');?></label>
                                <select class="form-control" name="gender" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_employee_gender');?>">
                                  <option value="Male" <?php if($gender=='Male'):?> selected <?php endif; ?>>Male</option>
                                  <option value="Female" <?php if($gender=='Female'):?> selected <?php endif; ?>>Female</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="marital_status" class="control-label"><?php echo $this->lang->line('tat_employee_mstatus');?></label>
                                <select class="form-control" name="marital_status" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_employee_mstatus');?>">
                                  <option value="Single" <?php if($marital_status=='Single'):?> selected <?php endif; ?>><?php echo $this->lang->line('tat_status_single');?></option>
                                  <option value="Married" <?php if($marital_status=='Married'):?> selected <?php endif; ?>><?php echo $this->lang->line('tat_status_married');?></option>
                                  <option value="Widowed" <?php if($marital_status=='Widowed'):?> selected <?php endif; ?>><?php echo $this->lang->line('tat_status_widowed');?></option>
                                  <option value="Divorced or Separated" <?php if($marital_status=='Divorced or Separated'):?> selected <?php endif; ?>><?php echo $this->lang->line('tat_status_divorced_separated');?></option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="contact_no" class="control-label"><?php echo $this->lang->line('tat_contact_number');?><i class="tatari-asterisk">*</i></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('tat_contact_number');?>" name="contact_no" type="text" value="<?php echo $contact_no;?>">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="status" class="control-label"><?php echo $this->lang->line('dashboard_tat_status');?></label>
                                <select class="form-control" name="status" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('dashboard_tat_status');?>">
                                  <option value="0" <?php if($is_active=='0'):?> selected <?php endif; ?>><?php echo $this->lang->line('tat_employees_inactive');?></option>
                                  <option value="1" <?php if($is_active=='1'):?> selected <?php endif; ?>><?php echo $this->lang->line('tat_employees_active');?></option>
                                </select>
                              </div>
                            </div>
                        
                          </div>
                          <div class="row">
                          	<div class="col-md-4">
                              <div class="form-group">
                                <label for="date_of_birth"><?php echo $this->lang->line('tat_employee_dob');?><i class="tatari-asterisk">*</i></label>
                                <input class="form-control date" readonly placeholder="<?php echo $this->lang->line('tat_employee_dob');?>" name="date_of_birth" type="text" value="<?php echo $date_of_birth;?>">
                              </div>
                            </div>
                          </div>

                            <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="estate"><?php echo $this->lang->line('tat_state');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('tat_state');?>" name="estate" type="text" value="<?php echo $state;?>">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="ecity"><?php echo $this->lang->line('tat_city');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('tat_city');?>" name="ecity" type="text" value="<?php echo $city;?>">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="ezipcode" class="control-label"><?php echo $this->lang->line('tat_zipcode');?></label>
                                <input class="form-control" placeholder="<?php echo $this->lang->line('tat_zipcode');?>" name="ezipcode" type="text" value="<?php echo $zipcode;?>">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="address"><?php echo $this->lang->line('tat_employee_address');?></label>
                                <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_address');?>" name="address" value="<?php echo $address;?>" />
                              </div>
                            </div>
                          </div>  
                          </div>
                          <?php $module_attributes = $this->Custom_fields_model->all_tatari_module_attributes();?>
                          <div class="row">
                            <?php foreach($module_attributes as $mattribute):?>
                            <?php $attribute_info = $this->Custom_fields_model->get_employee_custom_data($user_id,$mattribute->custom_field_id);?>
                            <?php
								if(!is_null($attribute_info)){
									$attr_val = $attribute_info->attribute_value;
								} else {
									$attr_val = '';
								}
							?>
                            <?php if($mattribute->attribute_type == 'date'){?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                                <input class="form-control date" placeholder="<?php echo $mattribute->attribute_label;?>" name="<?php echo $mattribute->attribute;?>" type="text" value="<?php echo $attr_val;?>">
                              </div>
                            </div>
                            <?php } else if($mattribute->attribute_type == 'select'){?>
                            <div class="col-md-4">
                            <?php $iselc_val = $this->Custom_fields_model->get_attribute_selection_values($mattribute->custom_field_id);?>
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                                <select class="form-control" name="<?php echo $mattribute->attribute;?>" data-plugin="select_tat" data-placeholder="<?php echo $mattribute->attribute_label;?>">
                                  <?php foreach($iselc_val as $selc_val) {?>
                                  <option value="<?php echo $selc_val->attributes_select_value_id?>" <?php if(isset($attribute_info->attribute_value)) {if($attribute_info->attribute_value==$selc_val->attributes_select_value_id):?> selected="selected"<?php endif; }?>><?php echo $selc_val->select_label?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } else if($mattribute->attribute_type == 'multiselect'){?>
                            <?php $multiselect_values = explode(',',$attribute_info->attribute_value);?>
                            <div class="col-md-4">
                            <?php $imulti_selc_val = $this->Custom_fields_model->get_attribute_selection_values($mattribute->custom_field_id);?>
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                                <select multiple="multiple" class="form-control" name="<?php echo $mattribute->attribute;?>[]" data-plugin="select_tat" data-placeholder="<?php echo $mattribute->attribute_label;?>">
                                  <?php foreach($imulti_selc_val as $multi_selc_val) {?>
                                  <option value="<?php echo $multi_selc_val->attributes_select_value_id?>" <?php if(in_array($multi_selc_val->attributes_select_value_id,$multiselect_values)):?> selected <?php endif;?>><?php echo $multi_selc_val->select_label?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php } else if($mattribute->attribute_type == 'textarea'){?>
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                                <input class="form-control" placeholder="<?php echo $mattribute->attribute_label;?>" name="<?php echo $mattribute->attribute;?>" type="text" value="<?php echo $attr_val;?>">
                              </div>
                            </div>
                            <?php } else if($mattribute->attribute_type == 'fileupload'){?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?>
                                <?php if($attr_val!=''):?><a href="<?php echo site_url('admin/download');?>?type=custom_files&filename=<?php echo $attr_val;?>"><?php echo $this->lang->line('tat_download');?></a>
                                <?php endif;?>
                                </label>
                                <input class="form-control-file" name="<?php echo $mattribute->attribute;?>" type="file">
                              </div>
                            </div>
                            <?php } else { ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="<?php echo $mattribute->attribute;?>"><?php echo $mattribute->attribute_label;?></label>
                                <input class="form-control" placeholder="<?php echo $mattribute->attribute_label;?>" name="<?php echo $mattribute->attribute;?>" type="text" value="<?php echo $attr_val;?>">
                              </div>
                            </div>
                            <?php }	?>
                            <?php endforeach;?>
                          </div>
                          <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_save'))); ?> </div>
                        </div>
                        <?php echo form_close(); ?> </div>                   
                   
                    </div>

                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="contacts" style="display:none;">
                      <div class="box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> <?php echo $this->lang->line('tat_list_all');?> <?php echo $this->lang->line('tat_e_details_contacts');?> </h3>
                        </div>
                        <div class="box-body">
                          <div class="box-datatable table-responsive">
                            <table class="table table-striped table-bordered dataTable" id="tat_table_contact" style="width:100%;">
                              <thead>
                                <tr>
                                  <th><?php echo $this->lang->line('tat_action');?></th>
                                  <th><?php echo $this->lang->line('tat_employees_full_name');?></th>
                                  <th><?php echo $this->lang->line('tat_e_details_relation');?></th>
                                  <th><?php echo $this->lang->line('dashboard_email');?></th>
                                  <th><?php echo $this->lang->line('tat_e_details_mobile');?></th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('tat_add_new');?> <?php echo $this->lang->line('tat_e_details_contact');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'contact_info', 'id' => 'contact_info', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'ADD');?>
                        <?php echo form_open('admin/employees/contact_info', $attributes, $hidden);?>
                        <?php
                          $data_usr1 = array(
                            'type'  => 'hidden',
                            'name'  => 'user_id',
                            'id'    => 'user_id',
                            'value' => $user_id,
                        );
                        echo form_input($data_usr1);
                        ?>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label for="relation"><?php echo $this->lang->line('tat_e_details_relation');?><i class="tatari-asterisk">*</i></label>
                              <select class="form-control" name="relation" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_select_one');?>">
                                <option value=""><?php echo $this->lang->line('tat_select_one');?></option>
                                <option value="Self"><?php echo $this->lang->line('tat_self');?></option>
                                <option value="Parent"><?php echo $this->lang->line('tat_parent');?></option>
                                <option value="Spouse"><?php echo $this->lang->line('tat_spouse');?></option>
                                <option value="Child"><?php echo $this->lang->line('tat_child');?></option>
                                <option value="Sibling"><?php echo $this->lang->line('tat_sibling');?></option>
                                <option value="In Laws"><?php echo $this->lang->line('tat_in_laws');?></option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <label for="work_email" class="control-label"><?php echo $this->lang->line('dashboard_email');?><i class="tatari-asterisk">*</i></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_work');?>" name="work_email" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label>
                                <input type="checkbox" class="minimal" value="1" id="is_primary" name="is_primary">
                                <?php echo $this->lang->line('tat_e_details_pcontact');?></span> </label>
                              &nbsp;
                              <label>
                                <input type="checkbox" class="minimal" value="1" id="is_dependent" name="is_dependent">
                                <?php echo $this->lang->line('tat_e_details_dependent');?></span> </label>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_personal');?>" name="personal_email" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label for="name" class="control-label"><?php echo $this->lang->line('tat_name');?><i class="tatari-asterisk">*</i></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_name');?>" name="contact_name" type="text">
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group" id="designation_ajax">
                              <label for="address_1" class="control-label"><?php echo $this->lang->line('tat_address');?></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_address_1');?>" name="address_1" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label for="work_phone"><?php echo $this->lang->line('tat_phone');?><i class="tatari-asterisk">*</i></label>
                              <div class="row">
                                <div class="col-md-8">
                                  <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_work');?>" name="work_phone" type="text">
                                </div>
                                <div class="col-md-4">
                                  <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_phone_ext');?>" name="work_phone_extension" type="text">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_address_2');?>" name="address_2" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_mobile');?>" name="mobile_phone" type="text">
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-5">
                                  <input class="form-control" placeholder="<?php echo $this->lang->line('tat_city');?>" name="city" type="text">
                                </div>
                                <div class="col-md-4">
                                  <input class="form-control" placeholder="<?php echo $this->lang->line('tat_state');?>" name="state" type="text">
                                </div>
                                <div class="col-md-3">
                                  <input class="form-control" placeholder="<?php echo $this->lang->line('tat_zipcode');?>" name="zipcode" type="text">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_home');?>" name="home_phone" type="text">
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="form-group">
                              <select name="country" id="select2-demo-6" class="form-control" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_country');?>">
                                <option value=""></option>
                                <?php foreach($all_countries as $country) {?>
                                <option value="<?php echo $country->country_id;?>"> <?php echo $country->country_name;?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_save'))); ?> </div>
                        <?php echo form_close(); ?> </div>
                    </div>
                   
                    <div class="tab-pane current-tab <?php echo $get_animate;?>" id="change-password" style="display:none;">
                      <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line('header_change_password');?> </h3>
                      </div>
                      <div class="box-body pb-2">
                        <?php $attributes = array('name' => 'e_change_password', 'id' => 'e_change_password', 'autocomplete' => 'off');?>
                        <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                        <?php echo form_open('admin/employees/change_password', $attributes, $hidden);?>
                        <?php
                            $data_usr5 = array(
                              'type'  => 'hidden',
                              'name'  => 'user_id',
                              'value' => $user_id,
                          );
                          echo form_input($data_usr5);
                          ?>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="new_password"><?php echo $this->lang->line('tat_e_details_enpassword');?><i class="tatari-asterisk">*</i></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_enpassword');?>" name="new_password" type="text">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="new_password_confirm" class="control-label"><?php echo $this->lang->line('tat_e_details_ecnpassword');?><i class="tatari-asterisk">*</i></label>
                              <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_ecnpassword');?>" name="new_password_confirm" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <div class="form-actions"> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_save'))); ?> </div>
                            </div>
                          </div>
                        </div>
                        <?php echo form_close(); ?> </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane" id="tat_profile_picture"  >
          <div class="box-body">
            <div class="row no-gutters row-bordered row-border-light">
              <div class="col-md-12">
                <div class="tab-content">
                  <div class="tab-pane  <?php echo $get_animate;?> active" id="profile-picture">
                    <div class="box-body pb-2">
                      <?php $attributes = array('name' => 'profile_picture', 'id' => 'f_profile_picture', 'autocomplete' => 'off');?>
                      <?php $hidden = array('u_profile_picture' => 'UPDATE');?>
                      <?php echo form_open_multipart('admin/employees/profile_picture', $attributes, $hidden);?>
                      <?php
						  $data_usr = array(
								'type'  => 'hidden',
								'name'  => 'user_id',
								'id'    => 'user_id',
								'value' => $user_id,
						 );
						echo form_input($data_usr);
					  ?>
                      <?php
						  $data_usr = array(
								'type'  => 'hidden',
								'name'  => 'session_id',
								'id'    => 'session_id',
								'value' => $session['user_id'],
						 );
						echo form_input($data_usr);
					  ?>
                      <div class="bg-white">
                        <div class="row">
                          <div class="col-md-12">
                            <div class='form-group'>
                              <fieldset class="form-group">
                                <label for="logo"><?php echo $this->lang->line('tat_browse');?><i class="tatari-asterisk">*</i></label>
                                <input type="file" class="form-control-file" id="p_file" name="p_file">
                                <small><?php echo $this->lang->line('tat_e_details_picture_type');?></small>
                              </fieldset>
                              <?php if($profile_picture!='' && $profile_picture!='no file') {?>
                              <img src="<?php echo base_url().'uploads/profile/'.$profile_picture;?>" width="50px" style="margin-left:20px;" id="u_file">
                              <?php } else {?>
                              <?php if($gender=='Male') { ?>
                              <?php $de_file = base_url().'uploads/profile/default_male.jpg';?>
                              <?php } else { ?>
                              <?php $de_file = base_url().'uploads/profile/default_female.jpg';?>
                              <?php } ?>
                              <img src="<?php echo $de_file;?>" width="50px" style="margin-left:20px;" id="u_file">
                              <?php } ?>
                              <?php if($profile_picture!='' && $profile_picture!='no file') {?>
                              <br />
                              <label>
                                <input type="checkbox" class="minimal" value="1" id="remove_profile_picture" name="remove_profile_picture">
                                <?php echo $this->lang->line('tat_e_details_remove_pic');?></span> </label>
                              <?php } else {?>
                              <div id="remove_file" style="display:none;">
                                <label>
                                  <input type="checkbox" class="minimal" value="1" id="remove_profile_picture" name="remove_profile_picture">
                                  <?php echo $this->lang->line('tat_e_details_remove_pic');?></span> </label>
                              </div>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-action box-footer"> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_save'))); ?> </div>
                      </div>
                      <?php echo form_close(); ?> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
