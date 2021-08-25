<?php

// Expense Controller: Expense management controller working with the expense model.

defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();

		$this->load->model("Expense_model");
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
		$data['title'] = $this->lang->line('tat_expenses').' | '.$this->Tat_model->site_title();
		$data['all_expense_types'] = $this->Expense_model->all_expense_types();
		$data['all_employees'] = $this->Tat_model->all_employees();
		$data['get_all_companies'] = $this->Tat_model->get_companies();
		$data['breadcrumbs'] = $this->lang->line('tat_expenses');
		$data['path_url'] = 'expense';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('10',$role_resources_ids)) {
			$data['subview'] = $this->load->view("admin/expense/expense_list", $data, TRUE);
			$this->load->view('admin/layout/layout_main', $data); 
		} else {
			redirect('admin/dashboard');
		}
     }

    public function read()
     {
     $session = $this->session->userdata('username');
     if(empty($session)){ 
         redirect('admin/');
     }
     $data['title'] = $this->Tat_model->site_title();
     $id = $this->input->get('expense_id');
     $result = $this->Expense_model->read_expense_information($id);
     $data = array(
             'expense_id' => $result[0]->expense_id,
             'employee_id' => $result[0]->employee_id,
             'company_id' => $result[0]->company_id,
             'expense_type_id' => $result[0]->expense_type_id,
             'billcopy_file' => $result[0]->billcopy_file,
             'amount' => $result[0]->amount,
             'purchase_date' => $result[0]->purchase_date,
             'remarks' => $result[0]->remarks,
             'status' => $result[0]->status,
             'all_expense_types' => $this->Expense_model->all_expense_types(),
             'all_employees' => $this->Tat_model->all_employees(),
             'get_all_companies' => $this->Tat_model->get_companies()
             );
     if(!empty($session)){ 
         $this->load->view('admin/expense/dialog_expense', $data);
     } else {
         redirect('admin/');
     }
 }
 
    public function expense_list()
     {

		$data['title'] = $this->Tat_model->site_title();
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/expense/expense_list", $data);
		} else {
			redirect('admin/');
		}
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('389',$role_resources_ids)) {
			$expense = $this->Expense_model->get_employee_expenses();
		} else {
			$expense = $this->Expense_model->get_expenses();
		}
		$data = array();

          foreach($expense->result() as $r) {
			  
			$expense_type = $this->Expense_model->read_expense_type_information($r->expense_type_id);
			if(!is_null($expense_type)){
				$expensen = $expense_type[0]->name;
			} else {
				$expensen = '--';	
			}

			$user = $this->Tat_model->read_user_info($r->employee_id);

			if(!is_null($user)){
				$full_name = $user[0]->first_name.' '.$user[0]->last_name;
			} else {
				$full_name = '--';	
			}

			$edate = $this->Tat_model->set_date_format($r->purchase_date);

			$currency = $this->Tat_model->currency_sign($r->amount);

			$download = '';

			$company = $this->Tat_model->read_company_info($r->company_id);
			if(!is_null($company)){
				$comp_name = $company[0]->name;
			} else {
				$comp_name = '--';	
			}
			  
			if($r->status==0): $status = '<span class="badge bg-orange">'.$this->lang->line('tat_pending').'</span>';
			elseif($r->status==1): $status = '<span class="badge bg-green">'.$this->lang->line('tat_approved').'</span>';else: $status = '<span class="badge bg-red">'.$this->lang->line('tat_cancel').'</span>'; endif;
			
			
				if(in_array('311',$role_resources_ids)) { 
					$edit = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_edit').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-expense_id="'. $r->expense_id . '"><span class="fa fa-pencil"></span></button></span>';
				} else {
					$edit = '';
				}
				if(in_array('312',$role_resources_ids)) { 
					$delete = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->expense_id . '"><span class="fa fa-trash"></span></button></span>';
				} else {
					$delete = '';
				}
				if(in_array('313',$role_resources_ids)) { 
					$view = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_view').'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-expense_id="'. $r->expense_id . '"><span class="fa fa-eye"></span></button></span>';
				} else {
					$view = '';
				}
				if(in_array('314',$role_resources_ids)) { 
					if($r->billcopy_file!='' && $r->billcopy_file!='no file') {
						$download = '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_download').'"><a href="download?type=expense&filename='.$r->billcopy_file.'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light" title="'.$this->lang->line('tat_download').'"><span class="fa fa-download"></span></button></a></span>';
					} else {
						$download = '';
					}
				} else {
					$download = '';
				}
				$combhr = $edit.$download.$view.$delete;
				$iexpensen = $expensen.'<br><small class="text-muted"><i>'.$this->lang->line('tat_purchased_by').': '.$full_name.'<i></i></i></small><br><small class="text-muted"><i>'.$status.'<i></i></i></small>';
               $data[] = array(
			   		$combhr,
					$iexpensen,
					$comp_name,                    
                    $currency,
                    $edate,
               );
          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $expense->num_rows(),
                 "recordsFiltered" => $expense->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }

	
	//Insert Expense records 

	public function add_expense() {
	
		if($this->input->post('add_type')=='expense') {
	
		$file = $_FILES['bill_copy']['tmp_name'];
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		$remarks = $this->input->post('remarks');
		$qt_remarks = htmlspecialchars(addslashes($remarks), ENT_QUOTES);	

		if($this->input->post('expense_type')==='') {
        	$Return['error'] = $this->lang->line('tat_error_expense_type');
		} else if($this->input->post('purchase_date')==='') {
			$Return['error'] = $this->lang->line('tat_error_purchase_date');
		} else if($this->input->post('amount')==='') {
			$Return['error'] = $this->lang->line('tat_error_expense_amount');
		} else if($this->input->post('company_id')==='') {
			$Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('employee_id')==='') {
			$Return['error'] = $this->lang->line('tat_error_employee_id');
		} 
		
		else if($_FILES['bill_copy']['size'] == 0) {
			$fname = 'no file';
		} else {
			if(is_uploaded_file($_FILES['bill_copy']['tmp_name'])) {

				$allowed =  array('png','jpg','jpeg','gif');
				$filename = $_FILES['bill_copy']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["bill_copy"]["tmp_name"];
					$bill_copy = "uploads/expense/";
	
					$lname = basename($_FILES["bill_copy"]["name"]);
					$newfilename = 'bill_copy_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $bill_copy.$newfilename);
					$fname = $newfilename;
				} else {
					$Return['error'] = $this->lang->line('tat_error_expense_file_type');
				}
			}
		}
		
		if($Return['error']!=''){
       		$this->output($Return);
    	}
	
		$data = array(
		'expense_type_id' => $this->input->post('expense_type'),
		'company_id' => $this->input->post('company_id'),
		'purchase_date' => $this->input->post('purchase_date'),
		'amount' => $this->input->post('amount'),
		'employee_id' => $this->input->post('employee_id'),
		'billcopy_file' => $fname,
		'remarks' => $qt_remarks,
		'created_at' => date('d-m-Y'),
		);

		$result = $this->Expense_model->add($data);
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_add_expense');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}
	
    // Update Expense Records
	
	public function update() {
	
		if($this->input->post('edit_type')=='expense') {
		$id = $this->uri->segment(4);

		$file = $_FILES['bill_copy']['tmp_name'];
		
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
			
		$remarks = $this->input->post('remarks');
		$qt_remarks = htmlspecialchars(addslashes($remarks), ENT_QUOTES);		
		
		$no_logo_data = array(
		'expense_type_id' => $this->input->post('expense_type'),
		'purchase_date' => $this->input->post('purchase_date'),
		'company_id' => $this->input->post('company_id'),
		'amount' => $this->input->post('amount'),
		'employee_id' => $this->input->post('employee_id'),
		'status' => $this->input->post('status'),
		'remarks' => $qt_remarks,
		);
			

		if($this->input->post('expense_type')==='') {
        	$Return['error'] = $this->lang->line('tat_error_expense_type');
		} else if($this->input->post('purchase_date')==='') {
			$Return['error'] = $this->lang->line('tat_error_purchase_date');
		} else if($this->input->post('amount')==='') {
			$Return['error'] = $this->lang->line('tat_error_expense_amount');
		} else if($this->input->post('company_id')==='') {
			$Return['error'] = $this->lang->line('error_company_field');
		} else if($this->input->post('employee_id')==='') {
			$Return['error'] = $this->lang->line('tat_error_employee_id');
		}  
		

		else if($_FILES['bill_copy']['size'] == 0) {
			$fname = 'no file';
			 $result = $this->Expense_model->update_record_no_logo($no_logo_data,$id);
		} else {
			if(is_uploaded_file($_FILES['bill_copy']['tmp_name'])) {
			
				$allowed =  array('png','jpg','jpeg','gif');
				$filename = $_FILES['bill_copy']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
				if(in_array($ext,$allowed)){
					$tmp_name = $_FILES["bill_copy"]["tmp_name"];
					$bill_copy = "uploads/expense/";

					$lname = basename($_FILES["bill_copy"]["name"]);
					$newfilename = 'bill_copy_'.round(microtime(true)).'.'.$ext;
					move_uploaded_file($tmp_name, $bill_copy.$newfilename);
					$fname = $newfilename;
					$data = array(
					'expense_type_id' => $this->input->post('expense_type'),
					'purchase_date' => $this->input->post('purchase_date'),
					'amount' => $this->input->post('amount'),
					'company_id' => $this->input->post('company_id'),
					'employee_id' => $this->input->post('employee_id'),
					'status' => $this->input->post('status'),
					'billcopy_file' => $fname,
					'remarks' => $qt_remarks,		
					);

					$result = $this->Expense_model->update_record($data,$id);
				} else {
					$Return['error'] = $this->lang->line('tat_error_expense_file_type');
				}
			}
		}
				
		if($Return['error']!=''){
       		$this->output($Return);
    	}
		
		if ($result == TRUE) {
			$Return['result'] = $this->lang->line('tat_success_update_expense');
		} else {
			$Return['error'] = $this->lang->line('tat_error_msg');
		}
		$this->output($Return);
		exit;
		}
	}

    // Delete expense records
	
	public function delete() {
		
		if($this->input->post('is_ajax')==2) {
			$session = $this->session->userdata('username');
			if(empty($session)){ 
				redirect('admin/');
			}
	
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			$id = $this->uri->segment(4);
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			$result = $this->Expense_model->delete_record($id);
			if(isset($id)) {
				$Return['result'] = $this->lang->line('tat_success_delete_expense');
			} else {
				$Return['error'] = $this->lang->line('tat_error_msg');
			}
			$this->output($Return);
		}
	}


    // Auxilary Functions

    public function get_employees() {

		$data['title'] = $this->Tat_model->site_title();
		$id = $this->uri->segment(4);
		
		$data = array(
			'company_id' => $id
			);
		$session = $this->session->userdata('username');
		if(!empty($session)){ 
			$this->load->view("admin/expense/get_employees", $data);
		} else {
			redirect('admin/');
		}
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
	 }

}
