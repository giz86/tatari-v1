<?php
$session = $this->session->userdata('username');
$theme = $this->Tat_model->read_theme_info(1);

// Layout Formatting
if($theme[0]->right_side_icons=='true') {
	$icons_right = 'expanded menu-icon-right';
} else {
	$icons_right = '';
}
if($theme[0]->bordered_menu=='true') {
	$menu_bordered = 'menu-bordered';
} else {
	$menu_bordered = '';
}
$user_info = $this->Tat_model->read_user_info($session['user_id']);
if($user_info[0]->is_active!=1) {
	redirect('admin/');
}
$role_user = $this->Tat_model->read_user_role_info($user_info[0]->user_role_id);
if(!is_null($role_user)){
	$role_resources_ids = explode(',',$role_user[0]->role_resources);
} else {
	$role_resources_ids = explode(',',0);	
}
?>

<?php $system = $this->Tat_model->read_setting_info(1);?>
<?php $arr_mod = $this->Tat_model->select_module_class($this->router->fetch_class(),$this->router->fetch_method()); ?>
<?php 
if($theme[0]->sub_menu_icons != ''){
	$submenuicon = $theme[0]->sub_menu_icons;
} else {
	$submenuicon = 'fa-circle-o';
}
?>


<?php  if($user_info[0]->profile_picture!='' && $user_info[0]->profile_picture!='no file') {?>
<?php $cpimg = base_url().'uploads/profile/'.$user_info[0]->profile_picture;?>
<?php } else {?>
<?php  if($user_info[0]->gender=='Male') { ?>
<?php 	$de_file = base_url().'uploads/profile/default_male.png';?>
<?php } else { ?>
<?php 	$de_file = base_url().'uploads/profile/default_female.png';?>
<?php } ?>
<?php $cpimg = $de_file;?>
<?php  } ?>


<section class="sidebar">
  <!-- Sidebar user panel -->
  
  <div class="user-panel">
    <div class="image text-center"><img src="<?php echo $cpimg;?>" class="img-circle" alt="<?php echo $user_info[0]->first_name. ' '.$user_info[0]->last_name;?>"> </div>
    <div class="info">
      <p><?php echo $user_info[0]->first_name. ' '.$user_info[0]->last_name;?></p>
      <a href="<?php echo site_url('admin/profile');?>"><i class="fa fa-user"></i></a>
      <a href="<?php echo site_url('admin/logout');?>"><i class="fa fa-power-off"></i></a> </div>
  </div>

  

  <ul class="sidebar-menu" data-widget="tree"> 
    <li class="<?php if(!empty($arr_mod['active']))echo $arr_mod['active'];?>"> <a href="<?php echo site_url('admin/dashboard');?>"> <i class="fa fa-dashboard"></i> <span><?php echo $this->lang->line('dashboard_title');?></span> </a> </li>
   
    
    <li class="<?php if(!empty($arr_mod['adm_open']))echo $arr_mod['adm_open'];?> treeview"> <a href="#"> <i class="fa fa-building"></i> <span><?php echo $this->lang->line('left_organization');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">

        <?php if(in_array('5',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['com_active']))echo $arr_mod['com_active'];?>"><a href="<?php echo site_url('admin/company')?>"><i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_company');?></a></li>
        <?php } ?>

        <?php if(in_array('6',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['loc_active']))echo $arr_mod['loc_active'];?>"><a href="<?php echo site_url('admin/location');?>"><i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_location');?></a></li>
        <?php } ?>

        <?php if(in_array('3',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['dep_active']))echo $arr_mod['dep_active'];?>"><a href="<?php echo site_url('admin/department');?>"><i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_department');?></a></li>
        <?php } ?>

        <?php if(in_array('3',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['sub_departments_active']))echo $arr_mod['sub_departments_active'];?>"><a href="<?php echo site_url('admin/department/sub_departments');?>"><i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_hr_sub_departments');?></a></li>
        <?php } ?>

        <?php if(in_array('4',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['des_active']))echo $arr_mod['des_active'];?>"><a href="<?php echo site_url('admin/designation');?>"><i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_designation');?></a></li>
        <?php } ?>

      </ul>
    </li>

    <?php if(in_array('13',$role_resources_ids) || in_array('88',$role_resources_ids) || in_array('92',$role_resources_ids) || in_array('22',$role_resources_ids) || in_array('23',$role_resources_ids) || in_array('393',$role_resources_ids) || in_array('400',$role_resources_ids) || $user_info[0]->user_role_id==1){?>
    <li class="<?php if(!empty($arr_mod['stff_open']))echo $arr_mod['stff_open'];?> treeview"> <a href="#"> <i class="fa fa-user"></i> <span><?php echo $this->lang->line('dashboard_employees');?></span> <span class="pull-right-container"> <span class="label label-danger pull-right"></span><i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">
        <?php if(in_array('13',$role_resources_ids)) { ?>
        <li class="<?php if(!empty($arr_mod['emp_active']))echo $arr_mod['emp_active'];?>"><a href="<?php echo site_url('admin/employees');?>"><i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('dashboard_employees');?></a></li>
        <?php } ?>
  
        <?php if(in_array('88',$role_resources_ids)) { ?>
          <li class="<?php if(!empty($arr_mod['hremp_active']))echo $arr_mod['hremp_active'];?>"><a href="<?php echo site_url('admin/employees/hr');?>"><i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_employees_directory');?></a></li>
          <?php } ?>

        <?php if($user_info[0]->user_role_id==1) { ?>
          <li class="<?php if(!empty($arr_mod['roles_active']))echo $arr_mod['roles_active'];?>"><a href="<?php echo site_url('admin/roles');?>"><i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_role_urole');?></a></li>
          <?php } ?>
          
        <?php if(in_array('22',$role_resources_ids)) { ?>
        <li class="<?php if(!empty($arr_mod['emp_ll_active']))echo $arr_mod['emp_ll_active'];?>"><a href="<?php echo site_url('admin/employees_last_login');?>"><i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_employees_last_login');?></a></li>
        <?php } ?>
      </ul>
    </li>

    <?php } ?>


    <?php  if(in_array('12',$role_resources_ids) || in_array('14',$role_resources_ids) || in_array('15',$role_resources_ids) || in_array('16',$role_resources_ids) || in_array('17',$role_resources_ids) || in_array('18',$role_resources_ids) || in_array('19',$role_resources_ids) || in_array('20',$role_resources_ids) || in_array('21',$role_resources_ids)){?>
    <li class="<?php if(!empty($arr_mod['emp_open']))echo $arr_mod['emp_open'];?> treeview"> <a href="#"> <i class="fa fa-futbol-o"></i> <span><?php echo $this->lang->line('tat_hr');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">
        
        <?php if(in_array('15',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['tra_active']))echo $arr_mod['tra_active'];?>"> <a href="<?php echo site_url('admin/transfers');?>" > <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_transfers');?> </a> </li>
        <?php } ?>

        <?php if(in_array('16',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['res_active']))echo $arr_mod['res_active'];?>"> <a href="<?php echo site_url('admin/resignation');?>" > <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_resignations');?> </a> </li>
        <?php } ?>

        <?php if(in_array('18',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['pro_active']))echo $arr_mod['pro_active'];?>"> <a href="<?php echo site_url('admin/promotion');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_promotions');?> </a> </li>
        <?php } ?>

        <?php if(in_array('19',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['compl_active']))echo $arr_mod['compl_active'];?>"> <a href="<?php echo site_url('admin/complaints');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_complaints');?> </a> </li>
        <?php } ?>

        <?php if(in_array('20',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['warn_active']))echo $arr_mod['warn_active'];?>"> <a href="<?php echo site_url('admin/warning');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_warnings');?> </a> </li>
        <?php } ?>

        <?php if(in_array('21',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['term_active']))echo $arr_mod['term_active'];?>"> <a href="<?php echo site_url('admin/termination');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_terminations');?> </a> </li>
        <?php } ?>
      </ul>
    </li>
    <?php } ?>


    <?php  if(in_array('27',$role_resources_ids) || in_array('28',$role_resources_ids) || in_array('29',$role_resources_ids) || in_array('30',$role_resources_ids) || in_array('31',$role_resources_ids) || in_array('7',$role_resources_ids) || in_array('8',$role_resources_ids) || in_array('46',$role_resources_ids) || in_array('401',$role_resources_ids)) {?>
    <li class="<?php if(!empty($arr_mod['attnd_open']))echo $arr_mod['attnd_open'];?> treeview"> <a href="#"> <i class="fa fa-clock-o"></i> <span><?php echo $this->lang->line('left_attendances');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">
      <?php if(in_array('28',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['attnd_active']))echo $arr_mod['attnd_active'];?>"> <a href="<?php echo site_url('admin/attendance/attendance');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_attendance');?> </a> </li>
        <?php } ?>
        <?php if(in_array('10',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['timesheet_active']))echo $arr_mod['timesheet_active'];?>"> <a href="<?php echo site_url('admin/attendance/');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_month_timesheet_title');?> </a> </li>
        <?php } ?>
        <?php if(in_array('29',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['dtwise_attnd_active']))echo $arr_mod['dtwise_attnd_active'];?>"> <a href="<?php echo site_url('admin/attendance/date_wise_attendance');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_date_wise_attendance');?> </a> </li>
        <?php } ?>
        <?php if(in_array('30',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['upd_attnd_active']))echo $arr_mod['upd_attnd_active'];?>"> <a href="<?php echo site_url('admin/attendance/update_attendance');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_update_attendance');?> </a> </li>
        <?php } ?>
        <?php if(in_array('7',$role_resources_ids)) { ?>
         <li class="sidenav-link <?php if(!empty($arr_mod['offsh_active']))echo $arr_mod['offsh_active'];?>"> <a href="<?php echo site_url('admin/attendance/work_shift');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_work_shifts');?> </a> </li>
        <?php } ?>
        <?php if(in_array('401',$role_resources_ids)) { ?>
          <li class="<?php if(!empty($arr_mod['overtime_request_act']))echo $arr_mod['overtime_request_act'];?>"><a href="<?php echo site_url('admin/overtime_request');?>"><i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_overtime_request');?></a></li>
          <?php } ?>
        <?php if(in_array('46',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['leave_active']))echo $arr_mod['leave_active'];?>"> <a href="<?php echo site_url('admin/attendance/leave');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_manage_leaves');?> </a> </li>
        <?php } ?>
        <?php if(in_array('31',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['import_attnd_active']))echo $arr_mod['import_attnd_active'];?>"> <a href="<?php echo site_url('admin/attendance/import');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_import_attendance');?> </a> </li>
        <?php } ?>
      </ul>
    </li>
    <?php } ?>

    <?php 
    if($system[0]->module_payroll=='yes'){
      ?>
    <?php  if(in_array('32',$role_resources_ids) || in_array('33',$role_resources_ids) || in_array('34',$role_resources_ids) || in_array('35',$role_resources_ids) || in_array('36',$role_resources_ids) || in_array('37',$role_resources_ids) || in_array('38',$role_resources_ids) || in_array('39',$role_resources_ids)) {?>
    <li class="<?php if(!empty($arr_mod['payrl_open']))echo $arr_mod['payrl_open'];?> treeview"> <a href="#"> <i class="fa fa-money"></i> <span><?php echo $this->lang->line('left_payroll');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">
        <?php if(in_array('37',$role_resources_ids)) { ?>
          <li class="sidenav-link <?php if(!empty($arr_mod['pay_his_active']))echo $arr_mod['pay_his_active'];?>"> <a href="<?php echo site_url('admin/payroll/payment_history');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_payment_history');?> </a> </li>
          <?php } ?>
          <?php if(in_array('36',$role_resources_ids)) { ?>
          <li class="sidenav-link <?php if(!empty($arr_mod['pay_generate_active']))echo $arr_mod['pay_generate_active'];?>"> <a href="<?php echo site_url('admin/payroll/generate_payslip');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_generate_payslip');?> </a> </li>
          <?php } ?>
      </ul>
    </li>
    <?php } ?>
    <?php 
  } 
  ?>


    <?php if($system[0]->module_recruitment=='true'){?>
      <?php  if(in_array('48',$role_resources_ids) || in_array('49',$role_resources_ids) || in_array('51',$role_resources_ids) || in_array('52',$role_resources_ids)) {?>
      <li class="<?php if(!empty($arr_mod['recruit_open']))echo $arr_mod['recruit_open'];?> treeview"> <a href="#"> <i class="fa fa-newspaper-o"></i> <span><?php echo $this->lang->line('left_vacancy');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <?php if(in_array('49',$role_resources_ids)) { ?>
          <li class="sidenav-link <?php if(!empty($arr_mod['jb_post_active']))echo $arr_mod['jb_post_active'];?>"> <a href="<?php echo site_url('admin/job_post');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_job_posts');?> </a> </li>
          <?php } ?>
          <?php if(in_array('51',$role_resources_ids)) { ?>
          <li class="sidenav-link <?php if(!empty($arr_mod['jb_cand_active']))echo $arr_mod['jb_cand_active'];?>"> <a href="<?php echo site_url('admin/job_candidates');?>"> <i class="fa <?php echo $submenuicon;?>"></i>
            <?php if(in_array('387',$role_resources_ids)) { ?>
            <?php echo $this->lang->line('left_job_candidates');?>
            <?php } else {?>
            <?php echo $this->lang->line('left_job_candidates');?>
            <?php } ?>
            </a> </li>
          <?php } ?>
        </ul>
      </li>
      <?php } ?>
      <?php } ?>


      <?php  if(in_array('110',$role_resources_ids) || in_array('111',$role_resources_ids) || in_array('112',$role_resources_ids) || in_array('113',$role_resources_ids) || in_array('114',$role_resources_ids) || in_array('115',$role_resources_ids)) {?>
    <li class="<?php if(!empty($arr_mod['reports_open']))echo $arr_mod['reports_open'];?> treeview"> <a href="#"> <i class="fa fa-bar-chart"></i> <span><?php echo $this->lang->line('tat_hr_report_title');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">

        <?php if(in_array('117',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['reports_employees_active']))echo $arr_mod['reports_employees_active'];?>"> <a href="<?php echo site_url('admin/reports/employees');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_hr_report_employees');?> </a> </li>
        <?php } ?>

        
        <?php if(in_array('112',$role_resources_ids)) { ?>
          <li class="sidenav-link <?php if(!empty($arr_mod['reports_employee_attendance_active']))echo $arr_mod['reports_employee_attendance_active'];?>"> <a href="<?php echo site_url('admin/reports/employee_attendance');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_hr_reports_attendance_employee');?> </a> </li>
          <?php } ?>

        <?php if(in_array('111',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['reports_payslip_active']))echo $arr_mod['reports_payslip_active'];?>"> <a href="<?php echo site_url('admin/reports/payslip');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_hr_reports_payslip');?> </a> </li>
        <?php } ?>
          
        <?php if(in_array('409',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['reports_leave_active']))echo $arr_mod['reports_leave_active'];?>"> <a href="<?php echo site_url('admin/reports/employee_leave');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_hr_report_leave_report');?> </a> </li>
        <?php } ?>

      </ul>
    </li>
    <?php } ?>



    <?php if($system[0]->module_finance=='true'){?>
    <?php if(in_array('71',$role_resources_ids) || in_array('72',$role_resources_ids) || in_array('73',$role_resources_ids)  ){?>

    <li class="<?php if(!empty($arr_mod['hr_acc_open1']))echo $arr_mod['hr_acc_open1'];?> treeview"> <a href="#"> <i class="fa fa-briefcase"></i> <span><?php echo $this->lang->line('tat_hr_ledger_accounts');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">

        <?php if(in_array('72',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['hr_bank_cash_active']))echo $arr_mod['hr_bank_cash_active'];?>"> <a href="<?php echo site_url('admin/finance/bank_cash');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_acc_account_list');?> </a> </li>
        <?php } ?>

        <?php if(in_array('73',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['hr_account_balances_active']))echo $arr_mod['hr_account_balances_active'];?>"> <a href="<?php echo site_url('admin/finance/account_balances');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_acc_account_balances');?> </a> </li>
        <?php } ?>
        
          </ul>
        </li>
        <?php } ?>
   
    </li>
    <?php } ?>
 


    <?php if($system[0]->module_finance=='true'){?>
    <?php if( in_array('79',$role_resources_ids) || in_array('80',$role_resources_ids) || in_array('81',$role_resources_ids) ){?>
    <li class="<?php if(!empty($arr_mod['hr_acc_open2']))echo $arr_mod['hr_acc_open2'];?> treeview"> <a href="#"> <i class="fa fa-users"></i> <span><?php echo $this->lang->line('tat_payer_payee');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">
        
        <?php if(in_array('80',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['hr_payees_active']))echo $arr_mod['hr_payees_active'];?>"> <a href="<?php echo site_url('admin/finance/payees');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_acc_payees');?> </a> </li>
        <?php } ?>

        <?php if(in_array('81',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['hr_payers_active']))echo $arr_mod['hr_payers_active'];?>"> <a href="<?php echo site_url('admin/finance/payers');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_acc_payers');?> </a> </li>
        <?php } ?>

          </ul>
        </li>
        <?php } ?>

    </li>
    <?php } ?>






    <?php if($system[0]->module_finance=='true'){?>
    <?php if(in_array('74',$role_resources_ids) || in_array('75',$role_resources_ids) || in_array('76',$role_resources_ids) || in_array('77',$role_resources_ids) || in_array('78',$role_resources_ids) ){?>
    <li class="<?php if(!empty($arr_mod['hr_acc_open3']))echo $arr_mod['hr_acc_open3'];?> treeview"> <a href="#"> <i class="fa fa-exchange"></i> <span><?php echo $this->lang->line('tat_fin_transactions');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">
        
        <?php if(in_array('75',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['hr_deposit_active']))echo $arr_mod['hr_deposit_active'];?>"> <a href="<?php echo site_url('admin/finance/deposit');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_hr_new_deposit');?> </a> </li>
        <?php } ?>

        <?php if(in_array('76',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['hr_account_expense_active']))echo $arr_mod['hr_account_expense_active'];?>"> <a href="<?php echo site_url('admin/finance/expense');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_hr_new_expense');?> </a> </li>
        <?php } ?>

        <?php if(in_array('77',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['hr_account_transfer_active']))echo $arr_mod['hr_account_transfer_active'];?>"> <a href="<?php echo site_url('admin/finance/transfer');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_acc_transfer');?> </a> </li>
        <?php } ?>
          
        <?php if(in_array('78',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['hr_account_transactions_active']))echo $arr_mod['hr_account_transactions_active'];?>"> <a href="<?php echo site_url('admin/finance/transactions');?>" > <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_acc_view_transactions');?> </a> </li>
        <?php } ?>

       
          </ul>
        </li>
        <?php } ?>
  
    </li>
    <?php } ?>



    <?php  if(in_array('87',$role_resources_ids) || in_array('119',$role_resources_ids) || in_array('410',$role_resources_ids) || in_array('415',$role_resources_ids) || in_array('121',$role_resources_ids) || in_array('330',$role_resources_ids)) {?>

     <li class="<?php if(!empty($arr_mod['hr_acc_open4']))echo $arr_mod['hr_acc_open4'];?> treeview"> <a href="#"> <i class="fa fa-tags"></i> <span><?php echo $this->lang->line('tat_bill_invoice');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">

        <?php if(in_array('121',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['hr_all_inv_active']))echo $arr_mod['hr_all_inv_active'];?>"> <a href="<?php echo site_url('admin/invoices/');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_invoices_title');?> </a> </li>
        <?php } ?>
       
        <?php if(in_array('330',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['hr_client_invoices_pay_active']))echo $arr_mod['hr_client_invoices_pay_active'];?>"> <a href="<?php echo site_url('admin/invoices/payments_history');?>"> <i class="fa <?php echo $submenuicon;?>"></i><?php echo $this->lang->line('tat_acc_invoice_payments');?> </a> </li>
        <?php } ?>
      </ul>
    </li>
    <?php } ?>


    <?php if($system[0]->module_finance=='true'){?>
    <?php if( in_array('82',$role_resources_ids) || in_array('83',$role_resources_ids) || in_array('84',$role_resources_ids) || in_array('85',$role_resources_ids) || in_array('86',$role_resources_ids)){?>
    <li class="<?php if(!empty($arr_mod['hr_acc_open5']))echo $arr_mod['hr_acc_open5'];?> treeview"> <a href="#"> <i class="fa fa-file-text-o"></i> <span><?php echo $this->lang->line('tat_acc_reports');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">
        
      <?php if(in_array('83',$role_resources_ids)) { ?>
            <li class="sidenav-link <?php if(!empty($arr_mod['hr_account_statement_active']))echo $arr_mod['hr_account_statement_active'];?>"> <a href="<?php echo site_url('admin/finance/account_statement');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_acc_account_statement');?> </a> </li>
            <?php } ?>
            <?php if(in_array('84',$role_resources_ids)) { ?>
            <li class="sidenav-link <?php if(!empty($arr_mod['hr_expense_report_active']))echo $arr_mod['hr_expense_report_active'];?>"> <a href="<?php echo site_url('admin/finance/expense_report');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_acc_expense_reports');?> </a> </li>
            <?php } ?>
            <?php if(in_array('85',$role_resources_ids)) { ?>
            <li class="sidenav-link <?php if(!empty($arr_mod['hr_income_report_active']))echo $arr_mod['hr_income_report_active'];?>"> <a href="<?php echo site_url('admin/finance/income_report');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_acc_income_reports');?> </a> </li>
            <?php } ?>
            <?php if(in_array('86',$role_resources_ids)) { ?>
            <li class="sidenav-link <?php if(!empty($arr_mod['hr_transfer_report_active']))echo $arr_mod['hr_transfer_report_active'];?>"> <a href="<?php echo site_url('admin/finance/transfer_report');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('tat_acc_transfer_report');?> </a> </li>
            <?php } ?>
       
          </ul>
        </li>
        <?php } ?>
  
    </li>
    <?php } ?>



    <?php  if( in_array('60',$role_resources_ids) || in_array('61',$role_resources_ids) || in_array('61',$role_resources_ids) || in_array('62',$role_resources_ids) || in_array('63',$role_resources_ids) ) {?>
    <li class="<?php if(!empty($arr_mod['system_open']))echo $arr_mod['system_open'];?> treeview"> <a href="#"> <i class="fa fa-cog"></i> <span><?php echo $this->lang->line('tat_system');?></span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">
        <?php if(in_array('62',$role_resources_ids)) { ?>
        <li class="sidenav-link <?php if(!empty($arr_mod['db_active']))echo $arr_mod['db_active'];?>"> <a href="<?php echo site_url('admin/settings/database_backup');?>"> <i class="fa <?php echo $submenuicon;?>"></i> <?php echo $this->lang->line('left_db_backup');?> </a> </li>
        <?php } ?>
      </ul>
    </li>
    <?php } ?>







    <li> &nbsp; </li>
  </ul>
</section>
