<?php

// Custom Fields Controller - to respond and interact with custom fields across system.
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_fields extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->model("Custom_fields_model");
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
		$data['title'] = $this->lang->line('tat_tatari_custom_fields').' | '.$this->Tat_model->site_title();
		$data['all_countries'] = $this->Tat_model->get_countries();
		$data['all_companies'] = $this->Tat_model->get_companies();
		$data['all_employees'] = $this->Tat_model->all_employees();
		$data['breadcrumbs'] = $this->lang->line('tat_tatari_custom_fields');
		$data['path_url'] = 'custom_fields';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('393',$role_resources_ids)) {
			if(!empty($session)){ 
			$data['subview'] = $this->load->view("admin/custom_fields/custom_fields_list", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); //page load
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}
     }
 
   
	public function read_info()
	{
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('custom_field_id');
		$result = $this->Custom_fields_model->read_tatari_module_attributes($id);
		$data = array(
				'custom_field_id' => $result[0]->custom_field_id,
				'attribute' => $result[0]->attribute,
				'attribute_label' => $result[0]->attribute_label,
				'attribute_type' => $result[0]->attribute_type,
				'validation' => $result[0]->validation,
				'module_id' => $result[0]->module_id,
				'priority' => $result[0]->priority
				);
		if(!empty($session)){ 
			$this->load->view('admin/custom_fields/dialog_custom_fields', $data);
		} else {
			redirect('admin/');
		}
	}
	

	public function add_custom_field() {
	
		if($this->input->post('add_type')=='custom_field') {
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			

		if($this->input->post('module_id')==='') {
        	$Return['error'] = $this->lang->line('tat_error_modules_field');
		} else if($this->input->post('attribute')==='') {
        	$Return['error'] = $this->lang->line('tat_error_cat_name_field');
		} else if (!ctype_alnum($this->input->post('attribute'))) {
			$Return['error'] = $this->lang->line('tat_field_name_lowercase_error');
		} else if($this->input->post('attribute_label')==='') {
			$Return['error'] = $this->lang->line('tat_tatari_field_label_error');
		} else if($this->input->post('priority')==='') {
			$Return['error'] = $this->lang->line('tat_tatari_field_priority_error');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'module_id' => $this->input->post('module_id'),
		'attribute' => $this->input->post('attribute'),
		'attribute_label' => $this->input->post('attribute_label'),
		'attribute_type' => $this->input->post('attribute_type'),
		'validation' => $this->input->post('validation'),
		'priority' => $this->input->post('priority'),
		'created_at' => date('d-m-Y'),
		);
		$result = $this->Custom_fields_model->add($data);
		if ($result) {
			foreach($this->input->post('select_value') as $items){
				if($items !=''){
					$select_val = array(
					'custom_field_id' => $result,
					'select_label' => $items,
					);
					$this->Custom_fields_model->add_select_value($select_val);
				}
			}
			$Return['result'] = $this->lang->line('tat_tatari_field_added_success');
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
		if($this->input->post('edit_type')=='custom_field') {
			
		$id = $this->uri->segment(4);
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();

		if($this->input->post('module_id')==='') {
        	$Return['error'] = $this->lang->line('tat_error_modules_field');
		} else if($this->input->post('attribute')==='') {
        	$Return['error'] = $this->lang->line('tat_error_cat_name_field');
		} else if($this->input->post('attribute_label')==='') {
			$Return['error'] = $this->lang->line('tat_tatari_field_label_error');
		} else if($this->input->post('priority')==='') {
			$Return['error'] = $this->lang->line('tat_tatari_field_priority_error');
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'module_id' => $this->input->post('module_id'),
		'attribute_label' => $this->input->post('attribute_label'),
		'validation' => $this->input->post('validation'),
		'priority' => $this->input->post('priority'),	
		);	
		
		$result = $this->Custom_fields_model->update_record($data,$id);		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_tatari_field_updated_success');
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
			$result = $this->Custom_fields_model->delete_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_tatari_field_deleted_success');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}
}
