<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * HR Reporting Model
 */
class Reports_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // General Employees Report
    public function get_employees_reports($company_id,$department_id,$designation_id) {
        if($company_id==0 && $department_id==0 && $designation_id==0) {
            return $query = $this->db->query("SELECT * FROM tat_employees");
        } else if($company_id!=0 && $department_id==0 && $designation_id==0) {
             $sql = 'SELECT * from tat_employees where company_id = ?';
            $binds = array($company_id);
            $query = $this->db->query($sql, $binds);
            return $query;
        } else if($company_id!=0 && $department_id!=0 && $designation_id==0) {
             $sql = 'SELECT * from tat_employees where company_id = ? and department_id = ?';
            $binds = array($company_id,$department_id);
            $query = $this->db->query($sql, $binds);
            return $query;
        } else if($company_id!=0 && $department_id!=0 && $designation_id!=0) {
             $sql = 'SELECT * from tat_employees where company_id = ? and department_id = ? and designation_id = ?';
            $binds = array($company_id,$department_id,$designation_id);
            $query = $this->db->query($sql, $binds);
            return $query;
        } else {
            return $query = $this->db->query("SELECT * FROM tat_employees");
        }
  }


   // Leave Reports
	public function get_leave_application_list() {
		
		$sql = 'SELECT * from `tat_leave_applications` group by employee_id';
		$query = $this->db->query($sql);
		return $query;
	}
	
	public function get_leave_application_filter_list($sd,$ed,$user_id,$company_id) {
		
		$sql = 'SELECT * from `tat_leave_applications` where company_id = ? and employee_id = ? and from_date >= ? and to_date <= ? group by employee_id';
		$binds = array($company_id,$user_id,$sd,$ed);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	

	public function get_pending_leave_application_list($employee_id) {
		
		$sql = 'SELECT * from `tat_leave_applications` where employee_id = ? and status = ?';
		$binds = array($employee_id,1);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}

	public function get_approved_leave_application_list($employee_id) {
		
		$sql = 'SELECT * from `tat_leave_applications` where employee_id = ? and status = ?';
		$binds = array($employee_id,2);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}
	

	public function get_upcoming_leave_application_list($employee_id) {
		
		$sql = 'SELECT * from `tat_leave_applications` where employee_id = ? and status = ?';
		$binds = array($employee_id,4);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}
	
	public function get_rejected_leave_application_list($employee_id) {
		
		$sql = 'SELECT * from `tat_leave_applications` where employee_id = ? and status = ?';
		$binds = array($employee_id,3);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}

	public function get_pending_leave_list($employee_id,$status) {
		
		$sql = 'SELECT * from `tat_leave_applications` where employee_id = ? and status = ?';
		$binds = array($employee_id,$status);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

    //   Payslip Report
	public function get_payslip_list($cid,$eid,$re_date) {
	  if($eid=='' || $eid==0){
		
		$sql = 'SELECT * from tat_salary_payslips where salary_month = ? and company_id = ?';
		$binds = array($re_date,$cid);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	  } else {
	 	 
		$sql = 'SELECT * from tat_salary_payslips where employee_id = ? and salary_month = ? and company_id = ?';
		$binds = array($eid,$re_date,$cid);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	  }
	}

   
    // Roles Report
	public function get_roles_employees($role_id) {
		  if($role_id==0) {
			  return $query = $this->db->query("SELECT * FROM tat_employees");
		  } else {
			  $sql = 'SELECT * from tat_employees where user_role_id = ?';
			  $binds = array($role_id);
			  $query = $this->db->query($sql, $binds);
			  return $query;
		  }
	}
	
	
}
?>