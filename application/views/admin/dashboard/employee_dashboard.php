<?php 
$session = $this->session->userdata('username');

$user_info = $this->Aux_model->read_user_info($session['user_id']);

$theme = $this->Tat_model->read_theme_info(1);

if($user_info[0]->profile_picture!='' && $user_info[0]->profile_picture!='no file') {
	$lde_file = base_url().'uploads/profile/'.$user_info[0]->profile_picture;
} else { 
	if($user_info[0]->gender=='Male') {  
		$lde_file = base_url().'uploads/profile/default_male.png'; 
	} else {  
		$lde_file = base_url().'uploads/profile/default_female.png';
	}
}

$last_login =  new DateTime($user_info[0]->last_login_date);

$designation = $this->Designation_model->read_designation_information($user_info[0]->designation_id);
if(!is_null($designation)){
	$designation_name = $designation[0]->designation_name;
} else {
	$designation_name = '--';	
}


$role_user = $this->Tat_model->read_user_role_info($user_info[0]->user_role_id);
if(!is_null($role_user)){
	$role_resources_ids = explode(',',$role_user[0]->role_resources);
} else {
	$role_resources_ids = explode(',',0);	
}
?>


<?php $get_animate = $this->Tat_model->get_content_animate();?>
<?php $system = $this->Tat_model->read_setting_info(1);?>


<?php
$att_date =  date('d-M-Y');
$attendance_date = date('d-M-Y');

// Employee Shift
$get_day = strtotime($att_date);
$day = date('l', $get_day);
$strtotime = strtotime($attendance_date);
$new_date = date('d-M-Y', $strtotime);

// Work Shift
$u_shift = $this->Attendance_model->read_office_shift_information($user_info[0]->office_shift_id);


//  Recieve ClockIn/ClockOut actions 
if($day == 'Monday') {
	if($u_shift[0]->monday_in_time==''){
		$office_shift = $this->lang->line('dashboard_today_monday_shift');
	} else {
		$in_time =  new DateTime($u_shift[0]->monday_in_time. ' ' .$attendance_date);
		$out_time =  new DateTime($u_shift[0]->monday_out_time. ' ' .$attendance_date);
		$clock_in = $in_time->format('h:i a');
		$clock_out = $out_time->format('h:i a');
		$office_shift = $this->lang->line('dashboard_office_shift').': '.$clock_in.' '.$this->lang->line('dashboard_to').' '.$clock_out;
	}
} else if($day == 'Tuesday') {
	if($u_shift[0]->tuesday_in_time==''){
		$office_shift = $this->lang->line('dashboard_today_tuesday_shift');
	} else {
		$in_time =  new DateTime($u_shift[0]->tuesday_in_time. ' ' .$attendance_date);
		$out_time =  new DateTime($u_shift[0]->tuesday_out_time. ' ' .$attendance_date);
		$clock_in = $in_time->format('h:i a');
		$clock_out = $out_time->format('h:i a');
		$office_shift = $this->lang->line('dashboard_office_shift').': '.$clock_in.' '.$this->lang->line('dashboard_to').' '.$clock_out;
	}
} else if($day == 'Wednesday') {
	if($u_shift[0]->wednesday_in_time==''){
		$office_shift = $this->lang->line('dashboard_today_wednesday_shift');
	} else {
		$in_time =  new DateTime($u_shift[0]->wednesday_in_time. ' ' .$attendance_date);
		$out_time =  new DateTime($u_shift[0]->wednesday_out_time. ' ' .$attendance_date);
		$clock_in = $in_time->format('h:i a');
		$clock_out = $out_time->format('h:i a');
		$office_shift = $this->lang->line('dashboard_office_shift').': '.$clock_in.' '.$this->lang->line('dashboard_to').' '.$clock_out;
	}
} else if($day == 'Thursday') {
	if($u_shift[0]->thursday_in_time==''){
		$office_shift = $this->lang->line('dashboard_today_thursday_shift');
	} else {
		$in_time =  new DateTime($u_shift[0]->thursday_in_time. ' ' .$attendance_date);
		$out_time =  new DateTime($u_shift[0]->thursday_out_time. ' ' .$attendance_date);
		$clock_in = $in_time->format('h:i a');
		$clock_out = $out_time->format('h:i a');
		$office_shift = $this->lang->line('dashboard_office_shift').': '.$clock_in.' '.$this->lang->line('dashboard_to').' '.$clock_out;
	}
} else if($day == 'Friday') {
	if($u_shift[0]->friday_in_time==''){
		$office_shift = $this->lang->line('dashboard_today_friday_shift');
	} else {
		$in_time =  new DateTime($u_shift[0]->friday_in_time. ' ' .$attendance_date);
		$out_time =  new DateTime($u_shift[0]->friday_out_time. ' ' .$attendance_date);
		$clock_in = $in_time->format('h:i a');
		$clock_out = $out_time->format('h:i a');
		$office_shift = $this->lang->line('dashboard_office_shift').': '.$clock_in.' '.$this->lang->line('dashboard_to').' '.$clock_out;
	}
} else if($day == 'Saturday') {
	if($u_shift[0]->saturday_in_time==''){
		$office_shift = $this->lang->line('dashboard_today_saturday_shift');
	} else {
		$in_time =  new DateTime($u_shift[0]->saturday_in_time. ' ' .$attendance_date);
		$out_time =  new DateTime($u_shift[0]->saturday_out_time. ' ' .$attendance_date);
		$clock_in = $in_time->format('h:i a');
		$clock_out = $out_time->format('h:i a');
		$office_shift = $this->lang->line('dashboard_office_shift').': '.$clock_in.' '.$this->lang->line('dashboard_to').' '.$clock_out;
	}
} else if($day == 'Sunday') {
	if($u_shift[0]->sunday_in_time==''){
		$office_shift = $this->lang->line('dashboard_today_sunday_shift');
	} else {
		$in_time =  new DateTime($u_shift[0]->sunday_in_time. ' ' .$attendance_date);
		$out_time =  new DateTime($u_shift[0]->sunday_out_time. ' ' .$attendance_date);
		$clock_in = $in_time->format('h:i a');
		$clock_out = $out_time->format('h:i a');
		$office_shift = $this->lang->line('dashboard_office_shift').': '.$clock_in.' '.$this->lang->line('dashboard_to').' '.$clock_out;
	}
}
?>

<?php $sys_arr = explode(',',$system[0]->system_ip_address); ?>
<?php $attendances = $this->Attendance_model->attendance_time_checks($user_info[0]->user_id); $dat = $attendances->result();?>

<?php
$bgatt = 'bg-success';
if($attendances->num_rows() < 1) {
	$bgatt = 'bg-success';
} else {
	$bgatt = 'bg-danger';
}
?>



<div class="row <?php echo $get_animate;?>">
  <div class="col-md-4">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab"><?php echo $this->lang->line('tat_attendance_mark_attendance');?></a></li>
        <li><a href="#tab_2" data-toggle="tab"><?php echo $this->lang->line('tat_attendance_overview_this_month');?></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="box-widget widget-user"> 
         
            <div class="widget-user-header <?php echo $bgatt;?> bg-darken-2">
              <h3 class="widget-user-username"><?php echo $user_info[0]->first_name. ' ' .$user_info[0]->last_name;?> </h3>
              <h5 class="widget-user-desc"><?php echo $designation_name;?></h5>
            </div>
            <div class="widget-user-image"> <img class="img-circle" src="<?php echo $lde_file;?>" alt="User Avatar"> </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-12">
                  <div class="description-block">
                    <p class="text-muted pb-0-5"><?php echo $this->lang->line('dashboard_last_login');?>: <?php echo $this->Tat_model->set_date_format($user_info[0]->last_login_date).' '.$last_login->format('h:i a');?></p>
                    <p class="text-muted pb-0-5"><?php echo $office_shift;?></p>
                  </div>
               
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="text-xs-center">
                    <div class="text-xs-center pb-0-5">
                      <?php $attributes = array('name' => 'set_clocking', 'id' => 'set_clocking', 'autocomplete' => 'off', 'class' => 'form');?>
                      <?php $hidden = array('exuser_id' => $session['user_id']);?>
                      <?php echo form_open('admin/attendance/set_clocking', $attributes, $hidden);?>
                      <input type="hidden" name="timeshseet" value="<?php echo $user_info[0]->user_id;?>">
                      <?php if($attendances->num_rows() < 1) {?>
                      <input type="hidden" value="clock_in" name="clock_state" id="clock_state">
                      <input type="hidden" value="" name="time_id" id="time_id">
                      <div class="row">
                        <div class="col-md-6">
                          <button class="btn btn-success btn-block text-uppercase" type="submit" id="clock_btn"><i class="fa fa-arrow-circle-right"></i> <?php echo $this->lang->line('dashboard_clock_in');?></button>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-danger btn-block text-uppercase" disabled="disabled" type="submit" id="clock_btn"><i class="fa fa-arrow-circle-left"></i> <?php echo $this->lang->line('dashboard_clock_out');?></button>
                        </div>
                      </div>
                      <?php } else {?>
                      <input type="hidden" value="clock_out" name="clock_state" id="clock_state">
                      <input type="hidden" value="<?php echo $dat[0]->time_attendance_id;?>" name="time_id" id="time_id">
                      <div class="row">
                        <div class="col-md-6">
                          <button class="btn btn-success btn-block text-uppercase" disabled="disabled" type="submit" id="clock_btn"><i class="fa fa-arrow-circle-right"></i> <?php echo $this->lang->line('dashboard_clock_in');?></button>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-danger btn-block text-uppercase" type="submit" id="clock_btn"><i class="fa fa-arrow-circle-left"></i> <?php echo $this->lang->line('dashboard_clock_out');?></button>
                        </div>
                      </div>
                      <?php } ?>
                      <?php echo form_close(); ?> </div>
                  </div>
                </div>
              </div>
              <?php if(in_array('10',$role_resources_ids)) { ?>
              <div class="row">
                <div class="col-md-12 col-md-offset-1">
                  <div class="margin">
                    <div class="btn-group"> <a type="button" href="<?php echo site_url('admin/attendance/');?>" class="btn btn-default btn-flat">My Attendance Timesheet</a> </div>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <!-- /.row --> 
          </div>
        </div>
        <!-- /.tab-pane -->

        
        <div class="tab-pane" id="tab_2">
          <?php
                $date = strtotime(date("Y-m-d"));
                $day = date('d', $date);
                $month = date('m', $date);
                $year = date('Y', $date);
				// total days in month
				$daysInMonth = cal_days_in_month(0, $month, $year);
				$imonth = date('F', $date);
				$r = $this->Tat_model->read_user_info($session['user_id']);
				$pcount = 0;
				$acount = 0;
				$lcount = 0;
				for($i = 1; $i <= $daysInMonth; $i++):
					$i = str_pad($i, 2, 0, STR_PAD_LEFT);
					// get date <
					$attendance_date = $year.'-'.$month.'-'.$i;
					$get_day = strtotime($attendance_date);
					$day = date('l', $get_day);
					$user_id = $r[0]->user_id;
					$office_shift_id = $r[0]->office_shift_id;
					$attendance_status = '';
					
					// get leave/employee
					$leave_date_chck = $this->Attendance_model->leave_date_check($user_id,$attendance_date);
					$leave_arr = array();
					if($leave_date_chck->num_rows() == 1){
						$leave_date = $this->Attendance_model->leave_date($user_id,$attendance_date);
						$begin1 = new DateTime( $leave_date[0]->from_date );
						$end1 = new DateTime( $leave_date[0]->to_date);
						$end1 = $end1->modify( '+1 day' ); 
						
						$interval1 = new DateInterval('P1D');
						$daterange1 = new DatePeriod($begin1, $interval1 ,$end1);
						
						foreach($daterange1 as $date1){
							$leave_arr[] =  $date1->format("Y-m-d");
						}	
					} else {
						$leave_arr[] = '99-99-99';
					}
					$office_shift = $this->Attendance_model->read_office_shift_information($office_shift_id);
					$check = $this->Attendance_model->attendance_first_in_check($user_id,$attendance_date);
			
					if($office_shift[0]->monday_in_time == '' && $day == 'Monday') {
						$status = 'H';	
						$pcount += 0;
						//$acount += 0;
					} else if($office_shift[0]->tuesday_in_time == '' && $day == 'Tuesday') {
						$status = 'H';
						$pcount += 0;
						//$acount += 0;
					} else if($office_shift[0]->wednesday_in_time == '' && $day == 'Wednesday') {
						$status = 'H';
						$pcount += 0;
						//$acount += 0;
					} else if($office_shift[0]->thursday_in_time == '' && $day == 'Thursday') {
						$status = 'H';
						$pcount += 0;
						//$acount += 0;
					} else if($office_shift[0]->friday_in_time == '' && $day == 'Friday') {
						$status = 'H';
						$pcount += 0;
						//$acount += 0;
					} else if($office_shift[0]->saturday_in_time == '' && $day == 'Saturday') {
						$status = 'H';
						$pcount += 0;
						//$acount -= 1;
					} else if($office_shift[0]->sunday_in_time == '' && $day == 'Sunday') {
						$status = 'H';
						$pcount += 0;
						//$acount -= 1;
					} else if(in_array($attendance_date,$leave_arr)) { // on leave
						$status = 'L';
						$pcount += 0;
						$lcount += 1;
					//	$acount += 0;
					} else if($check->num_rows() > 0){
						$pcount += 1;
						//$acount -= 1;
					}	else {
						$status = 'A';
						//$acount += 1;
						$pcount += 0;
						// set to present date
						$iattendance_date = strtotime($attendance_date);
						$icurrent_date = strtotime(date('Y-m-d'));
						if($iattendance_date <= $icurrent_date){
							$acount += 1;
						} else {
							$acount += 0;
						}
					}
				endfor;
                ?>
          <div class="">
            <div class="box-body">
              <div class="table-responsive" data-pattern="priority-columns">
                <table class="table table-striped m-md-b-0">
                  <tbody>
                    <tr>
                      <th scope="row" colspan="2" style="text-align: center;"><?php echo $this->lang->line('tat_attendance_this_month');?></th>
                    </tr>
                    <tr>
                      <th scope="row"><?php echo $this->lang->line('tat_attendance_total_present');?></th>
                      <td class="text-right"><?php echo $pcount;?></td>
                    </tr>
                    <tr>
                      <th scope="row"><?php echo $this->lang->line('tat_attendance_total_absent');?></th>
                      <td class="text-right"><?php echo $acount;?></td>
                    </tr>
                    <tr>
                      <th scope="row"><?php echo $this->lang->line('tat_attendance_total_leave');?></th>
                      <td class="text-right"><?php echo $lcount;?></td>
                    </tr>
                    <?php if(in_array('261',$role_resources_ids)) { ?>
                    <tr>
                      <th scope="row" colspan="2" style="text-align: center;"><a href=""><?php echo $this->lang->line('tat_attendance_cal_view');?></a></th>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.tab-pane --> 
      </div>
      <!-- /.tab-content --> 
    </div>
    <!-- Widget: user widget style 1 --> 
  </div>
  <!-- /.widget-user -->


 
  <div class="col-xl-4 col-lg-4">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><?php echo $this->lang->line('dashboard_personal_details');?></h3>
      </div>
      <div class="box-body px-1">
        <div id="recent-buyers" class="list-group scrollable-container height-350 position-relative">
          <div class="table-responsive" data-pattern="priority-columns">
            <table width="" class="table table-striped m-md-b-0">
              <tbody>
                <tr>
                  <th scope="row"><?php echo $this->lang->line('dashboard_fullname');?></th>
                  <td><?php echo $first_name.' '.$last_name;?></td>
                </tr>
                <tr>
                  <th scope="row"><?php echo $this->lang->line('dashboard_employee_id');?></th>
                  <td><?php echo $employee_id;?></td>
                </tr>
                <tr>
                  <th scope="row"><?php echo $this->lang->line('dashboard_username');?></th>
                  <td><?php echo $username;?></td>
                </tr>
                <tr>
                  <th scope="row"><?php echo $this->lang->line('dashboard_email');?></th>
                  <td><?php echo $email;?></td>
                </tr>
                <tr>
                  <th scope="row"><?php echo $this->lang->line('dashboard_designation');?></th>
                  <td><?php echo $designation_name;?></td>
                </tr>
                <tr>
                  <th scope="row"><?php echo $this->lang->line('left_department');?></th>
                  <td><?php echo $department_name;?></td>
                </tr>
                <tr>
                  <th scope="row"><?php echo $this->lang->line('dashboard_dob');?></th>
                  <td><?php echo $this->Tat_model->set_date_format($date_of_birth);?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>

<style type="text/css">
.btn-group {
	margin-top:5px !important;
}
</style>