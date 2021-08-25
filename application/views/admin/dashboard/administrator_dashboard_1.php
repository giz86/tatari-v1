<?php
$session = $this->session->userdata('username');
$user = $this->Tat_model->read_employee_info($session['user_id']);
?>
<?php $get_animate = $this->Tat_model->get_content_animate();?>
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
                <span class="stamp-tatari-4 stamp-tatari-md bg-tatari-danger-4 mr-3">
                    <i class="fa fa-history"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><a href="<?php echo site_url('admin/attendance');?>"><?php echo $this->lang->line('left_attendances');?><small></small></a></b></h5>
                    <small class="text-muted">View Records</small>
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
                <span class="stamp-tatari-4 stamp-tatari-md bg-tatari-warning-4 mr-3">
                    <i class="fa fa-money"></i>
                </span>
                <div>
                    <h5 class="mb-1"><b><a href="<?php echo site_url('admin//finance/transactions');?>"><?php echo $this->lang->line('tat_acc_transactions');?><small></small></a></b></h5>
                    <small class="text-muted"><?php echo $this->lang->line('tat_acc_view_transactions');?></small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row <?php echo $get_animate;?>">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">EMPDE <?php echo $this->lang->line('tat_employee_department_txt');?></h3>
      </div>
      <div class="box-body">
        <div class="box-block">
          <div class="col-md-7">
            <div class="overflow-scrolls" style="overflow:auto; height:200px;">
              <div class="table-responsive">
                <table class="table mb-0 table-dashboard">
                  <tbody>
                    <?php $c_color = array('#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC','#00A5A8','#FF4558','#16D39A','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC');?>
                    <?php $j=0;foreach($this->Department_model->all_departments() as $department) { ?>
                    <?php
                            $condition = "department_id =" . "'" . $department->department_id . "'";
                            $this->db->select('*');
                            $this->db->from('tat_employees');
                            $this->db->where($condition);
                            $query = $this->db->get();
                            
                            if ($query->num_rows() > 0) {
                          ?>
                    <tr>
                      <td><div style="width:4px;border:5px solid <?php echo $c_color[$j];?>;"></div></td>
                      <td><?php echo htmlspecialchars_decode($department->department_name);?> (<?php echo $query->num_rows();?>)</td>
                    </tr>
                    <?php $j++; } ?>
                    <?php  } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <canvas id="employee_department" height="200" width="" style="display: block;  height: 200px;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">EMPDE <?php echo $this->lang->line('tat_employee_designation_txt');?></h3>
      </div>
      <div class="box-body">
        <div class="box-block">
          <div class="col-md-7">
            <div class="overflow-scrolls" style="overflow:auto; height:200px;">
              <div class="table-responsive">
                <table class="table mb-0 table-dashboard">
                  <tbody>
                    <?php $c_color2 = array('#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED','#9932CC','#556B2F','#16D39A','#DC143C','#D2691E','#8A2BE2','#FF976A','#FF4558','#00A5A8','#6495ED');?>
                    <?php $k=0;foreach($this->Designation_model->all_designations() as $designation) { ?>
                    <?php
                              $condition1 = "designation_id =" . "'" . $designation->designation_id . "'";
                              $this->db->select('*');
                              $this->db->from('tat_employees');
                              $this->db->where($condition1);
                              $query1 = $this->db->get();
                              
                              if ($query1->num_rows() > 0) {
                            ?>
                    <tr>
                      <td><div style="width:4px;border:5px solid <?php echo $c_color2[$k];?>;"></div></td>
                      <td><?php echo htmlspecialchars_decode($designation->designation_name);?> (<?php echo $query1->num_rows();?>)</td>
                    </tr>
                    <?php $k++; } ?>
                    <?php  } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <canvas id="employee_designation" height="200" width="" style="display: block; height: 200px;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$current_month = date('Y-m-d');
$working = $this->Tat_model->current_month_day_attendance($current_month);
$query = $this->Tat_model->all_employees_status();
$total = $query->num_rows();
// absent
$abs = $total - $working;
?>
<?php
$emp_abs = $abs / $total * 100;
$emp_work = $working / $total * 100;
?>
<?php
$emp_abs = $abs / $total * 100;
$emp_work = $working / $total * 100;
?>

<div class="row row-card-no-pd mt--2 <?php echo $get_animate;?>">
    <div class="col-12 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5><span><?php echo $this->lang->line('tat_tatari_absent_today');?></span></h5>
                        <p class="text-muted"><?php echo $this->lang->line('tat_absent');?></p>
                    </div>
                    <h3 class="text-info fw-bold"><?php echo $abs;?></h3>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-info w-75" role="progressbar" aria-valuenow="<?php echo $this->Tat_model->set_percentage($emp_abs);?>" aria-valuemin="8" aria-valuemax="100" style="width: <?php echo $this->Tat_model->set_percentage($emp_abs);?>%"></div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <p class="text-muted mb-0"><?php echo $this->lang->line('tat_tatari_absent_status');?></p>
                    <p class="text-muted mb-0"><?php echo $this->Tat_model->set_percentage($emp_abs);?>%</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5><span><?php echo $this->lang->line('tat_tatari_present_today');?></span></h5>
                        <p class="text-muted"><?php echo $this->lang->line('tat_emp_working');?></p>
                    </div>
                    <h3 class="text-info fw-bold"><?php echo $working;?></h3>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-info w-75" role="progressbar" aria-valuenow="<?php echo $this->Tat_model->set_percentage($emp_work);?>" aria-valuemin="8" aria-valuemax="100" style="width: <?php echo $this->Tat_model->set_percentage($emp_work);?>%"></div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <p class="text-muted mb-0"><?php echo $this->lang->line('tat_tatari_present_status');?></p>
                    <p class="text-muted mb-0"><?php echo $this->Tat_model->set_percentage($emp_work);?>%</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt--2 <?php echo $get_animate;?>">
<div class="col-md-12">
    <div class="card full-height">
        <div class="card-body">
            <div class="card-title"><?php echo $this->lang->line('tat_tatari_paid_salaries_account_balances');?></div>
            <?php $exp_am = $this->Expense_model->get_total_expenses();?>
            <?php $all_sal = total_salaries_paid();?>
            <div class="row py-3">
                <div class="col-md-4 d-flex flex-column justify-content-around">        
                        <h6 class="fw-bold text-uppercase text-info op-8"><?php echo $this->lang->line('dashboard_account_balances');?></h6>
                        <h3 class="fw-bold"><?php echo $this->Tat_model->currency_sign(total_account_balances());?></h3>
                </div>
                <div class="col-md-4 d-flex flex-column justify-content-around">        
                        <h6 class="fw-bold text-uppercase text-danger op-8"><?php echo $this->lang->line('dashboard_total_salaries');?></h6>
                        <h3 class="fw-bold"><?php echo $this->Tat_model->currency_sign($all_sal);?></h3>
                </div>
                <div class="col-md-4 d-flex flex-column justify-content-around">
                    <h6 class="fw-bold text-uppercase text-success op-8"><?php echo $this->lang->line('dashboard_total_expenses');?></h6>
                        <h3 class="fw-bold"><?php echo $this->Tat_model->currency_sign($exp_am[0]->exp_amount);?></h3>
                </div>
            </div>
        </div>
    </div>
</div>
</div>





