<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function __construct()
     {
          parent::__construct();
       
          $this->load->model('Login_model');
		  $this->load->model('Designation_model');
		  $this->load->model('Department_model');
		  $this->load->model('Employees_model');
		  $this->load->model('Tat_model');
     }
	

	public function output($Return=array()){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		exit(json_encode($Return));
	} 

    public function set_language($language = "") {
        
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER']);
        
    }
	
	public function index()
	{
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$system = $this->Tat_model->read_setting_info(1);
		if($system[0]->module_language=='true'){

			$user = $this->Tat_model->read_user_info($session['user_id']);
	
			$designation = $this->Designation_model->read_designation_information($user[0]->designation_id);
			if(!is_null($designation)){
				$des_emp = $designation[0]->designation_name;
			} else {
				$des_emp = '--';
			}
	
			$department = $this->Department_model->read_department_information($user[0]->department_id);
			if(!is_null($department)){
				$dep_emp = $department[0]->department_name;
			} else {
				$dep_emp = '--';
			}
			$data = array(
			'title' => $this->lang->line('dashboard_title').' | '.$this->Tat_model->site_title(),
			'path_url' => 'dashboard',
			'first_name' => $user[0]->first_name,
			'last_name' => $user[0]->last_name,
			'employee_id' => $user[0]->employee_id,
			'username' => $user[0]->username,
			'email' => $user[0]->email,
			'designation_name' => $des_emp,
			'department_name' => $dep_emp,
			'date_of_birth' => $user[0]->date_of_birth,
			'date_of_joining' => $user[0]->date_of_joining,
			'contact_no' => $user[0]->contact_no,
			'last_four_employees' => $this->Tat_model->last_four_employees(),
			
			);
			$data['subview'] = $this->load->view('admin/dashboard/index', $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); //page load
		} else {
	
		$user = $this->Tat_model->read_user_info($session['user_id']);
		
		$designation = $this->Designation_model->read_designation_information($user[0]->designation_id);
	
		$department = $this->Department_model->read_department_information($user[0]->department_id);
		$data = array(
			'title' => $this->Tat_model->site_title(),
			'path_url' => 'dashboard',
			'first_name' => $user[0]->first_name,
			'last_name' => $user[0]->last_name,
			'employee_id' => $user[0]->employee_id,
			'username' => $user[0]->username,
			'email' => $user[0]->email,
			'designation_name' => $designation[0]->designation_name,
			'department_name' => $department[0]->department_name,
			'date_of_birth' => $user[0]->date_of_birth,
			'date_of_joining' => $user[0]->date_of_joining,
			'contact_no' => $user[0]->contact_no,
			'last_four_employees' => $this->Tat_model->last_four_employees(),
			);
			$data['subview'] = $this->load->view('admin/dashboard/index', $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); //page load
		}
	}
	

}
