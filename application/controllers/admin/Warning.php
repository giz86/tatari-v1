<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Warning extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->model("Warning_model");
		$this->load->model("Tat_model");
		$this->load->model("Department_model");
	}
	

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
		$data['title'] = $this->lang->line('left_warnings').' | '.$this->Tat_model->site_title();
		$data['all_employees'] = $this->Tat_model->all_employees();
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$data['all_warning_types'] = $this->Warning_model->all_warning_types();
		$data['breadcrumbs'] = $this->lang->line('left_warnings');
		$data['path_url'] = 'warning';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('20',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/warning/warning_list", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); //page load
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}
     }
	 

	 public function get_employees() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/warning/get_employees", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }
	 

	 public function get_employees_warning() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/warning/get_employees_warning", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }
 
    public function warning_list() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/warning/warning_list", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$role_resources_ids = $this->Tat_model->user_role_resource();
		$user_info = $this->Tat_model->read_user_info($session['user_id']);
		if($user_info[0]->user_role_id==1){
			$warning = $this->Warning_model->get_warning();
		} else {
			if(in_array('238',$role_resources_ids)) {
				$warning = $this->Warning_model->get_company_warning($user_info[0]->company_id);
			} else {
				$warning = $this->Warning_model->get_employee_warning($session['user_id']);
			}
		}		
		$data = array();

        foreach($warning->result() as $r) {
			 			
		$user = $this->Tat_model->read_user_info($r->warning_to);
		// user full name
		if(!is_null($user)){
			$warning_to = $user[0]->first_name.' '.$user[0]->last_name;
		} else {
			$warning_to = '--';	
		}
		$user_by = $this->Tat_model->read_user_info($r->warning_by);

		if(!is_null($user_by)){
			$warning_by = $user_by[0]->first_name.' '.$user_by[0]->last_name;
		} else {
			$warning_by = '--';	
		}

		$warning_date = $this->Tat_model->set_date_format($r->warning_date);
			
		if($r->status==0): $status = $this->lang->line('tat_pending');
		elseif($r->status==1): $status = $this->lang->line('tat_accepted'); else: $status = $this->lang->line('tat_rejected'); endif;
		// get warning type
		$warning_type = $this->Warning_model->read_warning_type_information($r->warning_type_id);
		if(!is_null($warning_type)){
			$wtype = $warning_type[0]->type;
		} else {
			$wtype = '--';	
		}

		$company = $this->Tat_model->read_company_info($r->company_id);
		if(!is_null($company)){
			$comp_name = $company[0]->name;
		} else {
			$comp_name = '--';	
		}
		
		if(in_array('226',$role_resources_ids)) { //edit
			$edit = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-warning_id="'. $r->warning_id . '"><span class="fa fa-pencil"></span></button></span>';
		} else {
			$edit = '';
		}
		if(in_array('227',$role_resources_ids)) { // delete
			$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->warning_id . '"><span class="fa fa-trash"></span></button></span>';
		} else {
			$delete = '';
		}
		if(in_array('238',$role_resources_ids)) { //view
			$view = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_view').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-warning_id="'. $r->warning_id . '"><span class="fa fa-eye"></span></button></span>';
		} else {
			$view = '';
		}
		if($r->status==0): $status = '<span class="badge bg-orange">'.$this->lang->line('tat_pending').'</span>';
		elseif($r->status==1): $status = '<span class="badge bg-green">'.$this->lang->line('tat_accepted').'</span>';else: $status = '<span class="badge bg-red">'.$this->lang->line('tat_rejected').'</span>'; endif;
		
		$combhr = $edit.$view.$delete;
		
		$iwarning_to = $warning_to.'<br><small class="text-muted"><i>'.$wtype.'<i></i></i></small><br><small class="text-muted"><i>'.$status.'<i></i></i></small>';
		
		$data[] = array(
			$combhr,
			$iwarning_to,
			$comp_name,
			$warning_date,
			$r->subject,
			$warning_by
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $warning->num_rows(),
			 "recordsFiltered" => $warning->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	 public function read()
	{
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('warning_id');
		$result = $this->Warning_model->read_warning_information($id);
		$data = array(
				'warning_id' => $result[0]->warning_id,
				'company_id' => $result[0]->company_id,
				'warning_to' => $result[0]->warning_to,
				'warning_by' => $result[0]->warning_by,
				'warning_date' => $result[0]->warning_date,
				'warning_type_id' => $result[0]->warning_type_id,
				'subject' => $result[0]->subject,
				'description' => $result[0]->description,
				'status' => $result[0]->status,
				'attachment' => $result[0]->attachment,
				'all_employees' => $this->Tat_model->all_employees(),
				'get_all_companies' => $this->Tat_model->get_companies(),
				'all_warning_types' => $this->Warning_model->all_warning_types(),
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('admin/warning/dialog_warning', $data);
		} else {
			redirect('admin/');
		}
	}
	

	public function add_warning() {
	
		if($this->input->post('add_type')=='warning') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		$description = $this->input->post('description');
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('company_id')==='') {
			$Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('warning_to')==='') {
       		 $Return['error'] = $this->lang->line('tat_employee_error_warning');
		} else if($this->input->post('type')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_warning_type');
		} else if($this->input->post('subject')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_subject');
		} else if($this->input->post('warning_by')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_warning_by');
		} else if($this->input->post('warning_date')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_warning_date');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		if(is_uploaded_file($_FILES['attachment']['tmp_name'])) {
			//checking image type
			$allowed =  array('png','jpg','jpeg','pdf','gif');
			$filename = $_FILES['attachment']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
			if(in_array($ext,$allowed)){
				$tmp_name = $_FILES["attachment"]["tmp_name"];
				$profile = "uploads/warning/";
				$set_img = base_url()."uploads/warning/";

				$name = basename($_FILES["attachment"]["name"]);
				$newfilename = 'warning_'.round(microtime(true)).'.'.$ext;
				move_uploaded_file($tmp_name, $profile.$newfilename);
				$fname = $newfilename;			
			} else {
				$Return['error'] = $this->lang->line('tat_error_attatchment_type');
			}
		} else {
			$fname = '';
		}
	
		$data = array(
		'warning_to' => $this->input->post('warning_to'),
		'company_id' => $this->input->post('company_id'),
		'warning_type_id' => $this->input->post('type'),
		'description' => $qt_description,
		'attachment' => $fname,
		'subject' => $this->input->post('subject'),
		'warning_by' => $this->input->post('warning_by'),
		'warning_date' => $this->input->post('warning_date'),
		'status' => '0',
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Warning_model->add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_warning_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function update() {
	
		if($this->input->post('edit_type')=='warning') {
			
		$id = $this->uri->segment(4);
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();

		$description = $this->input->post('description');
		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);
		
		if($this->input->post('type')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_warning_type');
		} else if($this->input->post('subject')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_subject');
		} else if($this->input->post('warning_date')==='') {
			 $Return['error'] = $this->lang->line('tat_employee_error_warning_date');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'warning_type_id' => $this->input->post('type'),
		'description' => $qt_description,
		'subject' => $this->input->post('subject'),
		'warning_date' => $this->input->post('warning_date'),
		'status' => $this->input->post('status'),
		);
		
		$result = $this->Warning_model->update_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_employee_warning_updated');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	public function delete() {

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$id = $this->uri->segment(4);
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		$result = $this->Warning_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = $this->lang->line('tat_employee_warning_deleted');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
	}
}
