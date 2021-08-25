<?php
	// Tat Model -  main Tatari model for overall base operations HR & Finance
	class Tat_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    public function is_logged_in($id)
	{
		$CI =& get_instance();
		$is_logged_in = $CI->session->userdata($id);
		return $is_logged_in;       
	}
	
	 public function read_location_info($id) {
	
		$sql = 'SELECT * FROM tat_office_location WHERE location_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


    public function get_department_employees($to_id) {
		
		$sql = 'SELECT * FROM tat_employees WHERE department_id = ? and user_role_id!=1';
		$binds = array($to_id);
		$query = $this->db->query($sql, $binds); 
		return $query->result();
	}
	

	public function get_company_department_employees($to_id) {
		
		$sql = 'SELECT * FROM tat_departments WHERE company_id = ?';
		$binds = array($to_id);
		$query = $this->db->query($sql, $binds); 
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


	public function get_content_animate(){
		$val = 'animated fadeInRight';
		return $val;
	}
	
	public function read_employee_info_att($id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE user_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_company_employees($company_id) {
		
		$sql = 'SELECT * FROM tat_employees WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds); 
		return $query;
	}


	public function all_active_departments_employees()
	{
	 	$session = $this->session->userdata('username');
		$euser_info = $this->read_user_info($session['user_id']);
		$sql = 'SELECT * FROM tat_employees WHERE is_active = ? and department_id = ?';
		$binds = array(1,$euser_info[0]->department_id);
		$query = $this->db->query($sql, $binds);
  	  	return $query->result();
	}
		
	public function generate_random_string($length = 7) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function get_countries()
	{
	  $query = $this->db->query("SELECT * from tat_countries");
  	  return $query->result();
	}
	
	public function read_user_info_byemail($email) {
	
		$sql = 'SELECT * FROM tat_employees WHERE email = ?';
		$binds = array($email);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}

	public function read_user_jobs_byemail($email) {
	
		$sql = 'SELECT * FROM tat_users WHERE email = ?';
		$binds = array($email);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	public function read_employee_info($id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE user_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
		
	}	
	
	public function read_employee_info_byemail($email) {
	
		$sql = 'SELECT * FROM tat_employees WHERE email = ?';
		$binds = array($email);
		$query = $this->db->query($sql, $binds);

		return $query;
	}

    public function read_designation_info($id) {
	
		$sql = 'SELECT * FROM tat_designations WHERE designation_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function read_low_designations($id) {
	
		$sql = 'SELECT * FROM tat_designations WHERE designation_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
  	 	return $query->result();
	}
		
	public function read_top_designations($id) {
	
		$sql = 'SELECT * FROM tat_designations WHERE top_designation_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
  	 	return $query->result();
	}
	
	
	public function read_dep_designations($id) {
	
		$sql = 'SELECT * FROM tat_designations WHERE department_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
  	 	return $query->result();
	}
	
		
	public function read_designation_employees($id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE designation_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
  	 	return $query->result();
	}
	
	public function all_employees_status()
	{
	  $query = $this->db->query("SELECT * from tat_employees");
  	  return $query;
	}
	
	public function all_employees()
	{
	  $query = $this->db->query("SELECT * from tat_employees where user_role_id!=1");
  	  return $query->result();
	}
	
	
	public function all_active_employees()
	{
	 	$sql = 'SELECT * FROM tat_employees WHERE is_active = ?';
		$binds = array(1);
		$query = $this->db->query($sql, $binds);
  	  	return $query->result();
	}
	

	public function male_employees()
	{
		$sql = 'SELECT * FROM tat_employees WHERE gender = ?';
		$binds = array('Male');
		$query = $this->db->query($sql, $binds);
		
		$male_emp = $query->num_rows();
		$stquery = $this->all_employees_status();
		$st_total = $stquery->num_rows();
		if($male_emp==0) {
			return $male_employees = 0;
		} else {
		
			$rd_emp = round($male_emp / ($st_total / 100),2);
			return $rd_emp;
		}
	}

	public function female_employees()
	{
		$sql = 'SELECT * FROM tat_employees WHERE gender = ?';
		$binds = array('Female');
		$query = $this->db->query($sql, $binds);
		$female_emp = $query->num_rows();
		$stquery = $this->all_employees_status();
		$st_total = $stquery->num_rows();
	
		if($female_emp==0) {
			return $female_employees = 0;
		} else {
			$rd_emp = round($female_emp / ($st_total / 100),2);
			return $rd_emp;
		}
	}

	public function all_languages()
	{
	     $sql = 'SELECT * FROM tat_languages WHERE is_active = ? order by language_name asc';
		 $binds = array(1);
		 $query = $this->db->query($sql, $binds); 
		 
  	  	  return $query->result();
	}
	

	public function all_head_count_chart()
	{
	  $query = $this->db->query("SELECT * from tat_employees group by created_at");
  	  return $query->result();
	}

	public function get_language_info($code) {
	
		$sql = 'SELECT * FROM tat_languages WHERE language_code = ?';
		$binds = array($code);
		$query = $this->db->query($sql, $binds); 
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


	public function last_four_employees()
	{
	  $query = $this->db->query("SELECT * from tat_employees order by user_id desc limit 4");
  	  return $query->result();
	}
	

	public function get_all_departments() {
	  $query = $this->db->get("tat_departments");
	  return $query->num_rows();
	}
	

	public function get_all_users() {
	  $query = $this->db->get("tat_users");
	  return $query->num_rows();
	}
	
	public function get_all_locations() {
	  $query = $this->db->get("tat_office_location");
	  return $query->num_rows();
	}
	
	public function get_all_companies() {
	  $query = $this->db->get("tat_companies");
	  return $query->num_rows();
	}

	public function read_setting_info($id) {
	
		$sql = 'SELECT * FROM tat_system_setting WHERE setting_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function read_company_setting_info($id) {
	
		$sql = 'SELECT * FROM tat_company_info WHERE company_info_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function login_update_record($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function read_user_info($id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE user_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function site_title() {
		$system = $this->read_setting_info(1);
		return $system[0]->application_name;
	}

	public function read_theme_info($id) {
	
		$sql = 'SELECT * FROM tat_theme_settings WHERE theme_settings_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function system_layout() {
	
		$system = $this->read_setting_info(1);
		
		if($system[0]->compact_sidebar!=''){
			$compact_sidebar = 'compact-sidebar';
		} else {
			$compact_sidebar = '';
		}
		if($system[0]->fixed_header!=''){
			$fixed_header = 'fixed-header';
		} else {
			$fixed_header = '';
		}
		if($system[0]->fixed_sidebar!=''){
			$fixed_sidebar = 'fixed-sidebar';
		} else {
			$fixed_sidebar = '';
		}
		if($system[0]->boxed_wrapper!=''){
			$boxed_wrapper = 'boxed-wrapper';
		} else {
			$boxed_wrapper = '';
		}
		if($system[0]->layout_static!=''){
			$static = 'static';
		} else {
			$static = '';
		}
		return $layout = $compact_sidebar.' '.$fixed_header.' '.$fixed_sidebar.' '.$boxed_wrapper.' '.$static;
	}

	public function read_user_role_info($id) {
	
		$sql = 'SELECT * FROM tat_user_roles WHERE role_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function user_role_resource(){

		$session = $this->session->userdata('username');

		$user = $this->read_user_info($session['user_id']);
		$role_user = $this->read_user_role_info($user[0]->user_role_id);
		
		$role_resources_ids = explode(',',$role_user[0]->role_resources);
		return $role_resources_ids;
	}

	public function get_companies()
	{
	  $query = $this->db->query("SELECT * from tat_companies");
  	  return $query->result();
	}
	

	public function read_company_info($id) {
	
		$sql = 'SELECT * FROM tat_companies WHERE company_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);		
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function all_locations()
	{
	  $query = $this->db->query("SELECT * from tat_office_location");
  	  return $query->result();
	}

	public function set_date_format($date) {
		
	
		$system_setting = $this->read_setting_info(1);
	
		if($system_setting[0]->date_format_xi=='d-m-Y'){
			$d_format = date("d-m-Y", strtotime($date));
		} else if($system_setting[0]->date_format_xi=='m-d-Y'){
			$d_format = date("m-d-Y", strtotime($date));
		} else if($system_setting[0]->date_format_xi=='d-M-Y'){
			$d_format = date("d-M-Y", strtotime($date));
		} else if($system_setting[0]->date_format_xi=='M-d-Y'){
			$d_format = date("M-d-Y", strtotime($date));
		} else if($system_setting[0]->date_format_xi=='F-j-Y'){
			$d_format = date("F-j-Y", strtotime($date));
		} else if($system_setting[0]->date_format_xi=='j-F-Y'){
			$d_format = date("j-F-Y", strtotime($date));
		} else if($system_setting[0]->date_format_xi=='m.d.y'){
			$d_format = date("m.d.y", strtotime($date));
		} else if($system_setting[0]->date_format_xi=='d.m.y'){
			$d_format = date("d.m.y", strtotime($date));
		} else {
			$d_format = $system_setting[0]->date_format_xi;
		}
		
		return $d_format;
	}


	public function currency_sign($number) {
		
		$system_setting = $this->read_setting_info(1);
		$default_locale = 'en_US';
		setlocale(LC_MONETARY, $default_locale);
		
		if($system_setting[0]->show_currency=='code'){
			$ar_sc = explode(' -',$system_setting[0]->default_currency_symbol);
			$sc_show = $ar_sc[0];
		} else {
			$ar_sc = explode('- ',$system_setting[0]->default_currency_symbol);
			$sc_show = $ar_sc[1];
		}
		if($system_setting[0]->currency_position=='Prefix'){
			$number = $this->money_format('%i', $number);
			$sign_value = $sc_show.' '.$number;
		} else {
			$number = $this->money_format('%i', $number);
			$sign_value = $number.' '.$sc_show;
		}
		
		return $sign_value;
	}

	public function money_format($format, $number) 
	{ 
		$regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'. 
				  '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/'; 
		if (setlocale(LC_MONETARY, 0) == 'C') { 
			setlocale(LC_MONETARY, ''); 
		} 
		$locale = localeconv(); 
		preg_match_all($regex, $format, $matches, PREG_SET_ORDER); 
		foreach ($matches as $fmatch) { 
			$value = floatval($number); 
			$flags = array( 
				'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ? 
							   $match[1] : ' ', 
				'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0, 
				'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ? 
							   $match[0] : '+', 
				'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0, 
				'isleft'    => preg_match('/\-/', $fmatch[1]) > 0 
			); 
			$width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0; 
			$left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0; 
			$right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits']; 
			$conversion = $fmatch[5]; 
	
			$positive = true; 
			if ($value < 0) { 
				$positive = false; 
				$value  *= -1; 
			} 
			$letter = $positive ? 'p' : 'n'; 
	
			$prefix = $suffix = $cprefix = $csuffix = $signal = ''; 
	
			$signal = $positive ? $locale['positive_sign'] : $locale['negative_sign']; 
			switch (true) { 
				case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+': 
					$prefix = $signal; 
					break; 
				case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+': 
					$suffix = $signal; 
					break; 
				case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+': 
					$cprefix = $signal; 
					break; 
				case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+': 
					$csuffix = $signal; 
					break; 
				case $flags['usesignal'] == '(': 
				case $locale["{$letter}_sign_posn"] == 0: 
					$prefix = '('; 
					$suffix = ')'; 
					break; 
			} 
			if (!$flags['nosimbol']) { 
				$currency = $cprefix . 
							($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) . 
							$csuffix; 
			} else { 
				$currency = ''; 
			} 
			$space  = $locale["{$letter}_sep_by_space"] ? ' ' : ''; 
	
			$value = number_format($value, $right, $locale['mon_decimal_point'], 
					 $flags['nogroup'] ? '' : $locale['mon_thousands_sep']); 
			$value = @explode($locale['mon_decimal_point'], $value); 
	
			$n = strlen($prefix) + strlen($currency) + strlen($value[0]); 
			if ($left > 0 && $left > $n) { 
				$value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0]; 
			} 
			$value = @implode($locale['mon_decimal_point'], $value); 
			if ($locale["{$letter}_cs_precedes"]) { 
				$value = $value; 
			} else { 
				$value = $value; 
			} 
			if ($width > 0) { 
				$value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ? 
						 STR_PAD_RIGHT : STR_PAD_LEFT); 
			} 
	
			$format = str_replace($fmatch[0], $value, $format); 
		} 
		return $format; 
	}

	public function set_date_format_js() {
		
		$system_setting = $this->read_setting_info(1);
		if($system_setting[0]->date_format_xi=='d-m-Y'){
			$d_format = 'dd-mm-yy';
		} else if($system_setting[0]->date_format_xi=='m-d-Y'){
			$d_format = 'mm-dd-yy';
		} else if($system_setting[0]->date_format_xi=='d-M-Y'){
			$d_format = 'dd-M-yy';
		} else if($system_setting[0]->date_format_xi=='M-d-Y'){
			$d_format = 'M-dd-yy';;
		}
		
		return $d_format;
	}

	public function read_country_info($id) {
		$sql = 'SELECT * FROM tat_countries WHERE country_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


	public function select_module_class($mClass,$mMethod) {
		$arr = array();
		if($mClass=='dashboard') {
			$arr['active'] = 'active';
			$arr['open'] = '';
			return $arr;
		} else if($mClass=='department' && $mMethod=='sub_departments') {
			$arr['sub_departments_active'] = 'active';
			$arr['adm_open'] = 'active';
			return $arr;
		} else if($mClass=='department') {
			$arr['dep_active'] = 'active';
			$arr['adm_open'] = 'active';
			return $arr;
		} else if($mClass=='designation') {
			$arr['des_active'] = 'active';
			$arr['adm_open'] = 'active';
			return $arr;
		} else if($mClass=='company' && $mMethod=='official_documents') {
			$arr['official_documents_active'] = 'active';
			$arr['adm_open'] = 'active';
			return $arr;
		} else if($mClass=='company') {
			$arr['com_active'] = 'active';
			$arr['adm_open'] = 'active';
			return $arr;
		} else if($mClass=='location') {
			$arr['loc_active'] = 'active';
			$arr['adm_open'] = 'active';
			return $arr;
		}
		else if($mClass=='employees') {
			$arr['emp_active'] = 'active';
			$arr['stff_open'] = 'active';
			return $arr;
		} else if($mClass=='custom_fields') {
			$arr['custom_fields_active'] = 'active';
			$arr['stff_open'] = 'active';
			return $arr;
		}
		else if($mClass=='transfers') {
			$arr['tra_active'] = 'active';
			$arr['emp_open'] = 'active';
			return $arr;
		} else if($mClass=='resignation') {
			$arr['res_active'] = 'active';
			$arr['emp_open'] = 'active';
			return $arr;
		} 
		else if($mClass=='promotion') {
			$arr['pro_active'] = 'active';
			$arr['emp_open'] = 'active';
			return $arr;
		} else if($mClass=='complaints') {
			$arr['compl_active'] = 'active';
			$arr['emp_open'] = 'active';
			return $arr;
		} else if($mClass=='warning') {
			$arr['warn_active'] = 'active';
			$arr['emp_open'] = 'active';
			return $arr;
		} else if($mClass=='termination') {
			$arr['term_active'] = 'active';
			$arr['emp_open'] = 'active';
			return $arr;
		}  else if($mClass=='attendance' && $mMethod=='attendance') {
			$arr['attnd_active'] = 'active';
			$arr['attnd_open'] = 'active';
			return $arr;
		}  else if($mMethod=='date_wise_attendance') {
			$arr['dtwise_attnd_active'] = 'active';
			$arr['attnd_open'] = 'active';
			return $arr;
		} else if($mMethod=='update_attendance') {
			$arr['upd_attnd_active'] = 'active';
			$arr['attnd_open'] = 'active';
			return $arr;
		} else if($mClass=='overtime_request') {
			$arr['overtime_request_act'] = 'active';
			$arr['attnd_open'] = 'active';
			return $arr;
		} else if($mMethod=='office_shift' && $mClass=='attendance') {
			$arr['offsh_active'] = 'active';
			$arr['attnd_open'] = 'active';
			return $arr;
		} else if($mMethod=='leave' && $mClass=='attendance') {
			$arr['leave_active'] = 'active';
			$arr['attnd_open'] = 'active';
			return $arr;
		} else if($mMethod=='leave_details' && $mClass=='attendance') {
			$arr['leave_active'] = 'active';
			$arr['attnd_open'] = 'active';
			return $arr;
		} else if($mClass=='attendance' && $mMethod=='index') {
			$arr['attendance_active'] = 'active';
			$arr['attnd_open'] = 'active';
			return $arr;
		} else if($mClass=='employees_last_login') {
			$arr['emp_ll_active'] = 'active';
			$arr['stff_open'] = 'active';
			return $arr;
		} else if($mMethod=='hourly_wages') {
			$arr['pay_hourly_active'] = 'active';
			$arr['payrl_open'] = 'active';
			return $arr;
		} else if($mMethod=='templates') {
			$arr['pay_temp_active'] = 'active';
			$arr['payrl_open'] = 'active';
			return $arr;
		} else if($mMethod=='manage_salary') {
			$arr['pay_mang_active'] = 'active';
			$arr['payrl_open'] = 'active';
			return $arr;
		} else if($mMethod=='generate_payslip') {
			$arr['pay_generate_active'] = 'active';
			$arr['payrl_open'] = 'active';
			return $arr;
		} else if($mMethod=='payment_history') {
			$arr['pay_his_active'] = 'active';
			$arr['payrl_open'] = 'active';
			return $arr;
		} else if($mMethod=='currency_converter') {
			$arr['curren_conv_active'] = 'active';
			$arr['payrl_open'] = 'active';
			return $arr;
		} else if($mMethod=='advance_salary') {
			$arr['pay_advn_active'] = 'active';
			$arr['payrl_open'] = 'active';
			return $arr;
		} else if($mMethod=='advance_salary_report') {
			$arr['pay_advn_rpt_active'] = 'active';
			$arr['payrl_open'] = 'active';
			return $arr;
		} else if($mMethod=='create' && $mClass=='invoices') {
			$arr['hr_create_inv_active'] = 'active';
			$arr['project_open'] = 'active';
			return $arr;
		}else if($mMethod=='taxes' && $mClass=='invoices') {
			$arr['hr_taxes_inv_active'] = 'active';
			$arr['project_open'] = 'active';
			return $arr;
		} else if($mMethod=='payments_history' && $mClass=='invoices') {
			$arr['hr_client_invoices_pay_active'] = 'active';
			$arr['hr_quote_manager_open'] = 'active';
			return $arr;
		} else if($mClass=='invoices') {
			$arr['hr_all_inv_active'] = 'active';
			$arr['hr_quote_manager_open'] = 'active';
			return $arr;
		} else if($mClass=='job_post' && $mMethod=='pages') {
			$arr['jb_pages_active'] = 'active';
			$arr['recruit_open'] = 'active';
			return $arr;
		} else if($mClass=='job_post' && $mMethod=='employer') {
			$arr['jb_emp_active'] = 'active';
			$arr['recruit_open'] = 'active';
			return $arr;
		} else if($mClass=='job_post') {
			$arr['jb_post_active'] = 'active';
			$arr['recruit_open'] = 'active';
			return $arr;
		} else if($mClass=='job_candidates') {
			$arr['jb_cand_active'] = 'active';
			$arr['recruit_open'] = 'active';
			return $arr;
		} else if($mClass=='users') {
			$arr['users_active'] = 'active';
			$arr['system_open'] = 'active';
			return $arr;
		} else if($mClass=='roles') {
			$arr['roles_active'] = 'active';
			$arr['stff_open'] = 'active';
			return $arr;
		} else if($mMethod=='database_backup' && $mClass=='settings') {
			$arr['db_active'] = 'active';
			$arr['system_open'] = 'active';
			return $arr;
		} else if($mMethod=='modules' && $mClass=='settings') {
			$arr['modules_active'] = 'active';
			$arr['system_open'] = 'active';
			return $arr;
		} else if($mClass=='theme') {
			$arr['theme_active'] = 'active';
			$arr['system_open'] = 'active';
			return $arr;
		} else if($mClass=='settings') {
			$arr['settings_active'] = 'active';
			$arr['system_open'] = 'active';
			return $arr;
		} else if($mClass=='languages') {
			$arr['languages_active'] = 'active';
			$arr['system_open'] = 'active';
			return $arr;
		}else if($mClass=='reports'  && $mMethod=='employee_leave') {
			$arr['reports_leave_active'] = 'active';
			$arr['reports_open'] = 'active';
			return $arr;
		} else if($mClass=='reports'  && $mMethod=='payslip') {
			$arr['reports_payslip_active'] = 'active';
			$arr['reports_open'] = 'active';
			return $arr;
		} else if($mClass=='reports'  && $mMethod=='employee_attendance') {
			$arr['reports_employee_attendance_active'] = 'active';
			$arr['reports_open'] = 'active';
			return $arr;
		} else if($mClass=='reports'  && $mMethod=='roles') {
			$arr['reports_roles_active'] = 'active';
			$arr['reports_open'] = 'active';
			return $arr;
		} else if($mClass=='reports'  && $mMethod=='employees') {
			$arr['reports_employees_active'] = 'active';
			$arr['reports_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='transfer') {
			$arr['hr_transfer_active'] = 'active';
			$arr['mylink_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='promotion') {
			$arr['hr_promotion_active'] = 'active';
			$arr['mylink_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='complaints') {
			$arr['hr_complaints_active'] = 'active';
			$arr['mylink_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='warning') {
			$arr['hr_warning_active'] = 'active';
			$arr['mylink_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='office_shift') {
			$arr['hr_office_shift_active'] = 'active';
			$arr['mylink_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='jobs_applied') {
			$arr['jobs_applied_active'] = 'active';
			$arr['rec_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='jobs_interviews') {
			$arr['jobs_interviews_active'] = 'active';
			$arr['rec_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='payslip') {
			$arr['hr_payslip_active'] = 'active';
			$arr['hr_payslip_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='advance_salary') {
			$arr['hr_advance_salary_active'] = 'active';
			$arr['hr_payslip_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='advance_salary_report') {
			$arr['hr_advance_salary_report_active'] = 'active';
			$arr['hr_payslip_open'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='attendance') {
			$arr['hr_attendance_active'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='attendance') {
			$arr['hr_attendance_active'] = 'active';
			return $arr;
		} else if($mClass=='user' && $mMethod=='expense_claims') {
			$arr['hr_expense_claims_active'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='bank_cash') {
			$arr['hr_bank_cash_active'] = 'active';
			$arr['hr_acc_open1'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='account_balances') {
			$arr['hr_account_balances_active'] = 'active';
			$arr['hr_acc_open1'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='transfer') {
			$arr['hr_account_transfer_active'] = 'active';
			$arr['hr_acc_open3'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='deposit') {
			$arr['hr_deposit_active'] = 'active';
			$arr['hr_acc_open3'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='expense') {
			$arr['hr_account_expense_active'] = 'active';
			$arr['hr_acc_open3'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='transactions') {
			$arr['hr_account_transactions_active'] = 'active';
			$arr['hr_acc_open3'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='bankwise_transactions') {
			$arr['hr_account_transactions_active'] = 'active';
			$arr['hr_acc_open3'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='payees') {
			$arr['hr_payees_active'] = 'active';
			$arr['hr_acc_open2'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='payers') {
			$arr['hr_payers_active'] = 'active';
			$arr['hr_acc_open2'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='account_statement') {
			$arr['hr_account_statement_active'] = 'active';
			$arr['hr_acc_open5'] = 'active';
			$arr['hr_acc_report_open'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='expense_report') {
			$arr['hr_expense_report_active'] = 'active';
			$arr['hr_acc_open5'] = 'active';
			$arr['hr_acc_report_open'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='income_report') {
			$arr['hr_income_report_active'] = 'active';
			$arr['hr_acc_open5'] = 'active';
			$arr['hr_acc_report_open'] = 'active';
			return $arr;
		} else if($mClass=='finance' && $mMethod=='transfer_report') {
			$arr['hr_transfer_report_active'] = 'active';
			$arr['hr_acc_open5'] = 'active';
			$arr['hr_acc_report_open'] = 'active';
			return $arr;
		} else if($mClass=='profile' && isset($_GET['change_password'])=='true') {
			$arr['hr_password_active'] = 'active';
			return $arr;
		} else if($mClass=='invoices' && $mClass=='payments_history') {
			$arr['hr_client_invoices_pay_active'] = 'active';
			return $arr;
		} else if($mClass=='invoices') {
			$arr['hr_client_invoices_active'] = 'active';
			return $arr;
		} 
		
		
	}

	public function read_payment_method($id) {
	
		$sql = 'SELECT * FROM tat_payment_method where payment_method_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function read_user_attendance_info() {
		
		$sql = 'SELECT * FROM tat_employees WHERE user_id = ?';
		$binds = array('000');
		$query = $this->db->query($sql, $binds);
		
		return $query;	
	}

	public function clean_post($post_name) {
		$name = trim($post_name);
		$Evalue = array('-','alert','<script>','</script>','</php>','<php>','<p>','\r\n','\n','\r','=',"'",'/','cmd','!',"('","')", '|');
		$post_name = str_replace($Evalue, '', $name); 
		$post_name = preg_replace('/^(\d{1,2}[^0-9])/m', '', $post_name);
		
		return $post_name;
	 }
	 
	 public function clean_date_post($post_name) {
		$name = trim($post_name);
		$Evalue = array('alert','<script>','</script>','</php>','<php>','<p>','\r\n','\n','\r','=',"'",'/','cmd','!',"('","')", '|');
		$post_name = str_replace($Evalue, '', $name); 
		$post_name = preg_replace('/^(\d{1,2}[^0-9])/m', '', $post_name);
		$post_name = htmlspecialchars(trim($post_name), ENT_QUOTES, "UTF-8");
		return $post_name;
	 }
	 
	 public function form_button_class() {
		 return 'btn btn-primary';
	 }


	 public function convertNumberToWord($num = false) {
		$num = str_replace(array(',', ' '), '' , trim($num));
		if(! $num) {
			return false;
		}
		$num = (int) $num;
		$words = array();
		$list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
			'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
		);
		$list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
		$list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion'
		);
		$num_length = strlen($num);
		$levels = (int) (($num_length + 2) / 3);
		$max_length = $levels * 3;
		$num = substr('00' . $num, -$max_length);
		$num_levels = str_split($num, 3);
		for ($i = 0; $i < count($num_levels); $i++) {
			$levels--;
			$hundreds = (int) ($num_levels[$i] / 100);
			$hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
			$tens = (int) ($num_levels[$i] % 100);
			$singles = '';
			if ( $tens < 20 ) {
				$tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
			} else {
				$tens = (int)($tens / 10);
				$tens = ' ' . $list2[$tens] . ' ';
				$singles = (int) ($num_levels[$i] % 10);
				$singles = ' ' . $list1[$singles] . ' ';
			}
			$words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
		} //end for loop
		$commas = count($words);
		if ($commas > 1) {
			$commas = $commas - 1;
		}
		return implode(' ', $words);
	}

	 public function get_job_type() {
		return  $query = $this->db->query("SELECT * from tat_job_type");
   }
 
	 public function validate_date($dateStr, $format)
	 {
		 date_default_timezone_set('UTC');
		 $date = DateTime::createFromFormat($format, $dateStr);
		 return $date && ($date->format($format) === $dateStr);
	 }
 
	 private function validate_numbers_only($value) {
		 return preg_match('/^([0-9]*)$/', $value);
	 }

	 public function current_month_day_attendance($current_month) {
		
		$session = $this->session->userdata('username');
		$sql = 'SELECT employee_id,attendance_date FROM tat_attendance_time WHERE attendance_date = ? group by employee_id';
		$binds = array($current_month);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}
	
	public function current_employee_absent_calendar($current_month) {
		
		$session = $this->session->userdata('username');		
		$sql = "SELECT at.*,e.*,la.* from tat_attendance_time as at, tat_employees as e, tat_leave_applications as la where at.attendance_date = ? and e.user_id!=at.employee_id and e.user_id!=la.employee_id";
		$binds = array($current_month);
		$query = $this->db->query($sql, $binds);
		
		
		return $query->result();
	}

	public function set_percentage($number){
		if(is_int($number)) {
			$inumber = $number;
		} else {
			$inumber = number_format((float)$number, 2, '.', '');
		}
		return $inumber;
		
	}

	public function get_email_templates() {
		return  $query = $this->db->query("SELECT * from tat_email_template");
   }
   

   public function read_email_template_info($id) {
   
	   $sql = 'SELECT * FROM tat_email_template WHERE template_id = ?';
	   $binds = array($id);
	   $query = $this->db->query($sql, $binds);
	   
	   if ($query->num_rows() > 0) {
		   return $query->result();
	   } else {
		   return null;
	   }
   }

   public function read_email_template($id) {
	
	$sql = 'SELECT * FROM tat_email_template where template_id = ?';
	$binds = array($id);
	$query = $this->db->query($sql, $binds);
	
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

   public function single_email_template($id){
		
	$sql = 'SELECT * FROM tat_email_template where template_id = ?';
	$binds = array($id);
	$query = $this->db->query($sql, $binds);
	return $query->result();
}

	public function add_backup($data){
		$this->db->insert('tat_database_backup', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function all_db_backup() {
		return  $query = $this->db->query("SELECT * from tat_database_backup");
	}

	public function delete_single_backup_record($id){
		$this->db->where('backup_id', $id);
		$this->db->delete('tat_database_backup');
		
	}

	public function delete_all_backup_record(){
		$this->db->empty_table('tat_database_backup');
		
	}
	
}
?>