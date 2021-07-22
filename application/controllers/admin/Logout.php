<?php
// Logout Controller - handle the logging out operation.
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Controller
{

	public function output($Return=array()){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		exit(json_encode($Return));
	}
	
	public function __construct()
     {
          parent::__construct();
          $this->load->model('Login_model');
		  $this->load->model('Employees_model');
		  date_default_timezone_set("Africa/Addis_Ababa");
     }
	 
	
	public function index() {
	
		$session = $this->session->userdata('username');
		$last_data = array(
			'is_logged_in' => '0',
			'last_logout_date' => date('d-m-Y H:i:s')
		); 
		$this->Employees_model->update_record($last_data, $session['user_id']);
				
		$data['title'] = 'Tatari System';
		$sess_array = array('username' => '');
		$this->session->sess_destroy();
		$Return['result'] = 'Successfully Logout.';
		redirect('admin/', 'refresh');
	}
} 
?>