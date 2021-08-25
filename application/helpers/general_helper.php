<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function initialize_elfinder($value=''){
	$CI =& get_instance();
	$CI->load->helper('path');
	$opts = array(
	    //'debug' => true, 
	    'roots' => array(
	      array( 
	        'driver' => 'LocalFileSystem', 
	        'path'   => './uploads/files_manager/', 
	        'URL'    => site_url('uploads/files_manager').'/'
	        // more elFinder options here
	      ) 
	    )
	);
	return $opts;
}


if ( ! function_exists('get_main_companies_chart'))
{
	function get_main_companies_chart() {
		$CI =&	get_instance();
		$sql = "select * from tat_companies";
		$query = $CI->db->query($sql);
		$result = $query->result();
		return $result;
	}
}
if ( ! function_exists('get_main_companies_location_chart'))
{
	function get_main_companies_location_chart($company_id) {
		$CI =&	get_instance();
		$sql = "select * from tat_office_location where company_id = '".$company_id."'";
		$query = $CI->db->query($sql);
		$result = $query->result();
		return $result;
	}
}
if ( ! function_exists('get_location_departments_head_employees'))
{
	function get_location_departments_head_employees($location_id) {
		$CI =&	get_instance();
		$sql = "select * from tat_departments where location_id = '".$location_id."'";
		$query = $CI->db->query($sql);
		$result = $query->result();
		return $result;
	}
}
if ( ! function_exists('get_main_departments_head_employees'))
{
	function get_main_departments_head_employees() {
		$CI =&	get_instance();
		$sql = "select * from tat_departments";
		$query = $CI->db->query($sql);
		$result = $query->result();
		return $result;
	}
}
if ( ! function_exists('get_departments_designations'))
{
	function get_departments_designations($department_id,$employee_id) {
		$CI =&	get_instance();
		$sql = "select d.*,e.* from tat_designations as d, tat_employees as e where d.department_id= '".$department_id."' and d.designation_id = e.designation_id GROUP by d.designation_id";
		$query = $CI->db->query($sql);
		$result = $query->result();
		return $result;
	}
}


if ( ! function_exists('get_sub_departments'))
{
	function get_sub_departments($id) {
		$CI =&	get_instance();
		$sql = "select * from tat_sub_departments where department_id = $id";
		$query = $CI->db->query($sql);
		$result = $query->result();
		return $result;
	}
}

if ( ! function_exists('get_main_departments_employees'))
{
	function get_main_departments_employees() {
		$CI =&	get_instance();
		$sql = "select d.*,e.* from tat_departments as d, tat_employees as e where d.department_id = e.department_id";
		$query = $CI->db->query($sql);
		$result = $query->result();
		return $result;
	}
}

if ( ! function_exists('get_sub_departments_employees'))
{
	function get_sub_departments_employees($id,$empid) {
		$CI =&	get_instance();
		$sql = "select d.*,e.* from tat_sub_departments as d, tat_employees as e where d.sub_department_id = e.sub_department_id and e.department_id = '".$id."' and e.employee_id!= '".$empid."' group by e.sub_department_id";
		$query = $CI->db->query($sql);
		$result = $query->result();
		return $result;
	}
}

if ( ! function_exists('get_sub_departments_designations'))
{
	function get_sub_departments_designations($id,$empid,$mainid) {
		$CI =&	get_instance();
		$sql = "select d.*,e.* from tat_designations as d, tat_employees as e where d.designation_id = e.designation_id and e.employee_id!= '".$empid."' and e.employee_id!= '".$mainid."' and e.designation_id = '".$id."'";
		$query = $CI->db->query($sql);
		$result = $query->result();
		return $result;
	}
}

if ( ! function_exists('total_salaries_paid'))
{
	function total_salaries_paid() {
			$CI =&	get_instance();
			$CI->db->from('tat_salary_payslips');
			$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			$tinc = 0;
			foreach($result as $inc){
				$tinc += $inc->net_salary;
			}
			return $tinc;
		}else{
			return 0;
		}
	}

}

if ( ! function_exists('count_leaves_info'))
{
	function count_leaves_info($leave_type_id,$employee_id) {
			$CI =&	get_instance();
			$CI->db->from('tat_leave_applications');
			$CI->db->where('employee_id',$employee_id);
			$CI->db->where('leave_type_id',$leave_type_id);
			$CI->db->where('status!=',3);
			$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			$tinc = 0;
			foreach($result as $inc){
				$ifrom_date =  $inc->from_date;
				$ito_date =  $inc->to_date;
				$datetime1 = new DateTime($ifrom_date);
				$datetime2 = new DateTime($ito_date);
				$interval = $datetime1->diff($datetime2);
				if(strtotime($inc->from_date) == strtotime($inc->to_date)){
					$tinc +=1;
				} else {
					$tinc += $interval->format('%a') + 1;
				}
				
			}
			return $tinc;
		}else{
			return 0;
		}
	}

}


if ( ! function_exists('active_employees'))
{
	function active_employees() {
		$CI =&	get_instance();
		$CI->db->from('tat_employees');
		$CI->db->where('is_active',1);
		$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}else{
			return 0;
		}
	}
}
if ( ! function_exists('inactive_employees'))
{
	function inactive_employees() {
		$CI =&	get_instance();
		$CI->db->from('tat_employees');
		$CI->db->where('is_active',0);
		$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}else{
			return 0;
		}
	}
}


if ( ! function_exists('total_account_balances'))
{
	function total_account_balances() {
			$CI =&	get_instance();
			$CI->db->from('tat_finance_bankcash');
			$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			$tinc = 0;
			foreach($result as $inc){
				$tinc += $inc->account_balance;
			}
			return $tinc;
		}else{
			return 0;
		}
	}

}

if ( ! function_exists('system_settings_info'))
{
		function system_settings_info($id) {
			$CI =&	get_instance();
			$CI->db->from('tat_system_setting');
			$CI->db->where('setting_id',$id);
			$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		}else{
			return "";
		}
	}

}

if ( ! function_exists('tat_company_info'))
{
		function tat_company_info($id) {
			$CI =&	get_instance();
			$CI->db->from('tat_company_info');
			$CI->db->where('company_info_id',$id);
			$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		}else{
			return "";
		}
	}

}

if ( ! function_exists('read_invoice_record'))
{
		function read_invoice_record($id) {
			$CI =&	get_instance();
			$CI->db->from('tat_tatari_invoices');
			$CI->db->where('invoice_id',$id);
			$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->row();
			return $result;
		}else{
			return "";
		}
	}
}

if ( ! function_exists('get_invoice_transaction_record'))
{
	function get_invoice_transaction_record($id) {
		$CI =&	get_instance();
		$CI->db->from('tat_finance_transaction');
		$CI->db->where('transaction_type','income');
		$CI->db->where('invoice_id',$id);
		$query=$CI->db->get();
		return $query;
	}
}

if ( ! function_exists('system_currency_sign'))
{
	//set currency sign
	function system_currency_sign($number) {
		
		// get details
		$system_setting = system_settings_info(1);
		// currency code/symbol
		if($system_setting->show_currency=='code'){
			$ar_sc = explode(' -',$system_setting->default_currency_symbol);
			$sc_show = $ar_sc[0];
		} else {
			$ar_sc = explode('- ',$system_setting->default_currency_symbol);
			$sc_show = $ar_sc[1];
		}
		if($system_setting->currency_position=='Prefix'){
			$sign_value = $sc_show.''.$number;
		} else {
			$sign_value = $number.''.$sc_show;
		}
		return $sign_value;
	}
}


if ( ! function_exists('get_employee_leave_category'))
{
	function get_employee_leave_category($id_nums,$employee_id) {
		$CI =&	get_instance();
		$sql = "select e.leave_categories,e.user_id,l.leave_type_id,l.days_per_year,l.type_name from tat_employees as e, tat_leave_type as l where l.leave_type_id IN ($id_nums) and e.user_id = $employee_id";
		$query = $CI->db->query($sql);
		$result = $query->result();
		return $result;
	}
}

if ( ! function_exists('employee_leave_halfday_cal'))
{
	function employee_leave_halfday_cal($leave_type_id,$employee_id) {
		$CI =&	get_instance();
		$CI->db->from('tat_leave_applications');
		$CI->db->where('employee_id',$employee_id);
		$CI->db->where('leave_type_id',$leave_type_id);
		$CI->db->where('is_half_day',1);
		$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return $query->result();
		}
	}
}

if ( ! function_exists('last_client_invoice_info'))
{
	function last_client_invoice_info() {
		$CI =&	get_instance();
		$sql = 'SELECT * FROM tat_tatari_invoices order by invoice_id desc limit 1';
		$query = $CI->db->query($sql);		
		if ($query->num_rows() > 0) {
			$inv = $query->result();
			if(!is_null($inv)) {
				return $invid = $inv[0]->invoice_id;
			} else {
				return $invid = 0;
			}
		} else {
			return $invid = 0;
		}
	}
}


if ( ! function_exists('all_invoice_paid_count'))
{
	function all_invoice_paid_count() {
		$CI =&	get_instance();
		$CI->db->from('tat_tatari_invoices');
		$CI->db->where('status',1);
		$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}else{
			return 0;
		}
	}
}

if ( ! function_exists('all_invoice_unpaid_count'))
{
	function all_invoice_unpaid_count() {
		$CI =&	get_instance();
		$CI->db->from('tat_tatari_invoices');
		$CI->db->where('status',0);
		$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}else{
			return 0;
		}
	}
}

if ( ! function_exists('all_invoice_paid_amount'))
{
	function all_invoice_paid_amount() {
		$CI =&	get_instance();
		$CI->db->from('tat_tatari_invoices');
		$CI->db->where('status',1);
		$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			$tinc = 0;
			foreach($result as $inc){
				$tinc += $inc->grand_total;
			}
			return $tinc;
		}else{
			return 0;
		}
	}
}

if ( ! function_exists('all_invoice_unpaid_amount'))
{
	function all_invoice_unpaid_amount() {
		$CI =&	get_instance();
		$CI->db->from('tat_tatari_invoices');
		$CI->db->where('status',0);
		$query=$CI->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result();
			$tinc = 0;
			foreach($result as $inc){
				$tinc += $inc->grand_total;
			}
			return $tinc;
		}else{
			return 0;
		}
	}
}

if ( ! function_exists('get_invoice_transaction_record'))
{
	function get_invoice_transaction_record($id) {
		$CI =&	get_instance();
		$CI->db->from('tat_finance_transaction');
		$CI->db->where('transaction_type','income');
		$CI->db->where('invoice_id',$id);
		$query=$CI->db->get();
		return $query;
	}
}


?>