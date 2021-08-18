<?php

/**
 * Job Post Controller: to manage data in between new job posts and vacancies.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Job_post extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->model("Job_post_model");
        $this->load->model("Department_model");
		$this->load->model("Company_model");
        $this->load->model("Designation_model");
		$this->load->model("Tat_model");
		$this->load->library('email');
		$this->load->helper('string');
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
		$system = $this->Tat_model->read_setting_info(1);

		if($system[0]->module_recruitment!='true'){
			redirect('admin/dashboard');
		}

		$data['title'] = $this->lang->line('left_job_posts').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('left_job_posts');
		$data['path_url'] = 'job_post';
		$data['all_departments'] = $this->Department_model->all_departments();
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('49',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/job_post/job_list", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}
     }


 
    public function job_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/job_post/job_list", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$role_resources_ids = $this->Tat_model->user_role_resource();
		$jobs = $this->Job_post_model->get_jobs();
		$data = array();


        foreach($jobs->result() as $r) {

		$job_type = $this->Job_post_model->read_job_type_information($r->job_type);
		if(!is_null($job_type)){
			$jtype = $job_type[0]->type;
		} else {
			$jtype = '--';
		}

		$date_of_closing = $this->Tat_model->set_date_format($r->date_of_closing);
		$created_at = $this->Tat_model->set_date_format($r->created_at);

		if($r->status==1): $status = '<span class="badge bg-green">'.$this->lang->line('tat_published').'</span>'; else: $status = '<span class="badge bg-orange">'.$this->lang->line('tat_unpublished').'</span>'; endif;
		

        $department = $this->Department_model->read_department_information($r->dept_id);
        if(!is_null($department)){
            $department_name = $department[0]->department_name;
        } else {
            $department_name = '--';	
        }



		if(in_array('292',$role_resources_ids)) { //edit
			$edit = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-job_id="'. $r->job_id . '"><span class="fa fa-pencil"></span></button></span>';
		} else {
			$edit = '';
		}
		if(in_array('293',$role_resources_ids)) { // delete
			$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->job_id . '"><span class="fa fa-trash"></span></button></span>';
		} else {
			$delete = '';
		}


			/**
			 * Take to possibly front end of the Site to show the Vacancy Announcement
			 */
		$view = '<a href="'.site_url().'vacancy/detail/'.$r->job_url.'" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$this->lang->line('tat_view').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"><span class="fa fa-eye"></span></button></a>';
	


		$combhr = $edit.$view.$delete;
		$app_row = $this->Job_post_model->job_applications_available($r->job_id);
		if($app_row > 0) {
			$app_available = '<br><a class="badge bg-purple btn-xs" href="'.site_url('admin/job_candidates/').'by_job/'.$r->job_id.'" target="_blank"><i class="fa fa-list"></i> '.$this->lang->line('tat_job_applicants_title').'</a>';
		} else {
			$app_available = '';
		}

		$ijob_title = $r->job_title.$app_available;
		$data[] = array(
			$combhr,
			$ijob_title,
			$department_name,
			$created_at,
			$status,
			$date_of_closing
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $jobs->num_rows(),
			 "recordsFiltered" => $jobs->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }
	 
	 
	 public function read()
	{
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('job_id');
		$result = $this->Job_post_model->read_job_information($id);
		$data = array(
				'job_id' => $result[0]->job_id,
				'dept_id' => $result[0]->dept_id,
				'job_title' => $result[0]->job_title,
				'job_type_id' => $result[0]->job_type,
				'job_vacancy' => $result[0]->job_vacancy,
				'is_featured' => $result[0]->is_featured,
				'gender' => $result[0]->gender,
				'minimum_experience' => $result[0]->minimum_experience,
				'date_of_closing' => $result[0]->date_of_closing,
				'short_description' => $result[0]->short_description,
				'long_description' => $result[0]->long_description,
				'status' => $result[0]->status,
				'all_designations' => $this->Designation_model->all_designations(),
				'all_job_types' => $this->Job_post_model->all_job_types(),
				'all_companies' => $this->Tat_model->get_companies()
				);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view('admin/job_post/dialog_job_post', $data);
		} else {
			redirect('admin/');
		}
	}
	

	public function add_job() {
	
		if($this->input->post('add_type')=='job') {		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		$long_description = $_POST['long_description'];	
		$short_description = $_POST['short_description'];	
		$qt_short_description = htmlspecialchars(addslashes($short_description), ENT_QUOTES);
		$qt_description = htmlspecialchars(addslashes($long_description), ENT_QUOTES);
		
		if($this->input->post('company')==='') {
       		$Return['error'] = $this->lang->line('tat_error_company');
		} else if($this->input->post('job_title')==='') {
       		$Return['error'] = $this->lang->line('tat_error_jobpost_title');
		} else if($this->input->post('job_type')==='') {
			$Return['error'] = $this->lang->line('tat_error_jobpost_type');
		} else if($this->input->post('designation_id')==='') {
			$Return['error'] = $this->lang->line('tat_error_jobpost_designation');
		} else if($this->input->post('vacancy')==='') {
			$Return['error'] = $this->lang->line('tat_error_jobpost_positions');
		} else if($this->input->post('date_of_closing')==='') {
       		$Return['error'] = $this->lang->line('tat_error_jobpost_closing_date');
		} else if($qt_short_description==='') {
       		$Return['error'] = $this->lang->line('tat_error_jobpost_short_description');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		$jurl = random_string('alnum', 40);
		$data = array(
		'job_title' => $this->input->post('job_title'),
		'dept_id' => $this->input->post('dept_id'),
		'job_type' => $this->input->post('job_type'),
		'job_url' => $jurl,
		'short_description' => $qt_short_description,
		'long_description' => $qt_description,
		'status' => $this->input->post('status'),
		'is_featured' => $this->input->post('is_featured'),
		'job_vacancy' => $this->input->post('vacancy'),
		'date_of_closing' => $this->input->post('date_of_closing'),
		'gender' => $this->input->post('gender'),
		'minimum_experience' => $this->input->post('experience'),
		'created_at' => date('Y-m-d h:i:s'),
		
		);
		$result = $this->Job_post_model->add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_job_added');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	
	public function update() {
	
		if($this->input->post('edit_type')=='job') {
			
		$id = $this->uri->segment(4);
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		$long_description = $_POST['long_description'];	
		$short_description = $_POST['short_description'];	
		$qt_short_description = htmlspecialchars(addslashes($short_description), ENT_QUOTES);
		$qt_description = htmlspecialchars(addslashes($long_description), ENT_QUOTES);
		
		if($this->input->post('company')==='') {
       		$Return['error'] = $this->lang->line('tat_error_company');
		} else if($this->input->post('job_title')==='') {
       		$Return['error'] = $this->lang->line('tat_error_jobpost_title');
		} else if($this->input->post('job_type')==='') {
			$Return['error'] = $this->lang->line('tat_error_jobpost_type');
		} else if($this->input->post('designation_id')==='') {
			$Return['error'] = $this->lang->line('tat_error_jobpost_designation');
		} else if($this->input->post('vacancy')==='') {
			$Return['error'] = $this->lang->line('tat_error_jobpost_positions');
		} else if($this->input->post('date_of_closing')==='') {
       		$Return['error'] = $this->lang->line('tat_error_jobpost_closing_date');
		} else if($qt_short_description==='') {
       		$Return['error'] = $this->lang->line('tat_error_jobpost_short_description');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'job_title' => $this->input->post('job_title'),
		'dept_id' => $this->input->post('dept_id'),
		'job_type' => $this->input->post('job_type'),
		'short_description' => $qt_short_description,
		'long_description' => $qt_description,
		'status' => $this->input->post('status'),
		'is_featured' => $this->input->post('is_featured'),
		'job_vacancy' => $this->input->post('vacancy'),
		'date_of_closing' => $this->input->post('date_of_closing'),
		'gender' => $this->input->post('gender'),
		'minimum_experience' => $this->input->post('experience')		
		);
		
		$result = $this->Job_post_model->update_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_job_updated');
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
		$result = $this->Job_post_model->delete_record($id);
		if(isset($id)) {
			$Return['result'] = $this->lang->line('tat_success_job_deleted');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
	}

}
