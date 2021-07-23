<?php
/*
* Designation View
*/
$session = $this->session->userdata('username');
?>
<?php $system = $this->Tat_model->read_setting_info(1);?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>
<?php $role_resources_ids = $this->Tat_model->user_role_resource(); ?>
<?php if(in_array('243',$role_resources_ids)) {?>
<?php $user_info = $this->Tat_model->read_user_info($session['user_id']);?>
<div class="row m-b-1 <?php echo $get_animate;?>">
  <div class="col-md-4">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"> <?php echo $this->lang->line('tat_add_new');?> <?php echo $this->lang->line('tat_designation');?> </h3>
      </div>
      <div class="box-body">
      <?php $attributes = array('name' => 'add_designation', 'id' => 'tat-form', 'autocomplete' => 'off');?>
      <?php $hidden = array('user_id' => $session['user_id']);?>
      <?php echo form_open('admin/designation/add_designation', $attributes, $hidden);?>
        <?php if($user_info[0]->user_role_id==1){ ?>
        <div class="form-group">
          <label for="first_name"><?php echo $this->lang->line('left_company');?></label>
          <select class="form-control" name="company_id" id="aj_company" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_company');?>">
            <option value=""></option>
            <?php foreach($get_all_companies as $company) {?>
            <option value="<?php echo $company->company_id?>"><?php echo $company->name?></option>
            <?php } ?>
          </select>
        </div>
        <?php } else { ?>
        <?php $ecompany_id = $user_info[0]->company_id;?>
        <div class="form-group">
          <label for="first_name"><?php echo $this->lang->line('left_company');?></label>
          <select class="form-control" name="company_id" id="aj_company" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_company');?>">
            <option value=""></option>
            <?php foreach($get_all_companies as $company) {?>
				<?php if($ecompany_id == $company->company_id):?>
                <option value="<?php echo $company->company_id?>"><?php echo $company->name?></option>
                <?php endif;?>
            <?php } ?>
          </select>
        </div>
        <?php } ?>
        <div class="form-group" id="department_ajax">
          <label for="name"><?php echo $this->lang->line('tat_hr_main_department');?></label>
          <select disabled="disabled" class="select2" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_select_department');?>" name="department_id">
            <option value=""></option>
          </select>
        </div>
        <?php if($system[0]->is_active_sub_departments=='yes'){?>
        <div class="form-group" id="subdepartment_ajax">
          <label for="name"><?php echo $this->lang->line('tat_hr_sub_department');?></label>
          <select disabled="disabled" class="select2" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_select_department');?>" name="subdepartment_id">
            <option value=""></option>
          </select>
        </div>
        <?php } else {?>
        <input type="hidden" name="subdepartment_id" value="0" />
        <?php } ?>
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('tat_designation_name');?></label>
          <input type="text" class="form-control" name="designation_name" placeholder="<?php echo $this->lang->line('tat_designation_name');?>">
        </div>
      
      <div class="form-actions box-footer">
        <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('tat_save');?> </button>
      </div>
      <?php echo form_close(); ?> </div></div>
  </div>
  <?php $colmdval = 'col-md-8';?>
  <?php } else {?>
  <?php $colmdval = 'col-md-12';?>
  <?php } ?>
  <div class="<?php echo $colmdval;?>">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"> <?php echo $this->lang->line('tat_list_all');?> <?php echo $this->lang->line('tat_designations');?> </h3>
      </div>
      <div class="box-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered" id="tat_table">
            <thead>
              <tr>
                <th style="width:65px;"><?php echo $this->lang->line('tat_action');?></th>
                <th><?php echo $this->lang->line('tat_designation');?></th>
                <th><?php echo $this->lang->line('left_company');?></th>
                <!--<th><?php echo $this->lang->line('tat_department');?></th>
                <th><?php echo $this->lang->line('tat_hr_sub_department');?></th>-->
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
