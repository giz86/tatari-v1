<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->model("Attendance_model");
		$this->load->model("Employees_model");
		$this->load->model("Tat_model");
		$this->load->model("Department_model");
		$this->load->model("Designation_model");
		$this->load->model("Roles_model");
		$this->load->model("Location_model");
	}
	
	public function output($Return=array()){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		exit(json_encode($Return));
	}

	 public function index() {
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$month_year = $this->input->post('month_year');
		if(isset($month_year)): $title = date('F Y', strtotime($month_year)); else: $title = date('F Y'); endif;
		$data['title'] = $this->lang->line('tat_employees_monthly_timesheet').' | '.$title;
		$data['breadcrumbs'] = $this->lang->line('tat_monthly_timesheet');
		$data['path_url'] = 'timesheet_monthly';		
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$data['all_employees'] = $this->Tat_model->all_employees();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('10',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/attendance/timesheet_monthly", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}		  
	 }

	  
	public function attendance()
	{
	   $session = $this->session->userdata('username');
	   if(empty($session)){ 
		   redirect('admin/');
	   }
	   $data['title'] = $this->lang->line('dashboard_attendance').' | '.$this->Tat_model->site_title();
	   $data['breadcrumbs'] = $this->lang->line('dashboard_attendance');
	   $data['path_url'] = 'attendance';
	   $data['all_office_shifts'] = $this->Location_model->all_office_locations();
	   $role_resources_ids = $this->Tat_model->user_role_resource();
	   if(in_array('28',$role_resources_ids)) {
		   if(!empty($session)){
		   $data['subview'] = $this->load->view("admin/attendance/attendance_list", $data, TRUE);
		   $this->load->view('admin/layout/layout_main', $data); 
		   } else {
			   redirect('admin/dashboard/');
		   }	
	   } else {
		   redirect('admin/dashboard');
	   }	  
	}

   

	//  public function attendance()
    //  {
	// 	$session = $this->session->userdata('username');
	// 	if(empty($session)){ 
	// 		redirect('admin/');
	// 	}
	// 	$data['title'] = $this->lang->line('dashboard_attendance').' | '.$this->Tat_model->site_title();
	// 	$data['breadcrumbs'] = $this->lang->line('dashboard_attendance');
	// 	$data['path_url'] = 'attendance';
	// 	$data['all_office_shifts'] = $this->Location_model->all_office_locations();
	// 	$role_resources_ids = $this->Tat_model->user_role_resource();
	// 	if(in_array('28',$role_resources_ids)) {
	// 		if(!empty($session)){
	// 		$data['subview'] = $this->load->view("admin/attendance/attendance_list", $data, TRUE);
	// 		$this->load->view('admin/layout/layout_main', $data); 
	// 		} else {
	// 			redirect('admin/dashboard/');
	// 		}	
	// 	} else {
	// 		redirect('admin/dashboard');
	// 	}	  
    //  }
	 

	 public function date_wise_attendance()
     {
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('left_date_wise_attendance').' | '.$this->Tat_model->site_title();
		$data['all_employees'] = $this->Tat_model->all_employees();
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$data['breadcrumbs'] = $this->lang->line('left_date_wise_attendance');
		$data['path_url'] = 'date_wise_attendance';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('29',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("admin/attendance/date_wise", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}  
     }	


 public function update_attendance()
     {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('left_update_attendance').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('left_update_attendance');
		$data['path_url'] = 'update_attendance';		
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$data['all_employees'] = $this->Tat_model->all_employees();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('30',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/attendance/update_attendance", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}	  
     }
	 
	 
	 public function work_shift() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('left_office_shift').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('left_office_shift');
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$data['path_url'] = 'work_shift';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('7',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/attendance/work_shift", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}
     }

     public function leave() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('left_leave').' | '.$this->Tat_model->site_title();
		$data['all_employees'] = $this->Tat_model->all_employees();
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$data['all_leave_types'] = $this->Attendance_model->all_leave_types();
		$data['breadcrumbs'] = $this->lang->line('left_leave');
		$data['path_url'] = 'leave';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('46',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/attendance/leave", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}
     }

	
     public function attendance_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		$user_info = $this->Tat_model->read_user_info($session['user_id']);
		if(!empty($session)){ 
			$this->load->view("admin/attendance/attendance_list", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$role_resources_ids = $this->Tat_model->user_role_resource();
		$attendance_date = $this->input->get("attendance_date");
		$ref_location_id = $this->input->get("location_id");
		if($user_info[0]->user_role_id==1){
			if($ref_location_id == 0) {
				$employee = $this->Employees_model->get_attendance_employees();
			} else {
				$employee = $this->Employees_model->get_attendance_location_employees($ref_location_id);
			}
		} else {
			if(in_array('397',$role_resources_ids)) {
				$employee = $this->Tat_model->get_company_employees($user_info[0]->company_id);
			} else {
				$employee = $this->Tat_model->read_employee_info_att($session['user_id']);
			}
		}
		
		$system = $this->Tat_model->read_setting_info(1);
		$data = array();

        foreach($employee->result() as $r) {
			if($r->user_role_id!=1){ 			  		
			
			$full_name = $r->first_name.' '.$r->last_name;	
			
			$get_day = strtotime($attendance_date);
			$day = date('l', $get_day);
			
			$office_shift = $this->Attendance_model->read_office_shift_information($r->office_shift_id);
			
			if($day == 'Monday') {
				if($office_shift[0]->monday_in_time==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift[0]->monday_in_time;
					$out_time = $office_shift[0]->monday_out_time;
				}
			} else if($day == 'Tuesday') {
				if($office_shift[0]->tuesday_in_time==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift[0]->tuesday_in_time;
					$out_time = $office_shift[0]->tuesday_out_time;
				}
			} else if($day == 'Wednesday') {
				if($office_shift[0]->wednesday_in_time==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift[0]->wednesday_in_time;
					$out_time = $office_shift[0]->wednesday_out_time;
				}
			} else if($day == 'Thursday') {
				if($office_shift[0]->thursday_in_time==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift[0]->thursday_in_time;
					$out_time = $office_shift[0]->thursday_out_time;
				}
			} else if($day == 'Friday') {
				if($office_shift[0]->friday_in_time==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift[0]->friday_in_time;
					$out_time = $office_shift[0]->friday_out_time;
				}
			} else if($day == 'Saturday') {
				if($office_shift[0]->saturday_in_time==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift[0]->saturday_in_time;
					$out_time = $office_shift[0]->saturday_out_time;
				}
			} else if($day == 'Sunday') {
				if($office_shift[0]->sunday_in_time==''){
					$in_time = '00:00:00';
					$out_time = '00:00:00';
				} else {
					$in_time = $office_shift[0]->sunday_in_time;
					$out_time = $office_shift[0]->sunday_out_time;
				}
			}
			
			$attendance_status = '';
			$check = $this->Attendance_model->attendance_first_in_check($r->user_id,$attendance_date);		
			if($check->num_rows() > 0){
				
				$attendance = $this->Attendance_model->attendance_first_in($r->user_id,$attendance_date);

				// ClockingIn
				$clock_in = new DateTime($attendance[0]->clock_in);
				$clock_in2 = $clock_in->format('h:i a');
				if($system[0]->is_ssl_available=='yes'){
				$clkInIp = $clock_in2.'<br><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-ipaddress="'.$attendance[0]->clock_in_ip_address.'" data-uid="'.$r->user_id.'" data-att_type="clock_in" data-start_date="'.$attendance_date.'"><i class="ft-map-pin"></i> '.$this->lang->line('tat_attend_clkin_ip').'</button>';
				} else {
					$clkInIp = $clock_in2;
				}
				$office_time =  new DateTime($in_time.' '.$attendance_date);
				// Calculate Time
				$office_time_new = strtotime($in_time.' '.$attendance_date);
				$clock_in_time_new = strtotime($attendance[0]->clock_in);
				if($clock_in_time_new <= $office_time_new) {
					$total_time_l = '00:00';
				} else {
					$interval_late = $clock_in->diff($office_time);
					$hours_l   = $interval_late->format('%h');
					$minutes_l = $interval_late->format('%i');			
					$total_time_l = $hours_l ."h ".$minutes_l."m";
				}
				
				// Total Work Hours
				$total_hrs = $this->Attendance_model->total_hours_worked_attendance($r->user_id,$attendance_date);
				$hrs_old_int1 = '';
				$Total = '';
				$Trest = '';
				$total_time_rs = '';
				$hrs_old_int_res1 = '';
				foreach ($total_hrs->result() as $hour_work){				
					$timee = $hour_work->total_work.':00';
					$str_time =$timee;
		
					$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
					
					sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
					
					$hrs_old_seconds = $hours * 3600 + $minutes * 60 + $seconds;
					
					$hrs_old_int1 = $hrs_old_seconds;
					
					$Total = gmdate("H:i", $hrs_old_int1);	
				}
				if($Total=='') {
					$total_work = '00:00';
				} else {
					$total_work = $Total;
				}
				
				// Total Rest Hours
				$total_rest = $this->Attendance_model->total_rest_attendance($r->user_id,$attendance_date);
				foreach ($total_rest->result() as $rest){			
					$str_time_rs = $rest->total_rest.':00';
					$str_time_rs = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_rs);
					
					sscanf($str_time_rs, "%d:%d:%d", $hours_rs, $minutes_rs, $seconds_rs);
					
					$hrs_old_seconds_rs = $hours_rs * 3600 + $minutes_rs * 60 + $seconds_rs;
					
					$hrs_old_int_res1 = $hrs_old_seconds_rs;
					
					$total_time_rs = gmdate("H:i", $hrs_old_int_res1);
				}
				
				$status = $attendance[0]->attendance_status;
				if($total_time_rs=='') {
					$Trest = '00:00';
				} else {
					$Trest = $total_time_rs;
				}
			
			} else {
				$clock_in2 = '-';
				$total_time_l = '00:00';
				$total_work = '00:00';
				$Trest = '00:00';
				$clkInIp = $clock_in2;
				// Leave or Absence Calculation
				
				$leave_date_chck = $this->Attendance_model->leave_date_check($r->user_id,$attendance_date);
				$leave_arr = array();
				if($leave_date_chck->num_rows() == 1){
					$leave_date = $this->Attendance_model->leave_date($r->user_id,$attendance_date);
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
					
				if($office_shift[0]->monday_in_time == '' && $day == 'Monday') {
					$status = $this->lang->line('tat_holiday');	
				} else if($office_shift[0]->tuesday_in_time == '' && $day == 'Tuesday') {
					$status = $this->lang->line('tat_holiday');	
				} else if($office_shift[0]->wednesday_in_time == '' && $day == 'Wednesday') {
					$status = $this->lang->line('tat_holiday');	
				} else if($office_shift[0]->thursday_in_time == '' && $day == 'Thursday') {
					$status = $this->lang->line('tat_holiday');	
				} else if($office_shift[0]->friday_in_time == '' && $day == 'Friday') {
					$status = $this->lang->line('tat_holiday');	
				} else if($office_shift[0]->saturday_in_time == '' && $day == 'Saturday') {
					$status = $this->lang->line('tat_holiday');	
				} else if($office_shift[0]->sunday_in_time == '' && $day == 'Sunday') {
					$status = $this->lang->line('tat_holiday');	
				} else if(in_array($attendance_date,$leave_arr)) { // Leave
					$status = $this->lang->line('tat_on_leave');
				} 
				else {
					$status = $this->lang->line('tat_absent');
				}
			}
			
			// ClockOut Check
			$check_out = $this->Attendance_model->attendance_first_out_check($r->user_id,$attendance_date);		
			if($check_out->num_rows() == 1){

				
				$early_time =  new DateTime($out_time.' '.$attendance_date);
				// ClockIn
				$first_out = $this->Attendance_model->attendance_first_out($r->user_id,$attendance_date);
				// ClockOut
				$clock_out = new DateTime($first_out[0]->clock_out);
				
				if ($first_out[0]->clock_out!='') {
					$clock_out2 = $clock_out->format('h:i a');
					if($system[0]->is_ssl_available=='yes'){
						$clkOutIp = $clock_out2.'<br><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-ipaddress="'.$attendance[0]->clock_out_ip_address.'" data-uid="'.$r->user_id.'" data-att_type="clock_out" data-start_date="'.$attendance_date.'"><i class="ft-map-pin"></i> '.$this->lang->line('tat_attend_clkout_ip').'</button>';
					} else {
						$clkOutIp = $clock_out2;
					}
				
					// Left Early
					$early_new_time = strtotime($out_time.' '.$attendance_date);
					$clock_out_time_new = strtotime($first_out[0]->clock_out);
				
					if($early_new_time <= $clock_out_time_new) {
						$total_time_e = '00:00';
					} else {			
						$interval_lateo = $clock_out->diff($early_time);
						$hours_e   = $interval_lateo->format('%h');
						$minutes_e = $interval_lateo->format('%i');			
						$total_time_e = $hours_e ."h ".$minutes_e."m";
					}
					
					// Overtime Calculation
					$over_time =  new DateTime($out_time.' '.$attendance_date);
					$overtime2 = $over_time->format('h:i a');
					
					$over_time_new = strtotime($out_time.' '.$attendance_date);
					$clock_out_time_new1 = strtotime($first_out[0]->clock_out);
					
					if($clock_out_time_new1 <= $over_time_new) {
						$overtime2 = '00:00';
					} else {			
						$interval_lateov = $clock_out->diff($over_time);
						$hours_ov   = $interval_lateov->format('%h');
						$minutes_ov = $interval_lateov->format('%i');			
						$overtime2 = $hours_ov ."h ".$minutes_ov."m";
					}				
					
				} else {
					$clock_out2 =  '-';
					$total_time_e = '00:00';
					$overtime2 = '00:00';
					$clkOutIp = $clock_out2;
				}
						
			} else {
				$clock_out2 =  '-';
				$total_time_e = '00:00';
				$overtime2 = '00:00';
				$clkOutIp = $clock_out2;
			}	
			
			
			$company = $this->Tat_model->read_company_info($r->company_id);
			if(!is_null($company)){
				$comp_name = $company[0]->name;
			} else {
				$comp_name = '--';	
			}	
			// Date Config
			$d_date = $this->Tat_model->set_date_format($attendance_date);
			
			if($user_info[0]->user_role_id==1){
				$fclckIn = $clkInIp;
				$fclckOut = $clkOutIp;
			} else {
				$fclckIn = $clock_in2;
				$fclckOut = $clock_out2;
			}
			$data[] = array(
				$full_name,
				$comp_name,
				$d_date,
				$status,
				$fclckIn,
				$fclckOut,
				$total_time_l,
				$total_time_e,
				$overtime2,
				$total_work,
				$Trest
			);
			}
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $employee->num_rows(),
			 "recordsFiltered" => $employee->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
    }



	 public function get_leave_employees() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/attendance/get_leave_employees", $data);
		} else {
			redirect('admin/');
		}
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	} 
	

	 public function get_employees_leave() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		
		$leave_type_id = $this->uri->segment(4);
		$employee_id = $this->uri->segment(5);
		
		$remaining_leave = $this->Attendance_model->count_total_leaves($leave_type_id,$employee_id);
		$type = $this->Attendance_model->read_leave_type_information($leave_type_id);
		if(!is_null($type)){
			$type_name = $type[0]->type_name;
			$total = $type[0]->days_per_year;
			$leave_remaining_total = $total - $remaining_leave;
		} else {
			$type_name = '--';	
			$leave_remaining_total = 0;
		}
		ob_start();
		echo $leave_remaining_total." ".$type_name. ' ' .$this->lang->line('tat_remaining');
		ob_end_flush();
	} 
	

	 public function get_employee_assigned_leave_types() {

		$data['title'] = $this->Tat_model->site_title();
		$employee_id = $this->uri->segment(4);
		
		$data = array(
			'employee_id' => $employee_id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/attendance/get_employee_assigned_leave_types", $data);
		} else {
			redirect('admin/');
		}
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	}
	 
	 public function leave_details() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		
		$data['title'] = $this->Tat_model->site_title();
		$leave_id = $this->uri->segment(5);
		$result = $this->Attendance_model->read_leave_information($leave_id);
		if(is_null($result)){
			redirect('admin/attendance/leave');
		}
		$edata = array(
			'is_notify' => 0,
		);
		$this->Attendance_model->update_leave_record($edata,$leave_id);

		// Leave Type
		$type = $this->Attendance_model->read_leave_type_information($result[0]->leave_type_id);
		if(!is_null($type)){
			$type_name = $type[0]->type_name;
		} else {
			$type_name = '--';	
		}
		// Employees
		$user = $this->Tat_model->read_user_info($result[0]->employee_id);
		if(!is_null($user)){
			$full_name = $user[0]->first_name. ' '.$user[0]->last_name;
			$u_role_id = $user[0]->user_role_id;
			$department = $this->Department_model->read_department_information($user[0]->department_id);
			if(!is_null($department)){
				$department_name = $department[0]->department_name;
			} else {
				$department_name = '--';	
			}
		} else {
			$full_name = '--';	
			$u_role_id = '--';
			$department_name = '--';
		}			 
		
		$data = array(
				'title' => $this->lang->line('tat_leave_detail').' | '.$this->Tat_model->site_title(),
				'type' => $type_name,
				'role_id' => $u_role_id,
				'full_name' => $full_name,
				'department_name' => $department_name,
				'leave_id' => $result[0]->leave_id,
				'employee_id' => $result[0]->employee_id,
				'company_id' => $result[0]->company_id,
				'leave_type_id' => $result[0]->leave_type_id,
				'from_date' => $result[0]->from_date,
				'to_date' => $result[0]->to_date,
				'applied_on' => $result[0]->applied_on,
				'reason' => $result[0]->reason,
				'remarks' => $result[0]->remarks,
				'status' => $result[0]->status,
				'leave_attachment' => $result[0]->leave_attachment,
				'is_half_day' => $result[0]->is_half_day,
				'created_at' => $result[0]->created_at,
				'all_employees' => $this->Tat_model->all_employees(),
				'all_leave_types' => $this->Attendance_model->all_leave_types(),
				);
		$data['breadcrumbs'] = $this->lang->line('tat_leave_detail');
		$data['path_url'] = 'leave_details';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('46',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/attendance/leave_details", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}
		  
     }


     public function get_timesheet_employees() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/attendance/get_timesheet_employees", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	
	 }


	// Date-wise Attendance Management
    public function dtwise_attendance_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/attendance/attendance_list", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$employee = $this->Tat_model->read_user_attendance_info();
		
		$data = array();

        foreach($employee->result() as $r) {
			$data[] = array('','','','','','','','','','','');
		}

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $employee->num_rows(),
			 "recordsFiltered" => $employee->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }	
	

    //  Work Leave Data
     public function leave_list() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/attendance/leave", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Index
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$data = array();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		$user_info = $this->Tat_model->read_user_info($session['user_id']);
		if($this->input->get("ihr")=='true'){
			if($this->input->get("company_id")==0 && $this->input->get("employee_id")==0 && $this->input->get("status")==0){
				$leave = $this->Attendance_model->get_leaves();
			} else if($this->input->get("company_id")!=0 && $this->input->get("employee_id")==0 && $this->input->get("status")==0){
				$leave = $this->Attendance_model->filter_company_leaves($this->input->get("company_id"));
			} else if($this->input->get("company_id")!=0 && $this->input->get("employee_id")!=0 && $this->input->get("status")==0){
				$leave = $this->Attendance_model->filter_company_employees_leaves($this->input->get("company_id"),$this->input->get("employee_id"));
			} else if($this->input->get("company_id")!=0 && $this->input->get("employee_id")!=0 && $this->input->get("status")!=0){
				$leave = $this->Attendance_model->filter_company_employees_status_leaves($this->input->get("company_id"),$this->input->get("status"));
			} else if($this->input->get("company_id")!=0 && $this->input->get("employee_id")==0 && $this->input->get("status")!=0){
				$leave = $this->Attendance_model->filter_company_only_status_leaves($this->input->get("company_id"),$this->input->get("status"));
			}
		} else {
			$view_companies_ids = explode(',',$user_info[0]->view_companies_id);
			if($user_info[0]->user_role_id==1){
				$leave = $this->Attendance_model->get_leaves();
			} else if(in_array($user_info[0]->company_id,$view_companies_ids)) {
				$leave = $this->Attendance_model->get_multi_company_leaves($view_companies_ids);
			} else {
				if(in_array('290',$role_resources_ids) || in_array('312',$role_resources_ids)) {
					$leave = $this->Attendance_model->get_company_leaves($user_info[0]->company_id);
				} else {
					$department = $this->Department_model->read_department_information($user_info[0]->department_id);
					if($department[0]->employee_id == $session['user_id']){
						$leave = $this->Attendance_model->get_employee_leaves_department_wise($user_info[0]->department_id);
					} else {
						$leave = $this->Attendance_model->get_employee_leaves($session['user_id']);
					}
				}
			}
		}
		foreach($leave->result() as $r) {
			  
			// Start to End Date
			$user = $this->Tat_model->read_user_info($r->employee_id);
			if(!is_null($user)){
				$full_name = $user[0]->first_name. ' '.$user[0]->last_name;
				$department = $this->Department_model->read_department_information($user[0]->department_id);
				if(!is_null($department)){
					$department_name = $department[0]->department_name;
				} else {
					$department_name = '--';	
				}
			} else {
				$full_name = '--';	
				$department_name = '--';
			}

			// Type of Leave
			$leave_type = $this->Attendance_model->read_leave_type_information($r->leave_type_id);
			if(!is_null($leave_type)){
				$type_name = $leave_type[0]->type_name;
			} else {
				$type_name = '--';	
			}
			
			// Company
			$company = $this->Tat_model->read_company_info($r->company_id);
			if(!is_null($company)){
				$comp_name = $company[0]->name;
			} else {
				$comp_name = '--';	
			}
			 
			$datetime1 = new DateTime($r->from_date);
			$datetime2 = new DateTime($r->to_date);
			$interval = $datetime1->diff($datetime2);
			if(strtotime($r->from_date) == strtotime($r->to_date)){
				$no_of_days =1;
			} else {
				$no_of_days = $interval->format('%a') + 1;
			}
			$applied_on = $this->Tat_model->set_date_format($r->applied_on);
	
			 if($r->is_half_day == 1){
			$duration = $this->Tat_model->set_date_format($r->from_date).' '.$this->lang->line('dashboard_to').' '.$this->Tat_model->set_date_format($r->to_date).'<br>'.$this->lang->line('tat_tatari_total_days').': '.$this->lang->line('tat_hr_leave_half_day');
			} else {
				$duration = $this->Tat_model->set_date_format($r->from_date).' '.$this->lang->line('dashboard_to').' '.$this->Tat_model->set_date_format($r->to_date).'<br>'.$this->lang->line('tat_tatari_total_days').': '.$no_of_days;
			}
			
			if($r->status==1): $status = '<span class="badge bg-orange">'.$this->lang->line('tat_pending').'</span>';
			elseif($r->status==2): $status = '<span class="badge bg-green">'.$this->lang->line('tat_approved').'</span>';
			elseif($r->status==4): $status = '<span class="badge bg-green">'.$this->lang->line('tat_role_first_level_approved').'</span>';
			else: $status = '<span class="badge bg-red">'.$this->lang->line('tat_rejected').'</span>'; endif;
			
			
			if(in_array('288',$role_resources_ids)) { // Update
				$edit = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light edit-data" data-toggle="modal" data-target=".edit-modal-data" data-leave_id="'. $r->leave_id.'" ><span class="fa fa-pencil"></span></button></span>';
			} else {
				$edit = '';
			}
			if(in_array('289',$role_resources_ids)) { // Delete
				$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->leave_id . '"><span class="fa fa-trash"></span></button></span>';
			} else {
				$delete = '';
			}
			if(in_array('290',$role_resources_ids) || $user_info[0]->user_role_id==1 || $department[0]->employee_id == $session['user_id'] || in_array('312',$role_resources_ids)) { //view
				$view = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_view_details').'"><a href="'.site_url().'admin/attendance/leave_details/id/'.$r->leave_id.'/"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
			} else {
				$view = '';
			}
			$combhr = $edit.$view.$delete;
			$itype_name = $type_name.'<br><small class="text-muted"><i>'.$this->lang->line('tat_reason').': '.$r->reason.'<i></i></i></small><br><small class="text-muted"><i>'.$status.'<i></i></i></small><br><small class="text-muted"><i>'.$this->lang->line('left_company').': '.$comp_name.'<i></i></i></small>';
	
		   $data[] = array(
				$combhr,
				$itype_name,
				$department_name,
				$full_name,
				$duration,
				$applied_on
		   );
	  }
	  $output = array(
		   "draw" => $draw,
           "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }


    //  Fetch Leave Records
     public function read_leave_record()
	{
		$data['title'] = $this->Tat_model->site_title();
		$leave_id = $this->input->get('leave_id');
		$result = $this->Attendance_model->read_leave_information($leave_id);
		
		$data = array(
				'leave_id' => $result[0]->leave_id,
				'company_id' => $result[0]->company_id,
				'employee_id' => $result[0]->employee_id,
				'leave_type_id' => $result[0]->leave_type_id,
				'from_date' => $result[0]->from_date,
				'to_date' => $result[0]->to_date,
				'applied_on' => $result[0]->applied_on,
				'reason' => $result[0]->reason,
				'remarks' => $result[0]->remarks,
				'status' => $result[0]->status,
				'created_at' => $result[0]->created_at,
				'all_employees' => $this->Tat_model->all_employees(),
				'get_all_companies' => $this->Tat_model->get_companies(),
				'all_leave_types' => $this->Attendance_model->all_leave_types(),
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('admin/attendance/dialog_leave', $data);
		} else {
			redirect('admin/');
		}
	}
	
	
	// Fetch Attendance Records
	public function read()
	{
		$data['title'] = $this->Tat_model->site_title();
		$attendance_id = $this->input->get('attendance_id');
		$result = $this->Attendance_model->read_attendance_information($attendance_id);
		$user = $this->Tat_model->read_user_info($result[0]->employee_id);
	
		$full_name = $user[0]->first_name.' '.$user[0]->last_name;
		
		$in_time = new DateTime($result[0]->clock_in);
		$out_time = new DateTime($result[0]->clock_out);
		
		$clock_in = $in_time->format('H:i');
		if($result[0]->clock_out == '') {
			$clock_out = '';
		} else {
			$clock_out = $out_time->format('H:i');
		}
		
		$data = array(
				'time_attendance_id' => $result[0]->time_attendance_id,
				'employee_id' => $result[0]->employee_id,
				'full_name' => $full_name,
				'attendance_date' => $result[0]->attendance_date,
				'clock_in' => $clock_in,
				'clock_out' => $clock_out
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('admin/attendance/dialog_attendance', $data);
		} else {
			redirect('admin/');
		}
	}

    // Fetch Work Shift Data
    public function read_shift_record()
	{
		$data['title'] = $this->Tat_model->site_title();
		$office_shift_id = $this->input->get('office_shift_id');
		$result = $this->Attendance_model->read_office_shift_information($office_shift_id);
		
		$data = array(
				'office_shift_id' => $result[0]->office_shift_id,
				'company_id' => $result[0]->company_id,
				'shift_name' => $result[0]->shift_name,
				'monday_in_time' => $result[0]->monday_in_time,
				'monday_out_time' => $result[0]->monday_out_time,
				'tuesday_in_time' => $result[0]->tuesday_in_time,
				'tuesday_out_time' => $result[0]->tuesday_out_time,
				'wednesday_in_time' => $result[0]->wednesday_in_time,
				'wednesday_out_time' => $result[0]->wednesday_out_time,
				'thursday_in_time' => $result[0]->thursday_in_time,
				'thursday_out_time' => $result[0]->thursday_out_time,
				'friday_in_time' => $result[0]->friday_in_time,
				'friday_out_time' => $result[0]->friday_out_time,
				'saturday_in_time' => $result[0]->saturday_in_time,
				'saturday_out_time' => $result[0]->saturday_out_time,
				'sunday_in_time' => $result[0]->sunday_in_time,
				'get_all_companies' => $this->Tat_model->get_companies(),
				'sunday_out_time' => $result[0]->sunday_out_time
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('admin/attendance/dialog_work_shift', $data);
		} else {
			redirect('admin/');
		}
	}

    // Update Attendance Records
    public function edit_attendance() {
	
		if($this->input->post('edit_type')=='attendance') {
			
		$id = $this->uri->segment(4);
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		// Input Validation
		if($this->input->post('attendance_date_e')==='') {
        	$Return['error'] = $this->lang->line('tat_error_attendance_date');
		} else if($this->input->post('clock_in')==='') {
        	$Return['error'] = $this->lang->line('tat_error_attendance_in_time');
		} 
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		$attendance_date = $this->input->post('attendance_date_e');
		$clock_in = $this->input->post('clock_in');
		$clock_in2 = $attendance_date.' '.$clock_in.':00';
		
		$total_work_cin =  new DateTime($clock_in2);
		
		if($this->input->post('clock_out') ==='') {
			$data = array(
			'employee_id' => $this->input->post('emp_att'),
			'attendance_date' => $attendance_date,
			'clock_in' => $clock_in2,
			'time_late' => $clock_in2,
			'early_leaving' => $clock_in2,
			'overtime' => $clock_in2,
		);
		} else {
			$clock_out = $this->input->post('clock_out');
			$clock_out2 = $attendance_date.' '.$clock_out.':00';
			$total_work_cout =  new DateTime($clock_out2);
			
			$interval_cin = $total_work_cout->diff($total_work_cin);
			$hours_in   = $interval_cin->format('%h');
			$minutes_in = $interval_cin->format('%i');
			$total_work = $hours_in .":".$minutes_in;
		
			$data = array(
			'employee_id' => $this->input->post('emp_att'),
			'attendance_date' => $attendance_date,
			'clock_in' => $clock_in2,
			'clock_out' => $clock_out2,
			'time_late' => $clock_in2,
			'total_work' => $total_work,
			'early_leaving' => $clock_out2,
			'overtime' => $clock_out2,
			'attendance_status' => 'Present',
			'clock_in_out' => '0'
			);
		}
		
		$result = $this->Attendance_model->update_attendance_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_attendance_update');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Default Shift
	public function default_shift() {
	
		if($this->input->get('office_shift_id')) {
		$id = $this->input->get('office_shift_id');
	
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		$data = array(
		'default_shift' => '0'
		);
		
		$data2 = array(
		'default_shift' => '1'
		);
		
		$result = $this->Attendance_model->update_default_shift_zero($data);
		$result = $this->Attendance_model->update_default_shift_record($data2,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_shift_default_made');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Insert New Work Shift
	public function add_office_shift() {
	
		if($this->input->post('add_type')=='office_shift') {		
	
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
			// Input Validation
		if($this->input->post('company_id')==='') {
        	$Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('shift_name')==='') {
        	$Return['error'] = $this->lang->line('tat_error_shift_name_field');
		} else if($this->input->post('monday_in_time')!='' && $this->input->post('monday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_monday_timeout');
		} else if($this->input->post('tuesday_in_time')!='' && $this->input->post('tuesday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_tuesday_timeout');
		} else if($this->input->post('wednesday_in_time')!='' && $this->input->post('wednesday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_wednesday_timeout');
		} else if($this->input->post('thursday_in_time')!='' && $this->input->post('thursday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_thursday_timeout');
		} else if($this->input->post('friday_in_time')!='' && $this->input->post('friday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_friday_timeout');
		} else if($this->input->post('saturday_in_time')!='' && $this->input->post('saturday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_saturday_timeout');
		} else if($this->input->post('sunday_in_time')!='' && $this->input->post('sunday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_sunday_timeout');
		} 
						
		if($Return['error']!=''){
       		$this->output($Return);
    	}
			
		$data = array(
		'shift_name' => $this->input->post('shift_name'),
		'company_id' => $this->input->post('company_id'),
		'monday_in_time' => $this->input->post('monday_in_time'),
		'monday_out_time' => $this->input->post('monday_out_time'),
		'tuesday_in_time' => $this->input->post('tuesday_in_time'),
		'tuesday_out_time' => $this->input->post('tuesday_out_time'),
		'wednesday_in_time' => $this->input->post('wednesday_in_time'),
		'wednesday_out_time' => $this->input->post('wednesday_out_time'),
		'thursday_in_time' => $this->input->post('thursday_in_time'),
		'thursday_out_time' => $this->input->post('thursday_out_time'),
		'friday_in_time' => $this->input->post('friday_in_time'),
		'friday_out_time' => $this->input->post('friday_out_time'),
		'saturday_in_time' => $this->input->post('saturday_in_time'),
		'saturday_out_time' => $this->input->post('saturday_out_time'),
		'sunday_in_time' => $this->input->post('sunday_in_time'),
		'sunday_out_time' => $this->input->post('sunday_out_time'),
		'created_at' => date('Y-m-d')
		);
		$result = $this->Attendance_model->add_office_shift_record($data);
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_shift_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Update Work Shift Schedule
	public function edit_office_shift() {
	
		if($this->input->post('edit_type')=='shift') {
			
		$id = $this->uri->segment(4);
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		// Input Validation
		if($this->input->post('company_id')==='') {
			$Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('shift_name')==='') {
        	$Return['error'] = $this->lang->line('tat_error_shift_name_field');
		} else if($this->input->post('monday_in_time')!='' && $this->input->post('monday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_monday_timeout');
		} else if($this->input->post('tuesday_in_time')!='' && $this->input->post('tuesday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_tuesday_timeout');
		} else if($this->input->post('wednesday_in_time')!='' && $this->input->post('wednesday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_wednesday_timeout');
		} else if($this->input->post('thursday_in_time')!='' && $this->input->post('thursday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_thursday_timeout');
		} else if($this->input->post('friday_in_time')!='' && $this->input->post('friday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_friday_timeout');
		} else if($this->input->post('saturday_in_time')!='' && $this->input->post('saturday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_saturday_timeout');
		} else if($this->input->post('sunday_in_time')!='' && $this->input->post('sunday_out_time')==='') {
			$Return['error'] = $this->lang->line('tat_error_shift_sunday_timeout');
		} 
						
		if($Return['error']!=''){
       		$this->output($Return);
    	}
			
		$data = array(
		'shift_name' => $this->input->post('shift_name'),
		'company_id' => $this->input->post('company_id'),
		'monday_in_time' => $this->input->post('monday_in_time'),
		'monday_out_time' => $this->input->post('monday_out_time'),
		'tuesday_in_time' => $this->input->post('tuesday_in_time'),
		'tuesday_out_time' => $this->input->post('tuesday_out_time'),
		'wednesday_in_time' => $this->input->post('wednesday_in_time'),
		'wednesday_out_time' => $this->input->post('wednesday_out_time'),
		'thursday_in_time' => $this->input->post('thursday_in_time'),
		'thursday_out_time' => $this->input->post('thursday_out_time'),
		'friday_in_time' => $this->input->post('friday_in_time'),
		'friday_out_time' => $this->input->post('friday_out_time'),
		'saturday_in_time' => $this->input->post('saturday_in_time'),
		'saturday_out_time' => $this->input->post('saturday_out_time'),
		'sunday_in_time' => $this->input->post('sunday_in_time'),
		'sunday_out_time' => $this->input->post('sunday_out_time')
		);
		
		$result = $this->Attendance_model->update_shift_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_shift_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	 

    //  Update Attendance New
	public function update_attendance_add()
	{
		$data['title'] = $this->Tat_model->site_title();
		$employee_id = $this->input->get('employee_id');
		$data = array(
				'employee_id' => $employee_id,
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('admin/attendance/dialog_attendance', $data);
		} else {
			redirect('admin/');
		}
	}

    // Insert Leave
    public function add_leave() {
	
		if($this->input->post('add_type')=='leave') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$remarks = $this->input->post('remarks');
	
		$st_date = strtotime($start_date);
		$ed_date = strtotime($end_date);
		$qt_remarks = htmlspecialchars(addslashes($remarks), ENT_QUOTES);
		
			// Input Validation
		if($this->input->post('leave_type')==='') {
        	$Return['error'] = $this->lang->line('tat_error_leave_type_field');
		} else if($this->input->post('start_date')==='') {
        	$Return['error'] = $this->lang->line('tat_error_start_date');
		} else if($this->input->post('end_date')==='') {
        	$Return['error'] = $this->lang->line('tat_error_end_date');
		} else if($st_date > $ed_date) {
			$Return['error'] = $this->lang->line('tat_error_start_end_date');
		} else if($this->input->post('company_id')==='') {
			$Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('employee_id')==='') {
			$Return['error'] = $this->lang->line('tat_error_employee_id');
		} else if($this->input->post('reason')==='') {
			$Return['error'] = $this->lang->line('tat_error_leave_type_reason');
		}
		$datetime1 = new DateTime($this->input->post('start_date'));
		$datetime2 = new DateTime($this->input->post('end_date'));
		$interval = $datetime1->diff($datetime2);
		$no_of_days = $interval->format('%a') + 1;
		if($this->input->post('leave_half_day')==1 && $no_of_days>1) {
			$Return['error'] = $this->lang->line('tat_hr_cant_appply_morethan').' 1 '.$this->lang->line('tat_day');
		}
		if($Return['error']!=''){
       		$this->output($Return);
    	}
			
		if($this->input->post('start_date')!=''){	
		
			$eremaining_leave = 0;
			
			$count_l = 0;
			$leave_halfday_cal = employee_leave_halfday_cal($this->input->post('leave_type'),$this->input->post('employee_id'));
			foreach($leave_halfday_cal as $lhalfday):
				$count_l += 0.5;
			endforeach;
			
			$remaining_leave = count_leaves_info($this->input->post('leave_type'),$this->input->post('employee_id'));
			$remaining_leave = $remaining_leave - $count_l;
			
			$type = $this->Attendance_model->read_leave_type_information($this->input->post('leave_type'));
			if(!is_null($type)){
				$type_name = $type[0]->type_name;
				$total = $type[0]->days_per_year;
				$leave_remaining_total = $total - $remaining_leave;
			} else {
				$type_name = '--';	
				$leave_remaining_total = 0;
			}
					
			if($this->input->post('leave_type')==3 || $this->input->post('leave_type')==5 || $this->input->post('leave_type')==7) {
				$leave_remaining_total = $leave_remaining_total + $eremaining_leave;
			} else {
				$leave_remaining_total = $leave_remaining_total;
			}
			
			if($this->input->post('leave_half_day')!=1){
				if($no_of_days > $leave_remaining_total){
					$Return['error'] = $this->lang->line('tat_hr_cant_appply_morethan').' '.$this->lang->line('tat_day');
				}
			} else {
				if(0.5 > $leave_remaining_total){
					$Return['error'] = $this->lang->line('tat_hr_cant_appply_morethan').' '.$leave_remaining_total.' '.$this->lang->line('tat_hr_contract_days');
				}
			}
			
			if($leave_remaining_total < 0.4){
				$Return['error'] = $this->lang->line('tat_leave_limit_msg').' '.$this->lang->line('tat_tatari_leave_quota_completed') .$type_name;
			}
				
		}

        // Error Handling
		if($Return['error']!=''){
       		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$this->output($Return);
    	}	
		if($this->input->post('leave_half_day')!=1){
			$leave_half_day_opt = 0;
		} else {
			$leave_half_day_opt = $this->input->post('leave_half_day');
		}
		if(is_uploaded_file($_FILES['attachment']['tmp_name'])) {
			
			$allowed =  array('png','jpg','jpeg','pdf','gif');
			$filename = $_FILES['attachment']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
			if(in_array($ext,$allowed)){
				$tmp_name = $_FILES["attachment"]["tmp_name"];
				$profile = "uploads/leave/";
				$set_img = base_url()."uploads/leave/";
				
				$name = basename($_FILES["attachment"]["name"]);
				$newfilename = 'leave_'.round(microtime(true)).'.'.$ext;
				move_uploaded_file($tmp_name, $profile.$newfilename);
				$fname = $newfilename;			
			} else {
				$Return['error'] = $this->lang->line('tat_error_attatchment_type');
			}
		} else {
			$fname = '';
		}
		
		$data = array(
		'employee_id' => $this->input->post('employee_id'),
		'company_id' => $this->input->post('company_id'),
		'leave_type_id' => $this->input->post('leave_type'),
		'from_date' => $this->input->post('start_date'),
		'to_date' => $this->input->post('end_date'),
		'applied_on' => date('Y-m-d h:i:s'),
		'reason' => $this->input->post('reason'),
		'remarks' => $qt_remarks,
		'leave_attachment' => $fname,
		'status' => '1',
		'is_notify' => '1',
		'is_half_day' => $leave_half_day_opt,
		'created_at' => date('Y-m-d h:i:s')
		);
		$result = $this->Attendance_model->add_leave_record($data);
		
		if ($result == TRUE) {
			$row = $this->db->select("*")->limit(1)->order_by('leave_id',"DESC")->get("tat_leave_applications")->row();
			$Return['result'] = $this->lang->line('tat_success_leave_added');
			
			$leave_type = $this->Attendance_model->read_leave_type_information($row->leave_type_id);
			if(!is_null($leave_type)){
				$type_name = $leave_type[0]->type_name;
			} else {
				$type_name = '--';	
			}
			$Return['re_last_id'] = $row->leave_id;
			$Return['lv_type_name'] = $type_name;
			
		
		$this->output($Return);
		exit;
		}
	}}


    // Update Leave Data
    public function edit_leave() {
	
		if($this->input->post('edit_type')=='leave') {
			
		$id = $this->uri->segment(4);		
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		
		$remarks = $this->input->post('remarks');
		$qt_remarks = htmlspecialchars(addslashes($remarks), ENT_QUOTES);
			
		if($this->input->post('reason')==='') {
			$Return['error'] = $this->lang->line('tat_error_leave_type_reason');
		}
						
		if($Return['error']!=''){
       		$this->output($Return);
    	}
			
		$data = array(
		'reason' => $this->input->post('reason'),
		'remarks' => $qt_remarks
		);
		
		$result = $this->Attendance_model->update_leave_record($data,$id);
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_leave_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	// Update Leave Status
	public function update_leave_status() {
	
		if($this->input->post('update_type')=='leave') {
			
		$id = $this->uri->segment(4);		
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		$remarks = $this->input->post('remarks');
		$qt_remarks = htmlspecialchars(addslashes($remarks), ENT_QUOTES);
			
		$data = array(
		'status' => $this->input->post('status'),
		'remarks' => $qt_remarks
		);
		
		$result = $this->Attendance_model->update_leave_record($data,$id);
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_leave__status_updated');
			$setting = $this->Tat_model->read_setting_info(1);

		$this->output($Return);
		exit;
		}
	}
}
	// Validate and add info in database
	public function add_attendance() {
	
		if($this->input->post('add_type')=='attendance') {		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		/* Server side PHP input validation */		
		if($this->input->post('attendance_date_m')==='') {
        	$Return['error'] = $this->lang->line('tat_error_attendance_date');
		} else if($this->input->post('clock_in_m')==='') {
        	$Return['error'] = $this->lang->line('tat_error_attendance_in_time');
		} else if($this->input->post('clock_out_m')==='') {
        	$Return['error'] = $this->lang->line('tat_error_attendance_out_time');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		$attendance_date = $this->input->post('attendance_date_m');
		$clock_in = $this->input->post('clock_in_m');
		$clock_out = $this->input->post('clock_out_m');
		
		$clock_in2 = $attendance_date.' '.$clock_in.':00';
		$clock_out2 = $attendance_date.' '.$clock_out.':00';
		
		//total work
		$total_work_cin =  new DateTime($clock_in2);
		$total_work_cout =  new DateTime($clock_out2);
		
		$interval_cin = $total_work_cout->diff($total_work_cin);
		$hours_in   = $interval_cin->format('%h');
		$minutes_in = $interval_cin->format('%i');
		$total_work = $hours_in .":".$minutes_in;
	
		$data = array(
		'employee_id' => $this->input->post('employee_id_m'),
		'attendance_date' => $attendance_date,
		'clock_in' => $clock_in2,
		'clock_out' => $clock_out2,
		'time_late' => $clock_in2,
		'total_work' => $total_work,
		'early_leaving' => $clock_out2,
		'overtime' => $clock_out2,
		'attendance_status' => 'Present',
		'clock_in_out' => '0'
		);
		$result = $this->Attendance_model->add_employee_attendance($data);
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_attendance_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	

    //  Date-wise Attendance List
    public function date_wise_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		$user_info = $this->Tat_model->read_user_info($session['user_id']);
		if(!empty($session)){ 
			$this->load->view("admin/attendance/date_wise", $data);
		} else {
			redirect('admin/');
		}
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$role_resources_ids = $this->Tat_model->user_role_resource(); 
		if(in_array('381',$role_resources_ids) && $user_info[0]->user_role_id!=1) {
			$employee_id = $this->input->get("user_id");
		} else if($user_info[0]->user_role_id!=1) {
			$employee_id = $session['user_id'];
		} else {
			$employee_id = $this->input->get("user_id");
		}
		$system = $this->Tat_model->read_setting_info(1);
		$employee = $this->Tat_model->read_user_info($employee_id);
		
		$start_date = new DateTime( $this->input->get("start_date"));
		$end_date = new DateTime( $this->input->get("end_date") );
		$end_date = $end_date->modify( '+1 day' ); 
		
		$interval_re = new DateInterval('P1D');
		$date_range = new DatePeriod($start_date, $interval_re ,$end_date);
		$attendance_arr = array();
		
		$data = array();
		foreach($date_range as $date) {
		$attendance_date =  $date->format("Y-m-d");
     
		$get_day = strtotime($attendance_date);
		$day = date('l', $get_day);
		
		// Shift Schedule
		$office_shift = $this->Attendance_model->read_office_shift_information($employee[0]->office_shift_id);
		
		// Fetch ClockIn and ClockOut
		if($day == 'Monday') {
			if($office_shift[0]->monday_in_time==''){
				$in_time = '00:00:00';
				$out_time = '00:00:00';
			} else {
				$in_time = $office_shift[0]->monday_in_time;
				$out_time = $office_shift[0]->monday_out_time;
			}
		} else if($day == 'Tuesday') {
			if($office_shift[0]->tuesday_in_time==''){
				$in_time = '00:00:00';
				$out_time = '00:00:00';
			} else {
				$in_time = $office_shift[0]->tuesday_in_time;
				$out_time = $office_shift[0]->tuesday_out_time;
			}
		} else if($day == 'Wednesday') {
			if($office_shift[0]->wednesday_in_time==''){
				$in_time = '00:00:00';
				$out_time = '00:00:00';
			} else {
				$in_time = $office_shift[0]->wednesday_in_time;
				$out_time = $office_shift[0]->wednesday_out_time;
			}
		} else if($day == 'Thursday') {
			if($office_shift[0]->thursday_in_time==''){
				$in_time = '00:00:00';
				$out_time = '00:00:00';
			} else {
				$in_time = $office_shift[0]->thursday_in_time;
				$out_time = $office_shift[0]->thursday_out_time;
			}
		} else if($day == 'Friday') {
			if($office_shift[0]->friday_in_time==''){
				$in_time = '00:00:00';
				$out_time = '00:00:00';
			} else {
				$in_time = $office_shift[0]->friday_in_time;
				$out_time = $office_shift[0]->friday_out_time;
			}
		} else if($day == 'Saturday') {
			if($office_shift[0]->saturday_in_time==''){
				$in_time = '00:00:00';
				$out_time = '00:00:00';
			} else {
				$in_time = $office_shift[0]->saturday_in_time;
				$out_time = $office_shift[0]->saturday_out_time;
			}
		} else if($day == 'Sunday') {
			if($office_shift[0]->sunday_in_time==''){
				$in_time = '00:00:00';
				$out_time = '00:00:00';
			} else {
				$in_time = $office_shift[0]->sunday_in_time;
				$out_time = $office_shift[0]->sunday_out_time;
			}
		}


		// New Status
		$attendance_status = '';
		$check = $this->Attendance_model->attendance_first_in_check($employee[0]->user_id,$attendance_date);		
		if($check->num_rows() > 0){
			
			$attendance = $this->Attendance_model->attendance_first_in($employee[0]->user_id,$attendance_date);
			// ClockIn
			$clock_in = new DateTime($attendance[0]->clock_in);
			$clock_in2 = $clock_in->format('h:i a');
			if($system[0]->is_ssl_available=='yes'){
				$clkInIp = $clock_in2.'<br><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-ipaddress="'.$attendance[0]->clock_in_ip_address.'" data-uid="'.$employee[0]->user_id.'" data-att_type="clock_in" data-start_date="'.$attendance_date.'"><i class="ft-map-pin"></i> '.$this->lang->line('tat_attend_clkin_ip').'</button>';
			} else {
				$clkInIp = $clock_in2;
			}		
			$office_time =  new DateTime($in_time.' '.$attendance_date);
			// Calculate Time
			$office_time_new = strtotime($in_time.' '.$attendance_date);
			$clock_in_time_new = strtotime($attendance[0]->clock_in);
			if($clock_in_time_new <= $office_time_new) {
				$total_time_l = '00:00';
			} else {
				$interval_late = $clock_in->diff($office_time);
				$hours_l   = $interval_late->format('%h');
				$minutes_l = $interval_late->format('%i');			
				$total_time_l = $hours_l ."h ".$minutes_l."m";
			}
			
			// Total Work Hours
			$total_hrs = $this->Attendance_model->total_hours_worked_attendance($employee[0]->user_id,$attendance_date);
			$hrs_old_int1 = 0;
			$Total = '';
			$Trest = '';
			$hrs_old_seconds = 0;
			$hrs_old_seconds_rs = 0;
			$total_time_rs = '';
			$hrs_old_int_res1 = 0;
			foreach ($total_hrs->result() as $hour_work){		
							
				$timee = $hour_work->total_work.':00';
				$str_time =$timee;
	
				$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
				
				sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
				
				$hrs_old_seconds = $hours * 3600 + $minutes * 60 + $seconds;
				
				$hrs_old_int1 += $hrs_old_seconds;
				
				$Total = gmdate("H:i", $hrs_old_int1);	
			}
			if($Total=='') {
				$total_work = '00:00';
			} else {
				$total_work = $Total;
			}
			
			// Total Free Time
			$total_rest = $this->Attendance_model->total_rest_attendance($employee[0]->user_id,$attendance_date);
			foreach ($total_rest->result() as $rest){			
				$str_time_rs = $rest->total_rest.':00';
	
				$str_time_rs = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_rs);
				
				sscanf($str_time_rs, "%d:%d:%d", $hours_rs, $minutes_rs, $seconds_rs);
				
				$hrs_old_seconds_rs = $hours_rs * 3600 + $minutes_rs * 60 + $seconds_rs;
				
				$hrs_old_int_res1 += $hrs_old_seconds_rs;
				
				$total_time_rs = gmdate("H:i", $hrs_old_int_res1);
			}

			$status = $attendance[0]->attendance_status;
			if($total_time_rs=='') {
				$Trest = '00:00';
			} else {
				$Trest = $total_time_rs;
			}
		
		} else {
			$clock_in2 = '-';
			$total_time_l = '00:00';
			$total_work = '00:00';
			$Trest = '00:00';
			$clkInIp = $clock_in2;
			// Leave or Absence Check

			$leave_date_chck = $this->Attendance_model->leave_date_check($employee[0]->user_id,$attendance_date);
			$leave_arr = array();
			if($leave_date_chck->num_rows() == 1){
				$leave_date = $this->Attendance_model->leave_date($employee[0]->user_id,$attendance_date);
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
				
			if($office_shift[0]->monday_in_time == '' && $day == 'Monday') {
				$status = $this->lang->line('tat_holiday');	
			} else if($office_shift[0]->tuesday_in_time == '' && $day == 'Tuesday') {
				$status = $this->lang->line('tat_holiday');	
			} else if($office_shift[0]->wednesday_in_time == '' && $day == 'Wednesday') {
				$status = $this->lang->line('tat_holiday');	
			} else if($office_shift[0]->thursday_in_time == '' && $day == 'Thursday') {
				$status = $this->lang->line('tat_holiday');	
			} else if($office_shift[0]->friday_in_time == '' && $day == 'Friday') {
				$status = $this->lang->line('tat_holiday');	
			} else if($office_shift[0]->saturday_in_time == '' && $day == 'Saturday') {
				$status = $this->lang->line('tat_holiday');	
			} else if($office_shift[0]->sunday_in_time == '' && $day == 'Sunday') {
				$status = $this->lang->line('tat_holiday');	
			}else if(in_array($attendance_date,$leave_arr)) { // Leave
				$status = $this->lang->line('tat_on_leave');
			} 
			else {
				$status = $this->lang->line('tat_absent');
			}
		}
		
		
		// ClockIn > ClockOut Check
		$check_out = $this->Attendance_model->attendance_first_out_check($employee[0]->user_id,$attendance_date);		
		if($check_out->num_rows() == 1){
			
			$early_time =  new DateTime($out_time.' '.$attendance_date);
			
			$first_out = $this->Attendance_model->attendance_first_out($employee[0]->user_id,$attendance_date);
			
			$clock_out = new DateTime($first_out[0]->clock_out);
			
			if ($first_out[0]->clock_out!='') {
				$clock_out2 = $clock_out->format('h:i a');
				if($system[0]->is_ssl_available=='yes'){
					$clkOutIp = $clock_out2.'<br><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-ipaddress="'.$attendance[0]->clock_out_ip_address.'" data-uid="'.$employee[0]->user_id.'" data-att_type="clock_out" data-start_date="'.$attendance_date.'"><i class="ft-map-pin"></i> '.$this->lang->line('tat_attend_clkout_ip').'</button>';
				} else {
					$clkOutIp = $clock_out2;
				}			
				
				$early_new_time = strtotime($out_time.' '.$attendance_date);
				$clock_out_time_new = strtotime($first_out[0]->clock_out);
			
				if($early_new_time <= $clock_out_time_new) {
					$total_time_e = '00:00';
				} else {			
					$interval_lateo = $clock_out->diff($early_time);
					$hours_e   = $interval_lateo->format('%h');
					$minutes_e = $interval_lateo->format('%i');			
					$total_time_e = $hours_e ."h ".$minutes_e."m";
				}
				
				// Overtime Calc
				$over_time =  new DateTime($out_time.' '.$attendance_date);
				$overtime2 = $over_time->format('h:i a');
				
				$over_time_new = strtotime($out_time.' '.$attendance_date);
				$clock_out_time_new1 = strtotime($first_out[0]->clock_out);
				
				if($clock_out_time_new1 <= $over_time_new) {
					$overtime2 = '00:00';
				} else {			
					$interval_lateov = $clock_out->diff($over_time);
					$hours_ov   = $interval_lateov->format('%h');
					$minutes_ov = $interval_lateov->format('%i');			
					$overtime2 = $hours_ov ."h ".$minutes_ov."m";
				}				
				
			} else {
				$clock_out2 =  '-';
				$total_time_e = '00:00';
				$overtime2 = '00:00';
				$clkOutIp = $clock_out2;
			}
					
		} else {
			$clock_out2 =  '-';
			$total_time_e = '00:00';
			$overtime2 = '00:00';
			$clkOutIp = $clock_out2;
		}		

		// User Info
			$full_name = $employee[0]->first_name.' '.$employee[0]->last_name;
			
			$company = $this->Tat_model->read_company_info($employee[0]->company_id);
			if(!is_null($company)){
				$comp_name = $company[0]->name;
			} else {
				$comp_name = '--';	
			}	
			
			$tdate = $this->Tat_model->set_date_format($attendance_date);
		
			$data[] = array(
				$full_name,
				$status,
				$tdate,
				$clkInIp,
				$clkOutIp,
				$total_time_l,
				$total_time_e,
				$overtime2,
				$total_work,
				$Trest
			);
	
      }

	  $output = array(
		   "draw" => $draw,
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
	 }
	 
	 public function import() {
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('left_import_attendance').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('left_import_attendance');
		$data['path_url'] = 'import_attendance';		
		$data['all_employees'] = $this->Tat_model->all_employees();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('31',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/attendance/attendance_import", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}		  
     }

	 public function import_attendance() {
	
		if($this->input->post('is_ajax')=='3') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		//validate whether uploaded file is a csv file
   		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		
		if(empty($_FILES['file']['name'])) {
			$Return['error'] = $this->lang->line('tat_attendance_allowed_size');
		} else {
			if(in_array($_FILES['file']['type'],$csvMimes)){
				if(is_uploaded_file($_FILES['file']['tmp_name'])){
				
					// check file size
					if(filesize($_FILES['file']['tmp_name']) > 512000) {
						$Return['error'] = $this->lang->line('tat_error_attendance_import_size');
					} else {
					//open uploaded csv file with read only mode
					$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
					//skip first line
					fgetcsv($csvFile);
					
					//parse data from csv file line by line
					while(($line = fgetcsv($csvFile)) !== FALSE){
							
						$attendance_date = $line[1];
						$clock_in = $line[2];
						$clock_out = $line[3];
						$clock_in2 = $attendance_date.' '.$clock_in;
						$clock_out2 = $attendance_date.' '.$clock_out;
						
						//total work
						$total_work_cin =  new DateTime($clock_in2);
						$total_work_cout =  new DateTime($clock_out2);
						
						$interval_cin = $total_work_cout->diff($total_work_cin);
						$hours_in   = $interval_cin->format('%h');
						$minutes_in = $interval_cin->format('%i');
						$total_work = $hours_in .":".$minutes_in;
						
						$user = $this->Tat_model->read_user_by_employee_id($line[0]);
						if(!is_null($user)){
							$user_id = $user[0]->user_id;
						} else {
							$user_id = '0';
						}
					
						$data = array(
						'employee_id' => $user_id,
						'attendance_date' => $attendance_date,
						'clock_in' => $clock_in2,
						'clock_out' => $clock_out2,
						'time_late' => $clock_in2,
						'total_work' => $total_work,
						'early_leaving' => $clock_out2,
						'overtime' => $clock_out2,
						'attendance_status' => 'Present',
						'clock_in_out' => '0'
						);
					$result = $this->Attendance_model->add_employee_attendance($data);
				}					
				//close opened csv file
				fclose($csvFile);
	
				$Return['result'] = $this->lang->line('tat_success_attendance_import');
				}
			}else{
				$Return['error'] = $this->lang->line('tat_error_not_attendance_import');
			}
		}else{
			$Return['error'] = $this->lang->line('tat_error_invalid_file');
		}
		} 
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		
		$this->output($Return);
		exit;
		}
	}
	 
	// Update Attendance Record
	 public function update_attendance_list() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
	
		$attendance_date = $this->input->get("attendance_date");
	
		$employee_id = $this->input->get("employee_id");
		
		if(!empty($session)){ 
			$this->load->view("admin/attendance/update_attendance", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Index
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		

		$attendance_employee = $this->Attendance_model->attendance_employee_with_date($employee_id,$attendance_date);
		$role_resources_ids = $this->Tat_model->user_role_resource();
		$data = array();

          foreach($attendance_employee->result() as $r) {
			  
			$in_time = new DateTime($r->clock_in);
			$out_time = new DateTime($r->clock_out);
			$clock_in = $in_time->format('h:i a');			
			
			$att_date_in = explode(' ',$r->clock_in);
			$att_date_out = explode(' ',$r->clock_out);
			$cidate = $this->Tat_model->set_date_format($att_date_in[0]);
			$cin_date = $cidate.' '.$clock_in;
			if($r->clock_out=='') {
				$cout_date = '-';
				$total_time = '-';
			} else {
				$clock_out = $out_time->format('h:i a');
				$interval = $in_time->diff($out_time);
				$hours  = $interval->format('%h');
				$minutes = $interval->format('%i');			
				$total_time = $hours ."h ".$minutes."m";
				$codate = $this->Tat_model->set_date_format($att_date_out[0]);
				$cout_date = $codate.' '.$clock_out;
			}
			if(in_array('278',$role_resources_ids)) { // Update
				$edit = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light edit-data" data-toggle="modal" data-target=".edit-modal-data" data-attendance_id="'.$r->time_attendance_id.'"><i class="fa fa-pencil"></i></button></span>';
			} else {
				$edit = '';
			}
			if(in_array('279',$role_resources_ids)) { // Delete
				$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'.$r->time_attendance_id.'"><i class="fa fa-trash"></i></button></span>';
			} else {
				$delete = '';
			}
			
			$combhr = $edit.$delete;

		   $data[] = array(
				$combhr,
				$cin_date,
				$cout_date,
				$total_time
		   );
	  }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $attendance_employee->num_rows(),
			 "recordsFiltered" => $attendance_employee->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	//  Work Shift Data
	 public function office_shift_list() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/attendance/work_shift", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Index
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$role_resources_ids = $this->Tat_model->user_role_resource();
		$user_info = $this->Tat_model->read_user_info($session['user_id']);
		if($user_info[0]->user_role_id==1){
			$office_shift = $this->Attendance_model->get_office_shifts();
		} else {
			if(in_array('311',$role_resources_ids)) {
				$office_shift = $this->Attendance_model->get_company_shifts($user_info[0]->company_id);
			} else {
				$office_shift = $this->Tat_model->get_employee_shift_office($user_info[0]->office_shift_id);
			}
		}
		$data = array();

          foreach($office_shift->result() as $r) {
			  
			$monday_in_time = new DateTime($r->monday_in_time);
			$monday_out_time = new DateTime($r->monday_out_time);
			$tuesday_in_time = new DateTime($r->tuesday_in_time);
			$tuesday_out_time = new DateTime($r->tuesday_out_time);
			$wednesday_in_time = new DateTime($r->wednesday_in_time);
			$wednesday_out_time = new DateTime($r->wednesday_out_time);
			$thursday_in_time = new DateTime($r->thursday_in_time);
			$thursday_out_time = new DateTime($r->thursday_out_time);
			$friday_in_time = new DateTime($r->friday_in_time);
			$friday_out_time = new DateTime($r->friday_out_time);
			$saturday_in_time = new DateTime($r->saturday_in_time);
			$saturday_out_time = new DateTime($r->saturday_out_time);
			$sunday_in_time = new DateTime($r->sunday_in_time);
			$sunday_out_time = new DateTime($r->sunday_out_time);
			
			if($r->monday_in_time == '') {
				$monday = '-';
			} else {
				$monday = $monday_in_time->format('h:i a') .' ' .$this->lang->line('dashboard_to').' ' .$monday_out_time->format('h:i a');
			}
			if($r->tuesday_in_time == '') {
				$tuesday = '-';
			} else {
				$tuesday = $tuesday_in_time->format('h:i a') .' ' . $this->lang->line('dashboard_to').' '.$tuesday_out_time->format('h:i a');
			}
			if($r->wednesday_in_time == '') {
				$wednesday = '-';
			} else {
				$wednesday = $wednesday_in_time->format('h:i a') .' ' . $this->lang->line('dashboard_to').' ' .$wednesday_out_time->format('h:i a');
			}
			if($r->thursday_in_time == '') {
				$thursday = '-';
			} else {
				$thursday = $thursday_in_time->format('h:i a') .' ' . $this->lang->line('dashboard_to').' ' .$thursday_out_time->format('h:i a');
			}
			if($r->friday_in_time == '') {
				$friday = '-';
			} else {
				$friday = $friday_in_time->format('h:i a') .' ' . $this->lang->line('dashboard_to').' ' .$friday_out_time->format('h:i a');
			}
			if($r->saturday_in_time == '') {
				$saturday = '-';
			} else {
				$saturday = $saturday_in_time->format('h:i a') .' ' . $this->lang->line('dashboard_to').' ' .$saturday_out_time->format('h:i a');
			}
			if($r->sunday_in_time == '') {
				$sunday = '-';
			} else {
				$sunday = $sunday_in_time->format('h:i a') .' ' . $this->lang->line('dashboard_to').' ' .$sunday_out_time->format('h:i a');
			}
			
			// Company Info
			$company = $this->Tat_model->read_company_info($r->company_id);
			if(!is_null($company)){
				$comp_name = $company[0]->name;
			} else {
				$comp_name = '--';	
			}
			
			if(in_array('281',$role_resources_ids)) { // Update
				$edit = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light edit-data" data-toggle="modal" data-target=".edit-modal-data" data-office_shift_id="'. $r->office_shift_id.'" ><span class="fa fa-pencil"></span></button></span>';
			} else {
				$edit = '';
			}
			if(in_array('282',$role_resources_ids)) { // Delete
				$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->office_shift_id . '"><span class="fa fa-trash"></span></button></span>';
			} else {
				$delete = '';
			}
		$functions = '';
		if($r->default_shift=='' || $r->default_shift==0) {
			if(in_array('2822',$role_resources_ids)) { // Delete Default
		 		$functions = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_make_default').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light default-shift" data-office_shift_id="'. $r->office_shift_id.'"><span class="fa fa-clock-o"></span></button></span>';
			} else {
				$functions = '';
			}
		 } else {
		 	$functions = '';
		 }
		 $combhr = $edit.$functions.$delete;
		
		 if($r->default_shift==1){
			$success = '<span class="badge badge-success">'.$this->lang->line('tat_default').'</span>';
		 } else {
			 $success = '';
		 }

		   $data[] = array(
				$combhr,
				$comp_name,
				$r->shift_name . ' ' .$success,
				$monday,
				$tuesday,
				$wednesday,
				$thursday,
				$friday,
				$saturday,
				$sunday
		   );
	  }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $office_shift->num_rows(),
			 "recordsFiltered" => $office_shift->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }  


     // Delete Attendance
	public function delete_attendance() {
		if($this->input->post('type')=='delete') {
			
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$id = $this->uri->segment(4);
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$result = $this->Attendance_model->delete_attendance_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_success_employe_attendance_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}


    // Delete Work Shift
    public function delete_shift() {
		if($this->input->post('type')=='delete') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$id = $this->uri->segment(4);
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$result = $this->Attendance_model->delete_shift_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_success_shift_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}
	
	// Delete Leave Records
	public function delete_leave() {
		if($this->input->post('type')=='delete') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$id = $this->uri->segment(4);
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$result = $this->Attendance_model->delete_leave_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_success_leave_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}

    // Rough Function - to EDIT Clcoking Setting
    public function set_clocking() {
	
		if($this->input->post('type')=='set_clocking') {
			$system = $this->Tat_model->read_setting_info(1);

        	$sys_arr = explode(',',$system[0]->system_ip_address);
        
            $Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
            $Return['csrf_hash'] = $this->security->get_csrf_hash();	
            
            $session = $this->session->userdata('username');
            
            $employee_id = $session['user_id'];
            $clock_state = $this->input->post('clock_state');
            $time_id = $this->input->post('time_id');
    
            $nowtime = date("Y-m-d H:i:s");
        
            $date = date('Y-m-d H:i:s');
            $curtime = $date;
            $today_date = date('Y-m-d');	
            
            if($clock_state=='clock_in') {
                $query = $this->Attendance_model->check_user_attendance();
                $result = $query->result();
                if($query->num_rows() < 1) {
                    $total_rest = '';
                } else {
                    $cout =  new DateTime($result[0]->clock_out);
                    $cin =  new DateTime($curtime);
                    
                    $interval_cin = $cin->diff($cout);
                    $hours_in   = $interval_cin->format('%h');
                    $minutes_in = $interval_cin->format('%i');
                    $total_rest = $hours_in .":".$minutes_in;
                }
                
                $data = array(
                'employee_id' => $employee_id,
                'attendance_date' => $today_date,
                'clock_in' => $curtime,
                'clock_in_ip_address' => $this->input->ip_address(),
                'time_late' => $curtime,
                'early_leaving' => $curtime,
                'overtime' => $curtime,
                'total_rest' => $total_rest,
                'attendance_status' => 'Present',
                'clock_in_out' => '1'
                );
                
                $result = $this->Attendance_model->add_new_attendance($data);
                            
                if ($result == TRUE) {
                    $Return['result'] = $this->lang->line('tat_success_clocked_in');
                } else {
                    $Return['error'] = $this->lang->line('tat_error_msg');
                }
            } else if($clock_state=='clock_out') {
                
                $query = $this->Attendance_model->check_user_attendance_clockout();
                $clocked_out = $query->result();
                $total_work_cin =  new DateTime($clocked_out[0]->clock_in);
                $total_work_cout =  new DateTime($curtime);
                
                $interval_cin = $total_work_cout->diff($total_work_cin);
                $hours_in   = $interval_cin->format('%h');
                $minutes_in = $interval_cin->format('%i');
                $total_work = $hours_in .":".$minutes_in;
                
                $data = array(
                    'employee_id' => $employee_id,
                    'clock_out' => $curtime,
                    'clock_out_ip_address' => $this->input->ip_address(),
                    'clock_in_out' => '0',
                    'early_leaving' => $curtime,
                    'overtime' => $curtime,
                    'total_work' => $total_work
                );
                
    
                $id = $this->input->post('time_id');
                $resuslt2 = $this->Attendance_model->update_attendance_clockedout($data,$id);
                
                if ($resuslt2 == TRUE) {
                    $Return['result'] = $this->lang->line('tat_success_clocked_out');
                    $Return['time_id'] = '';
                } else {
                    $Return['error'] = $this->lang->line('tat_error_msg');
                }
            
            }
                
            $this->output($Return);
            exit;
        }
 	}


    // Auxilary Functions
     public function get_employees() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/attendance/get_employees", $data);
		} else {
			redirect('admin/');
		}
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	} 



    public function get_company_employees() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/attendance/tasks/get_employees", $data);
		} else {
			redirect('admin/');
		}
	
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	}



	 public function get_update_employees() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/attendance/get_update_employees", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	
	 }


}
