<?php

/**
 * Job Candidates Controller: to manage job application from candidates.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Job_candidates extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->model("Job_post_model");
		$this->load->model("Designation_model");
		$this->load->model("Department_model");
		$this->load->model("Tat_model");
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
		$data['title'] = $this->lang->line('left_job_candidates').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('left_job_candidates');
		$data['path_url'] = 'job_candidates';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('51',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/job_post/job_candidates", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}		  
     }
 

    public function candidate_list() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/job_post/job_candidates", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Index
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$role_resources_ids = $this->Tat_model->user_role_resource();
	
		$candidates = $this->Job_post_model->get_jobs_candidates();

		$data = array();

        foreach($candidates->result() as $r) {
		
            $job = $this->Job_post_model->read_job_information($r->job_id);
            if(!is_null($job)){
                $app_row = $this->Job_post_model->job_applications_available($r->job_id);
                if($app_row > 1) {
                    $app_available = '<br><a class="badge bg-purple btn-xs" href="'.site_url('admin/job_candidates/').'by_job/'.$r->job_id.'" target="_blank"><i class="fa fa-list"></i> '.$this->lang->line('tat_job_applicants_title').'</a>';
                } else {
                    $app_available = '';
                }
                $job_title = '<a href="'.site_url().'vacancy	/detail/'.$job[0]->job_url.'" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$this->lang->line('tat_view').'">'.$job[0]->job_title.'</a>';
                $job_title = $job_title.$app_available;
            } else {
                $job_title = '-';	
            }

            $created_at = $this->Tat_model->set_date_format($r->created_at);


            if($r->application_status == 0){
                $status = '<span class="badge bg-yellow">'.$this->lang->line('tat_pending').'</span>';
            } else if($r->application_status == 1){
                $status = '<span class="badge bg-teal">'.$this->lang->line('tat_primary_selected').'</span>';
            } if($r->application_status == 2){
                $status = '<span class="badge bg-primary">'.$this->lang->line('tat_call_for_interview').'</span>';
            } if($r->application_status == 3){
                $status = '<span class="badge bg-green">'.$this->lang->line('tat_confirm_del').'</span>';
            } if($r->application_status == 4){
                $status = '<span class="badge bg-red">'.$this->lang->line('tat_rejected').'</span>';
            }

            if(in_array('294',$role_resources_ids)) { //download
                $download = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_download').'">
                <a href="'.site_url('admin/download').'?type=resume&filename='.$r->job_resume.'"><button type="button" class="btn btn-default btn-sm m-b-0-0 waves-effect waves-light"><i class="fa fa-download"></i></button></a></span>';
            } else {
                $download = '';
            }

            if(in_array('295',$role_resources_ids)) { // delete
                $delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->application_id . '"><i class="fa fa-trash"></i></button></span>';
                $edit_status = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_change_status').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".add-modal-data" data-application_id="'. $r->application_id . '"><i class="fa fa-pencil-square-o"></i></button></span>';
            } else {
                $delete = '';
                $edit_status = '';
            }

            $iticket_code = $r->full_name.'<br><small class="text-muted"><i>'.$r->email.'<i></i></i></small>';
            $cover_letter = '<a><button class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-application_id="'. $r->application_id . '">'.$this->lang->line('tat_view').' '.$this->lang->line('tat_jobs_cover_letter').'</button></a>';
            $combhr = $download.$edit_status.$delete;
            
            $data[] = array(
                $combhr,
                $job_title,
                $r->full_name,
                $r->email,
                $status,
                $cover_letter,
                $created_at
            );
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $candidates->num_rows(),
			 "recordsFiltered" => $candidates->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }


	 public function read_application() {
            $session = $this->session->userdata('username');
            if(empty($session)){ 
                redirect('admin/');
            }
            $data['title'] = $this->Tat_model->site_title();
            $id = $this->input->get('application_id');
            $result = $this->Job_post_model->read_job_application_info($id);
            $data = array(
                    'application_id' => $result[0]->application_id,
                    'job_id' => $result[0]->job_id,
                    'application_status' => $result[0]->application_status,
                    'message' => $result[0]->message
                    );
            if(!empty($session)){ 
                $this->load->view('admin/job_post/dialog_application', $data);
            } else {
                redirect('admin/');
            }
	}


	public function by_job() {
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$system = $this->Tat_model->read_setting_info(1);
		if($system[0]->module_recruitment!='true'){
			redirect('admin/dashboard');
		}
		$id = $this->uri->segment(4);
		$job = $this->Job_post_model->read_job_information($id);
		if(is_null($job)){
			redirect('admin/job_candidates/');	
		}
		$data['title'] = $this->lang->line('tat_job_applicants_title').' | '.$this->Tat_model->site_title();
		$data['breadcrumbs'] = $job[0]->job_title.' '.$this->lang->line('tat_job_applicants_title');
		$data['path_url'] = 'job_applicants';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('51',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/job_post/view_applicants", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}		  
     }

	
	public function applicants_list() {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/job_post/view_applicants", $data);
		} else {
			redirect('admin/');
		}
		// Datatables Index
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$id = $this->uri->segment(4);
		$role_resources_ids = $this->Tat_model->user_role_resource();
		
		$applicants = $this->Job_post_model->get_jobs_single_candidate($id);
		
		$data = array();

        foreach($applicants->result() as $r) {
		
		$job = $this->Job_post_model->read_job_information($r->job_id);
		if(!is_null($job)){
			$job_title = $job[0]->job_title;
		} else {
			$job_title = '-';	
		}
	
		$created_at = $this->Tat_model->set_date_format($r->created_at);
	
		if($r->application_status == 0){
			$status = '<span class="badge bg-yellow">'.$this->lang->line('tat_pending').'</span>';
		} else if($r->application_status == 1){
			$status = '<span class="badge bg-teal">'.$this->lang->line('tat_primary_selected').'</span>';
		} if($r->application_status == 2){
			$status = '<span class="badge bg-primary">'.$this->lang->line('tat_call_for_interview').'</span>';
		} if($r->application_status == 3){
			$status = '<span class="badge bg-green">'.$this->lang->line('tat_confirm_del').'</span>';
		} if($r->application_status == 4){
			$status = '<span class="badge bg-red">'.$this->lang->line('tat_rejected').'</span>';
		}
		
		if(in_array('294',$role_resources_ids)) { //download
			$download = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_download').'">
			<a href="'.site_url('admin/download').'?type=resume&filename='.$r->job_resume.'"><button type="button" class="btn btn-default btn-sm m-b-0-0 waves-effect waves-light"><i class="fa fa-download"></i></button></a></span>';
		} else {
			$download = '';
		}
		if(in_array('295',$role_resources_ids)) { // delete
			$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->application_id . '"><i class="fa fa-trash"></i></button></span>';
			$edit_status = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_change_status').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".add-modal-data" data-application_id="'. $r->application_id . '"><i class="fa fa-pencil-square-o"></i></button></span>';
		} else {
			$delete = '';
			$edit_status = '';
		}
		$iticket_code = $r->full_name.'<br><small class="text-muted"><i>'.$r->email.'<i></i></i></small>';
		$cover_letter = '<a><button class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-application_id="'. $r->application_id . '">'.$this->lang->line('tat_view').' '.$this->lang->line('tat_jobs_cover_letter').'</button></a>';
		$combhr = $download.$edit_status.$delete;
		
		$data[] = array(
			$combhr,
			$r->full_name,
			$r->email,
			$status,
			$cover_letter,
			$created_at
		);
      }

	  $output = array(
		   "draw" => $draw,
			 "recordsTotal" => $applicants->num_rows(),
			 "recordsFiltered" => $applicants->num_rows(),
			 "data" => $data
		);
	  echo json_encode($output);
	  exit();
     }


	public function update_status() {
	
		if($this->input->post('edit_type')=='update_status') {		
	
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();	
		$data = array(
		'application_status' => $this->input->post('status'),
		);

		$id = $this->input->post('jid');
		$result = $this->Job_post_model->update_applicant_status($data,$id);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_applicant_status_updated');
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
		$result = $this->Job_post_model->delete_application_record($id);
		if(isset($id)) {
			$Return['result'] = $this->lang->line('tat_error_job_application');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
	}
    
}
