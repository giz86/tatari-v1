<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();

		$this->load->model("Employees_model");
		$this->load->model("Tat_model");
		$this->load->model("Department_model");
		$this->load->model("Designation_model");
		$this->load->model("Roles_model");
		$this->load->model("Location_model");
		$this->load->model("Company_model");
		$this->load->model("Custom_fields_model");
		$this->load->library("pagination");
		$this->load->helper('string');
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
		$data['get_all_companies'] = $this->Tat_model->get_companies();
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
					$de_file = base_url().'uploads/profile/default_male.jpg';
				 } else {
					$de_file = base_url().'uploads/profile/default_female.jpg';
				 }
				$ol = '<a href="javascript:void(0);"><span class="avatar box-32"><img src="'.$de_file.'" class="user-image-hr" alt=""></span></a>';
			}



			$employee_name = $ol.$full_name.'<br><small class="text-muted tatari-text-info-margin"><i>id: '.$r->employee_id.'<i></i></i></small><br><small class="text-muted tatari-text-info-margin"></small><br>';
			
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
			'is_active' => $result[0]->is_active,
			'date_of_joining' => $result[0]->date_of_joining,
			'all_departments' => $this->Department_model->all_departments(),
			'all_designations' => $this->Designation_model->all_designations(),
			'all_user_roles' => $this->Roles_model->all_user_roles(),
			'title' => $this->lang->line('tat_employee_detail').' | '.$this->Tat_model->site_title(),
			'profile_picture' => $result[0]->profile_picture,
			'view_companies_id' => $result[0]->view_companies_id,
			'all_countries' => $this->Tat_model->get_countries(),
			'get_all_companies' => $this->Tat_model->get_companies(),
			'all_office_locations' => $this->Location_model->all_office_locations(),
			);
		
		$data['subview'] = $this->load->view("admin/employees/employee_detail", $data, TRUE);
		$this->load->view('admin/layout/layout_main', $data); //page load
		
		// Datatables Variables
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
			'work_phone_extension' => $result[0]->work_phone_extension,
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
		$view_companies_id = implode(',',$this->input->post('view_companies_id'));
		
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
		'state' => $this->input->post('estate'),
		'city' => $this->input->post('ecity'),
		'zipcode' => $this->input->post('ezipcode'),
		'view_companies_id' => $view_companies_id,
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
						$Return['img'] = $profile.'default_male.jpg';
					} else {
						$Return['img'] = $profile.'default_female.jpg';
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
		/* Define return | here result is used to return user data and error for error message */
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
		} else if($this->input->post('work_phone_extension')!=='' && !preg_match('/^([0-9]*)$/', $this->input->post('work_phone_extension'))) {
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
		'work_phone_extension' => $this->input->post('work_phone_extension'),
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
		'work_phone_extension' => $this->input->post('work_phone_extension'),
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
	 

	public function location() {

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
	
	
	public function delete_imgdocument() {
		
		if($this->input->post('data')=='delete_record') {

			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$id = $this->uri->segment(4);
			$result = $this->Employees_model->delete_imgdocument_record($id);
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_employee_img_document_deleted');
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
	

}
