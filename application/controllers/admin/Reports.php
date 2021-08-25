<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * HR Reports Controller
 */
class Reports extends MY_Controller
{

	public function output($Return=array()){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		exit(json_encode($Return));
	}
	
	public function __construct()
     {
          parent::__construct();

          $this->load->model('Company_model');
		  $this->load->model('Tat_model');
		  $this->load->model('Aux_model');
		  $this->load->model("Employees_model");
		  $this->load->model('Department_model');
		  $this->load->model('Attendance_model');
		  $this->load->model("Designation_model");
		  $this->load->model('Reports_model');
		  $this->load->model('Payroll_model');
		  $this->load->model("Roles_model");
     }


    public function employee_leave() {
	
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('tat_hr_report_leave_report').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('tat_hr_report_leave_report');
		$data['path_url'] = 'reports_employee_leave';
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('409',$role_resources_ids)) {
			$data['subview'] = $this->load->view("admin/reports/employee_leave", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); 
		} else {
			redirect('admin/dashboard');
		}
	}
    
	public function read_leave_details() {
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('employee_id');
		//$result = $this->Job_post_model->read_job_application_info($id);
		$data = 'A';
		if(!empty($session)){ 
			$this->load->view('admin/reports/dialog_leave_details', $data);
		} else {
			redirect('admin/');
		}
	}

    public function roles() {
	
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('tat_hr_report_user_roles_report').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('tat_hr_report_user_roles_report');
		$data['path_url'] = 'reports_roles';
		$data['all_companies'] = $this->Tat_model->get_companies();
		$data['all_user_roles'] = $this->Roles_model->all_user_roles();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('116',$role_resources_ids)) {
			$data['subview'] = $this->load->view("admin/reports/roles", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); 
		} else {
			redirect('admin/dashboard');
		}
	}
	 

	public function employees() {
	
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('tat_hr_report_employees').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('tat_hr_report_employees');
		$data['path_url'] = 'reports_employees';
		$data['all_companies'] = $this->Tat_model->get_companies();
		$data['all_departments'] = $this->Department_model->all_departments();
		$data['all_designations'] = $this->Designation_model->all_designations();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('117',$role_resources_ids)) {
			$data['subview'] = $this->load->view("admin/reports/employees", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); 
		} else {
			redirect('admin/dashboard');
		}
	}


    public function payslip() {
	
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('tat_hr_reports_payslip').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('tat_hr_reports_payslip');
		$data['path_url'] = 'reports_payslip';
		$data['all_companies'] = $this->Tat_model->get_companies();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('111',$role_resources_ids)) {
			$data['subview'] = $this->load->view("admin/reports/payslip", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); 
		} else {
			redirect('admin/dashboard');
		}
	}

    public function designation() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'department_id' => $id,
			'all_designations' => $this->Designation_model->all_designations(),
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/reports/report_get_designations", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }
	


	 public function get_departments() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/reports/report_get_departments", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 } 
	 

	public function employee_attendance() {
	
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('tat_hr_reports_attendance_employee').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('tat_hr_reports_attendance_employee');
		$data['path_url'] = 'reports_employee_attendance';
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('112',$role_resources_ids)) {
			$data['subview'] = $this->load->view("admin/reports/employee_attendance", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); 
		} else {
			redirect('admin/dashboard');
		}
	}

	
	public function payslip_report() {
	
		if($this->input->post('type')=='payslip_report') {		
	
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
				
		if($this->input->post('company_id')==='') {
			$Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('employee_id')==='') {
        	$Return['error'] = $this->lang->line('tat_error_employee_id');
		} else if($this->input->post('month_year')==='') {
			$Return['error'] = $this->lang->line('tat_hr_report_error_month_field');
		} 
				
		if($Return['error']!=''){
       		$this->output($Return);
		}
		$Return['result'] = $this->lang->line('tat_hr_request_submitted');
		$this->output($Return);
		}
	}
	
	public function role_employees_list() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/reports/roles", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$roleId = $this->uri->segment(4);
		$employee = $this->Reports_model->get_roles_employees($roleId);
		
		$data = array();

        foreach($employee->result() as $r) {		  
		
			$company = $this->Tat_model->read_company_info($r->company_id);
			if(!is_null($company)){
				$comp_name = $company[0]->name;
			} else {
				$comp_name = '--';	
			}
			
			$full_name = $r->first_name.' '.$r->last_name;				

			if($r->is_active==0): $status = $this->lang->line('tat_employees_inactive');
			elseif($r->is_active==1): $status = $this->lang->line('tat_employees_active'); endif;

			$role = $this->Tat_model->read_user_role_info($r->user_role_id);
			if(!is_null($role)){
				$role_name = $role[0]->role_name;
			} else {
				$role_name = '--';	
			}

			$designation = $this->Designation_model->read_designation_information($r->designation_id);
			if(!is_null($designation)){
				$designation_name = $designation[0]->designation_name;
			} else {
				$designation_name = '--';	
			}

			$department = $this->Department_model->read_department_information($r->department_id);
			if(!is_null($department)){
			$department_name = $department[0]->department_name;
			} else {
			$department_name = '--';	
			}
			$department_designation = $designation_name.' ('.$department_name.')';
			
			$data[] = array(
				$r->employee_id,
				$full_name,
				$comp_name,
				$r->email,
				$role_name,
				$department_designation,
				$status
			);
      
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
	 
	 public function report_employees_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/reports/employees", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$company_id = $this->uri->segment(4);
		$department_id = $this->uri->segment(5);
		$designation_id = $this->uri->segment(6);
		$employee = $this->Reports_model->get_employees_reports($company_id,$department_id,$designation_id);
		
		$data = array();

        foreach($employee->result() as $r) {		  
		
			$company = $this->Tat_model->read_company_info($r->company_id);
			if(!is_null($company)){
				$comp_name = $company[0]->name;
			} else {
				$comp_name = '--';	
			}
			
			$full_name = $r->first_name.' '.$r->last_name;				
	
			if($r->is_active==0): $status = $this->lang->line('tat_employees_inactive');
			elseif($r->is_active==1): $status = $this->lang->line('tat_employees_active'); endif;
	
			$designation = $this->Designation_model->read_designation_information($r->designation_id);
			if(!is_null($designation)){
				$designation_name = $designation[0]->designation_name;
			} else {
				$designation_name = '--';	
			}
		
			$department = $this->Department_model->read_department_information($r->department_id);
			if(!is_null($department)){
				$department_name = $department[0]->department_name;
			} else {
				$department_name = '--';	
			}
						
			$data[] = array(
				$r->employee_id,
				$full_name,
				$r->email,
				$department_name,
				$designation_name,
				$status
			);
      
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
	
	

	 public function get_employees() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/reports/get_employees", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }

	 public function get_employees_att() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/reports/get_employees_att", $data);
		} else {
			redirect('admin/');
		}
	
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }
	 

    public function empdtwise_attendance_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/reports/employee_attendance", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		
		$employee = $this->Tat_model->read_user_attendance_info();
		
		$data = array();

        foreach($employee->result() as $r) {
			$data[] = array('','','','','','','','');
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


     public function payslip_report_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/reports/payslip", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$cid = $this->uri->segment(4);
		$eid = $this->uri->segment(5);
		$re_date = $this->uri->segment(6);
		
		
		$payslip_re = $this->Reports_model->get_payslip_list($cid,$eid,$re_date);
		
		$data = array();

          foreach($payslip_re->result() as $r) {

			  // get addd by > template
			  $user = $this->Tat_model->read_user_info($r->employee_id);
			  // user full name
			  if(!is_null($user)){
			  	$full_name = $user[0]->first_name.' '.$user[0]->last_name;
				$emp_link = $user[0]->employee_id;
			  
			  		  
			  $month_payment = date("F, Y", strtotime($r->salary_month));

			  $p_amount = $this->Tat_model->currency_sign($r->net_salary);
	
			  $created_at = $this->Tat_model->set_date_format($r->created_at);
			 
			 $payslip = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_view').'"><a href="'.site_url().'admin/payroll/payslip/id/'.$r->payslip_id.'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_download').'"><a href="'.site_url().'admin/payroll/pdf_create/p/'.$r->payslip_id.'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"><span class="fa fa-download"></span></button></a></span>';
			 
				$p_method = '';
			
			$ifull_name = $full_name.'<br><small class="text-muted"><i>'.$this->lang->line('tat_employees_id').': '.$emp_link.'<i></i></i></small>';

		 	 $payslip = '<a class="text-success" href="'.site_url().'admin/payroll/payslip/id/'.$r->payslip_id.'">'.$this->lang->line('left_generate_payslip').'</a>';

               $data[] = array(
                    $ifull_name,
                    $p_amount,
                    $month_payment,
                    $created_at,
					$payslip
               );
          }
		  } 

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $payslip_re->num_rows(),
                 "recordsFiltered" => $payslip_re->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }
	 

    public function employee_date_wise_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		$user_info = $this->Tat_model->read_user_info($session['user_id']);
		if(!empty($session)){ 
			$this->load->view("admin/reports/employee_attendance", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$employee_id = $this->input->get("user_id");
		
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

		// get office shift for employee
		$get_day = strtotime($attendance_date);
		$day = date('l', $get_day);
		
		// office shift
		$office_shift = $this->Attendance_model->read_office_shift_information($employee[0]->office_shift_id);
		
		// get clock in/clock out of each employee
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
		// check if clock-in for date
		$attendance_status = '';
		$check = $this->Attendance_model->attendance_first_in_check($employee[0]->user_id,$attendance_date);		
		if($check->num_rows() > 0){
			// check clock in time
			$attendance = $this->Attendance_model->attendance_first_in($employee[0]->user_id,$attendance_date);
			// clock in
			$clock_in = new DateTime($attendance[0]->clock_in);
			$clock_in2 = $clock_in->format('h:i a');
			$clkInIp = $clock_in2.'<br><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-ipaddress="'.$attendance[0]->clock_in_ip_address.'" data-uid="'.$employee[0]->user_id.'" data-att_type="clock_in" data-start_date="'.$attendance_date.'"><i class="ft-map-pin"></i> '.$this->lang->line('tat_attend_clkin_ip').'</button>';
			
			$office_time =  new DateTime($in_time.' '.$attendance_date);
			//time diff > total time late
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
			
			// total hours work/ed
			$total_hrs = $this->Attendance_model->total_hours_worked_attendance($employee[0]->user_id,$attendance_date);
			$hrs_old_int1 = 0;
			$Total = '';
			$Trest = '';
			$hrs_old_seconds = 0;
			$hrs_old_seconds_rs = 0;
			$total_time_rs = '';
			$hrs_old_int_res1 = 0;
			foreach ($total_hrs->result() as $hour_work){		
				// total work			
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
			
			// total rest > 
			$total_rest = $this->Attendance_model->total_rest_attendance($employee[0]->user_id,$attendance_date);
			foreach ($total_rest->result() as $rest){			
				// total rest
				$str_time_rs = $rest->total_rest.':00';
	
				$str_time_rs = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time_rs);
				
				sscanf($str_time_rs, "%d:%d:%d", $hours_rs, $minutes_rs, $seconds_rs);
				
				$hrs_old_seconds_rs = $hours_rs * 3600 + $minutes_rs * 60 + $seconds_rs;
				
				$hrs_old_int_res1 += $hrs_old_seconds_rs;
				
				$total_time_rs = gmdate("H:i", $hrs_old_int_res1);
			}
			
			// check attendance status
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
			// get leave or absent
			
			// get leave employee
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
			} else if(in_array($attendance_date,$leave_arr)) { // on leave
				$status = $this->lang->line('tat_on_leave');
			} 
			else {
				$status = $this->lang->line('tat_absent');
			}
		}
			
		// check if clock-out for date
		$check_out = $this->Attendance_model->attendance_first_out_check($employee[0]->user_id,$attendance_date);		
		if($check_out->num_rows() == 1){
			/* early time */
			$early_time =  new DateTime($out_time.' '.$attendance_date);
			// check clock in time
			$first_out = $this->Attendance_model->attendance_first_out($employee[0]->user_id,$attendance_date);
			// clock out
			$clock_out = new DateTime($first_out[0]->clock_out);
			
			if ($first_out[0]->clock_out!='') {
				$clock_out2 = $clock_out->format('h:i a');
				$clkOutIp = $clock_out2.'<br><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-ipaddress="'.$attendance[0]->clock_out_ip_address.'" data-uid="'.$employee[0]->user_id.'" data-att_type="clock_out" data-start_date="'.$attendance_date.'"><i class="ft-map-pin"></i> '.$this->lang->line('tat_attend_clkout_ip').'</button>';
				// early leaving
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
				
				/* over time */
				$over_time =  new DateTime($out_time.' '.$attendance_date);
				$overtime2 = $over_time->format('h:i a');
				// over time
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

		    // user full name
			$full_name = $employee[0]->first_name.' '.$employee[0]->last_name;
			// get company
			$company = $this->Tat_model->read_company_info($employee[0]->company_id);
			if(!is_null($company)){
				$comp_name = $company[0]->name;
			} else {
				$comp_name = '--';	
			}	
			// attendance date
			$tdate = $this->Tat_model->set_date_format($attendance_date);
			
			$data[] = array(
				$full_name,
				$comp_name,
				$status,
				$tdate,
				$clock_in2,
				$clock_out2,
				$total_work
			);
      }

	  $output = array(
		   "draw" => $draw,
	
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	 public function employee_leave_list() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/reports/employee_leave", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$sd = $this->uri->segment(4);
		$ed = $this->uri->segment(5);
		$user_id = $this->uri->segment(6);
		$company_id = $this->uri->segment(7);
		if($user_id == '') {
			$employee = $this->Reports_model->get_leave_application_list();
		} else {
			$employee = $this->Reports_model->get_leave_application_filter_list($sd,$ed,$user_id,$company_id);
		}
		$data = array();

        foreach($employee->result() as $r) {		  
		
			// get company
			$company = $this->Tat_model->read_company_info($r->company_id);
			if(!is_null($company)){
				$comp_name = $company[0]->name;
			} else {
				$comp_name = '--';	
			}
			$employee = $this->Tat_model->read_user_info($r->employee_id);
			// user full name 
			if(!is_null($employee)){
				$full_name = $employee[0]->first_name.' '.$employee[0]->last_name;
			} else {
				$full_name = '--';
			}
			//approved leave
			$rapproved = $this->Reports_model->get_approved_leave_application_list($r->employee_id);
			$approved = '<a style="cursor:pointer" data-toggle="modal" data-target=".edit-modal-data" data-leave_opt="Approved" data-employee_id="'. $r->employee_id . '">'.$rapproved.' '.$this->lang->line('tat_case').'</a>';
			// pending leave
			$rpending = $this->Reports_model->get_pending_leave_application_list($r->employee_id);
			$pending = '<a style="cursor:pointer" data-toggle="modal" data-target=".edit-modal-data" data-leave_opt="Pending" data-employee_id="'. $r->employee_id . '">'.$rpending.' '.$this->lang->line('tat_case').'</a>';
			//upcoming leave
			$rupcoming = $this->Reports_model->get_upcoming_leave_application_list($r->employee_id);
			$upcoming = '<a style="cursor:pointer" data-toggle="modal" data-target=".edit-modal-data" data-leave_opt="Upcoming" data-employee_id="'. $r->employee_id . '">'.$rupcoming.' '.$this->lang->line('tat_case').'</a>';
			//rejected leave
			$rrejected = $this->Reports_model->get_rejected_leave_application_list($r->employee_id);
			$rejected = '<a style="cursor:pointer" data-toggle="modal" data-target=".edit-modal-data" data-leave_opt="Rejected" data-employee_id="'. $r->employee_id . '">'.$rrejected.' '.$this->lang->line('tat_case').'</a>';			
			
			$data[] = array(
				$comp_name,
				$full_name,
				$approved,
				$pending,
				$upcoming,
				$rejected,
			);
      
	  }
	  $output = array(
		   "draw" => $draw,
			 //"recordsTotal" => $employee->num_rows(),
			 //"recordsFiltered" => $employee->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }

	   
} 
?>