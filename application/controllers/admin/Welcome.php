<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->model('Employees_model');
		 $this->load->model('Tat_model');
	}


	public function index()
	{
		$data['title'] = 'Tatari | Log in';
		$this->load->view('admin/auth/login-1', $data);
	}
}
