<?php

// Payroll Model : data manipulation on salary and related tables
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Payroll_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_models() {
	  return $this->db->get("tat_salary_models");
	}
	
    public function get_employee_comp_model($cid,$id) {
		
		$sql = 'SELECT * FROM tat_employees WHERE company_id = ? and user_id = ?';
		$binds = array($cid,$id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_comp_model($cid,$id) {
		
		$sql = 'SELECT * FROM tat_employees WHERE company_id = ? and user_role_id!=?';
		$binds = array($cid,1);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
    public function get_advance_salaries() {
        return $this->db->get("tat_advance_salaries");
      }
       
    public function get_advance_salaries_single($id) {
          
          $sql = 'SELECT * FROM tat_advance_salaries WHERE employee_id = ?';
          $binds = array($id);
          $query = $this->db->query($sql, $binds);
          return $query;
      }

	// Payroll Calls
	public function get_company_payroll_employees($company_id) {
		
		$sql = 'SELECT * FROM tat_employees WHERE user_role_id!=1 and company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_company_location_payroll_employees($company_id,$location_id) {
		
		$sql = 'SELECT * FROM tat_employees WHERE user_role_id!=1 and company_id = ? and location_id = ?';
		$binds = array($company_id,$location_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_company_location_dep_payroll_employees($company_id,$location_id,$department_id) {
		
		$sql = 'SELECT * FROM tat_employees WHERE user_role_id!=1 and company_id = ? and location_id = ? and department_id = ?';
		$binds = array($company_id,$location_id,$department_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	// Payment Elements
	public function all_payment_history() {
	  return $this->db->get("tat_make_payment");
	}
	
	public function employees_payment_history() {
	  return $this->db->get("tat_salary_payslips");
	}

	public function get_all_employees() {
		$sql = 'SELECT * FROM tat_employees WHERE user_role_id!=?';
		$binds = array(1);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function all_employees_payment_history() {
	  	$sql = 'SELECT * FROM tat_salary_payslips';
		$query = $this->db->query($sql);
		return $query;
	}
	
	public function all_employees_payment_history_month($salary_month) {
	  	$sql = 'SELECT * FROM tat_salary_payslips WHERE salary_month = ?';
		$binds = array($salary_month);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

    // Payslips Element
    public function get_payroll_slip($id) {
		
		$sql = 'SELECT * FROM tat_salary_payslips WHERE employee_id = ? and status = ?';
		$binds = array($id,2);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

	public function get_company_payslips($id) {
		
		$sql = 'SELECT * FROM tat_salary_payslips WHERE company_id = ? and status = ?';
		$binds = array($id,2);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_company_payslip_history($company_id) {
		
		$sql = 'SELECT * FROM tat_salary_payslips WHERE company_id = ?';
		$binds = array($company_id,$salary_month);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_company_payslip_history_month($company_id,$salary_month) {
		
		$sql = 'SELECT * FROM tat_salary_payslips WHERE company_id = ? and salary_month = ?';
		$binds = array($company_id,$salary_month);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

    public function get_company_location_department_payslips($company_id,$location_id,$department_id) {
		
		$sql = 'SELECT * FROM tat_salary_payslips WHERE company_id = ? and location_id = ? and department_id = ?';
		$binds = array($company_id,$location_id,$department_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_company_location_department_payslips_month($company_id,$location_id,$department_id,$salary_month) {
		
		$sql = 'SELECT * FROM tat_salary_payslips WHERE company_id = ? and location_id = ? and department_id = ? and salary_month = ?';
		$binds = array($company_id,$location_id,$department_id,$salary_month);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_company_location_department_designation_payslips($company_id,$location_id,$department_id,$designation_id) {
		
		$sql = 'SELECT * FROM tat_salary_payslips WHERE company_id = ? and location_id = ? and department_id = ? and designation_id = ?';
		$binds = array($company_id,$location_id,$department_id,$designation_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_company_location_payslips($company_id,$location_id) {
		
		$sql = 'SELECT * FROM tat_salary_payslips WHERE company_id = ? and location_id = ?';
		$binds = array($company_id,$location_id,$salary_month);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_company_location_payslips_month($company_id,$location_id,$salary_month) {
		
		$sql = 'SELECT * FROM tat_salary_payslips WHERE company_id = ? and location_id = ? and salary_month = ?';
		$binds = array($company_id,$location_id,$salary_month);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	

	// Hourly: Basic Payment model : not requirement
	public function get_hourly_wages()
	{
	  return $this->db->get("tat_hourly_models");
	}
	 
	public function read_model_information($id) {
	
		$sql = 'SELECT * FROM tat_salary_models WHERE salary_model_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function requested_date_details($id) {
		
		$sql = 'SELECT * FROM `tat_advance_salaries` WHERE employee_id = ? and status = ?';
		$binds = array($id,1);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	public function read_hourly_wage_information($id) {
	
		$sql = 'SELECT * FROM tat_hourly_models WHERE hourly_rate_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function advance_salaries_report_view($id) {
	  $sql = 'SELECT advance_salary_id,company_id,employee_id,month_year,one_time_deduct,monthly_installment,reason,status,total_paid,is_deducted_from_salary,created_at,SUM(`tat_advance_salaries`.advance_amount) AS advance_amount FROM `tat_advance_salaries` where status=1 and employee_id= ? group by employee_id';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
	    return $query->result();
	}
	
	public function read_make_payment_information($id) {
	
		$sql = 'SELECT * FROM tat_make_payment WHERE make_payment_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function read_payslip_information($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslips WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	// Add - Insert Record to Payment models
	public function add_model($data){
		$this->db->insert('tat_salary_models', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_monthly_payment_payslip($data){
		$this->db->insert('tat_make_payment', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function add_hourly_payment_payslip($data){
		$this->db->insert('tat_make_payment', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function add_advance_salary_payroll($data){
		$this->db->insert('tat_advance_salaries', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_payslip($data){
		$this->db->insert('tat_salary_payslips', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function add_salary_payslip_allowances($data){
		$this->db->insert('tat_salary_payslip_allowances', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_payslip_commissions($data){
		$this->db->insert('tat_salary_payslip_commissions', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_payslip_other_payments($data){
		$this->db->insert('tat_salary_payslip_other_payments', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_payslip_statutory_deductions($data){
		$this->db->insert('tat_salary_payslip_statutory_deductions', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_payslip_loan($data){
		$this->db->insert('tat_salary_payslip_loan', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_payslip_overtime($data){
		$this->db->insert('tat_salary_payslip_overtime', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function add_hourly_wages($data){
		$this->db->insert('tat_hourly_models', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Read from Models
	public function read_advance_salary_info($id) {
	
		$sql = 'SELECT * FROM tat_advance_salaries WHERE advance_salary_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function all_hourly_models()
	{
		$query = $this->db->query("SELECT * from tat_hourly_models");
		return $query->result();
	}

	public function all_salary_models()
	{
		$query = $this->db->query("SELECT * from tat_salary_models");
		return $query->result();
	}
	
	public function get_paid_salary_by_employee_id($id) {
	
		$sql = 'SELECT advance_salary_id,employee_id,month_year,one_time_deduct,monthly_installment,reason,status,total_paid,is_deducted_from_salary,created_at,SUM(`tat_advance_salaries`.advance_amount) AS advance_amount FROM `tat_advance_salaries` where status=1 and employee_id=? group by employee_id';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query->result();
	}

	public function read_make_payment_payslip_check($employee_id,$p_date) {
	
		$sql = 'SELECT * FROM tat_salary_payslips WHERE employee_id = ? and salary_month = ?';
		$binds = array($employee_id,$p_date);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	public function read_make_payment_payslip_half_month_check($employee_id,$p_date) {
	
		$sql = "SELECT * FROM tat_salary_payslips WHERE is_half_monthly_payroll = '1' and employee_id = ? and salary_month = ?";
		$binds = array($employee_id,$p_date);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function read_make_payment_payslip_half_month_check_last($employee_id,$p_date) {
	
		$sql = "SELECT * FROM tat_salary_payslips WHERE is_half_monthly_payroll = '1' and employee_id = ? and salary_month = ? order by payslip_id desc";
		$binds = array($employee_id,$p_date);
		$query = $this->db->query($sql, $binds);
		return $query->result();
	}
	public function read_make_payment_payslip_half_month_check_first($employee_id,$p_date) {
	
		$sql = "SELECT * FROM tat_salary_payslips WHERE is_half_monthly_payroll = '1' and employee_id = ? and salary_month = ? order by payslip_id asc";
		$binds = array($employee_id,$p_date);
		$query = $this->db->query($sql, $binds);
		return $query->result();
	}
	
	public function advance_salary_by_employee_id($id) {
	
		$sql = 'SELECT * FROM tat_advance_salaries WHERE employee_id = ? and status = ? order by advance_salary_id desc';
		$binds = array($id,1);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function read_salary_payslip_info($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslips WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	public function read_salary_payslip_info_key($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslips WHERE payslip_key = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function read_make_payment_payslip($employee_id,$p_date) {
	
		$sql = 'SELECT * FROM tat_salary_payslips WHERE employee_id = ? and salary_month = ?';
		$binds = array($employee_id,$p_date);
		$query = $this->db->query($sql, $binds);
		
		return $query->result();
	}

	public function read_count_make_payment_payslip($employee_id,$p_date) {
	
		$sql = 'SELECT * FROM tat_salary_payslips WHERE employee_id = ? and salary_month = ?';
		$binds = array($employee_id,$p_date);
		$query = $this->db->query($sql, $binds);
		
		return $query->num_rows();
	}


	// Update - Edit from Payment Model Records
	public function update_models_record($data, $id){
		$this->db->where('salary_model_id', $id);
		if( $this->db->update('tat_salary_models',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function update_hourly_wages_record($data, $id){
		$this->db->where('hourly_rate_id', $id);
		if( $this->db->update('tat_hourly_models',$data)) {
			return true;
		} else {
			return false;
		}		
	}	
	
	public function update_salary_model($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function updated_advance_salary_paid_amount($data, $id){
		$this->db->where('employee_id', $id);
		if( $this->db->update('tat_advance_salaries',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function updated_advance_salary_payroll($data, $id){
		$this->db->where('advance_salary_id', $id);
		if( $this->db->update('tat_advance_salaries',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function update_hourlygrade_salary_model($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function update_monthlygrade_salary_model($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function update_hourlygrade_zero($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
		
	public function update_payroll_status($data, $id){
		$this->db->where('payslip_key', $id);
		if( $this->db->update('tat_salary_payslips',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function update_monthlygrade_zero($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function update_empty_salary_model($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}


	// Delete Records from Tables
	public function delete_record($id){
		$this->db->where('payslip_id', $id);
		$this->db->delete('tat_salary_payslips');
		
	}
	
	public function delete_payslip_allowances_items($id){
		$this->db->where('payslip_id', $id);
		$this->db->delete('tat_salary_payslip_allowances');
		
	}

	public function delete_payslip_other_payment_items($id){
		$this->db->where('payslip_id', $id);
		$this->db->delete('tat_salary_payslip_other_payments');
		
	}
	
	public function delete_payslip_overtime_items($id){
		$this->db->where('payslip_id', $id);
		$this->db->delete('tat_salary_payslip_overtime');
		
	}
	
	public function delete_payslip_statutory_deductions_items($id){
		$this->db->where('payslip_id', $id);
		$this->db->delete('tat_salary_payslip_statutory_deductions');
		
	}
	
	public function delete_payslip_commissions_items($id){
		$this->db->where('payslip_id', $id);
		$this->db->delete('tat_salary_payslip_commissions');
		
	}
	
	public function delete_payslip_loan_items($id){
		$this->db->where('payslip_id', $id);
		$this->db->delete('tat_salary_payslip_loan');
		
	}
	
	public function delete_models_record($id){
		$this->db->where('salary_model_id', $id);
		$this->db->delete('tat_salary_models');
		
	}
	
	public function delete_hourly_wage_record($id){
		$this->db->where('hourly_rate_id', $id);
		$this->db->delete('tat_hourly_models');
		
	}
	
	public function delete_advance_salary_record($id){
		$this->db->where('advance_salary_id', $id);
		$this->db->delete('tat_advance_salaries');
		
	}

	// Extended: 
	public function total_hours_worked($id,$attendance_date) {
		
		$sql = 'SELECT * FROM tat_attendance_time WHERE employee_id = ? and attendance_date like ?';
		$binds = array($id, '%'.$attendance_date.'%');
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function total_hours_worked_payslip($id,$attendance_date) {
		$sql = 'SELECT * FROM tat_attendance_time WHERE employee_id = ? and attendance_date like ?';
		$binds = array($id, '%'.$attendance_date.'%');
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_advance_salaries_report() {
	  return $this->db->query("SELECT advance_salary_id,employee_id,company_id,month_year,one_time_deduct,monthly_installment,reason,status,total_paid,is_deducted_from_salary,created_at,SUM(`tat_advance_salaries`.advance_amount) AS advance_amount FROM `tat_advance_salaries` where status=1 group by employee_id");
	}
	
	public function advance_salaries_report_single($id) {
	  $sql = 'SELECT advance_salary_id,employee_id,company_id,month_year,one_time_deduct,monthly_installment,reason,status,total_paid,is_deducted_from_salary,created_at,SUM(`tat_advance_salaries`.advance_amount) AS advance_amount FROM `tat_advance_salaries` where status=1 and employee_id = ? group by employee_id';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	 
}
?>