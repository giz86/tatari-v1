<?php $session = $this->session->userdata('username');?>
<?php $user = $this->Tat_model->read_user_info($session['user_id']);?>
<?php $system = $this->Tat_model->read_setting_info(1);?>

<?php if($profile_picture!='' && $profile_picture!='no file') {?>
<?php $de_file = base_url().'uploads/profile/'.$profile_picture;?>
<?php } else {?>
<?php if($gender=='Male') { ?>
<?php $de_file = base_url().'uploads/profile/default_male.jpg';?>
<?php } else { ?>
<?php $de_file = base_url().'uploads/profile/default_female.jpg';?>
<?php } ?>
<?php } ?>


<?php $full_name = $user[0]->first_name.' '.$user[0]->last_name;?>
<?php $designation = $this->Designation_model->read_designation_information($user[0]->designation_id);?>
<?php
	if(!is_null($designation)){
		$designation_name = $designation[0]->designation_name;
	} else {
		$designation_name = '--';	
	}
	$leave_user = $this->Tat_model->read_user_info($session['user_id']);
?>

<?php $role_resources_ids = $this->Tat_model->user_role_resource(); ?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>

<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom mb-4">

      <ul class="nav nav-tabs">
        <li class="nav-item active"> <a class="nav-link active show" data-toggle="tab" href="#tat_general"><?php echo $this->lang->line('tat_general');?></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tat_employee_set_salary"><?php echo $this->lang->line('tat_salary_title');?></a> </li>
     </ul>

     <d iv class="tab-content">
        <div class="tab-pane <?php echo $get_animate;?> active" id="tat_general">
        	<div class="row">
              <div class="col-md-3 <?php echo $get_animate;?>"> 
                
               <!-- User Basic Info Profile -->
                <div class="box box-primary">
                  <div class="box-body box-profile"> <a class="nav-tabs-link" href="#profile-picture" data-profile="2" data-profile-block="profile_picture" data-toggle="tab" aria-expanded="true" id="user_profile_2"> <img class="profile-user-img img-responsive img-circle" src="<?php echo $de_file;?>" alt="<?php echo $full_name;?>"></a>
                    <h3 class="profile-username text-center"><?php echo $full_name;?></h3>
                    <p class="text-muted text-center"><?php echo $designation_name;?></p>
                    <div class="list-group">
                   
                <a class="list-group-item-profile list-group-item list-group-item-action nav-tabs-link" href="#user_basic_info" data-profile="1" data-profile-block="user_basic_info" data-toggle="tab" aria-expanded="true" id="user_profile_1"> <i class="fa fa-user"></i> <?php echo $this->lang->line('tat_e_details_basic');?> </a>
               
                <a class="list-group-item-profile list-group-item list-group-item-action nav-tabs-link" href="#profile-picture" data-profile="2" data-profile-block="profile_picture" data-toggle="tab" aria-expanded="true" id="user_profile_2"> <i class="fa fa-camera"></i> <?php echo $this->lang->line('tat_e_details_profile_picture');?> </a>
                
                 <a class="list-group-item-profile list-group-item list-group-item-action nav-tabs-link" href="#change_password" data-profile="14" data-profile-block="change_password" data-toggle="tab" aria-expanded="true" id="user_profile_14"> <i class="fa fa-key"></i> <?php echo $this->lang->line('tat_e_details_cpassword');?> </a></div>
                  </div>
                 
                </div>
              </div>


              <div class="col-md-9 current-tab <?php echo $get_animate;?>" id="user_basic_info"  aria-expanded="false">
                <?php $attributes = array('name' => 'basic_info', 'id' => 'basic_info', 'autocomplete' => 'off');?>
                <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                <?php echo form_open('admin/profile/user_basic_info/', $attributes, $hidden);?>
                <?php
                      $data_usr1 = array(
                            'type'  => 'hidden',
                            'name'  => 'user_id',
                            'id'  => 'user_id',
                            'value' => $session['user_id'],
                       );
                         echo form_input($data_usr1);
                    ?>
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title"> <?php echo $this->lang->line('tat_e_details_basic_info');?> </h3>
                  </div>
                  <div class="box-body">
                    <div class="card-block">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="first_name"><?php echo $this->lang->line('tat_employee_first_name');?></label>
                            <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_first_name');?>" name="first_name" type="text" value="<?php echo $first_name;?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="last_name" class="control-label"><?php echo $this->lang->line('tat_employee_last_name');?></label>
                            <input class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_last_name');?>" name="last_name" type="text" value="<?php echo $last_name;?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="email" class="control-label"><?php echo $this->lang->line('dashboard_email');?></label>
                            <input class="form-control" placeholder="<?php echo $this->lang->line('dashboard_email');?>" name="email" type="text" value="<?php echo $email;?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="date_of_birth"><?php echo $this->lang->line('tat_employee_dob');?></label>
                            <input class="form-control date" readonly placeholder="<?php echo $this->lang->line('tat_employee_dob');?>" name="date_of_birth" type="text" value="<?php echo $date_of_birth;?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="gender" class="control-label"><?php echo $this->lang->line('tat_employee_gender');?></label>
                            <select class="form-control" name="gender" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_employee_gender');?>">
                              <option value="Male" <?php if($gender=='Male'):?> selected <?php endif; ?>><?php echo $this->lang->line('tat_gender_male');?></option>
                              <option value="Female" <?php if($gender=='Female'):?> selected <?php endif; ?>><?php echo $this->lang->line('tat_gender_female');?></option>
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
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="contact_no" class="control-label"><?php echo $this->lang->line('tat_contact_number');?></label>
                            <input class="form-control" placeholder="<?php echo $this->lang->line('tat_contact_number');?>" name="contact_no" type="text" value="<?php echo $contact_no;?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="address"><?php echo $this->lang->line('tat_employee_address');?></label>
                            <textarea class="form-control" placeholder="<?php echo $this->lang->line('tat_employee_address');?>" name="address" cols="30" rows="3" id="address"><?php echo $address;?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_save'))); ?> </div>
                    </div>
                  </div>
                </div>
                <?php echo form_close(); ?> </div>


                <!-- Profile Picture -->
              <div class="col-md-9 current-tab <?php echo $get_animate;?>" id="profile_picture" style="display:none;">
                <?php $attributes = array('name' => 'profile_picture', 'id' => 'f_profile_picture', 'autocomplete' => 'off');?>
                <?php $hidden = array('u_profile_picture' => 'UPDATE');?>
                <?php echo form_open_multipart('admin/employees/profile_picture/', $attributes, $hidden);?>
                <?php
                      $data_usr2 = array(
                            'type'  => 'hidden',
                            'name'  => 'user_id',
                            'id'  => 'user_id',
                            'value' => $session['user_id'],
                     );
                    echo form_input($data_usr2);
                    ?>
                <?php
                    $data_usr3 = array(
                            'type'  => 'hidden',
                            'name'  => 'session_id',
                            'id'  => 'session_id',
                            'value' => $session['user_id'],
                     );
                    echo form_input($data_usr3);
                    ?>
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title"> <?php echo $this->lang->line('tat_e_details_profile_picture');?> </h3>
                  </div>
                  <div class="box-body">
                    <div class="card-block">
                      <div class="row">
                        <div class="col-md-12">
                          <div class='form-group'>
                            <fieldset class="form-group">
                              <label for="logo"><?php echo $this->lang->line('tat_browse');?></label>
                              <input type="file" class="form-control-file" id="p_file" name="p_file">
                              <small><?php echo $this->lang->line('tat_e_details_picture_type');?></small>
                            </fieldset>
                            <?php if($profile_picture!='' && $profile_picture!='no file') {?>
                            <img src="<?php echo site_url().'uploads/profile/'.$profile_picture;?>" width="50px" style="margin-left:20px;" id="u_file">
                            <?php } else {?>
                            <?php if($gender=='Male') { ?>
                            <?php $de_file = site_url().'uploads/profile/default_male.jpg';?>
                            <?php } else { ?>
                            <?php $de_file = site_url().'uploads/profile/default_female.jpg';?>
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
                      <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_save'))); ?> </div>
                    </div>
                  </div>
                </div>
                <?php echo form_close(); ?> </div>

         
          
                <!-- Change Password -->
              <div class="col-md-9 current-tab <?php echo $get_animate;?>" id="change_password" style="display:none;">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title"> <?php echo $this->lang->line('tat_e_details_cpassword');?> </h3>
                  </div>
                  <div class="box-body">
                    <div class="card-block">
                      <?php $attributes = array('name' => 'e_change_password', 'id' => 'e_change_password', 'autocomplete' => 'off');?>
                      <?php $hidden = array('u_basic_info' => 'UPDATE');?>
                      <?php echo form_open('admin/employees/change_password/', $attributes, $hidden);?>
                      <?php
                      $data_usr11 = array(
                            'type'  => 'hidden',
                            'name'  => 'user_id',
                            'value' => $session['user_id'],
                     );
                    echo form_input($data_usr11);
                    ?>
                      <?php if($this->input->get('change_password')):?>
                      <input type="hidden" id="change_pass" value="<?php echo $this->input->get('change_password');?>" />
                      <?php endif;?>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="new_password"><?php echo $this->lang->line('tat_e_details_enpassword');?></label>
                            <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_enpassword');?>" name="new_password" type="text">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="new_password_confirm" class="control-label"><?php echo $this->lang->line('tat_e_details_ecnpassword');?></label>
                            <input class="form-control" placeholder="<?php echo $this->lang->line('tat_e_details_ecnpassword');?>" name="new_password_confirm" type="text">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div class="form-actions box-footer"> <?php echo form_button(array('name' => 'tatari_form', 'type' => 'submit', 'class' => $this->Tat_model->form_button_class(), 'content' => '<i class="fa fa fa-check-square-o"></i> '.$this->lang->line('tat_save'))); ?> </div>
                          </div>
                        </div>
                      </div>
                      <?php echo form_close(); ?> </div>
                  </div>
                </div>
              </div>

            </div>
        </div>
                    
        <div class="tab-pane <?php echo $get_animate;?>" id="tat_employee_set_salary">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('tat_salary_title');?> </h3>
          </div>
          <div class="box-body pb-2">
            <div class="bg-white">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="wages_type"><?php echo $this->lang->line('tat_employee_type_wages');?></label><br />
                    <?php if($wages_type==1):?> <?php echo $this->lang->line('tat_payroll_basic_salary');?><?php endif;?>
                    <?php if($wages_type==2):?> <?php echo $this->lang->line('tat_employee_daily_wages');?><?php endif;?>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                  <label for="basic_salary"><?php echo $this->lang->line('tat_salary_title');?></label><br />
                    <?php echo $this->Tat_model->currency_sign($basic_salary);?>
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
     

