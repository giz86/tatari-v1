<?php
$session = $this->session->userdata('username');
$user = $this->Tat_model->read_employee_info($session['user_id']);
?>

<div class="box-widget widget-user-2"> 

  <div class="widget-user-header">
    <h4 class="widget-user-username welcome-tatari-user"><?php echo $this->lang->line('tat_title_wcb');?>, <?php echo $user[0]->first_name.' '.$user[0]->last_name;?>!</h4>
    <h5 class="widget-user-desc welcome-tatari-user-text"><?php echo $this->lang->line('tat_title_today_is');?> <?php echo date('l, j F Y');?></h5>
  </div>
</div>

<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp-tatari-4 stamp-tatari-md bg-tatari-secondary mr-3">
                    <i class="fa fa-user"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><a href="<?php echo site_url('admin/employees');?>"><?php echo $this->Employees_model->get_total_employees();?> <small><?php echo $this->lang->line('tat_people');?></small></a></b></h5>
                    <small class="text-muted"><span class="badge badge-info"> <?php echo $this->lang->line('tat_employees_active');?> <?php echo active_employees();?> </span><span class="ml-2"> <span class="badge bg-red"> <?php echo $this->lang->line('tat_employees_inactive');?> <?php echo inactive_employees();?> </span></span></small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp-tatari-4 stamp-tatari-md bg-tatari-success-4 mr-3">
                    <i class="fa fa-lock"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><a href="<?php echo site_url('admin/roles');?>"> <?php echo $this->lang->line('tat_roles');?> <small><?php echo $this->lang->line('tat_permission');?></small></a></b></h5>
                    <small class="text-muted"><?php echo $this->lang->line('left_set_roles');?></small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp-tatari-4 stamp-tatari-md bg-tatari-danger-4 mr-3">
                    <i class="fa fa-history"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><a href="">Attendance <small></small></a></b></h5>
                    <small class="text-muted">View Records</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card p-3">
            <div class="d-flex align-items-center">
                <span class="stamp-tatari-4 stamp-tatari-md bg-tatari-warning-4 mr-3">
                    <i class="fa fa-money"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><a href="">Finances<small></small></a></b></h5>
                    <small class="text-muted">View Finances</small>
                </div>
            </div>
        </div>
    </div>
</div>


