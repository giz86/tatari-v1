<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('email');

		$this->load->model("Tat_model");
		$this->load->model("Employees_model");
		$this->load->model("Designation_model");
		$this->load->model("Department_model");
		$this->load->model("Location_model");
	}
	

	public function output($Return=array()){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		exit(json_encode($Return));
	}
	
	public function index()
	{
		$data['title'] = $this->lang->line('tat_forgot_password_link');
		$this->load->view('admin/auth/forgot_password', $data);
	}
	

}
