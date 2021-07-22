<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		//load the models
		$this->load->model("Company_model");
		$this->load->model("Tat_model");
		$this->load->model("Custom_fields_model");
		$this->load->model("Employees_model");
	}
	
	/*Function to set JSON output*/
	public function output($Return=array()){
		/*Set response header*/
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		/*Final JSON response*/
		exit(json_encode($Return));
	}
	
	 public function index()
     {
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('module_company_title').' | '.$this->Tat_model->site_title();
		$data['all_countries'] = $this->Tat_model->get_countries();
		$data['get_company_types'] = $this->Company_model->get_company_types();
		$data['breadcrumbs'] = $this->lang->line('module_company_title');
		$data['path_url'] = 'company';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('5',$role_resources_ids)) {
			$data['subview'] = $this->load->view("admin/company/company", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); //page load
		} else {
			redirect('admin/dashboard');
		}
     }

	 
	 public function company()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/company/company", $data);
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
			$company = $this->Company_model->get_companies();
		} else {
			$company = $this->Company_model->get_company_single($user_info[0]->company_id);
		}
		$data = array();

          foreach($company->result() as $r) {
			  
			  // get country
			  $country = $this->Tat_model->read_country_info($r->country);
			  if(!is_null($country)){
			  	$c_name = $country[0]->country_name;
			  } else {
				  $c_name = '--';	
			  }
			  // get user
			  $user = $this->Tat_model->read_user_info($r->added_by);
			  // user full name
			  if(!is_null($user)){
			  	$full_name = $user[0]->first_name.' '.$user[0]->last_name;
			  } else {
				  $full_name = '--';	
			  }
			  // company type
			  $ctype = $this->Company_model->read_company_type($r->type_id);
			  if(!is_null($ctype)){
			  	$type_name = $ctype[0]->name;
			  } else {
				 $type_name = '--';	
			  }
			  
			  if(in_array('247',$role_resources_ids)) { //edit
				$edit = '<span data-toggle="tooltip" data-placement="top" title="Edit"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-company_id="'. $r->company_id . '"><span class="fa fa-pencil"></span></button></span>';
			} else {
				$edit = '';
			}
			if(in_array('248',$role_resources_ids)) { // delete
				$delete = '<span data-toggle="tooltip" data-placement="top" title="Delete"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->company_id . '"><span class="fa fa-trash"></span></button></span>';
			} else {
				$delete = '';
			}
			if(in_array('249',$role_resources_ids)) { //view
				$view = '<span data-toggle="tooltip" data-placement="top" title="View"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-company_id="'. $r->company_id . '"><span class="fa fa-eye"></span></button></span>';
			} else {
				$view = '';
			}
			$combhr = $edit.$view.$delete;//
			$icname = $r->name.'<br><small class="text-muted"><i>Type: '.$type_name.'<i></i></i></small><br><small class="text-muted"><i>'.$this->lang->line('dashboard_contact').'#: '.$r->contact_number.'<i></i></i></small><br><small class="text-muted"><i>Website: '.$r->website_url.'<i></i></i></small>';
		   $data[] = array(
				$combhr,
				$icname,
				$r->email,
				$r->city,
				$c_name,
				$full_name
		   );
          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $company->num_rows(),
                 "recordsFiltered" => $company->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }
	 

	 public function read() {
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('company_id');
       // $data['all_countries'] = $this->tat_model->get_countries();
		$result = $this->Company_model->read_company_information($id);
		$data = array(
				'company_id' => $result[0]->company_id,
				'name' => $result[0]->name,
				'username' => $result[0]->username,
				'password' => $result[0]->password,
				'type_id' => $result[0]->type_id,
				'government_tax' => $result[0]->government_tax,
				'trading_name' => $result[0]->trading_name,
				'registration_no' => $result[0]->registration_no,
				'email' => $result[0]->email,
				'logo' => $result[0]->logo,
				'contact_number' => $result[0]->contact_number,
				'website_url' => $result[0]->website_url,
				'address_1' => $result[0]->address_1,
				'address_2' => $result[0]->address_2,
				'city' => $result[0]->city,
				'state' => $result[0]->state,
				'zipcode' => $result[0]->zipcode,
				'countryid' => $result[0]->country,
				'all_countries' => $this->Tat_model->get_countries(),
				'get_company_types' => $this->Company_model->get_company_types()
				);
		$this->load->view('admin/company/company_modal', $data);
	}
	
	
	public function read_info()
	{
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}               
		$data['title'] = $this->Tat_model->site_title();
		$id = $this->input->get('company_id');
       // $data['all_countries'] = $this->tat_model->get_countries();
		$result = $this->Company_model->read_company_information($id);
		$data = array(
				'company_id' => $result[0]->company_id,
				'name' => $result[0]->name,
				'username' => $result[0]->username,
				'password' => $result[0]->password,
				'type_id' => $result[0]->type_id,
				'government_tax' => $result[0]->government_tax,
				'trading_name' => $result[0]->trading_name,
				'registration_no' => $result[0]->registration_no,
				'email' => $result[0]->email,
				'logo' => $result[0]->logo,
				'contact_number' => $result[0]->contact_number,
				'website_url' => $result[0]->website_url,
				'address_1' => $result[0]->address_1,
				'address_2' => $result[0]->address_2,
				'city' => $result[0]->city,
				'state' => $result[0]->state,
				'zipcode' => $result[0]->zipcode,
				'countryid' => $result[0]->country,
				'all_countries' => $this->Tat_model->get_countries(),
				'get_company_types' => $this->Company_model->get_company_types()
				);
		$this->load->view('admin/company/view_company.php', $data);
	}
	
	// Validate and add info in database
	public function add_company() {
	
		if($this->input->post('add_type')=='company') {
		// Check validation for user input
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('website', 'Website', 'trim|required|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
		
		$name = $this->input->post('name');
		$trading_name = $this->input->post('trading_name');
		$registration_no = $this->input->post('registration_no');
		$email = $this->input->post('email');
		$contact_number = $this->input->post('contact_number');
		$website = $this->input->post('website');
		$address_1 = $this->input->post('address_1');
		$address_2 = $this->input->post('address_2');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$zipcode = $this->input->post('zipcode');
		$country = $this->input->post('country');
		$user_id = $this->input->post('user_id');
		$file = $_FILES['logo']['tmp_name'];
		
		/* Define return | here result is used to return user data and error for error message */
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		/* Server side PHP input validation */
		if($name==='') {
			$Return['error'] = $this->lang->line('tat_error_name_field');
		} else if( $this->input->post('company_type')==='') {
			$Return['error'] = $this->lang->line('tat_error_ctype_field');
		} else if($contact_number==='') {
			$Return['error'] = $this->lang->line('tat_error_contact_field');
		} else if($email==='') {
			$Return['error'] = $this->lang->line('tat_error_cemail_field');
		} else if($website==='') {
			$Return['error'] = $this->lang->line('tat_error_website_field');
		}  else if($city==='') {
			$Return['error'] = $this->lang->line('tat_error_city_field');
		} else if($zipcode==='') {
			$Return['error'] = $this->lang->line('tat_error_zipcode_field');
		} else if($country==='') {
			$Return['error'] = $this->lang->line('tat_error_country_field');
		} else if($this->input->post('username')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_username');
		} else if($this->input->post('password')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_password');
		}
		
		/* Check if file uploaded..*/
		else if($_FILES['logo']['size'] == 0) {
			$fname = 'no file';
			 $Return['error'] = $this->lang->line('tat_error_logo_field');
		} else {
			if(is_uploaded_file($_FILES['logo']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','gif');
				$filename = $_FILES['logo']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["logo"]["tmp_name"];
					$bill_copy = "uploads/company/";
					// basename() may prevent filesystem traversal attacks;
					// further validation/sanitation of the filename may be appropriate
					$lname = basename($_FILES["logo"]["name"]);
					$newfilename = 'logo_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $bill_copy.$newfilename);
					$fname = $newfilename;
				} else {
					$Return['error'] = $this->lang->line('tat_error_attatchment_type');
				}
			}
		}
		
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		$module_attributes = $this->Custom_fields_model->company_tatari_module_attributes();
		$count_module_attributes = $this->Custom_fields_model->count_company_module_attributes();	
		$i=1;
		if($count_module_attributes > 0){
			 foreach($module_attributes as $mattribute) {
				 if($mattribute->validation == 1){
					 if($i!=1) {
					 } else if($this->input->post($mattribute->attribute)=='') {
						$Return['error'] = $this->lang->line('tat_tatari_custom_field_the').' '.$mattribute->attribute_label.' '.$this->lang->line('tat_tatari_custom_field_is_required');
					}
				 }
			 }		
			 if($Return['error']!=''){
				$this->output($Return);
			}	
		}
		$data = array(
		'name' => $this->input->post('name'),
		'type_id' => $this->input->post('company_type'),
		'username' => $this->input->post('username'),
		'password' => $this->input->post('password'),
		'government_tax' => $this->input->post('tat_gtax'),
		'trading_name' => $this->input->post('trading_name'),
		'registration_no' => $this->input->post('registration_no'),
		'email' => $this->input->post('email'),
		'contact_number' => $this->input->post('contact_number'),
		'website_url' => $this->input->post('website'),
		'address_1' => $this->input->post('address_1'),
		'address_2' => $this->input->post('address_2'),
		'city' => $this->input->post('city'),
		'state' => $this->input->post('state'),
		'zipcode' => $this->input->post('zipcode'),
		'country' => $this->input->post('country'),
		'added_by' => $this->input->post('user_id'),
		'logo' => $fname,
		'created_at' => date('d-m-Y'),
		
		);
		$iresult = $this->Company_model->add($data);
		if ($iresult) {
			$Return['result'] = $this->lang->line('tat_success_add_company');
			$id = $iresult;
			if($count_module_attributes > 0){
				foreach($module_attributes as $mattribute) {

					if($mattribute->attribute_type == 'fileupload'){
						if($_FILES[$mattribute->attribute]['size'] != 0) {
							if(is_uploaded_file($_FILES[$mattribute->attribute]['tmp_name'])) {
							//checking image type
								$allowed =  array('png','jpg','jpeg','pdf','gif','xls','doc','xlsx','docx');
								$filename = $_FILES[$mattribute->attribute]['name'];
								$ext = pathinfo($filename, PATHINFO_EXTENSION);
								
								if(in_array($ext,$allowed)){
									$tmp_name = $_FILES[$mattribute->attribute]["tmp_name"];
									$profile = "uploads/custom_files/";
									$set_img = base_url()."uploads/custom_files/";

									$name = basename($_FILES[$mattribute->attribute]["name"]);
									$newfilename = 'custom_file_'.round(microtime(true)).'.'.$ext;
									move_uploaded_file($tmp_name, $profile.$newfilename);
									$fname = $newfilename;	
								}
								$iattr_data = array(
									'user_id' => $id,
									'module_attributes_id' => $mattribute->custom_field_id,
									'attribute_value' => $fname,
									'created_at' => date('Y-m-d h:i:s')
								);
								$this->Custom_fields_model->add_values($iattr_data);
							}
						} else {
							$iattr_data = array(
									'user_id' => $id,
									'module_attributes_id' => $mattribute->custom_field_id,
									'attribute_value' => '',
									'created_at' => date('Y-m-d h:i:s')
								);
								$this->Custom_fields_model->add_values($iattr_data);
						}
					} else if($mattribute->attribute_type == 'multiselect') {
						$multisel_val = $this->input->post($mattribute->attribute);
						if(!empty($multisel_val)){
							$newdata = implode(',', $this->input->post($mattribute->attribute));
							$iattr_data = array(
								'user_id' => $id,
								'module_attributes_id' => $mattribute->custom_field_id,
								'attribute_value' => $newdata,
								'created_at' => date('Y-m-d h:i:s')
							);
							$this->Custom_fields_model->add_values($iattr_data);
						}
					} else {
							if($this->input->post($mattribute->attribute) == ''){
								$file_val = '';
							} else {
								$file_val = $this->input->post($mattribute->attribute);
							}
							$iattr_data = array(
								'user_id' => $id,
								'module_attributes_id' => $mattribute->custom_field_id,
								'attribute_value' => $file_val,
								'created_at' => date('Y-m-d h:i:s')
							);
						$this->Custom_fields_model->add_values($iattr_data);
					}

				 }
			}
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	

	public function update() {
	
		if($this->input->post('edit_type')=='company') {
		$id = $this->uri->segment(4);
		// Check validation for user input
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('website', 'Website', 'trim|required|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
		$name = $this->input->post('name');
		$trading_name = $this->input->post('trading_name');
		$registration_no = $this->input->post('registration_no');
		$email = $this->input->post('email');
		$contact_number = $this->input->post('contact_number');
		$website = $this->input->post('website');
		$address_1 = $this->input->post('address_1');
		$address_2 = $this->input->post('address_2');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$zipcode = $this->input->post('zipcode');
		$country = $this->input->post('country');
		$user_id = $this->input->post('user_id');
		$file = $_FILES['logo']['tmp_name'];
				

		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		/* Server side PHP input validation */
		if($name==='') {
			$Return['error'] = $this->lang->line('tat_error_name_field');
		} else if( $this->input->post('company_type')==='') {
			$Return['error'] = $this->lang->line('tat_error_ctype_field');
		} else if($contact_number==='') {
			$Return['error'] = $this->lang->line('tat_error_contact_field');
		} else if($email==='') {
			$Return['error'] = $this->lang->line('tat_error_cemail_field');
		} else if($website==='') {
			$Return['error'] = $this->lang->line('tat_error_website_field');
		} else if($city==='') {
			$Return['error'] = $this->lang->line('tat_error_city_field');
		} else if($zipcode==='') {
			$Return['error'] = $this->lang->line('tat_error_zipcode_field');
		} else if($country==='') {
			$Return['error'] = $this->lang->line('tat_error_country_field');
		} else if($this->input->post('username')==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_username');
		}
		
		/* Check if file uploaded..*/
		else if($_FILES['logo']['size'] == 0) {
			 $fname = 'no file';
			 $module_attributes = $this->Custom_fields_model->company_tatari_module_attributes();
			$count_module_attributes = $this->Custom_fields_model->count_company_module_attributes();	
			$i=1;
			if($count_module_attributes > 0){
				 foreach($module_attributes as $mattribute) {
					 if($mattribute->validation == 1){
						 if($i!=1) {
						 } else if($this->input->post($mattribute->attribute)=='') {
							$Return['error'] = $this->lang->line('tat_tatari_custom_field_the').' '.$mattribute->attribute_label.' '.$this->lang->line('tat_tatari_custom_field_is_required');
						}
					 }
				 }		
				 if($Return['error']!=''){
					$this->output($Return);
				}	
			}
			 $no_logo_data = array(
			'name' => $this->input->post('name'),
			'type_id' => $this->input->post('company_type'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'government_tax' => $this->input->post('tat_gtax'),
			'trading_name' => $this->input->post('trading_name'),
			'registration_no' => $this->input->post('registration_no'),
			'email' => $this->input->post('email'),
			'contact_number' => $this->input->post('contact_number'),
			'website_url' => $this->input->post('website'),
			'address_1' => $this->input->post('address_1'),
			'address_2' => $this->input->post('address_2'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zipcode' => $this->input->post('zipcode'),
			'country' => $this->input->post('country'),
			);
			 $result = $this->Company_model->update_record_no_logo($no_logo_data,$id);
			 if($count_module_attributes > 0){
			foreach($module_attributes as $mattribute) {
				
				//
				$count_exist_values = $this->Custom_fields_model->count_module_attributes_values($id,$mattribute->custom_field_id);
				if($count_exist_values > 0){
					if($mattribute->attribute_type == 'fileupload'){
						if($_FILES[$mattribute->attribute]['size'] != 0) {
							if(is_uploaded_file($_FILES[$mattribute->attribute]['tmp_name'])) {
							//checking image type
								$allowed =  array('png','jpg','jpeg','pdf','gif','xls','doc','xlsx','docx');
								$filename = $_FILES[$mattribute->attribute]['name'];
								$ext = pathinfo($filename, PATHINFO_EXTENSION);
								
								if(in_array($ext,$allowed)){
									$tmp_name = $_FILES[$mattribute->attribute]["tmp_name"];
									$profile = "uploads/custom_files/";
									$set_img = base_url()."uploads/custom_files/";
									// basename() may prevent filesystem traversal attacks;
									// further validation/sanitation of the filename may be appropriate
									$name = basename($_FILES[$mattribute->attribute]["name"]);
									$newfilename = 'custom_file_'.round(microtime(true)).'.'.$ext;
									move_uploaded_file($tmp_name, $profile.$newfilename);
									$fname = $newfilename;	
								}
								$iattr_data = array(
									'attribute_value' => $fname
								);
								$this->Custom_fields_model->update_att_record($iattr_data, $id,$mattribute->custom_field_id);
							}
							
						} else {
						}
					} else if($mattribute->attribute_type == 'multiselect') {
						$multisel_val = $this->input->post($mattribute->attribute);
						if(!empty($multisel_val)){
							$newdata = implode(',', $this->input->post($mattribute->attribute));
							$iattr_data = array(
								'attribute_value' => $newdata,
							);
							$this->Custom_fields_model->update_att_record($iattr_data, $id,$mattribute->custom_field_id);
						}
					} else {
						$attr_data = array(
							'attribute_value' => $this->input->post($mattribute->attribute),
						);
						$this->Custom_fields_model->update_att_record($attr_data, $id,$mattribute->custom_field_id);
					}
					
				} else {
					if($mattribute->attribute_type == 'fileupload'){
						if($_FILES[$mattribute->attribute]['size'] != 0) {
							if(is_uploaded_file($_FILES[$mattribute->attribute]['tmp_name'])) {
							//checking image type
								$allowed =  array('png','jpg','jpeg','pdf','gif','xls','doc','xlsx','docx');
								$filename = $_FILES[$mattribute->attribute]['name'];
								$ext = pathinfo($filename, PATHINFO_EXTENSION);
								
								if(in_array($ext,$allowed)){
									$tmp_name = $_FILES[$mattribute->attribute]["tmp_name"];
									$profile = "uploads/custom_files/";
									$set_img = base_url()."uploads/custom_files/";

									$name = basename($_FILES[$mattribute->attribute]["name"]);
									$newfilename = 'custom_file_'.round(microtime(true)).'.'.$ext;
									move_uploaded_file($tmp_name, $profile.$newfilename);
									$fname = $newfilename;	
								}
								$iattr_data = array(
									'user_id' => $id,
									'module_attributes_id' => $mattribute->custom_field_id,
									'attribute_value' => $fname,
									'created_at' => date('Y-m-d h:i:s')
								);
								$this->Custom_fields_model->add_values($iattr_data);
							}
						} else {
							if($this->input->post($mattribute->attribute) == ''){
								$file_val = '';
							} else {
								$file_val = $this->input->post($mattribute->attribute);
							}
							$iattr_data = array(
								'user_id' => $id,
								'module_attributes_id' => $mattribute->custom_field_id,
								'created_at' => date('Y-m-d h:i:s')
							);
							$this->Custom_fields_model->add_values($iattr_data);
						}
					} else if($mattribute->attribute_type == 'multiselect') {
						$multisel_val = $this->input->post($mattribute->attribute);
						if(!empty($multisel_val)){
							$newdata = implode(',', $this->input->post($mattribute->attribute));
							$iattr_data = array(
								'user_id' => $id,
								'module_attributes_id' => $mattribute->custom_field_id,
								'attribute_value' => $newdata,
								'created_at' => date('Y-m-d h:i:s')
							);
							$this->Custom_fields_model->add_values($iattr_data);
						}
					} else {
							if($this->input->post($mattribute->attribute) == ''){
								$file_val = '';
							} else {
								$file_val = $this->input->post($mattribute->attribute);
							}
							$iattr_data = array(
								'user_id' => $id,
								'module_attributes_id' => $mattribute->custom_field_id,
								'attribute_value' => $file_val,
								'created_at' => date('Y-m-d h:i:s')
							);
						$this->Custom_fields_model->add_values($iattr_data);
					}
				}
			 }
		}
		} else {
			$module_attributes = $this->Custom_fields_model->company_tatari_module_attributes();
			$count_module_attributes = $this->Custom_fields_model->count_company_module_attributes();	
			$i=1;
			if($count_module_attributes > 0){
				 foreach($module_attributes as $mattribute) {
					 if($mattribute->validation == 1){
						 if($i!=1) {
						 } else if($this->input->post($mattribute->attribute)=='') {
							$Return['error'] = $this->lang->line('tat_tatari_custom_field_the').' '.$mattribute->attribute_label.' '.$this->lang->line('tat_tatari_custom_field_is_required');
						}
					 }
				 }		
				 if($Return['error']!=''){
					$this->output($Return);
				}	
			}
			if(is_uploaded_file($_FILES['logo']['tmp_name'])) {
				//checking image type
				$allowed =  array('png','jpg','jpeg','gif');
				$filename = $_FILES['logo']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["logo"]["tmp_name"];
					$bill_copy = "uploads/company/";

					$lname = basename($_FILES["logo"]["name"]);
					$newfilename = 'logo_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $bill_copy.$newfilename);
					$fname = $newfilename;
					$data = array(
					'name' => $this->input->post('name'),
					'type_id' => $this->input->post('company_type'),
					'government_tax' => $this->input->post('tat_gtax'),
					'trading_name' => $this->input->post('trading_name'),
					'registration_no' => $this->input->post('registration_no'),
					'email' => $this->input->post('email'),
					'contact_number' => $this->input->post('contact_number'),
					'website_url' => $this->input->post('website'),
					'address_1' => $this->input->post('address_1'),
					'address_2' => $this->input->post('address_2'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'zipcode' => $this->input->post('zipcode'),
					'country' => $this->input->post('country'),
					'logo' => $fname,		
					);
					// update record > model
					$result = $this->Company_model->update_record($data,$id);
					if($count_module_attributes > 0){
						foreach($module_attributes as $mattribute) {
							
							//
							$count_exist_values = $this->Custom_fields_model->count_module_attributes_values($id,$mattribute->custom_field_id);
							if($count_exist_values > 0){
								if($mattribute->attribute_type == 'fileupload'){
									if($_FILES[$mattribute->attribute]['size'] != 0) {
										if(is_uploaded_file($_FILES[$mattribute->attribute]['tmp_name'])) {
										//checking image type
											$allowed =  array('png','jpg','jpeg','pdf','gif','xls','doc','xlsx','docx');
											$filename = $_FILES[$mattribute->attribute]['name'];
											$ext = pathinfo($filename, PATHINFO_EXTENSION);
											
											if(in_array($ext,$allowed)){
												$tmp_name = $_FILES[$mattribute->attribute]["tmp_name"];
												$profile = "uploads/custom_files/";
												$set_img = base_url()."uploads/custom_files/";
											
												$name = basename($_FILES[$mattribute->attribute]["name"]);
												$newfilename = 'custom_file_'.round(microtime(true)).'.'.$ext;
												move_uploaded_file($tmp_name, $profile.$newfilename);
												$fname = $newfilename;	
											}
											$iattr_data = array(
												'attribute_value' => $fname
											);
											$this->Custom_fields_model->update_att_record($iattr_data, $id,$mattribute->custom_field_id);
										}
										
									} else {
									}
								} else if($mattribute->attribute_type == 'multiselect') {
									$multisel_val = $this->input->post($mattribute->attribute);
									if(!empty($multisel_val)){
										$newdata = implode(',', $this->input->post($mattribute->attribute));
										$iattr_data = array(
											'attribute_value' => $newdata,
										);
										$this->Custom_fields_model->update_att_record($iattr_data, $id,$mattribute->custom_field_id);
									}
								} else {
									$attr_data = array(
										'attribute_value' => $this->input->post($mattribute->attribute),
									);
									$this->Custom_fields_model->update_att_record($attr_data, $id,$mattribute->custom_field_id);
								}
								
							} else {
								if($mattribute->attribute_type == 'fileupload'){
									if($_FILES[$mattribute->attribute]['size'] != 0) {
										if(is_uploaded_file($_FILES[$mattribute->attribute]['tmp_name'])) {
										//checking image type
											$allowed =  array('png','jpg','jpeg','pdf','gif','xls','doc','xlsx','docx');
											$filename = $_FILES[$mattribute->attribute]['name'];
											$ext = pathinfo($filename, PATHINFO_EXTENSION);
											
											if(in_array($ext,$allowed)){
												$tmp_name = $_FILES[$mattribute->attribute]["tmp_name"];
												$profile = "uploads/custom_files/";
												$set_img = base_url()."uploads/custom_files/";

												$name = basename($_FILES[$mattribute->attribute]["name"]);
												$newfilename = 'custom_file_'.round(microtime(true)).'.'.$ext;
												move_uploaded_file($tmp_name, $profile.$newfilename);
												$fname = $newfilename;	
											}
											$iattr_data = array(
												'user_id' => $id,
												'module_attributes_id' => $mattribute->custom_field_id,
												'attribute_value' => $fname,
												'created_at' => date('Y-m-d h:i:s')
											);
											$this->Custom_fields_model->add_values($iattr_data);
										}
									} else {
										if($this->input->post($mattribute->attribute) == ''){
											$file_val = '';
										} else {
											$file_val = $this->input->post($mattribute->attribute);
										}
										$iattr_data = array(
											'user_id' => $id,
											'module_attributes_id' => $mattribute->custom_field_id,
											'created_at' => date('Y-m-d h:i:s')
										);
										$this->Custom_fields_model->add_values($iattr_data);
									}
								} else if($mattribute->attribute_type == 'multiselect') {
									$multisel_val = $this->input->post($mattribute->attribute);
									if(!empty($multisel_val)){
										$newdata = implode(',', $this->input->post($mattribute->attribute));
										$iattr_data = array(
											'user_id' => $id,
											'module_attributes_id' => $mattribute->custom_field_id,
											'attribute_value' => $newdata,
											'created_at' => date('Y-m-d h:i:s')
										);
										$this->Custom_fields_model->add_values($iattr_data);
									}
								} else {
										if($this->input->post($mattribute->attribute) == ''){
											$file_val = '';
										} else {
											$file_val = $this->input->post($mattribute->attribute);
										}
										$iattr_data = array(
											'user_id' => $id,
											'module_attributes_id' => $mattribute->custom_field_id,
											'attribute_value' => $file_val,
											'created_at' => date('Y-m-d h:i:s')
										);
									$this->Custom_fields_model->add_values($iattr_data);
								}
							}
						 }
					}
				} else {
					$Return['error'] = $this->lang->line('tat_error_attatchment_type');
				}
			}
		}
		
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_update_company');
		} else {
			$Return['error'] = $Return['error'] = $this->lang->line('tat_error_msg');
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
			$result = $this->Company_model->delete_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_success_delete_company');
			} else {
				$Return['error'] = $Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}
	
}
