<?php
/**
 * Profile Controller:  for managing one's own user information and details as a User Profile.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();

		$this->load->model("Tat_model");
		$this->load->model("Employees_model");
		$this->load->model("Department_model");
		$this->load->model("Designation_model");
		$this->load->model("Roles_model");
		$this->load->model("Payroll_model");
		$this->load->model("Location_model");
		$this->load->model("Attendance_model");
		$this->load->model("Transfers_model");
		$this->load->model("Promotion_model");
		$this->load->model("Complaints_model");
		$this->load->model("Warning_model");
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
		$result = $this->Employees_model->read_employee_information($session['user_id']);
		
		$designation = $this->Designation_model->read_designation_information($result[0]->designation_id);
		if(!is_null($designation)){
			$edesignation_name = $designation[0]->designation_name;
		} else {
			$edesignation_name = '--';	
		}

		$data = array(
			'first_name' => $result[0]->first_name,
			'last_name' => $result[0]->last_name,
			'designation' => $edesignation_name,
			'user_id' => $result[0]->user_id,
			'employee_id' => $result[0]->employee_id,
			'username' => $result[0]->username,
			'email' => $result[0]->email,
			'department_id' => $result[0]->department_id,
			'designation_id' => $result[0]->designation_id,
			'user_role_id' => $result[0]->user_role_id,
			'date_of_birth' => $result[0]->date_of_birth,
			'date_of_leaving' => $result[0]->date_of_leaving,
			'gender' => $result[0]->gender,
			'marital_status' => $result[0]->marital_status,
			'contact_no' => $result[0]->contact_no,
			'wages_type' => $result[0]->wages_type,
			'basic_salary' => $result[0]->basic_salary,
			'address' => $result[0]->address,
			'is_active' => $result[0]->is_active,
			'date_of_joining' => $result[0]->date_of_joining,
			'all_departments' => $this->Department_model->all_departments(),
			'all_designations' => $this->Designation_model->all_designations(),
			'all_user_roles' => $this->Roles_model->all_user_roles(),
			'title' => $this->lang->line('header_my_profile').' | '.$this->Tat_model->site_title(),
			'profile_picture' => $result[0]->profile_picture,
			'last_login_date' => $result[0]->last_login_date,
			'last_login_date' => $result[0]->last_login_date,
			'last_login_ip' => $result[0]->last_login_ip,
			'all_countries' => $this->Tat_model->get_countries(),
			'all_document_types' => $this->Employees_model->all_document_types(),
			'all_education_level' => $this->Employees_model->all_education_level(),
			'all_qualification_language' => $this->Employees_model->all_qualification_language(),
			'all_qualification_skill' => $this->Employees_model->all_qualification_skill(),
			'all_office_shifts' => $this->Employees_model->all_office_shifts(),
			'all_office_locations' => $this->Location_model->all_office_locations(),
			'all_leave_types' => $this->Attendance_model->all_leave_types()
			);
		$data['breadcrumbs'] = $this->lang->line('header_my_profile');
		$data['path_url'] = 'profile';
		if(!empty($session)){ 
			$data['subview'] = $this->load->view("admin/employees/profile", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); 
		} else {
			redirect('hr/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }
	 	


	public function user_basic_info() {
	
		if($this->input->post('type')=='basic_info') {		
	
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		
		$first_name = $this->Tat_model->clean_post($this->input->post('first_name'));
		$last_name = $this->Tat_model->clean_post($this->input->post('last_name'));
		$date_of_birth = $this->Tat_model->clean_date_post($this->input->post('date_of_birth'));
		$contact_no = $this->Tat_model->clean_date_post($this->input->post('contact_no'));
		$address = $this->Tat_model->clean_date_post($this->input->post('address'));
					
		if($this->input->post('first_name')==='') {
        	$Return['error'] = $this->lang->line('tat_employee_error_first_name');
		} else if($first_name==='') {
			$Return['error'] = $this->lang->line('tat_hr_special_charactors_not_allowed');
		} else if($this->input->post('last_name')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_last_name');
		} else if($last_name==='') {
			$Return['error'] = $this->lang->line('tat_hr_special_charactors_not_allowed');
		} else if($this->input->post('date_of_birth')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_joining_date');
		} else if($this->Tat_model->validate_date($this->input->post('date_of_birth'),'Y-m-d') == false) {
			 $Return['error'] = $this->lang->line('tat_hr_date_format_error');
		} else if($this->input->post('email')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_email');
		} else if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$Return['error'] = $this->lang->line('tat_employee_error_invalid_email');
		} else if($this->input->post('date_of_birth')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_date_of_birth');
		} else if($this->Tat_model->validate_date($this->input->post('date_of_birth'),'Y-m-d') == false) {
			 $Return['error'] = $this->lang->line('tat_hr_date_format_error');
		} else if($this->input->post('contact_no')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_contact_number');
		} 
						
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'first_name' => $first_name,
		'last_name' => $last_name,
		'email' => $this->input->post('email'),
		'date_of_birth' => $date_of_birth,
		'gender' => $this->input->post('gender'),
		'marital_status' => $this->input->post('marital_status'),
		'contact_no' => $contact_no,
		'address' => $address
		);
		$id = $this->input->post('user_id');
		$result = $this->Employees_model->basic_info($data,$id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_basic_info_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
}