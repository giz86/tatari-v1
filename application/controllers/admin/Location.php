<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->model("Location_model");
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
		$data['title'] = $this->lang->line('tat_locations').' | '.$this->Tat_model->site_title();
		$data['all_countries'] = $this->Tat_model->get_countries();
		$data['all_companies'] = $this->Tat_model->get_companies();
		$data['all_employees'] = $this->Tat_model->all_employees();
		$data['breadcrumbs'] = $this->lang->line('tat_locations');
		$data['path_url'] = 'location';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('6',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("admin/location/location_list", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); //page load
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}
     }
 
    public function location_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/location/location_list", $data);
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
			$location = $this->Location_model->get_locations();
		} else {
			$location = $this->Location_model->get_company_office_location($user_info[0]->company_id);
		}
		$data = array();

          foreach($location->result() as $r) {
			  
			  // get country
			  $country = $this->Tat_model->read_country_info($r->country);
			  if(!is_null($country)){
			  	$c_name = $country[0]->country_name;
			  } else {
				  $c_name = '--';	
			  }
			  // get company
			  $company = $this->Tat_model->read_company_info($r->company_id);
			  if(!is_null($company)){
			  	$comp_name = $company[0]->name;
			  } else {
				  $comp_name = '--';	
			  }
			  // get user
			  $user = $this->Tat_model->read_user_info($r->added_by);
			  // user full name
			  if(!is_null($user)){
			  	$full_name = $user[0]->first_name.' '.$user[0]->last_name;
			  } else {
				$full_name = '--';	
			  }
			  
			   // get location head
			  $location_head = $this->Tat_model->read_user_info($r->location_head);
			  // user full name
			  if(!is_null($location_head)){
			  	$head_name = $location_head[0]->first_name.' '.$location_head[0]->last_name;
			  } else {
				  $head_name = '--';	
			  }
			  if(in_array('251',$role_resources_ids)) { //edit
				$edit = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"  data-toggle="modal" data-target="#edit-modal-data"  data-location_id="'. $r->location_id . '"><span class="fa fa-pencil"></span></button></span></span>';
			} else {
				$edit = '';
			}
			if(in_array('252',$role_resources_ids)) { // delete
				$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->location_id . '"><span class="fa fa-trash"></span></button></span>';
			} else {
				$delete = '';
			}
			if(in_array('253',$role_resources_ids)) { //view
				$view = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_view').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-location_id="'. $r->location_id . '"><span class="fa fa-eye"></span></button></span>';
			} else {
				$view = '';
			}
			$ilocation_name = $r->location_name.'<br><small class="text-muted"><i>'.$this->lang->line('module_company_title').': '.$comp_name.'<i></i></i></small>';
			$combhr = $edit.$view.$delete;

               $data[] = array(
			   		$combhr,
                    $ilocation_name,
					$head_name,
                    $r->city,
                    $c_name,
					$full_name
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
	

	 public function get_employees() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/location/get_employees", $data);
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
		$id = $this->input->get('location_id');
       // $data['all_countries'] = $this->tat_model->get_countries();
		$result = $this->Location_model->read_location_information($id);
		$data = array(
				'location_id' => $result[0]->location_id,
				'company_id' => $result[0]->company_id,
				'location_head' => $result[0]->location_head,
				'location_name' => $result[0]->location_name,
				'email' => $result[0]->email,
				'phone' => $result[0]->phone,
				'fax' => $result[0]->fax,
				'address_1' => $result[0]->address_1,
				'address_2' => $result[0]->address_2,
				'city' => $result[0]->city,
				'state' => $result[0]->state,
				'zipcode' => $result[0]->zipcode,
				'countryid' => $result[0]->country,
				'all_countries' => $this->Tat_model->get_countries(),
				'all_companies' => $this->Tat_model->get_companies(),
				'all_employees' => $this->Tat_model->all_employees()
				);
		if(!empty($session)){ 
			$this->load->view('admin/location/dialog_location', $data);
		} else {
			redirect('admin/');
		}
	}
	
	public function read_info()
	{
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('location_id');
       // $data['all_countries'] = $this->tat_model->get_countries();
		$result = $this->Location_model->read_location_information($id);
		$data = array(
				'location_id' => $result[0]->location_id,
				'company_id' => $result[0]->company_id,
				'location_head' => $result[0]->location_head,
				'location_name' => $result[0]->location_name,
				'email' => $result[0]->email,
				'phone' => $result[0]->phone,
				'fax' => $result[0]->fax,
				'address_1' => $result[0]->address_1,
				'address_2' => $result[0]->address_2,
				'city' => $result[0]->city,
				'state' => $result[0]->state,
				'zipcode' => $result[0]->zipcode,
				'countryid' => $result[0]->country,
				'all_countries' => $this->Tat_model->get_countries(),
				'all_companies' => $this->Tat_model->get_companies(),
				'all_employees' => $this->Tat_model->all_employees()
				);
		if(!empty($session)){ 
			$this->load->view('admin/location/view_location', $data);
		} else {
			redirect('admin/');
		}
	}


	public function add_location() {
	
		if($this->input->post('add_type')=='location') {

		$this->form_validation->set_rules('company', 'Company', 'trim|required|xss_clean');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		/* Server side PHP input validation */
		if($this->input->post('company')==='') {
        	$Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('name')==='') {
			$Return['error'] = $this->lang->line('tat_error_name_field');
		} else if($this->input->post('city')==='') {
			$Return['error'] = $this->lang->line('tat_error_city_field');
		} else if($this->input->post('country')==='') {
			$Return['error'] = $this->lang->line('tat_error_country_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'company_id' => $this->input->post('company'),
		'location_name' => $this->input->post('name'),
		'location_head' => $this->input->post('location_head'),
		'email' => $this->input->post('email'),
		'phone' => $this->input->post('phone'),
		'fax' => $this->input->post('fax'),
		'address_1' => $this->input->post('address_1'),
		'address_2' => $this->input->post('address_2'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'country' => $this->input->post('country'),
		'added_by' => $this->input->post('user_id'),
		'created_at' => date('d-m-Y'),
		
		);
		$result = $this->Location_model->add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_add_location');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

	public function update() {
	
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		if($this->input->post('edit_type')=='location') {
			
		$id = $this->uri->segment(4);
		

		$this->form_validation->set_rules('company', 'Company', 'trim|required|xss_clean');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		/* Server side PHP input validation */
		if($this->input->post('company')==='') {
        	$Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('name')==='') {
			$Return['error'] = $this->lang->line('tat_error_name_field');
		} else if($this->input->post('city')==='') {
			$Return['error'] = $this->lang->line('tat_error_city_field');
		} else if($this->input->post('country')==='') {
			$Return['error'] = $this->lang->line('tat_error_country_field');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'company_id' => $this->input->post('company'),
		'location_name' => $this->input->post('name'),
		'location_head' => $this->input->post('location_head'),
		'email' => $this->input->post('email'),
		'phone' => $this->input->post('phone'),
		'fax' => $this->input->post('fax'),
		'address_1' => $this->input->post('address_1'),
		'address_2' => $this->input->post('address_2'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'country' => $this->input->post('country'),		
		);	
		
		$result = $this->Location_model->update_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_update_location');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
	public function delete() {
		if($this->input->post('is_ajax')==2) {
			$session = $this->session->userdata('username');
			if(empty($session)){ 
				redirect('admin/');
			}

			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$id = $this->uri->segment(4);
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$result = $this->Location_model->delete_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_success_delete_location');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}
}
