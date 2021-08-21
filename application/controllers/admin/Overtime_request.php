<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Overtime Request Controller : Handle records management for Overtime related requests and activities.

class Overtime_request extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
        $this->load->library('email');
		
		$this->load->model("Employees_model");
        $this->load->model("Overtime_request_model");
		$this->load->model("Department_model");
		$this->load->model("Designation_model");
		$this->load->model("Roles_model");
        $this->load->model("Location_model");
        $this->load->model("Tat_model");

	}
	
	public function output($Return=array()){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		exit(json_encode($Return));
	}

	

    public function read() {
		$data['title'] = $this->Tat_model->site_title();
		$time_request_id = $this->input->get('time_request_id');
		$result = $this->Overtime_request_model->read_overtime_request_info($time_request_id);
		$user = $this->Tat_model->read_user_info($result[0]->employee_id);
	
		$full_name = $user[0]->first_name.' '.$user[0]->last_name;
		
		$in_time = new DateTime($result[0]->request_clock_in);
		$out_time = new DateTime($result[0]->request_clock_out);
		
		$clock_in = $in_time->format('H:i');
		if($result[0]->request_clock_out == '') {
			$clock_out = '';
		} else {
			$clock_out = $out_time->format('H:i');
		}
		
		$data = array(
				'time_request_id' => $result[0]->time_request_id,
				'company_id' => $result[0]->company_id,
				'employee_id' => $result[0]->employee_id,
				'full_name' => $full_name,
				'request_date' => $result[0]->request_date,
				'request_clock_in' => $clock_in,
				'request_clock_out' => $clock_out,
				'request_reason' => $result[0]->request_reason,
				'is_approved' => $result[0]->is_approved,
				'get_all_companies' => $this->Tat_model->get_companies(),
				'all_employees' => $this->Tat_model->all_employees(),
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('admin/attendance/dialog_overtime_request', $data);
		} else {
			redirect('admin/');
		}
	}
	 
	
	public function index()
     {
		
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('tat_overtime_request').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('tat_overtime_request');
		$data['path_url'] = 'overtime_request';		
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$data['all_employees'] = $this->Tat_model->all_employees();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('401',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/attendance/overtime_request", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}	  
     }	 

     public function add_request_attendance() {
	
		if($this->input->post('add_type')=='attendance') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		if($this->input->post('company_id')==='') {
			$Return['error'] = $this->lang->line('tat_error_company');
		} else if($this->input->post('employee_id')==='') {
			$Return['error'] = $this->lang->line('tat_error_employee_id');
		} else if($this->input->post('attendance_date_m')==='') {
        	$Return['error'] = $this->lang->line('tat_error_request_attendance_date');
		} else if($this->input->post('clock_in_m')==='') {
        	$Return['error'] = $this->lang->line('tat_error_request_attendance_in_time');
		} else if($this->input->post('clock_out_m')==='') {
        	$Return['error'] = $this->lang->line('tat_error_request_attendance_out_time');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		$attendance_date = $this->input->post('attendance_date_m');
		$clock_in = $this->input->post('clock_in_m');
		$clock_out = $this->input->post('clock_out_m');
		
		$clock_in2 = $attendance_date.' '.$clock_in.':00';
		$clock_out2 = $attendance_date.' '.$clock_out.':00';
		
		// Total Work Hour
		$total_work_cin =  new DateTime($clock_in2);
		$total_work_cout =  new DateTime($clock_out2);
		
		$interval_cin = $total_work_cout->diff($total_work_cin);
		$hours_in   = $interval_cin->format('%h');
		$minutes_in = $interval_cin->format('%i');
		$total_work = $hours_in .":".$minutes_in;
	
		// Pay Day
		$att_date = strtotime($attendance_date);
		$rq_date = date('Y-m',$att_date);
		
		$data = array(
            'company_id' => $this->input->post('company_id'),
            'employee_id' => $this->input->post('employee_id'),
            'request_date' => $attendance_date,
            'request_date_request' => $rq_date,
            'request_clock_in' => $clock_in2,
            'request_clock_out' => $clock_out2,
            'total_hours' => $total_work,
            'request_reason' => $this->input->post('tat_reason'),
            'is_approved' => 1
		);
		$result = $this->Overtime_request_model->add_employee_overtime_request($data);
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_request_attendance_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function overtime_request_list() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
	
		$attendance_date = $this->input->get("attendance_date");
	
		$employee_id = $session['user_id'];
		// Datatables Index
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$user_info = $this->Tat_model->read_user_info($session['user_id']);
		if($user_info[0]->user_role_id==1){
			$attendance_employee = $this->Overtime_request_model->all_employee_overtime_requests();
		} else {
			$attendance_employee = $this->Overtime_request_model->employee_overtime_requests($employee_id);
		}
		$role_resources_ids = $this->Tat_model->user_role_resource();
		$data = array();

          foreach($attendance_employee->result() as $r) {
			  
			$in_time = new DateTime($r->request_clock_in);
			$out_time = new DateTime($r->request_clock_out);
			
			$clock_in = $in_time->format('h:i a');			

			$att_date_in = explode(' ',$r->request_clock_in);
			$att_date_out = explode(' ',$r->request_clock_out);
			$request_date = $this->Tat_model->set_date_format($r->request_date);
			$cin_date = $clock_in;
			if($r->request_clock_out=='') {
				$cout_date = '-';
				$total_time = '-';
			} else {
				$clock_out = $out_time->format('h:i a');
				$interval = $in_time->diff($out_time);
				$hours  = $interval->format('%h');
				$minutes = $interval->format('%i');			
				$total_time = $hours ."h ".$minutes."m";
				$cout_date = $clock_out;
			}
			if($user_info[0]->user_role_id==1){
				if(in_array('402',$role_resources_ids)) { // Update
					$edit = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light edit-data" data-toggle="modal" data-target=".edit-modal-data" data-time_request_id="'.$r->time_request_id.'"><i class="fa fa-pencil"></i></button></span>';
				} else {
					$edit = '';
				}
				if(in_array('403',$role_resources_ids)) { // Delete
					$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'.$r->time_request_id.'"><i class="fa fa-trash"></i></button></span>';
				} else {
					$delete = '';
				}
			} else {
				if($r->is_approved == '2'){
					if(in_array('402',$role_resources_ids)) { // Edit
						$edit = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light edit-data" disabled data-toggle="modal" data-target=".edit-modal-data" ><i class="fa fa-pencil"></i></button></span>';
					} else {
						$edit = '';
					}
					if(in_array('403',$role_resources_ids)) { // Delete
						$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" disabled data-toggle="modal" data-target=".delete-modal" ><i class="fa fa-trash"></i></button></span>';
					} else {
						$delete = '';
					}
				} else {
					if(in_array('402',$role_resources_ids)) { // Edit
						$edit = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light edit-data" data-toggle="modal" data-target=".edit-modal-data" data-time_request_id="'.$r->time_request_id.'"><i class="fa fa-pencil"></i></button></span>';
					} else {
						$edit = '';
					}
					if(in_array('403',$role_resources_ids)) { // Delete
						$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'.$r->time_request_id.'"><i class="fa fa-trash"></i></button></span>';
					} else {
						$delete = '';
					}
				}
			}

			if($r->is_approved == '1'){
				$status = $this->lang->line('tat_pending');
			} else if($r->is_approved == '2'){
				$status = $this->lang->line('tat_accepted');
			} else {
				$status = $this->lang->line('tat_rejected');
			}
			
			$combhr = $edit.$delete;

		   $data[] = array(
				$combhr,
				$request_date,
				$cin_date,
				$cout_date,
				$total_time,
				$status
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
	 
	
	
	public function edit_attendance() {
	
		if($this->input->post('edit_type')=='attendance') {
			
		$id = $this->uri->segment(4);
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		$session = $this->session->userdata('username');
		$user = $this->Tat_model->read_user_info($session['user_id']);	
		
		if($this->input->post('company_id')==='') {
			$Return['error'] = $this->lang->line('tat_error_company');
		} else if($this->input->post('employee_id')==='') {
			$Return['error'] = $this->lang->line('tat_error_employee_id');
		} else if($this->input->post('attendance_date_e')==='') {
        	$Return['error'] = $this->lang->line('tat_error_request_attendance_date');
		} else if($this->input->post('clock_in')==='') {
        	$Return['error'] = $this->lang->line('tat_error_request_attendance_in_time');
		} else if($this->input->post('clock_out')==='') {
        	$Return['error'] = $this->lang->line('tat_error_request_attendance_out_time');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		$attendance_date = $this->input->post('attendance_date_e');
		$clock_in = $this->input->post('clock_in');
		$clock_in2 = $attendance_date.' '.$clock_in.':00';
		
		$total_work_cin =  new DateTime($clock_in2);
		
		$clock_out = $this->input->post('clock_out');
		$clock_out2 = $attendance_date.' '.$clock_out.':00';
		$total_work_cout =  new DateTime($clock_out2);
		
		$interval_cin = $total_work_cout->diff($total_work_cin);
		$hours_in   = $interval_cin->format('%h');
		$minutes_in = $interval_cin->format('%i');
		$total_work = $hours_in .":".$minutes_in;
		if($user[0]->user_role_id == 1) {
			$data = array(
			'company_id' => $this->input->post('company_id'),
			'employee_id' => $this->input->post('employee_id'),
			'request_date' => $attendance_date,
			'request_clock_in' => $clock_in2,
			'request_clock_out' => $clock_out2,
			'total_hours' => $total_work,
			'request_reason' => $this->input->post('tat_reason'),
			'is_approved' => $this->input->post('status'),
			);
		} else {
			$data = array(
			'request_date' => $attendance_date,
			'request_clock_in' => $clock_in2,
			'request_clock_out' => $clock_out2,
			'total_hours' => $total_work,
			'request_reason' => $this->input->post('tat_reason'),
			);
		}
		
		$result = $this->Overtime_request_model->update_request_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_request_attendance_update');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

    public function update_attendance_add() {
		$data['title'] = $this->Tat_model->site_title();
		$data = array(
				'get_all_companies' => $this->Tat_model->get_companies(),
				'all_employees' => $this->Tat_model->all_employees(),
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('admin/attendance/dialog_overtime_request', $data);
		} else {
			redirect('admin/');
		}
	}
	
	// DELETE RECORDS

	public function delete_attendance() {
		if($this->input->post('type')=='delete') {
			
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$id = $this->uri->segment(4);
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$result = $this->Overtime_request_model->delete_overtime_request_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_success_employe_attendance_deleted');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}
	
    // Extended:
	public function get_update_employees() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/attendance/get_request_employees", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Index
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	
	 }
}
