<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->library("pagination");
		$this->load->helper('string');

		$this->load->model("Employees_model");
		$this->load->model("Department_model");
		$this->load->model("Designation_model");
		$this->load->model("Roles_model");
		$this->load->model("Location_model");
		$this->load->model("Company_model");
		$this->load->model("Custom_fields_model");
		$this->load->model("Attendance_model");
		$this->load->model("Promotion_model");
		$this->load->model("Complaints_model");
		$this->load->model("Warning_model");
		$this->load->model("Transfers_model");
		$this->load->model("Payroll_model");
		$this->load->model("Tat_model");
	
	}
	
	/*Function to set JSON output*/
	public function output($Return=array()){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		exit(json_encode($Return));
	}
	
	 public function index()
     {
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('tat_employees').' | '.$this->Tat_model->site_title();
		$data['all_departments'] = $this->Department_model->all_departments();
		$data['all_designations'] = $this->Designation_model->all_designations();
		$data['all_user_roles'] = $this->Roles_model->all_user_roles();
		$data['all_office_shifts'] = $this->Employees_model->all_office_shifts();
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$data['all_leave_types'] = $this->Attendance_model->all_leave_types();
		$data['breadcrumbs'] = $this->lang->line('tat_employees');
		$data['path_url'] = 'employees';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('13',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/employees/employees_list", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); //page load
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}
     }
	

 
    public function employees_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employees_list", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$role_resources_ids = $this->Tat_model->user_role_resource();		
		$system = $this->Tat_model->read_setting_info(1);
		$user_info = $this->Tat_model->read_user_info($session['user_id']);
		if($this->input->get("ihr")=='true'){
			if($this->input->get("company_id")==0 && $this->input->get("location_id")==0 && $this->input->get("department_id")==0 && $this->input->get("designation_id")==0){
				$employee = $this->Employees_model->get_employees();
				
			} else if($this->input->get("company_id")!=0 && $this->input->get("location_id")==0 && $this->input->get("department_id")==0 && $this->input->get("designation_id")==0){
				$employee = $this->Employees_model->get_company_employees_flt($this->input->get("company_id"));
			} else if($this->input->get("company_id")!=0 && $this->input->get("location_id")!=0 && $this->input->get("department_id")==0 && $this->input->get("designation_id")==0){
				$employee = $this->Employees_model->get_company_location_employees_flt($this->input->get("company_id"),$this->input->get("location_id"));
				
			} else if($this->input->get("company_id")!=0 && $this->input->get("location_id")!=0 && $this->input->get("department_id")!=0 && $this->input->get("designation_id")==0){
				$employee = $this->Employees_model->get_company_location_department_employees_flt($this->input->get("company_id"),$this->input->get("location_id"),$this->input->get("department_id"));
				
			} else if($this->input->get("company_id")!=0 && $this->input->get("location_id")!=0 && $this->input->get("department_id")!=0 && $this->input->get("designation_id")!=0){
				$employee = $this->Employees_model->get_company_location_department_designation_employees_flt($this->input->get("company_id"),$this->input->get("location_id"),$this->input->get("department_id"),$this->input->get("designation_id"));
			}
		} else {
			if($user_info[0]->user_role_id==1) {
				$employee = $this->Employees_model->get_employees();
			} else {
				if(in_array('372',$role_resources_ids)) {
					$employee = $this->Employees_model->get_employees_for_other($user_info[0]->company_id);
				} else if(in_array('373',$role_resources_ids)) {
					$employee = $this->Employees_model->get_employees_for_location($user_info[0]->location_id);
				} else {
					$employee = $this->Employees_model->get_employees_for_location($user_info[0]->location_id);
				}
			}
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
			
			// user full name 
			$full_name = $r->first_name.' '.$r->last_name;
			// user role
			$role = $this->Tat_model->read_user_role_info($r->user_role_id);
			if(!is_null($role)){
				$role_name = $role[0]->role_name;
			} else {
				$role_name = '--';	
			}
			// get designation
			$designation = $this->Designation_model->read_designation_information($r->designation_id);
			if(!is_null($designation)){
				$designation_name = $designation[0]->designation_name;
			} else {
				$designation_name = '--';	
			}
			// department
			$department = $this->Department_model->read_department_information($r->department_id);
			if(!is_null($department)){
			$department_name = $department[0]->department_name;
			} else {
			$department_name = '--';	
			}
			// location
			$location = $this->Location_model->read_location_information($r->location_id);
			if(!is_null($location)){
			$location_name = $location[0]->location_name;
			} else {
			$location_name = '--';	
			}
			
			
			$department_designation = $designation_name.' ('.$department_name.')';
			// get status
			if($r->is_active==0): $status = '<span class="badge bg-red">'.$this->lang->line('tat_employees_inactive').'</span>';
			elseif($r->is_active==1): $status = '<span class="badge bg-green">'.$this->lang->line('tat_employees_active').'</span>';endif;
			
			if($r->user_id != '1') {
				if(in_array('203',$role_resources_ids)) {
					$del_opt = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->user_id . '"><span class="fa fa-trash"></span></button></span>';
				} else {
					$del_opt = '';
				}
			} else {
				$del_opt = '';
			}
			if(in_array('202',$role_resources_ids)) {
				$view_opt = ' <span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_view_details').'"><a href="'.site_url().'admin/employees/detail/'.$r->user_id.'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"><span class="fa fa-arrow-circle-right"></span></button></a></span>';
			} else {
				$view_opt = '';
			}
			$function = $view_opt.$del_opt.'';
			if($r->wages_type == 1){
				$bsalary = $this->Tat_model->currency_sign($r->basic_salary);
			} else {
				$bsalary = $this->Tat_model->currency_sign($r->daily_wages);
			}
			
			
			if($r->profile_picture!='' && $r->profile_picture!='no file') {
				$ol = '<a href="javascript:void(0);"><span class="avatar box-32"><img src="'.base_url().'uploads/profile/'.$r->profile_picture.'" class="user-image-hr" alt=""></span></a>';
			} else {
				if($r->gender=='Male') { 
					$de_file = base_url().'uploads/profile/default_male.png';
				 } else {
					$de_file = base_url().'uploads/profile/default_female.png';
				 }
				$ol = '<a href="javascript:void(0);"><span class="avatar box-32"><img src="'.$de_file.'" class="user-image-hr" alt=""></span></a>';
			}

			$office_shift = $this->Attendance_model->read_office_shift_information($r->office_shift_id);
			if(!is_null($office_shift)){
				$shift = $office_shift[0]->shift_name;
			} else {
				$shift = '--';	
			}

			

			$employee_name = $ol.$full_name.'<br><small class="text-muted tatari-text-info-margin"><i>'.$this->lang->line('tat_employees_id').': '.$r->employee_id.'<i></i></i></small><br><small class="text-muted tatari-text-info-margin"><i>'.$this->lang->line('tat_e_details_shift').': '.$shift.'<i></i></i></small><br>';

			$comp_name = $comp_name.'<br><small class="text-muted"><i>Location: '.$location_name.'<i></i></i></small><br><small class="text-muted"><i>'.$this->lang->line('left_department').': '.$department_name.'<i></i></i></small><br><small class="text-muted"><i>'.$this->lang->line('left_designation').': '.$designation_name.'<i></i></i></small>';
			
			$contact_info = '<i class="fa fa-user" data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('dashboard_username').'"></i> '.$r->username.'<br><i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('dashboard_email').'"></i> '.$r->email.'<br><i class="fa fa-phone" data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_contact_number').'"></i> '.$r->contact_no;
			
			$role_status = $role_name.'<br>'.$status;
			$data[] = array(
				$function,
				$employee_name,
				$comp_name,
				$contact_info,
				$role_status,
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

	public function hr() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('tat_employees_directory').' | '.$this->Tat_model->site_title();
		$data['all_departments'] = $this->Department_model->all_departments();
		$data['all_designations'] = $this->Designation_model->all_designations();
		$data['all_user_roles'] = $this->Roles_model->all_user_roles();
		$data['all_employees'] = $this->Tat_model->all_employees();
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$data['breadcrumbs'] = $this->lang->line('tat_employees_directory');
		$data['path_url'] = 'employees_directory';
		
		// init params
        $config = array();
        $limit_per_page = 18;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		if($this->input->post("tatari_directory")==1){
			if($this->input->post("company_id")==0 && $this->input->post("location_id")==0 && $this->input->post("department_id")==0 && $this->input->post("designation_id")==0){
				$total_records = $this->Employees_model->record_count();
				// get current page records
				$data["results"] = $this->Employees_model->fetch_all_employees($limit_per_page, $page*$limit_per_page);
			} else if($this->input->post("company_id")!=0 && $this->input->post("location_id")==0 && $this->input->post("department_id")==0 && $this->input->post("designation_id")==0){
				$total_records = $this->Employees_model->record_count_company_employees($this->input->post("company_id"));
				// get current page records
				$data["results"] = $this->Employees_model->fetch_all_company_employees_flt($limit_per_page, $page*$limit_per_page,$this->input->post("company_id"));
			} else if($this->input->post("company_id")!=0 && $this->input->post("location_id")!=0 && $this->input->post("department_id")==0 && $this->input->post("designation_id")==0){
				$total_records = $this->Employees_model->record_count_company_location_employees($this->input->post("company_id"),$this->input->post("location_id"));
				// get current page records
				$data["results"] = $this->Employees_model->fetch_all_company_location_employees_flt($limit_per_page, $page*$limit_per_page,$this->input->post("company_id"),$this->input->post("location_id"));
			} else if($this->input->post("company_id")!=0 && $this->input->post("location_id")!=0 && $this->input->post("department_id")!=0 && $this->input->post("designation_id")==0){
				$total_records = $this->Employees_model->record_count_company_location_department_employees($this->input->post("company_id"),$this->input->post("location_id"),$this->input->post("department_id"));
				// get current page records
				$data["results"] = $this->Employees_model->fetch_all_company_location_department_employees_flt($limit_per_page, $page*$limit_per_page,$this->input->post("company_id"),$this->input->post("location_id"),$this->input->post("department_id"));
			} else if($this->input->post("company_id")!=0 && $this->input->post("location_id")!=0 && $this->input->post("department_id")!=0 && $this->input->post("designation_id")!=0){
				$total_records = $this->Employees_model->record_count_company_location_department_designation_employees($this->input->post("company_id"),$this->input->post("location_id"),$this->input->post("department_id"),$this->input->post("designation_id"));
				// get current page records
				$data["results"] = $this->Employees_model->fetch_all_company_location_department_designation_employees_flt($limit_per_page, $page*$limit_per_page,$this->input->post("company_id"),$this->input->post("location_id"),$this->input->post("department_id"),$this->input->post("designation_id"));
			}
		} else {
			$total_records = $this->Employees_model->record_count();
			// get current page records
			$data["results"] = $this->Employees_model->fetch_all_employees($limit_per_page, $page*$limit_per_page);
		}
		$config['base_url'] = site_url() . "admin/employees/hr";
		$config['total_rows'] = $total_records;
		$config['per_page'] = $limit_per_page;
		$config["uri_segment"] = 4;
		 
		// custom paging configuration
	   // $config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = FALSE;
		//$config['page_query_string'] = TRUE;
		 
		//$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_records;
		$config['cur_tag_open'] = '&nbsp;<a>';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = '»';
		$config['prev_link'] = '«';
		 
		$this->pagination->initialize($config);
			 
		// build paging links
		//$data["links"] = $this->pagination->create_links();
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );
		$data["total_record"] = $total_records;
		// View data according to array.
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('88',$role_resources_ids)) {
			$data['subview'] = $this->load->view("admin/employees/directory", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); //page load
		} else {
			redirect('admin/dashboard');
		}	  
     } 
		


	 public function detail() {

		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$id = $this->uri->segment(4);
		$result = $this->Employees_model->read_employee_information($id);
		if(is_null($result)){
			redirect('admin/employees');
		}
		$role_resources_ids = $this->Tat_model->user_role_resource();
		$check_role = $this->Employees_model->read_employee_information($session['user_id']);
		if(!in_array('202',$role_resources_ids)) {
			redirect('admin/employees');
		}


		$data = array(
			'breadcrumbs' => $this->lang->line('tat_employee_detail'),
			'path_url' => 'employees_detail',
			'first_name' => $result[0]->first_name,
			'last_name' => $result[0]->last_name,
			'user_id' => $result[0]->user_id,
			'employee_id' => $result[0]->employee_id,
			'company_id' => $result[0]->company_id,
			'location_id' => $result[0]->location_id,
			'office_shift_id' => $result[0]->office_shift_id,
			'username' => $result[0]->username,
			'email' => $result[0]->email,
			'department_id' => $result[0]->department_id,
			'sub_department_id' => $result[0]->sub_department_id,
			'designation_id' => $result[0]->designation_id,
			'user_role_id' => $result[0]->user_role_id,
			'date_of_birth' => $result[0]->date_of_birth,
			'date_of_leaving' => $result[0]->date_of_leaving,
			'gender' => $result[0]->gender,
			'marital_status' => $result[0]->marital_status,
			'contact_no' => $result[0]->contact_no,
			'state' => $result[0]->state,
			'city' => $result[0]->city,
			'zipcode' => $result[0]->zipcode,
			'address' => $result[0]->address,
			'wages_type' => $result[0]->wages_type,
			'basic_salary' => $result[0]->basic_salary,
			'is_active' => $result[0]->is_active,
			'date_of_joining' => $result[0]->date_of_joining,
			'all_departments' => $this->Department_model->all_departments(),
			'all_designations' => $this->Designation_model->all_designations(),
			'all_user_roles' => $this->Roles_model->all_user_roles(),
			'title' => $this->lang->line('tat_employee_detail').' | '.$this->Tat_model->site_title(),
			'profile_picture' => $result[0]->profile_picture,
			'leave_categories' => $result[0]->leave_categories,
			'view_companies_id' => $result[0]->view_companies_id,
			'all_countries' => $this->Tat_model->get_countries(),
			'all_document_types' => $this->Employees_model->all_document_types(),
			'all_education_level' => $this->Employees_model->all_education_level(),
			'all_qualification_language' => $this->Employees_model->all_qualification_language(),
			'all_qualification_skill' => $this->Employees_model->all_qualification_skill(),
			'all_office_shifts' => $this->Employees_model->all_office_shifts(),
			'get_all_companies' => $this->Tat_model->get_companies(),
			'all_office_locations' => $this->Location_model->all_office_locations(),
			'all_leave_types' => $this->Attendance_model->all_leave_types(),
			);
		
		$data['subview'] = $this->load->view("admin/employees/employee_detail", $data, TRUE);
		$this->load->view('admin/layout/layout_main', $data); 
		
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
			$this->load->view("admin/employees/get_departments", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 } 
	 
	public function dialog_contact() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_contact_information($id);
		$data = array(
			'contact_id' => $result[0]->contact_id,
			'employee_id' => $result[0]->employee_id,
			'relation' => $result[0]->relation,
			'is_primary' => $result[0]->is_primary,
			'is_dependent' => $result[0]->is_dependent,
			'contact_name' => $result[0]->contact_name,
			'work_phone' => $result[0]->work_phone,
			'mobile_phone' => $result[0]->mobile_phone,
			'home_phone' => $result[0]->home_phone,
			'work_email' => $result[0]->work_email,
			'personal_email' => $result[0]->personal_email,
			'address_1' => $result[0]->address_1,
			'address_2' => $result[0]->address_2,
			'city' => $result[0]->city,
			'state' => $result[0]->state,
			'zipcode' => $result[0]->zipcode,
			'icountry' => $result[0]->country,
			'all_countries' => $this->Tat_model->get_countries()
		);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}


	public function dialog_shift() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_emp_shift_information($id);
		$data = array(
				'emp_shift_id' => $result[0]->emp_shift_id,
				'employee_id' => $result[0]->employee_id,
				'shift_id' => $result[0]->shift_id,
				'from_date' => $result[0]->from_date,
				'to_date' => $result[0]->to_date
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}

	 public function get_company_elocations() {

		$data['title'] = $this->Tat_model->site_title();
		$keywords = preg_split("/[\s,]+/", $this->uri->segment(4));
		if(is_numeric($keywords[0])) {
			$id = $keywords[0];
		
			$data = array(
				'company_id' => $id
				);
			$session = $this->session->userdata('username');
			if(!empty($session)){ 
				$data = $this->security->xss_clean($data);
				$this->load->view("admin/employees/get_company_elocations", $data);
			} else {
				redirect('admin/');
			}
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }


	 public function get_location_departments() {

		$data['title'] = $this->Tat_model->site_title();
		$keywords = preg_split("/[\s,]+/", $this->uri->segment(4));
		if(is_numeric($keywords[0])) {
			$id = $keywords[0];
		
			$data = array(
				'location_id' => $id
				);
			$session = $this->session->userdata('username');
			if(!empty($session)){ 
				$data = $this->security->xss_clean($data);
				$this->load->view("admin/employees/get_location_departments", $data);
			} else {
				redirect('admin/');
			}
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }


	

	 public function designation() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'subdepartment_id' => $id,
			'all_designations' => $this->Designation_model->all_designations(),
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/get_designations", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }
	 
	  public function is_designation() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'department_id' => $id,
			'all_designations' => $this->Designation_model->all_designations(),
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/get_designations", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }


	 public function get_sub_departments() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'department_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/get_sub_departments", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }
	 
	 public function read()
	{
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('warning_id');
		$result = $this->Warning_model->read_warning_information($id);
		$data = array(
				'warning_id' => $result[0]->warning_id,
				'warning_to' => $result[0]->warning_to,
				'warning_by' => $result[0]->warning_by,
				'warning_date' => $result[0]->warning_date,
				'warning_type_id' => $result[0]->warning_type_id,
				'subject' => $result[0]->subject,
				'description' => $result[0]->description,
				'status' => $result[0]->status,
				'all_employees' => $this->Tat_model->all_employees(),
				'all_warning_types' => $this->Warning_model->all_warning_types(),
				);
		if(!empty($session)){ 
			$this->load->view('admin/warning/dialog_warning', $data);
		} else {
			redirect('admin/');
		}
	}
	

	public function add_employee() {
	
		if($this->input->post('add_type')=='employee') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();		

		$system = $this->Tat_model->read_setting_info(1);
		/* Server side PHP input validation */		
		if($this->input->post('first_name')==='') {
        	$Return['error'] = $this->lang->line('tat_employee_error_first_name');
		} 
		else if($this->input->post('last_name')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_last_name');
		} 
		else if($this->input->post('employee_id')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_employee_id');
		} else if($this->Employees_model->check_employee_id($this->input->post('employee_id')) > 0) {
			 $Return['error'] = $this->lang->line('tat_employee_id_already_exist');
		} else if($this->input->post('date_of_joining')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_joining_date');
		} else if($this->Tat_model->validate_date($this->input->post('date_of_joining'),'Y-m-d') == false) {
			 $Return['error'] = $this->lang->line('tat_hr_date_format_error');
		} else if($this->input->post('company_id')==='') {
			 $Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('department_id')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_department');
		} 	else if($this->input->post('designation_id')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_designation');
		} else if($this->input->post('username')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_username');
		} else if($this->Employees_model->check_employee_username($this->input->post('username')) > 0) {
			 $Return['error'] = $this->lang->line('tat_employee_username_already_exist');
		} else if($this->input->post('email')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_email');
		} else if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$Return['error'] = $this->lang->line('tat_employee_error_invalid_email');
		} else if($this->Employees_model->check_employee_email($this->input->post('email')) > 0) {
			 $Return['error'] = $this->lang->line('tat_employee_email_already_exist');
		} else if($this->input->post('date_of_birth')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_date_of_birth');
		} else if($this->Tat_model->validate_date($this->input->post('date_of_birth'),'Y-m-d') == false) {
			 $Return['error'] = $this->lang->line('tat_hr_date_format_error');
		} else if($this->input->post('contact_no')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_contact_number');
		} else if(!preg_match('/^([0-9]*)$/', $this->input->post('contact_no'))) {
			 $Return['error'] = $this->lang->line('tat_hr_numeric_error');
		} else if($this->input->post('password')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_password');
		} else if(strlen($this->input->post('password')) < 6) {
			 $Return['error'] = $this->lang->line('tat_employee_error_password_least');
		} else if($this->input->post('password')!==$this->input->post('confirm_password')) {
			 $Return['error'] = $this->lang->line('tat_employee_error_password_not_match');
		} else if($this->input->post('role')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_user_role');
		} 
		if($Return['error']!=''){
       		$this->output($Return);
    	}

		
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		$module_attributes = $this->Custom_fields_model->all_tatari_module_attributes();
		$count_module_attributes = $this->Custom_fields_model->count_module_attributes();	
		$i=1;
		if($count_module_attributes > 0){
			 foreach($module_attributes as $mattribute) {
				 if($mattribute->validation == 1){
					 if($i!=1) {
					 } else if($this->input->post($mattribute->attribute)=='') {
						$Return['error'] = $this->lang->line('tat_tatari_custom_field_the').' '.$mattribute->attribute_label.' '.$this->lang->line('tat_tatari_custom_field_is_required');
					}
				 }
			 }		
			 if($Return['error']!=''){
				$this->output($Return);
			}	
		}
		
		$first_name = $this->Tat_model->clean_post($this->input->post('first_name'));
		$last_name = $this->Tat_model->clean_post($this->input->post('last_name'));
		$employee_id = $this->Tat_model->clean_post($this->input->post('employee_id'));
		$date_of_joining = $this->Tat_model->clean_date_post($this->input->post('date_of_joining'));
		$username = $this->Tat_model->clean_post($this->input->post('username'));
		$date_of_birth = $this->Tat_model->clean_date_post($this->input->post('date_of_birth'));
		$contact_no = $this->Tat_model->clean_post($this->input->post('contact_no'));
		$address = $this->Tat_model->clean_post($this->input->post('address'));
		
		$options = array('cost' => 12);
		$password_hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
		$leave_categories = array($this->input->post('leave_categories'));
		$cat_ids = implode(',',$this->input->post('leave_categories'));

		$data = array(
		'employee_id' => $employee_id,
		'office_shift_id' => $this->input->post('office_shift_id'),
		'first_name' => $first_name,
		'last_name' => $last_name,
		'username' => $username,
		'company_id' => $this->input->post('company_id'),
		'location_id' => $this->input->post('location_id'),
		'email' => $this->input->post('email'),
		'password' => $password_hash,
		'date_of_birth' => $date_of_birth,
		'gender' => $this->input->post('gender'),
		'user_role_id' => $this->input->post('role'),
		'department_id' => $this->input->post('department_id'),
		'sub_department_id' => $this->input->post('subdepartment_id'),
		'designation_id' => $this->input->post('designation_id'),
		'date_of_joining' => $date_of_joining,
		'contact_no' => $contact_no,
		'address' => $address,
		'is_active' => 1,
		'created_at' => date('Y-m-d h:i:s')
		);
		$iresult = $this->Employees_model->add($data);
		if ($iresult) {
			
			$id = $iresult;
			if($count_module_attributes > 0){
				foreach($module_attributes as $mattribute) {
				 
					if($mattribute->attribute_type == 'fileupload'){
						if($_FILES[$mattribute->attribute]['size'] != 0) {
							if(is_uploaded_file($_FILES[$mattribute->attribute]['tmp_name'])) {
							//checking image type
								$allowed =  array('png','jpg','jpeg','pdf','gif','xls','doc','xlsx','docx');
								$filename = $_FILES[$mattribute->attribute]['name'];
								$ext = pathinfo($filename, PATHINFO_EXTENSION);
								
								if(in_array($ext,$allowed)){
									$tmp_name = $_FILES[$mattribute->attribute]["tmp_name"];
									$profile = "uploads/custom_files/";
									$set_img = base_url()."uploads/custom_files/";

									$name = basename($_FILES[$mattribute->attribute]["name"]);
									$newfilename = 'custom_file_'.round(microtime(true)).'.'.$ext;
									move_uploaded_file($tmp_name, $profile.$newfilename);
									$fname = $newfilename;	
								}
								$iattr_data = array(
									'user_id' => $id,
									'module_attributes_id' => $mattribute->custom_field_id,
									'attribute_value' => $fname,
									'created_at' => date('Y-m-d h:i:s')
								);
								$this->Custom_fields_model->add_values($iattr_data);
							}
						} else {
							$iattr_data = array(
									'user_id' => $id,
									'module_attributes_id' => $mattribute->custom_field_id,
									'attribute_value' => '',
									'created_at' => date('Y-m-d h:i:s')
								);
								$this->Custom_fields_model->add_values($iattr_data);
						}
					} else if($mattribute->attribute_type == 'multiselect') {
						$multisel_val = $this->input->post($mattribute->attribute);
						if(!empty($multisel_val)){
							$newdata = implode(',', $this->input->post($mattribute->attribute));
							$iattr_data = array(
								'user_id' => $id,
								'module_attributes_id' => $mattribute->custom_field_id,
								'attribute_value' => $newdata,
								'created_at' => date('Y-m-d h:i:s')
							);
							$this->Custom_fields_model->add_values($iattr_data);
						}
					} else {
							if($this->input->post($mattribute->attribute) == ''){
								$file_val = '';
							} else {
								$file_val = $this->input->post($mattribute->attribute);
							}
							$iattr_data = array(
								'user_id' => $id,
								'module_attributes_id' => $mattribute->custom_field_id,
								'attribute_value' => $file_val,
								'created_at' => date('Y-m-d h:i:s')
							);
						$this->Custom_fields_model->add_values($iattr_data);
					}
				
				 }
			}
			
		$this->output($Return);
		exit;
		}
	}
	}
	
	
	
	public function basic_info() {
	
		if($this->input->post('type')=='basic_info') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		$system = $this->Tat_model->read_setting_info(1);
			
		/* Server side PHP input validation */		
		if($this->input->post('first_name')==='') {
        	$Return['error'] = $this->lang->line('tat_employee_error_first_name');
		} else if(preg_match("/^(\pL{1,}[ ]?)+$/u",$this->input->post('first_name'))!=1) {
			$Return['error'] = $this->lang->line('tat_hr_string_error');
		} else if($this->input->post('last_name')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_last_name');
		} else if(preg_match("/^(\pL{1,}[ ]?)+$/u",$this->input->post('last_name'))!=1) {
			$Return['error'] = $this->lang->line('tat_hr_string_error');
		} else if($this->input->post('employee_id')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_employee_id');
		} else if($this->input->post('username')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_username');
		} else if($this->input->post('email')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_email');
		} else if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
			$Return['error'] = $this->lang->line('tat_employee_error_invalid_email');
		} else if($this->input->post('company_id')==='') {
			 $Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('location_id')==='') {
			 $Return['error'] = $this->lang->line('tat_location_field_error');
		} else if($this->input->post('department_id')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_department');
		} else if($this->input->post('subdepartment_id')==='') {
        	$Return['error'] = $this->lang->line('tat_hr_sub_department_field_error');
		} else if($this->input->post('designation_id')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_designation');
		} else if($this->input->post('date_of_birth')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_date_of_birth');
		} else if($this->Tat_model->validate_date($this->input->post('date_of_birth'),'Y-m-d') == false) {
			 $Return['error'] = $this->lang->line('tat_hr_date_format_error');
		} else if($this->input->post('date_of_joining')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_joining_date');
		} else if($this->Tat_model->validate_date($this->input->post('date_of_joining'),'Y-m-d') == false) {
			 $Return['error'] = $this->lang->line('tat_hr_date_format_error');
		}  else if($this->input->post('role')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_user_role');
		} else if($this->input->post('contact_no')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_contact_number');
		} else if(!preg_match('/^([0-9]*)$/', $this->input->post('contact_no'))) {
			 $Return['error'] = $this->lang->line('tat_hr_numeric_error');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}

		
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		$first_name = $this->Tat_model->clean_post($this->input->post('first_name'));
		$last_name = $this->Tat_model->clean_post($this->input->post('last_name'));
		$employee_id = $this->input->post('employee_id');
		$date_of_joining = $this->Tat_model->clean_date_post($this->input->post('date_of_joining'));
		$username = $this->input->post('username');
		$date_of_birth = $this->Tat_model->clean_date_post($this->input->post('date_of_birth'));
		$contact_no = $this->Tat_model->clean_post($this->input->post('contact_no'));
		$address = $this->Tat_model->clean_post($this->input->post('address'));
		$leave_categories = array($this->input->post('leave_categories'));
		$cat_ids = implode(',',$this->input->post('leave_categories'));
		// $view_companies_id = implode(',',$this->input->post('view_companies_id'));
		
		$module_attributes = $this->Custom_fields_model->all_tatari_module_attributes();
		$count_module_attributes = $this->Custom_fields_model->count_module_attributes();	
		$i=1;
		if($count_module_attributes > 0){
			 foreach($module_attributes as $mattribute) {
				 if($mattribute->validation == 1){
					 if($i!=1) {
					 } else if($this->input->post($mattribute->attribute)=='') {
						$Return['error'] = $this->lang->line('tat_tatari_custom_field_the').' '.$mattribute->attribute_label.' '.$this->lang->line('tat_tatari_custom_field_is_required');
					}
				 }
			 }		
			 if($Return['error']!=''){
				$this->output($Return);
			}	
		}
	
		$data = array(
		'employee_id' => $employee_id,
		'office_shift_id' => $this->input->post('office_shift_id'),
		'first_name' => $first_name,
		'last_name' => $last_name,
		'username' => $username,
		'company_id' => $this->input->post('company_id'),
		'location_id' => $this->input->post('location_id'),
		'email' => $this->input->post('email'),
		'date_of_birth' => $date_of_birth,
		'gender' => $this->input->post('gender'),
		'user_role_id' => $this->input->post('role'),
		'department_id' => $this->input->post('department_id'),
		'sub_department_id' => $this->input->post('subdepartment_id'),
		'designation_id' => $this->input->post('designation_id'),
		'date_of_joining' => $date_of_joining,
		'contact_no' => $contact_no,
		'address' => $address,
		'leave_categories' => $cat_ids,
		'state' => $this->input->post('estate'),
		'city' => $this->input->post('ecity'),
		'zipcode' => $this->input->post('ezipcode'),
		'date_of_leaving' => $this->input->post('date_of_leaving'),
		'marital_status' => $this->input->post('marital_status'),
		'is_active' => $this->input->post('status'),
		);
		$id = $this->input->post('user_id');
		$result = $this->Employees_model->basic_info($data,$id);
		if($count_module_attributes > 0){
			foreach($module_attributes as $mattribute) {
				
				$count_exist_values = $this->Custom_fields_model->count_module_attributes_values($id,$mattribute->custom_field_id);
				if($count_exist_values > 0){
					if($mattribute->attribute_type == 'fileupload'){
						if($_FILES[$mattribute->attribute]['size'] != 0) {
							if(is_uploaded_file($_FILES[$mattribute->attribute]['tmp_name'])) {
							//checking image type
								$allowed =  array('png','jpg','jpeg','pdf','gif','xls','doc','xlsx','docx');
								$filename = $_FILES[$mattribute->attribute]['name'];
								$ext = pathinfo($filename, PATHINFO_EXTENSION);
								
								if(in_array($ext,$allowed)){
									$tmp_name = $_FILES[$mattribute->attribute]["tmp_name"];
									$profile = "uploads/custom_files/";
									$set_img = base_url()."uploads/custom_files/";

									$name = basename($_FILES[$mattribute->attribute]["name"]);
									$newfilename = 'custom_file_'.round(microtime(true)).'.'.$ext;
									move_uploaded_file($tmp_name, $profile.$newfilename);
									$fname = $newfilename;	
								}
								$iattr_data = array(
									'attribute_value' => $fname
								);
								$this->Custom_fields_model->update_att_record($iattr_data, $id,$mattribute->custom_field_id);
							}
							
						} else {
						}
					} else if($mattribute->attribute_type == 'multiselect') {
						$multisel_val = $this->input->post($mattribute->attribute);
						if(!empty($multisel_val)){
							$newdata = implode(',', $this->input->post($mattribute->attribute));
							$iattr_data = array(
								'attribute_value' => $newdata,
							);
							$this->Custom_fields_model->update_att_record($iattr_data, $id,$mattribute->custom_field_id);
						}
					} else {
						$attr_data = array(
							'attribute_value' => $this->input->post($mattribute->attribute),
						);
						$this->Custom_fields_model->update_att_record($attr_data, $id,$mattribute->custom_field_id);
					}
					
				} else {
					if($mattribute->attribute_type == 'fileupload'){
						if($_FILES[$mattribute->attribute]['size'] != 0) {
							if(is_uploaded_file($_FILES[$mattribute->attribute]['tmp_name'])) {
							//checking image type
								$allowed =  array('png','jpg','jpeg','pdf','gif','xls','doc','xlsx','docx');
								$filename = $_FILES[$mattribute->attribute]['name'];
								$ext = pathinfo($filename, PATHINFO_EXTENSION);
								
								if(in_array($ext,$allowed)){
									$tmp_name = $_FILES[$mattribute->attribute]["tmp_name"];
									$profile = "uploads/custom_files/";
									$set_img = base_url()."uploads/custom_files/";
		
									$name = basename($_FILES[$mattribute->attribute]["name"]);
									$newfilename = 'custom_file_'.round(microtime(true)).'.'.$ext;
									move_uploaded_file($tmp_name, $profile.$newfilename);
									$fname = $newfilename;	
								}
								$iattr_data = array(
									'user_id' => $id,
									'module_attributes_id' => $mattribute->custom_field_id,
									'attribute_value' => $fname,
									'created_at' => date('Y-m-d h:i:s')
								);
								$this->Custom_fields_model->add_values($iattr_data);
							}
						} else {
							if($this->input->post($mattribute->attribute) == ''){
								$file_val = '';
							} else {
								$file_val = $this->input->post($mattribute->attribute);
							}
							$iattr_data = array(
								'user_id' => $id,
								'module_attributes_id' => $mattribute->custom_field_id,
								'created_at' => date('Y-m-d h:i:s')
							);
							$this->Custom_fields_model->add_values($iattr_data);
						}
					} else if($mattribute->attribute_type == 'multiselect') {
						$multisel_val = $this->input->post($mattribute->attribute);
						if(!empty($multisel_val)){
							$newdata = implode(',', $this->input->post($mattribute->attribute));
							$iattr_data = array(
								'user_id' => $id,
								'module_attributes_id' => $mattribute->custom_field_id,
								'attribute_value' => $newdata,
								'created_at' => date('Y-m-d h:i:s')
							);
							$this->Custom_fields_model->add_values($iattr_data);
						}
					} else {
							if($this->input->post($mattribute->attribute) == ''){
								$file_val = '';
							} else {
								$file_val = $this->input->post($mattribute->attribute);
							}
							$iattr_data = array(
								'user_id' => $id,
								'module_attributes_id' => $mattribute->custom_field_id,
								'attribute_value' => $file_val,
								'created_at' => date('Y-m-d h:i:s')
							);
						$this->Custom_fields_model->add_values($iattr_data);
					}
				}
			 }
		}
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_basic_info_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	

	public function profile_picture() {
	
		if($this->input->post('type')=='profile_picture') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		$id = $this->input->post('user_id');

		if($_FILES['p_file']['size'] == 0 && null ==$this->input->post('remove_profile_picture')) {
			$Return['error'] = $this->lang->line('tat_employee_select_picture');
		} else {
			if(is_uploaded_file($_FILES['p_file']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','pdf','gif');
				$filename = $_FILES['p_file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["p_file"]["tmp_name"];
					$profile = "uploads/profile/";
					$set_img = base_url()."uploads/profile/";

					$name = basename($_FILES["p_file"]["name"]);
					$newfilename = 'profile_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $profile.$newfilename);
					$fname = $newfilename;

					$data = array('profile_picture' => $fname);
					$result = $this->Employees_model->profile_picture($data,$id);
					if ($result == TRUE) {
						$Return['result'] = $this->lang->line('tat_employee_picture_updated');
						$Return['img'] = $set_img.$fname;
					} else {
						$Return['error'] = $this->lang->line('tat_error_msg');
					}
					$this->output($Return);
					exit;
					
				} else {
					$Return['error'] = $this->lang->line('tat_employee_picture_type');
				}
				}
			}
			
			if(null!=$this->input->post('remove_profile_picture')) {

				$data = array('profile_picture' => 'no file');				
				$row = $this->Employees_model->read_employee_information($id);
				$profile = base_url()."uploads/profile/";
				$result = $this->Employees_model->profile_picture($data,$id);
				if ($result == TRUE) {
					$Return['result'] = $this->lang->line('tat_employee_picture_updated');
					if($row[0]->gender=='Male') {
						$Return['img'] = $profile.'default_male.png';
					} else {
						$Return['img'] = $profile.'default_female.png';
					}
				} else {
					$Return['error'] = $this->lang->line('tat_error_msg');
				}
				$this->output($Return);
				exit;
				
			}
				
			if($Return['error']!=''){
				$this->output($Return);
			}
		}
	}


	public function shift_info() {
	
		if($this->input->post('type')=='shift_info') {		
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_frm_date');
		} else if($this->input->post('shift_id')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_shift_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date'),
		'shift_id' => $this->input->post('shift_id'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->shift_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_shift_info_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	
	public function e_shift_info() {
	
		if($this->input->post('type')=='e_shift_info') {		
	
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		
		if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_frm_date');
		}
					
		$data = array(
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->shift_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_shift_info_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function leave_info() {
	
		if($this->input->post('type')=='leave_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		
		if($this->input->post('contract_id')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_contract_f');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'contract_id' => $this->input->post('contract_id'),
		'casual_leave' => $this->input->post('casual_leave'),
		'medical_leave' => $this->input->post('medical_leave'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->leave_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_leave_info_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	

	public function e_leave_info() {
	
		if($this->input->post('type')=='e_leave_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
							
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'casual_leave' => $this->input->post('casual_leave'),
		'medical_leave' => $this->input->post('medical_leave')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->leave_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_leave_info_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	

	public function update_contacts_info() {
	
		if($this->input->post('type')=='contact_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
	
		if($this->input->post('salutation')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_salutation');
		} else if($this->input->post('contact_name')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_contact_name');
		} else if($this->input->post('relation')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_grp');
		} else if($this->input->post('primary_email')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_pemail');
		} else if($this->input->post('mobile_phone')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_mobile');
		} else if($this->input->post('city')==='') {
			 $Return['error'] = $this->lang->line('tat_error_city_field');
		} else if($this->input->post('country')==='') {
			 $Return['error'] = $this->lang->line('tat_error_country_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'salutation' => $this->input->post('salutation'),
		'contact_name' => $this->input->post('contact_name'),
		'relation' => $this->input->post('relation'),
		'company' => $this->input->post('company'),
		'job_title' => $this->input->post('job_title'),
		'primary_email' => $this->input->post('primary_email'),
		'mobile_phone' => $this->input->post('mobile_phone'),
		'address' => $this->input->post('address'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'country' => $this->input->post('country'),
		'employee_id' => $this->input->post('user_id'),
		'contact_type' => 'permanent'
		);
		
		$query = $this->Employees_model->check_employee_contact_permanent($this->input->post('user_id'));
		if ($query->num_rows() > 0 ) {
			$res = $query->result();
			$e_field_id = $res[0]->contact_id;
			$result = $this->Employees_model->contact_info_update($data,$e_field_id);
		} else {
			$result = $this->Employees_model->contact_info_add($data);
		}

		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_contact_info_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function update_contact_info() {
	
		if($this->input->post('type')=='contact_info') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
	
		if($this->input->post('salutation')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_salutation');
		} else if($this->input->post('contact_name')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_contact_name');
		} else if($this->input->post('relation')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_grp');
		} else if($this->input->post('primary_email')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_pemail');
		} else if($this->input->post('mobile_phone')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_mobile');
		} else if($this->input->post('city')==='') {
			 $Return['error'] = $this->lang->line('tat_error_city_field');
		} else if($this->input->post('country')==='') {
			 $Return['error'] = $this->lang->line('tat_error_country_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'salutation' => $this->input->post('salutation'),
		'contact_name' => $this->input->post('contact_name'),
		'relation' => $this->input->post('relation'),
		'company' => $this->input->post('company'),
		'job_title' => $this->input->post('job_title'),
		'primary_email' => $this->input->post('primary_email'),
		'mobile_phone' => $this->input->post('mobile_phone'),
		'address' => $this->input->post('address'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'country' => $this->input->post('country'),
		'employee_id' => $this->input->post('user_id'),
		'contact_type' => 'current'
		);
		
		$query = $this->Employees_model->check_employee_contact_current($this->input->post('user_id'));
		if ($query->num_rows() > 0 ) {
			$res = $query->result();
			$e_field_id = $res[0]->contact_id;
			$result = $this->Employees_model->contact_info_update($data,$e_field_id);
		} else {
			$result = $this->Employees_model->contact_info_add($data);
		}
		//$e_field_id = 1;
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_contact_info_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}


	

	public function contact_info() {
	
		if($this->input->post('type')=='contact_info') {		
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		/* Server side PHP input validation */		
		if($this->input->post('relation')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_relation');
		} else if($this->input->post('contact_name')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_contact_name');
		} else if(!preg_match("/^(\pL{1,}[ ]?)+$/u",$this->input->post('contact_name'))) {
			$Return['error'] = $this->lang->line('tat_hr_string_error');
		} else if($this->input->post('contact_no')!=='' && !preg_match('/^([0-9]*)$/', $this->input->post('contact_no'))) {
			 $Return['error'] = $this->lang->line('tat_hr_numeric_error');
		} else if($this->input->post('work_phone')!=='' && !preg_match('/^([0-9]*)$/', $this->input->post('work_phone'))) {
			 $Return['error'] = $this->lang->line('tat_hr_numeric_error');
		} else if($this->input->post('mobile_phone')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_mobile');
		} else if(!preg_match('/^([0-9]*)$/', $this->input->post('mobile_phone'))) {
			 $Return['error'] = $this->lang->line('tat_hr_numeric_error');
		} else if($this->input->post('home_phone')!=='' && !preg_match('/^([0-9]*)$/', $this->input->post('home_phone'))) {
			 $Return['error'] = $this->lang->line('tat_hr_numeric_error');
		} else if($this->input->post('work_email')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_email');
		} else if (!filter_var($this->input->post('work_email'), FILTER_VALIDATE_EMAIL)) {
			$Return['error'] = $this->lang->line('tat_employee_error_invalid_email');
		} else if ($this->input->post('personal_email')!=='' && !filter_var($this->input->post('personal_email'), FILTER_VALIDATE_EMAIL)) {
			$Return['error'] = $this->lang->line('tat_employee_error_invalid_email');
		} else if($this->input->post('zipcode')!=='' && !preg_match('/^([0-9]*)$/', $this->input->post('zipcode'))) {
			 $Return['error'] = $this->lang->line('tat_hr_numeric_error');
		}
		
		if(null!=$this->input->post('is_primary')) {
			$is_primary = $this->input->post('is_primary');
		} else {
			$is_primary = '';
		}
		if(null!=$this->input->post('is_dependent')) {
			$is_dependent = $this->input->post('is_dependent');
		} else {
			$is_dependent = '';
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		$contact_name = $this->Tat_model->clean_post($this->input->post('contact_name'));
		$address_1 = $this->Tat_model->clean_post($this->input->post('address_1'));
		$address_2 = $this->Tat_model->clean_post($this->input->post('address_2'));
		$city = $this->Tat_model->clean_post($this->input->post('city'));
		$state = $this->Tat_model->clean_post($this->input->post('state'));		
	
		$data = array(
		'relation' => $this->input->post('relation'),
		'work_email' => $this->input->post('work_email'),
		'is_primary' => $is_primary,
		'is_dependent' => $is_dependent,
		'personal_email' => $this->input->post('personal_email'),
		'contact_name' => $contact_name,
		'address_1' => $address_1,
		'work_phone' => $this->input->post('work_phone'),
		'address_2' => $address_2,
		'mobile_phone' => $this->input->post('mobile_phone'),
		'city' => $city,
		'state' => $state,
		'zipcode' => $this->input->post('zipcode'),
		'home_phone' => $this->input->post('home_phone'),
		'country' => $this->input->post('country'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->contact_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_contact_info_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}


	public function dialog_document() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$document = $this->Employees_model->read_document_information($id);
		$data = array(
				'document_id' => $document[0]->document_id,
				'document_type_id' => $document[0]->document_type_id,
				'd_employee_id' => $document[0]->employee_id,
				'all_document_types' => $this->Employees_model->all_document_types(),
				'date_of_expiry' => $document[0]->date_of_expiry,
				'title' => $document[0]->title,
				'description' => $document[0]->description,
				'document_file' => $document[0]->document_file
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}
	
	
	public function dialog_qualification() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_qualification_information($id);
		$data = array(
				'qualification_id' => $result[0]->qualification_id,
				'employee_id' => $result[0]->employee_id,
				'name' => $result[0]->name,
				'education_level_id' => $result[0]->education_level_id,
				'from_year' => $result[0]->from_year,
				'language_id' => $result[0]->language_id,
				'to_year' => $result[0]->to_year,
				'skill_id' => $result[0]->skill_id,
				'description' => $result[0]->description,
				'all_education_level' => $this->Employees_model->all_education_level(),
				'all_qualification_language' => $this->Employees_model->all_qualification_language(),
				'all_qualification_skill' => $this->Employees_model->all_qualification_skill()
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}
	public function dialog_work_experience() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_work_experience_information($id);
		$data = array(
				'work_experience_id' => $result[0]->work_experience_id,
				'employee_id' => $result[0]->employee_id,
				'company_name' => $result[0]->company_name,
				'from_date' => $result[0]->from_date,
				'to_date' => $result[0]->to_date,
				'post' => $result[0]->post,
				'description' => $result[0]->description
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}
	
	public function dialog_bank_account() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_bank_account_information($id);
		$data = array(
				'bankaccount_id' => $result[0]->bankaccount_id,
				'employee_id' => $result[0]->employee_id,
				'is_primary' => $result[0]->is_primary,
				'account_title' => $result[0]->account_title,
				'account_number' => $result[0]->account_number,
				'bank_name' => $result[0]->bank_name,
				'bank_code' => $result[0]->bank_code,
				'bank_branch' => $result[0]->bank_branch
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}

	public function leave() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$leave = $this->Employees_model->set_employee_leave($id);
		
		$data = array();

        foreach($leave->result() as $r) {			
			
			$contract = $this->Employees_model->read_contract_information($r->contract_id);
			if(!is_null($contract)){
	
			$duration = $this->Tat_model->set_date_format($contract[0]->from_date).' '.$this->lang->line('dashboard_to').' '.$this->Tat_model->set_date_format($contract[0]->to_date);
				$ctitle = $contract[0]->title.' '.$duration;
			} else {
				$ctitle = '--';
			}
			
			$contracti = $ctitle;
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->leave_id . '" data-field_type="leave"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->leave_id . '" data-token_type="leave"><i class="fa fa-trash-o"></i></button></span>',
			$contracti,
			$r->casual_leave,
			$r->medical_leave
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $leave->num_rows(),
			 "recordsFiltered" => $leave->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 


	
	public function dialog_leave() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_leave_information($id);
		$data = array(
				'leave_id' => $result[0]->leave_id,
				'employee_id' => $result[0]->employee_id,
				'contract_id' => $result[0]->contract_id,
				'casual_leave' => $result[0]->casual_leave,
				'medical_leave' => $result[0]->medical_leave
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}

	
	public function dialog_location() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_location_information($id);
		$data = array(
				'office_location_id' => $result[0]->office_location_id,
				'employee_id' => $result[0]->employee_id,
				'location_id' => $result[0]->location_id,
				'from_date' => $result[0]->from_date,
				'to_date' => $result[0]->to_date
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}
	
	public function dialog_salary_allowance() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_single_salary_allowance($id);
		$data = array(
				'allowance_id' => $result[0]->allowance_id,
				'employee_id' => $result[0]->employee_id,
				'is_allowance_taxable' => $result[0]->is_allowance_taxable,
				'allowance_title' => $result[0]->allowance_title,
				'allowance_amount' => $result[0]->allowance_amount
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}
	public function dialog_salary_commissions() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_single_salary_commissions($id);
		$data = array(
				'salary_commissions_id' => $result[0]->salary_commissions_id,
				'employee_id' => $result[0]->employee_id,
				'commission_title' => $result[0]->commission_title,
				'commission_amount' => $result[0]->commission_amount
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}
	public function dialog_salary_statutory_deductions() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_single_salary_statutory_deduction($id);
		$data = array(
			'statutory_deductions_id' => $result[0]->statutory_deductions_id,
			'employee_id' => $result[0]->employee_id,
			'deduction_title' => $result[0]->deduction_title,
			'deduction_amount' => $result[0]->deduction_amount,
			'statutory_options' => $result[0]->statutory_options
			);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}
	public function dialog_salary_other_payments() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_single_salary_other_payment($id);
		$data = array(
			'other_payments_id' => $result[0]->other_payments_id,
			'employee_id' => $result[0]->employee_id,
			'payments_title' => $result[0]->payments_title,
			'payments_amount' => $result[0]->payments_amount
			);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}
	
	public function dialog_salary_loan() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_single_loan_deductions($id);
		$data = array(
				'loan_deduction_id' => $result[0]->loan_deduction_id,
				'employee_id' => $result[0]->employee_id,
				'loan_deduction_title' => $result[0]->loan_deduction_title,
				'start_date' => $result[0]->start_date,
				'end_date' => $result[0]->end_date,
				'loan_options' => $result[0]->loan_options,
				'monthly_installment' => $result[0]->monthly_installment,
				'reason' => $result[0]->reason,
				'created_at' => $result[0]->created_at
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}
	public function dialog_emp_overtime() {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('field_id');
		$result = $this->Employees_model->read_salary_overtime_record($id);
		$data = array(
				'salary_overtime_id' => $result[0]->salary_overtime_id,
				'employee_id' => $result[0]->employee_id,
				'overtime_type' => $result[0]->overtime_type,
				'no_of_days' => $result[0]->no_of_days,
				'overtime_hours' => $result[0]->overtime_hours,
				'overtime_rate' => $result[0]->overtime_rate
				);
		if(!empty($session)){ 
			$this->load->view('admin/employees/dialog_employee_details', $data);
		} else {
			redirect('admin/');
		}
	}


	public function shift() {
		
		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$shift = $this->Employees_model->set_employee_shift($id);
		
		$data = array();

        foreach($shift->result() as $r) {			
			
			$shift_info = $this->Employees_model->read_shift_information($r->shift_id);
			
			$duration = $this->Tat_model->set_date_format($r->from_date).' '.$this->lang->line('dashboard_to').' '.$this->Tat_model->set_date_format($r->to_date);
			
			if(!is_null($shift_info)){
				$shift_name = $shift_info[0]->shift_name;
			} else {
				$shift_name = '--';
			}
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->emp_shift_id . '" data-field_type="shift"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->emp_shift_id . '" data-token_type="shift"><i class="fa fa-trash-o"></i></button></span>',
			$duration,
			$shift_name
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $shift->num_rows(),
			 "recordsFiltered" => $shift->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	

	public function e_contact_info() {
	
		if($this->input->post('type')=='e_contact_info') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
	
		if($this->input->post('relation')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_relation');
		} else if($this->input->post('contact_name')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_contact_name');
		} else if($this->input->post('mobile_phone')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_mobile');
		}
		
		if(null!=$this->input->post('is_primary')) {
			$is_primary = $this->input->post('is_primary');
		} else {
			$is_primary = '';
		}
		if(null!=$this->input->post('is_dependent')) {
			$is_dependent = $this->input->post('is_dependent');
		} else {
			$is_dependent = '';
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'relation' => $this->input->post('relation'),
		'work_email' => $this->input->post('work_email'),
		'is_primary' => $is_primary,
		'is_dependent' => $is_dependent,
		'personal_email' => $this->input->post('personal_email'),
		'contact_name' => $this->input->post('contact_name'),
		'address_1' => $this->input->post('address_1'),
		'work_phone' => $this->input->post('work_phone'),
		'address_2' => $this->input->post('address_2'),
		'mobile_phone' => $this->input->post('mobile_phone'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'home_phone' => $this->input->post('home_phone'),
		'country' => $this->input->post('country')
		);
		
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->contact_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_contact_info_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}


	public function salary_all_allowances() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}
	
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$allowances = $this->Employees_model->set_employee_allowances($id);
		
		$data = array();
	

        foreach($allowances->result() as $r) {			

		if($r->is_allowance_taxable==0){
			$allowance_opt = $this->lang->line('tat_salary_allowance_non_taxable');
		} else {
			$allowance_opt = $this->lang->line('tat_salary_allowance_taxable');
		}
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->allowance_id . '" data-field_type="salary_allowance"><span class="fa fa-pencil"></span></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->allowance_id . '" data-token_type="all_allowances"><span class="fa fa-trash"></span></button></span>',
			$allowance_opt,
			$r->allowance_title,
			$r->allowance_amount
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $allowances->num_rows(),
			 "recordsFiltered" => $allowances->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }

	public function salary_all_commissions() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$commissions = $this->Employees_model->set_employee_commissions($id);
		
		$data = array();

        foreach($commissions->result() as $r) {			
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->salary_commissions_id . '" data-field_type="salary_commissions"><span class="fa fa-pencil"></span></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->salary_commissions_id . '" data-token_type="all_commissions"><span class="fa fa-trash"></span></button></span>',
			$r->commission_title,
			$r->commission_amount
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $commissions->num_rows(),
			 "recordsFiltered" => $commissions->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }


	public function salary_all_statutory_deductions() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$statutory_deductions = $this->Employees_model->set_employee_statutory_deductions($id);
		
		$data = array();

        foreach($statutory_deductions->result() as $r) {			
		if($r->statutory_options==1){
			$sd_opt = $this->lang->line('tat_sd_ssc_title');
		} else if($r->statutory_options==2){
			$sd_opt = $this->lang->line('tat_sd_phic_title');
		} else if($r->statutory_options==3){
			$sd_opt = $this->lang->line('tat_sd_hdmf_title');
		} else if($r->statutory_options==4){
			$sd_opt = $this->lang->line('tat_sd_wht_title');
		} else {
			$sd_opt = $this->lang->line('tat_sd_other_sd_title');
		}
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->statutory_deductions_id . '" data-field_type="salary_statutory_deductions"><span class="fa fa-pencil"></span></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->statutory_deductions_id . '" data-token_type="all_statutory_deductions"><span class="fa fa-trash"></span></button></span>',
			$sd_opt,
			$r->deduction_title,
			$r->deduction_amount
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $statutory_deductions->num_rows(),
			 "recordsFiltered" => $statutory_deductions->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }


	public function salary_all_other_payments() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$other_payment = $this->Employees_model->set_employee_other_payments($id);
		
		$data = array();

        foreach($other_payment->result() as $r) {			
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->other_payments_id . '" data-field_type="salary_other_payments"><span class="fa fa-pencil"></span></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->other_payments_id . '" data-token_type="all_other_payments"><span class="fa fa-trash"></span></button></span>',
			$r->payments_title,
			$r->payments_amount
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $other_payment->num_rows(),
			 "recordsFiltered" => $other_payment->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 

	public function salary_overtime() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$overtime = $this->Employees_model->set_employee_overtime($id);
		$system = $this->Tat_model->read_setting_info(1);
		$data = array();

        foreach($overtime->result() as $r) {			
		$current_amount = $r->overtime_rate;
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->salary_overtime_id . '" data-field_type="emp_overtime"><span class="fa fa-pencil"></span></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->salary_overtime_id . '" data-token_type="emp_overtime"><span class="fa fa-trash"></span></button></span>',
			$r->overtime_type,
			$r->no_of_days,
			$r->overtime_hours,
			$current_amount
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $overtime->num_rows(),
			 "recordsFiltered" => $overtime->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 

	public function salary_all_deductions() {
		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$deductions = $this->Employees_model->set_employee_deductions($id);
		
		$data = array();

        foreach($deductions->result() as $r) {		
		
		$sdate = $this->Tat_model->set_date_format($r->start_date);
		$edate = $this->Tat_model->set_date_format($r->end_date);	

		if($r->loan_time < 2) {
			$loan_time = $r->loan_time. ' '.$this->lang->line('tat_employee_loan_time_single_month');
		} else {
			$loan_time = $r->loan_time. ' '.$this->lang->line('tat_employee_loan_time_more_months');
		}
		if($r->loan_options == 1) {
			$loan_options = $this->lang->line('tat_loan_ssc_title');
		} else if($r->loan_options == 2) {
			$loan_options = $this->lang->line('tat_loan_hdmf_title');
		} else {
			$loan_options = $this->lang->line('tat_loan_other_sd_title');
		}
		$loan_details = '<div class="text-semibold">'.$this->lang->line('dashboard_tat_title').': '.$r->loan_deduction_title.'</div>
								<div class="text-muted">'.$this->lang->line('tat_salary_loan_options').': '.$loan_options.'</div><div class="text-muted">'.$this->lang->line('tat_start_date').': '.$sdate.'</div><div class="text-muted">'.$this->lang->line('tat_end_date').': '.$edate.'</div><div class="text-muted">'.$this->lang->line('tat_reason').': '.$r->reason.'</div>';
	
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->loan_deduction_id . '" data-token_type="all_deductions"><span class="fa fa-trash"></span></button></span>',
			$loan_details,
			$r->monthly_installment,
			$loan_time
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $deductions->num_rows(),
			 "recordsFiltered" => $deductions->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	

	public function location_info() {
	
		if($this->input->post('type')=='location_info') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();


		if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_frm_date');
		} else if($this->input->post('location_id')==='') {
			 $Return['error'] = $this->lang->line('error_location_dept_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date'),
		'location_id' => $this->input->post('location_id'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->location_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_location_info_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	

	public function e_location_info() {
	
		if($this->input->post('type')=='e_location_info') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();

		/* Server side PHP input validation */		
		if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_frm_date');
		} else if($this->input->post('location_id')==='') {
			 $Return['error'] = $this->lang->line('error_location_dept_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->location_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_location_info_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function documents() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 	

			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}
	
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$documents = $this->Employees_model->set_employee_documents($id);
		
		$data = array();

        foreach($documents->result() as $r) {
			
			$d_type = $this->Employees_model->read_document_type_information($r->document_type_id);
			if(!is_null($d_type)){
				$document_d = $d_type[0]->document_type;
			} else {
				$document_d = '--';
			}
			$date_of_expiry = $this->Tat_model->set_date_format($r->date_of_expiry);
			if($r->document_file!='' && $r->document_file!='no file') {
			 $functions = '<span data-toggle="tooltip" data-placement="top" title="Download"><a href="'.site_url().'admin/download?type=document&filename='.$r->document_file.'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" title="'.$this->lang->line('tat_download').'"><i class="fa fa-download"></i></button></a></span>';
			 } else {
				 $functions ='';
			 }
			 
		
		$data[] = array(
			$functions.'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->document_id . '" data-field_type="document"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->document_id . '" data-token_type="document"><i class="fa fa-trash-o"></i></button></span>',
			$document_d,
			$r->title,
			$date_of_expiry
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $documents->num_rows(),
			 "recordsFiltered" => $documents->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }


	public function document_info() {
	
		if($this->input->post('type')=='document_info' && $this->input->post('data')=='document_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();

		if($this->input->post('document_type_id')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_d_type');
		} else if($this->Tat_model->validate_date($this->input->post('date_of_expiry'),'Y-m-d') == false) {
			 $Return['error'] = $this->lang->line('tat_hr_date_format_error');
		} else if($this->input->post('title')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_document_title');
		} 
	
		else if($_FILES['document_file']['size'] == 0) {
			$fname = '';
		} else {
			if(is_uploaded_file($_FILES['document_file']['tmp_name'])) {
			
				$allowed =  array('png','jpg','jpeg','pdf','gif','txt','pdf','xls','xlsx','doc','docx');
				$filename = $_FILES['document_file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["document_file"]["tmp_name"];
					$documentd = "uploads/document/";
			
					$name = basename($_FILES["document_file"]["name"]);
					$newfilename = 'document_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $documentd.$newfilename);
					$fname = $newfilename;
				} else {
					$Return['error'] = $this->lang->line('tat_employee_document_file_type');
				}
			}
		}
					
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		$title = $this->Tat_model->clean_post($this->input->post('title'));
		$description = $this->Tat_model->clean_post($this->input->post('description'));
		$date_of_expiry = $this->Tat_model->clean_date_post($this->input->post('date_of_expiry'));
	
		$data = array(
		'document_type_id' => $this->input->post('document_type_id'),
		'date_of_expiry' => $date_of_expiry,
		'document_file' => $fname,
		'title' => $title,
		'description' => $description,
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->document_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_d_info_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}


	public function e_document_info() {
	 
		if($this->input->post('type')=='e_document_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
				
		if($this->input->post('document_type_id')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_d_type');
		} else if($this->input->post('title')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_document_title');
		} else if($this->input->post('email')==='') {
			 $Return['error'] = $this->lang->line('tat_error_notify_email_field');
		}
		

		else if($_FILES['document_file']['size'] == 0) {
			$data = array(
				'document_type_id' => $this->input->post('document_type_id'),
				'date_of_expiry' => $this->input->post('date_of_expiry'),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description')
				);
				$e_field_id = $this->input->post('e_field_id');
				$result = $this->Employees_model->document_info_update($data,$e_field_id);
				if ($result == TRUE) {
					$Return['result'] = $this->lang->line('tat_employee_d_info_updated');
				} else {
					$Return['error'] = $this->lang->line('tat_error_msg');
				}
				$this->output($Return);
				exit;
		} else {
			if(is_uploaded_file($_FILES['document_file']['tmp_name'])) {
				
				$allowed =  array('png','jpg','jpeg','pdf','gif','txt','pdf','xls','xlsx','doc','docx');
				$filename = $_FILES['document_file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["document_file"]["tmp_name"];
					$documentd = "uploads/document/";
					
					$name = basename($_FILES["document_file"]["name"]);
					$newfilename = 'document_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $documentd.$newfilename);
					$fname = $newfilename;
					$data = array(
					'document_type_id' => $this->input->post('document_type_id'),
					'date_of_expiry' => $this->input->post('date_of_expiry'),
					'document_file' => $fname,
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description')
					);
					$e_field_id = $this->input->post('e_field_id');
					$result = $this->Employees_model->document_info_update($data,$e_field_id);
					if ($result == TRUE) {
						$Return['result'] = $this->lang->line('tat_employee_d_info_updated');
					} else {
						$Return['error'] = $this->lang->line('tat_error_msg');
					}
					$this->output($Return);
					exit;
				} else {
					$Return['error'] = $this->lang->line('tat_employee_document_file_type');
				}
			}
		}
					
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		
		}
	}
	
	
	public function qualification_info() {
	
		if($this->input->post('type')=='qualification_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		$from_year = $this->input->post('from_year');
		$to_year = $this->input->post('to_year');
		$st_date = strtotime($from_year);
		$ed_date = strtotime($to_year);
			
		if($this->input->post('name')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_sch_uni');
		} else if(preg_match("/^(\pL{1,}[ ]?)+$/u",$this->input->post('name'))!=1) {
			$Return['error'] = $this->lang->line('tat_hr_string_error');
		} else if($this->input->post('from_year')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_frm_date');
		} else if($this->Tat_model->validate_date($this->input->post('from_year'),'Y-m-d') == false) {
			 $Return['error'] = $this->lang->line('tat_hr_date_format_error');
		} else if($this->input->post('to_year')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_to_date');
		} else if($this->Tat_model->validate_date($this->input->post('to_year'),'Y-m-d') == false) {
			 $Return['error'] = $this->lang->line('tat_hr_date_format_error');
		} else if($st_date > $ed_date) {
			$Return['error'] = $this->lang->line('tat_employee_error_date_shouldbe');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		$name = $this->Tat_model->clean_post($this->input->post('name'));
		$from_year = $this->Tat_model->clean_date_post($this->input->post('from_year'));
		$to_year = $this->Tat_model->clean_date_post($this->input->post('to_year'));
		$description = $this->Tat_model->clean_post($this->input->post('description'));
		$data = array(
		'name' => $name,
		'education_level_id' => $this->input->post('education_level'),
		'from_year' => $from_year,
		'language_id' => $this->input->post('language'),
		'to_year' => $this->input->post('to_year'),
		'skill_id' => $this->input->post('skill'),
		'description' => $description,
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->qualification_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_error_q_info_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	

	public function e_qualification_info() {
	
		if($this->input->post('type')=='e_qualification_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
				
		$from_year = $this->input->post('from_year');
		$to_year = $this->input->post('to_year');
		$st_date = strtotime($from_year);
		$ed_date = strtotime($to_year);
			
		if($this->input->post('name')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_sch_uni');
		} else if($this->input->post('from_year')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_frm_date');
		} else if($this->input->post('to_year')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_to_date');
		} else if($st_date > $ed_date) {
			$Return['error'] = $this->lang->line('tat_employee_error_date_shouldbe');
		}
			
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'name' => $this->input->post('name'),
		'education_level_id' => $this->input->post('education_level'),
		'from_year' => $this->input->post('from_year'),
		'language_id' => $this->input->post('language'),
		'to_year' => $this->input->post('to_year'),
		'skill_id' => $this->input->post('skill'),
		'description' => $this->input->post('description')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->qualification_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_error_q_info_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	

	public function work_experience_info() {
	
		if($this->input->post('type')=='work_experience_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		
		$frm_date = strtotime($this->input->post('from_date'));	
		$to_date = strtotime($this->input->post('to_date'));		
		if($this->input->post('company_name')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_company_name');
		} else if($this->input->post('post')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_post');
		} else if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_frm_date');
		} else if($this->input->post('to_date')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_to_date');
		} else if($frm_date > $to_date) {
			 $Return['error'] = $this->lang->line('tat_employee_error_date_shouldbe');
		} 
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'company_name' => $this->input->post('company_name'),
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date'),
		'post' => $this->input->post('post'),
		'description' => $this->input->post('description'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->work_experience_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_error_w_exp_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	public function e_work_experience_info() {
	
		if($this->input->post('type')=='e_work_experience_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		
		$frm_date = strtotime($this->input->post('from_date'));	
		$to_date = strtotime($this->input->post('to_date'));
		
		if($this->input->post('company_name')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_company_name');
		} else if($this->input->post('from_date')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_frm_date');
		} else if($this->input->post('to_date')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_to_date');
		} else if($frm_date > $to_date) {
			 $Return['error'] = $this->lang->line('tat_employee_error_date_shouldbe');
		} else if($this->input->post('post')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_post');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'company_name' => $this->input->post('company_name'),
		'from_date' => $this->input->post('from_date'),
		'to_date' => $this->input->post('to_date'),
		'post' => $this->input->post('post'),
		'description' => $this->input->post('description')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->work_experience_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_error_w_exp_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	

	public function bank_account_info() {
	
		if($this->input->post('type')=='bank_account_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
	
		if($this->input->post('account_title')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_acc_title');
		} else if(preg_match("/^(\pL{1,}[ ]?)+$/u",$this->input->post('account_title'))!=1) {
			$Return['error'] = $this->lang->line('tat_hr_string_error');
		} else if($this->input->post('account_number')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_acc_number');
		} else if($this->input->post('bank_name')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_bank_name');
		} else if($this->input->post('bank_code')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_bank_code');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'account_title' => $this->input->post('account_title'),
		'account_number' => $this->input->post('account_number'),
		'bank_name' => $this->input->post('bank_name'),
		'bank_code' => $this->input->post('bank_code'),
		'bank_branch' => $this->input->post('bank_branch'),
		'employee_id' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Employees_model->bank_account_info_add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_error_bank_info_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function change_password() {
	
		if($this->input->post('type')=='change_password') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
				
		if(trim($this->input->post('new_password'))==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_newpassword');
		} else if(strlen($this->input->post('new_password')) < 6) {
			$Return['error'] = $this->lang->line('tat_employee_error_password_least');
		} else if(trim($this->input->post('new_password_confirm'))==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_new_cpassword');
		} else if($this->input->post('new_password')!=$this->input->post('new_password_confirm')) {
			 $Return['error'] = $this->lang->line('tat_employee_error_old_new_cpassword');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		$options = array('cost' => 12);
		$password_hash = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT, $options);
	
		$data = array(
		'password' => $password_hash
		);
		$id = $this->input->post('user_id');
		$result = $this->Employees_model->change_password($data,$id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_password_update');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function e_bank_account_info() {
	
		if($this->input->post('type')=='e_bank_account_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();

		if($this->input->post('account_title')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_acc_title');
		} else if($this->input->post('account_number')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_acc_number');
		} else if($this->input->post('bank_name')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_bank_name');
		} else if($this->input->post('bank_code')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_bank_code');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'account_title' => $this->input->post('account_title'),
		'account_number' => $this->input->post('account_number'),
		'bank_name' => $this->input->post('bank_name'),
		'bank_code' => $this->input->post('bank_code'),
		'bank_branch' => $this->input->post('bank_branch')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->bank_account_info_update($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_error_bank_info_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	
	public function contacts()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$contacts = $this->Employees_model->set_employee_contacts($id);
		
		$data = array();

        foreach($contacts->result() as $r) {
			
			if($r->is_primary==1){
				$primary = '<span class="tag tag-success">'.$this->lang->line('tat_employee_primary').'</span>';
			 } else {
				 $primary = '';
			 }
			 if($r->is_dependent==2){
				$dependent = '<span class="tag tag-danger">'.$this->lang->line('tat_employee_dependent').'</span>';
			 } else {
				 $dependent = '';
			 }
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->contact_id . '" data-field_type="contact"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->contact_id . '" data-token_type="contact"><i class="fa fa-trash-o"></i></button></span>',
			$r->contact_name . ' ' .$primary . ' '.$dependent,
			$r->relation,
			$r->work_email,
			$r->mobile_phone
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $contacts->num_rows(),
			 "recordsFiltered" => $contacts->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }

	 public function qualification() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$qualification = $this->Employees_model->set_employee_qualification($id);
		
		$data = array();

        foreach($qualification->result() as $r) {
			
			$education = $this->Employees_model->read_education_information($r->education_level_id);
			if(!is_null($education)){
				$edu_name = $education[0]->name;
			} else {
				$edu_name = '--';
			}
	
			$sdate = $this->Tat_model->set_date_format($r->from_year);
			$edate = $this->Tat_model->set_date_format($r->to_year);	
			
			$time_period = $sdate.' - '.$edate;

			$pdate = $time_period;
			$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->qualification_id . '" data-field_type="qualification"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->qualification_id . '" data-token_type="qualification"><i class="fa fa-trash-o"></i></button></span>',
			$r->name,
			$pdate,
			$edu_name
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $qualification->num_rows(),
			 "recordsFiltered" => $qualification->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 

	public function experience() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$experience = $this->Employees_model->set_employee_experience($id);
		
		$data = array();

        foreach($experience->result() as $r) {
			
			$from_date = $this->Tat_model->set_date_format($r->from_date);
			$to_date = $this->Tat_model->set_date_format($r->to_date);
			
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->work_experience_id . '" data-field_type="work_experience"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->work_experience_id . '" data-token_type="work_experience"><i class="fa fa-trash-o"></i></button></span>',
			$r->company_name,
			$from_date,
			$to_date,
			$r->post,
			$r->description
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $experience->num_rows(),
			 "recordsFiltered" => $experience->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 

	public function bank_account() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$bank_account = $this->Employees_model->set_employee_bank_account($id);
		
		$data = array();

        foreach($bank_account->result() as $r) {			
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->bankaccount_id . '" data-field_type="bank_account"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->bankaccount_id . '" data-token_type="bank_account"><i class="fa fa-trash-o"></i></button></span>',
			$r->account_title,
			$r->account_number,
			$r->bank_name,
			$r->bank_code,
			$r->bank_branch
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $bank_account->num_rows(),
			 "recordsFiltered" => $bank_account->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 

	public function location() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/employees/employee_detail", $data);
		} else {
			redirect('admin/');
		}

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$id = $this->uri->segment(4);
		$location = $this->Employees_model->set_employee_location($id);
		
		$data = array();

        foreach($location->result() as $r) {			
			// contract
			$of_location = $this->Location_model->read_location_information($r->location_id);
			// contract duration
			$duration = $this->Tat_model->set_date_format($r->from_date).' '.$this->lang->line('dashboard_to').' '.$this->Tat_model->set_date_format($r->to_date);
			if(!is_null($of_location)){
				$location_name = $of_location[0]->location_name;
			} else {
				$location_name = '--';
			}
		
		$data[] = array(
			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".edit-modal-data" data-field_id="'. $r->office_location_id . '" data-field_type="location"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->office_location_id . '" data-token_type="location"><i class="fa fa-trash-o"></i></button></span>',
			$duration,
			$location_name
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $location->num_rows(),
			 "recordsFiltered" => $location->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }


	 public function update_salary_option() {
	
		if($this->input->post('type')=='employee_update_salary') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();	
		if($this->input->post('basic_salary')==='') {
			$Return['error'] = $this->lang->line('tat_employee_salary_error_basic');
		}
		
		if($Return['error']!=''){
			$this->output($Return);
		}
		$data = array(
		'wages_type' => $this->input->post('wages_type'),
		'basic_salary' => $this->input->post('basic_salary')
		);
		$id = $this->input->post('user_id');
		$result = $this->Employees_model->basic_info($data,$id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_updated_salary_success');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}


		public function set_overtime() {
	
			if($this->input->post('type')=='emp_overtime') {		
	
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();	
			if($this->input->post('overtime_type')==='') {
				$Return['error'] = $this->lang->line('tat_employee_set_overtime_title_error');
			} else if($this->input->post('no_of_days')==='') {
				$Return['error'] = $this->lang->line('tat_employee_set_overtime_no_of_days_error');
			} else if($this->input->post('overtime_hours')==='') {
				$Return['error'] = $this->lang->line('tat_employee_set_overtime_hours_error');
			} else if($this->input->post('overtime_rate')==='') {
				$Return['error'] = $this->lang->line('tat_employee_set_overtime_rate_error');
			}
			
			if($Return['error']!=''){
				$this->output($Return);
			}
			$data = array(
			'employee_id' => $this->input->post('user_id'),
			'overtime_type' => $this->input->post('overtime_type'),
			'no_of_days' => $this->input->post('no_of_days'),
			'overtime_hours' => $this->input->post('overtime_hours'),
			'overtime_rate' => $this->input->post('overtime_rate')
			);
			$id = $this->input->post('user_id');
			$result = $this->Employees_model->add_salary_overtime($data);
			if ($result == TRUE) {
				$Return['result'] = $this->lang->line('tat_employee_added_overtime_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
			exit;
			}
		}
		

		public function update_overtime_info() {
		
			if($this->input->post('type')=='e_overtime_info') {		

			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();	
			if($this->input->post('overtime_type')==='') {
				$Return['error'] = $this->lang->line('tat_employee_set_overtime_title_error');
			} else if($this->input->post('no_of_days')==='') {
				$Return['error'] = $this->lang->line('tat_employee_set_overtime_no_of_days_error');
			} else if($this->input->post('overtime_hours')==='') {
				$Return['error'] = $this->lang->line('tat_employee_set_overtime_hours_error');
			} else if($this->input->post('overtime_rate')==='') {
				$Return['error'] = $this->lang->line('tat_employee_set_overtime_rate_error');
			}
			
			if($Return['error']!=''){
				$this->output($Return);
			}
			$id = $this->input->post('e_field_id');
			$data = array(
			'overtime_type' => $this->input->post('overtime_type'),
			'no_of_days' => $this->input->post('no_of_days'),
			'overtime_hours' => $this->input->post('overtime_hours'),
			'overtime_rate' => $this->input->post('overtime_rate')
			);
	
			$result = $this->Employees_model->salary_overtime_update_record($data,$id);
			if ($result == TRUE) {
				$Return['result'] = $this->lang->line('tat_employee_updated_overtime_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
			exit;
			}
		}
		

		public function employee_allowance_option() {
		
			if($this->input->post('type')=='employee_update_allowance') {		

			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();	
			if($this->input->post('allowance_title')==='') {
				$Return['error'] = $this->lang->line('tat_employee_set_allowance_title_error');
			} else if($this->input->post('allowance_amount')==='') {
				$Return['error'] = $this->lang->line('tat_employee_set_allowance_amount_error');
			}
			
			if($Return['error']!=''){
				$this->output($Return);
			}
			$data = array(
			'allowance_title' => $this->input->post('allowance_title'),
			'allowance_amount' => $this->input->post('allowance_amount'),
			'employee_id' => $this->input->post('user_id'),
			'is_allowance_taxable' => $this->input->post('is_allowance_taxable')
			);
			$result = $this->Employees_model->add_salary_allowances($data);
			if ($result == TRUE) {
				$Return['result'] = $this->lang->line('tat_employee_set_allowance_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
			exit;
			}
		}


		public function employee_commissions_option() {
		
			if($this->input->post('type')=='employee_update_commissions') {		

			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();	
			if($this->input->post('title')==='') {
				$Return['error'] = $this->lang->line('tat_error_title');
			} else if($this->input->post('amount')==='') {
				$Return['error'] = $this->lang->line('tat_error_amount_field');
			}
			
			if($Return['error']!=''){
				$this->output($Return);
			}
			$data = array(
			'commission_title' => $this->input->post('title'),
			'commission_amount' => $this->input->post('amount'),
			'employee_id' => $this->input->post('user_id')
			);
			$result = $this->Employees_model->add_salary_commissions($data);
			if ($result == TRUE) {
				$Return['result'] = $this->lang->line('tat_employee_set_commission_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
			exit;
			}
		}



		public function set_statutory_deductions() {
		
			if($this->input->post('type')=='statutory_deductions_info') {		

			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();	
			if($this->input->post('title')==='') {
				$Return['error'] = $this->lang->line('tat_error_title');
			} else if($this->input->post('amount')==='') {
				$Return['error'] = $this->lang->line('tat_error_amount_field');
			}
			
			if($Return['error']!=''){
				$this->output($Return);
			}
			$data = array(
			'deduction_title' => $this->input->post('title'),
			'deduction_amount' => $this->input->post('amount'),
			'statutory_options' => $this->input->post('statutory_options'),
			'employee_id' => $this->input->post('user_id')
			);
			$result = $this->Employees_model->add_salary_statutory_deductions($data);
			if ($result == TRUE) {
				$Return['result'] = $this->lang->line('tat_employee_set_statutory_deduction_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
			exit;
			}
		}


		public function set_other_payments() {
		
			if($this->input->post('type')=='other_payments_info') {		
	
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();	
			if($this->input->post('title')==='') {
				$Return['error'] = $this->lang->line('tat_error_title');
			} else if($this->input->post('amount')==='') {
				$Return['error'] = $this->lang->line('tat_error_amount_field');
			}
			
			if($Return['error']!=''){
				$this->output($Return);
			}
			$data = array(
			'payments_title' => $this->input->post('title'),
			'payments_amount' => $this->input->post('amount'),
			'employee_id' => $this->input->post('user_id')
			);
			$result = $this->Employees_model->add_salary_other_payments($data);
			if ($result == TRUE) {
				$Return['result'] = $this->lang->line('tat_employee_set_otherpayments_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
			exit;
			}
		}
		


	 public function update_allowance_info() {
	
		if($this->input->post('type')=='e_allowance_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();

		if($this->input->post('allowance_title')==='') {
			$Return['error'] = $this->lang->line('tat_employee_set_allowance_title_error');
		} else if($this->input->post('allowance_amount')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_set_allowance_amount_error');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'allowance_title' => $this->input->post('allowance_title'),
		'allowance_amount' => $this->input->post('allowance_amount'),
		'is_allowance_taxable' => $this->input->post('is_allowance_taxable')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->salary_allowance_update_record($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_updated_allowance_success');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function update_commissions_info() {
	
		if($this->input->post('type')=='e_salary_commissions_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
	
		if($this->input->post('title')==='') {
			$Return['error'] = $this->lang->line('tat_error_title');
		} else if($this->input->post('amount')==='') {
			$Return['error'] = $this->lang->line('tat_error_amount_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'commission_title' => $this->input->post('title'),
		'commission_amount' => $this->input->post('amount')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->salary_commissions_update_record($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_update_commission_success');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function update_statutory_deductions_info() {
	
		if($this->input->post('type')=='e_salary_statutory_deductions_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		
		if($this->input->post('title')==='') {
			$Return['error'] = $this->lang->line('tat_error_title');
		} else if($this->input->post('amount')==='') {
			$Return['error'] = $this->lang->line('tat_error_amount_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'deduction_title' => $this->input->post('title'),
		'deduction_amount' => $this->input->post('amount'),
		'statutory_options' => $this->input->post('statutory_options')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->salary_statutory_deduction_update_record($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_update_statutory_deduction_success');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function update_other_payment_info() {
	
		if($this->input->post('type')=='e_salary_other_payments_info') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		
		if($this->input->post('title')==='') {
			$Return['error'] = $this->lang->line('tat_error_title');
		} else if($this->input->post('amount')==='') {
			$Return['error'] = $this->lang->line('tat_error_amount_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'payments_title' => $this->input->post('title'),
		'payments_amount' => $this->input->post('amount')
		);
		$e_field_id = $this->input->post('e_field_id');
		$result = $this->Employees_model->salary_other_payment_update_record($data,$e_field_id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_update_otherpayments_success');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}


	public function delete_document() {
		
		if($this->input->post('data')=='delete_record') {
	
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$id = $this->uri->segment(4);
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$result = $this->Employees_model->delete_document_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_document_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}
	
	

	public function delete_contact() {
		if($this->input->post('data')=='delete_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_contact_record($id);
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_contact_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}

	public function delete_qualification() {
		
		if($this->input->post('data')=='delete_record') {
			
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_qualification_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_qualification_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}
	

	public function delete_work_experience() {
		
		if($this->input->post('data')=='delete_record') {
			
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_work_experience_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_work_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}
	

	public function delete_bank_account() {
		
		if($this->input->post('data')=='delete_record') {
		
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_bank_account_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_bankaccount_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}
	
	
	

	public function delete_location() {
		
		if($this->input->post('data')=='delete_record') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_location_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_location_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}




	public function delete_shift() {
		
		if($this->input->post('data')=='delete_record') {
			
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_shift_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_shift_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}

	public function delete_all_allowances() {
		
		if($this->input->post('data')=='delete_record') {
		
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_allowance_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_delete_allowance_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}


	public function delete_all_commissions() {
		
		if($this->input->post('data')=='delete_record') {
	
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_commission_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_delete_commission_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}


	public function delete_all_statutory_deductions() {
		
		if($this->input->post('data')=='delete_record') {
		
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_statutory_deductions_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_delete_statutory_deduction_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}

	public function delete_all_other_payments() {
		
		if($this->input->post('data')=='delete_record') {
			
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_other_payments_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_delete_otherpayments_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}
	

	public function delete_all_deductions() {
		
		if($this->input->post('data')=='delete_record') {
			
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_loan_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_delete_loan_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}


	public function delete_emp_overtime() {
		
		if($this->input->post('data')=='delete_record') {
			
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_overtime_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_delete_overtime_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}


	public function update_loan_info() {
	
		if($this->input->post('type')=='loan_info') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		$reason = $this->input->post('reason');
		$qt_reason = htmlspecialchars(addslashes($reason), ENT_QUOTES);
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$st_date = strtotime($start_date);
		$ed_date = strtotime($end_date);
		
		$id = $this->input->post('e_field_id');
			
		if($this->input->post('loan_deduction_title')==='') {
			$Return['error'] = $this->lang->line('tat_employee_set_loan_title_error');
		} else if($this->input->post('monthly_installment')==='') {
			$Return['error'] = $this->lang->line('tat_employee_set_mins_title_error');
		} else if($this->input->post('start_date')==='') {
			$Return['error'] = $this->lang->line('tat_error_start_date');
		} else if($this->input->post('end_date')==='') {
			$Return['error'] = $this->lang->line('tat_error_end_date');
		} else if($st_date > $ed_date) {
			$Return['error'] = $this->lang->line('tat_error_start_end_date');
		}
						
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'loan_deduction_title' => $this->input->post('loan_deduction_title'),
		'reason' => $qt_reason,
		'monthly_installment' => $this->input->post('monthly_installment'),
		'start_date' => $this->input->post('start_date'),
		'end_date' => $this->input->post('end_date'),
		'loan_options' => $this->input->post('loan_options')
		);
		
		$result = $this->Employees_model->salary_loan_update_record($data,$id);
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_update_loan_success');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	

	public function employee_loan_info() {
	
		if($this->input->post('type')=='loan_info') {		

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		$reason = $this->input->post('reason');
		$qt_reason = htmlspecialchars(addslashes($reason), ENT_QUOTES);
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$st_date = strtotime($start_date);
		$ed_date = strtotime($end_date);
		
		$user_id = $this->input->post('user_id');
		
		
		if($this->input->post('loan_deduction_title')==='') {
			$Return['error'] = $this->lang->line('tat_employee_set_loan_title_error');
		} else if($this->input->post('monthly_installment')==='') {
			$Return['error'] = $this->lang->line('tat_employee_set_mins_title_error');
		} else if($this->input->post('start_date')==='') {
			$Return['error'] = $this->lang->line('tat_error_start_date');
		} else if($this->input->post('end_date')==='') {
			$Return['error'] = $this->lang->line('tat_error_end_date');
		} else if($st_date > $ed_date) {
			$Return['error'] = $this->lang->line('tat_error_start_end_date');
		}
						
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		$tm = $this->Employees_model->get_month_diff($this->input->post('start_date'),$this->input->post('end_date'));
		if($tm < 1) {
			$m_ins = $this->input->post('monthly_installment');
		} else {
			$m_ins = $this->input->post('monthly_installment')/$tm;
		}
	
		$data = array(
		'loan_deduction_title' => $this->input->post('loan_deduction_title'),
		'reason' => $qt_reason,
		'monthly_installment' => $this->input->post('monthly_installment'),
		'start_date' => $this->input->post('start_date'),
		'end_date' => $this->input->post('end_date'),
		'loan_options' => $this->input->post('loan_options'),
		'loan_time' => $tm,
		'loan_deduction_amount' => $m_ins,
		'employee_id' => $user_id
		);
		
		$result = $this->Employees_model->add_salary_loan($data);
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_add_loan_success');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	

	public function delete() {
		
		if($this->input->post('is_ajax')=='2') {
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_current_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}


	/** Filter Company, Location, Department and Designations */

	public function filter_company_flocations() {

		$data['title'] = $this->Tat_model->site_title();
		$keywords = preg_split("/[\s,]+/", $this->uri->segment(4));
		if(is_numeric($keywords[0])) {
			$id = $keywords[0];
		
			$data = array(
				'company_id' => $id
				);
			$session = $this->session->userdata('username');
			if(!empty($session)){ 
				$data = $this->security->xss_clean($data);
				$this->load->view("admin/filter/filter_company_flocations", $data);
			} else {
				redirect('admin/');
			}
		}
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }

	
	 public function filter_location_fdepartments() {

		$data['title'] = $this->Tat_model->site_title();
		$keywords = preg_split("/[\s,]+/", $this->uri->segment(4));
		if(is_numeric($keywords[0])) {
			$id = $keywords[0];
		
			$data = array(
				'location_id' => $id
				);
			$session = $this->session->userdata('username');
			if(!empty($session)){ 
				$data = $this->security->xss_clean($data);
				$this->load->view("admin/filter/filter_location_fdepartments", $data);
			} else {
				redirect('admin/');
			}
		}
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }

	 public function filter_location_fdesignation() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'department_id' => $id,
			'all_designations' => $this->Designation_model->all_designations(),
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/filter/filter_location_fdesignation", $data);
		} else {
			redirect('admin/');
		}
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }
	

}
