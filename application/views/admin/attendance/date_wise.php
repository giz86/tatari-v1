<?php
/* Date Wise Attendance view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $role_resources_ids = $this->Tat_model->user_role_resource(); ?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>
<?php $user = $this->Tat_model->read_user_info($session['user_id']);?>

<div class="box mb-4 <?php echo $get_animate;?>">
  <div class="box-body">
    <div class="row">
      <div class="col-md-12">
        <?php $attributes = array('name' => 'attendance_datewise_report', 'id' => 'attendance_datewise_report', 'autocomplete' => 'off', 'class' => 'add form-tat');?>
        <?php $hidden = array('euser_id' => $session['user_id']);?>
        <?php echo form_open('admin/attendance/datewise_attendance_list', $attributes, $hidden);?>
        <?php
				$data = array(
				  'type'        => 'hidden',
				  'name'        => 'user_id',
				  'id'          => 'user_id',
				  'value'       => $session['user_id'],
				  'class'       => 'form-control',
				);
				echo form_input($data);
				?>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label for="tat_start_date"><?php echo $this->lang->line('tat_start_date');?></label>
              <input class="form-control attendance_date" placeholder="<?php echo $this->lang->line('tat_select_date');?>" readonly id="start_date" name="start_date" type="text" value="<?php echo date('Y-m-d');?>">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="tat_end_date"><?php echo $this->lang->line('tat_end_date');?></label>
              <input class="form-control attendance_date" placeholder="<?php echo $this->lang->line('tat_select_date');?>" readonly id="end_date" name="end_date" type="text" value="<?php echo date('Y-m-d');?>">
            </div>
          </div>
          <?php if(!in_array('381',$role_resources_ids) && $user[0]->user_role_id!=1) {?>
          <div class="col-md-2">
            <div class="form-group"><label for="tat_start_date">&nbsp;</label><br />
              <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('tat_get');?></button>
            </div>
          </div>
          <?php } ?>
        </div>
       

        <?php if($user[0]->user_role_id==1 || in_array('381',$role_resources_ids)) {?>
        <div class="row">
          <div class="col-md-5">
            <?php if($user[0]->user_role_id==1){?>
            <div class="form-group">
              <select class="form-control" name="company_id" id="aj_company" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_company');?>">
                <option value=""></option>
                <?php foreach($get_all_companies as $company) {?>
                <option value="<?php echo $company->company_id?>"><?php echo $company->name?></option>
                <?php } ?>
              </select>
            </div>
            <?php } else {?>
            <div class="form-group">
              <select class="form-control" name="company_id" id="aj_company" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('left_company');?>">
                <option value=""></option>
                <?php foreach($get_all_companies as $company) {?>
					<?php if($user[0]->company_id == $company->company_id):?>
                    <option value="<?php echo $company->company_id?>"><?php echo $company->name?></option>
                    <?php endif;?>
                <?php } ?>
              </select>
            </div>
            <?php } ?>
          </div>
          <div class="col-md-5">
            <div class="form-group" id="employee_ajax">
              <select name="employee_id" id="employee_id" class="form-control" data-plugin="select_tat" data-placeholder="<?php echo $this->lang->line('tat_choose_an_employee');?>" required>
                <option value="">All</option>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group"> &nbsp;
              <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('tat_get');?></button>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php echo form_close(); ?> </div>
    </div>
  </div>
</div>


<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo $this->lang->line('dashboard_attendance');?></h3>
  </div>
  <div class="box-body">
  <div class="box-datatable table-responsive">
    <table class="datatables-demo table table-striped table-bordered" id="tat_table">
      <thead>
        <tr>
          <th colspan="1"><?php
          //  echo $this->lang->line('tat_hr_info');
           ?></th>
          <th colspan="10"><?php echo $this->lang->line('tat_attendance_report');?></th>
        </tr>
        <tr>
          <th style="width:120px;"><?php echo $this->lang->line('tat_employee');?></th>
          <!-- <th style="width:100px;"><?php echo $this->lang->line('left_company');?></th> -->
          <th style="width:120px;"><?php echo $this->lang->line('dashboard_tat_status');?></th>
          <th style="width:120px;"><?php echo $this->lang->line('tat_e_details_date');?></th>
          <th style="width:120px;"><?php echo $this->lang->line('dashboard_clock_in');?></th>
          <th style="width:120px;"><?php echo $this->lang->line('dashboard_clock_out');?></th>
          <th style="width:120px;"><?php echo $this->lang->line('dashboard_late');?></th>
          <th style="width:120px;"><?php echo $this->lang->line('dashboard_early_leaving');?></th>
          <th style="width:120px;"><?php echo $this->lang->line('dashboard_overtime');?></th>
          <th style="width:120px;"><?php echo $this->lang->line('dashboard_total_work');?></th>
          <th style="width:120px;"><?php echo $this->lang->line('dashboard_total_rest');?></th>
        </tr>
      </thead>
    </table>
  </div>
  </div>
</div>
