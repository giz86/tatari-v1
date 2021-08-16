<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Attendance_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_office_shifts() {
	  return $this->db->get("tat_office_shift");
	}

    public function get_company_shifts($company_id) {
      
        $sql = 'SELECT * FROM tat_office_shift WHERE company_id = ?';
        $binds = array($company_id);
        $query = $this->db->query($sql, $binds);
        return $query;
    }
    
    	
	public function all_leave_types() {
        $query = $this->db->get("tat_leave_type");
        return $query->result();
      }

      
    public function get_company_leaves($company_id) {
      
          $sql = 'SELECT * FROM tat_leave_applications WHERE company_id = ?';
          $binds = array($company_id);
          $query = $this->db->query($sql, $binds);
          return $query;
      }
  
    public function get_multi_company_leaves($company_ids) {
      
          $sql = 'SELECT * FROM tat_leave_applications where company_id IN ?';
          $binds = array($company_ids);
          $query = $this->db->query($sql, $binds);
          return $query;
      }

    public function attendance_time_check($employee_id) {
	
		$sql = 'SELECT * FROM tat_attendance_time WHERE employee_id = ?';
		$binds = array($employee_id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
				
	// Check if CheckIn is available
	public function attendance_first_in_check($employee_id,$attendance_date) {
	
		$sql = 'SELECT * FROM tat_attendance_time WHERE employee_id = ? and attendance_date = ? limit 1';
		$binds = array($employee_id,$attendance_date);
		$query = $this->db->query($sql, $binds);

		return $query;
	}
	
	public function attendance_first_in($employee_id,$attendance_date) {
	
		$sql = 'SELECT * FROM tat_attendance_time WHERE employee_id = ? and attendance_date = ?';
		$binds = array($employee_id,$attendance_date);
		$query = $this->db->query($sql, $binds);
		
		return $query->result();
	}
	
	// Check if CheckOut is available
	public function attendance_first_out_check($employee_id,$attendance_date) {
	
		$sql = 'SELECT * FROM tat_attendance_time WHERE employee_id = ? and attendance_date = ? order by time_attendance_id desc limit 1';
		$binds = array($employee_id,$attendance_date);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}

	public function attendance_first_out($employee_id,$attendance_date) {
	
		$sql = 'SELECT * FROM tat_attendance_time WHERE employee_id = ? and attendance_date = ? order by time_attendance_id desc limit 1';
		$binds = array($employee_id,$attendance_date);
		$query = $this->db->query($sql, $binds);
		
		return $query->result();
	}
	
	// Total Work Hours
	public function total_hours_worked_attendance($id,$attendance_date) {
		
		$sql = 'SELECT * FROM tat_attendance_time WHERE employee_id = ? and attendance_date = ? and total_work != ""';
		$binds = array($id,$attendance_date);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	// Total Rest Time
	public function total_rest_attendance($id,$attendance_date) {
		
		$sql = 'SELECT * FROM tat_attendance_time WHERE employee_id = ? and attendance_date = ? and total_rest != ""';
		$binds = array($id,$attendance_date);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	

	// Leave Functions
	public function get_leaves() {
	  return $this->db->get("tat_leave_applications");
	}

	public function filter_company_leaves($company_id) {
	
		$sql = 'SELECT * FROM tat_leave_applications WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

	public function filter_company_employees_leaves($company_id,$employee_id) {
	
		$sql = 'SELECT * FROM tat_leave_applications WHERE company_id = ? and employee_id = ?';
		$binds = array($company_id,$employee_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

	public function filter_company_employees_status_leaves($company_id,$employee_id,$status) {
	
		$sql = 'SELECT * FROM tat_leave_applications WHERE company_id = ? and employee_id = ? and status = ?';
		$binds = array($company_id,$employee_id,$status);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

	public function filter_company_only_status_leaves($company_id,$status) {
	
		$sql = 'SELECT * FROM tat_leave_applications WHERE company_id = ? and status = ?';
		$binds = array($company_id,$status);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_employee_leaves($id) {
		
		$sql = 'SELECT * FROM tat_leave_applications WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function get_leaves_request_calendar() {
	  return $query = $this->db->query("SELECT * from tat_leave_applications");
	}


	public function leave_date_check($emp_id,$attendance_date) {
	
		$sql = 'SELECT * from tat_leave_applications where (from_date between from_date and to_date) and employee_id = ? or from_date = ? and to_date = ? limit 1';
		$binds = array($emp_id,$attendance_date,$attendance_date);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	

	public function leave_date($emp_id,$attendance_date) {
	
		$sql = 'SELECT * from tat_leave_applications where (from_date between from_date and to_date) and employee_id = ? or from_date = ? and to_date = ? limit 1';
		$binds = array($emp_id,$attendance_date,$attendance_date);
		$query = $this->db->query($sql, $binds);
		
		return $query->result();
	}
	
	public function count_total_leaves($leave_type_id,$employee_id) {
		
		$sql = 'SELECT * FROM tat_leave_applications WHERE employee_id = ? and leave_type_id = ? and status = ?';
		$binds = array($employee_id,$leave_type_id,2);
		$query = $this->db->query($sql, $binds);

		return $query->result();
	}
	
	 
	public function read_office_shift_information($id) {
	
		$sql = 'SELECT * FROM tat_office_shift WHERE office_shift_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
    // Fetch Leave Data
	public function read_leave_information($id) {
	
		$sql = 'SELECT * FROM tat_leave_applications WHERE leave_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
    public function attendance_employee_with_date($emp_id,$attendance_date) {
		
		$sql = 'SELECT * FROM tat_attendance_time where attendance_date = ? and employee_id = ?';
		$binds = array($attendance_date,$emp_id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
    // Fetch Leave Type Info
	public function read_leave_type_information($id) {
	
		$sql = 'SELECT * FROM tat_leave_type WHERE leave_type_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

    // Fetch Attendance Data
	 public function read_attendance_information($id) {
	
		$sql = 'SELECT * FROM tat_attendance_time WHERE time_attendance_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
    // Insert Attendance Data
	public function add_employee_attendance($data){
		$this->db->insert('tat_attendance_time', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

    public function add_new_attendance($data){
		$this->db->insert('tat_attendance_time', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Insert Leave Data
	public function add_leave_record($data){
		$this->db->insert('tat_leave_applications', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Insert Work Shift Data
	public function add_office_shift_record($data){
		$this->db->insert('tat_office_shift', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	
	// Delete Attendance Record
	public function delete_attendance_record($id){ 
		$this->db->where('time_attendance_id', $id);
		$this->db->delete('tat_attendance_time');
		
	}
	
	// Delete Work Shift Record
	public function delete_shift_record($id){ 
		$this->db->where('office_shift_id', $id);
		$this->db->delete('tat_office_shift');
		
	}
	
	// Delete Leave Record
	public function delete_leave_record($id){ 
		$this->db->where('leave_id', $id);
		$this->db->delete('tat_leave_applications');
		
	}
	
	
	// Update Attendance Record
	public function update_attendance_record($data, $id){
		$this->db->where('time_attendance_id', $id);
		if( $this->db->update('tat_attendance_time',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	// Update Leave Record
	public function update_leave_record($data, $id){
		$this->db->where('leave_id', $id);
		if( $this->db->update('tat_leave_applications',$data)) {
			return true;
		} else {
			return false;
		}		
	}
		
	// Update Work Shift Record
	public function update_shift_record($data, $id){
		$this->db->where('office_shift_id', $id);
		if( $this->db->update('tat_office_shift',$data)) {
			return true;
		} else {
			return false;
		}		
	}	
	
	public function update_default_shift_record($data, $id){
		$this->db->where('office_shift_id', $id);
		if( $this->db->update('tat_office_shift',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function update_default_shift_zero($data){
		$this->db->where("office_shift_id!=''");
		if( $this->db->update('tat_office_shift',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	
	// Check Attendance
	public function check_user_attendance() {
		$today_date = date('Y-m-d');
		$session = $this->session->userdata('username');
		$sql = 'SELECT * FROM tat_attendance_time where `employee_id` = ? and `attendance_date` = ? order by time_attendance_id desc limit 1';
		$binds = array($session['user_id'],$today_date);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	// Check ClockOut
	public function check_user_attendance_clockout() {
		$today_date = date('Y-m-d');
		$session = $this->session->userdata('username');
		$sql = 'SELECT * FROM tat_attendance_time where `employee_id` = ? and `attendance_date` = ? and clock_out = ? order by time_attendance_id desc limit 1';
		$binds = array($session['user_id'],$today_date,'');
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	public function get_last_user_attendance() {

		$session = $this->session->userdata('username');
		$sql = 'SELECT * FROM tat_attendance_time where `employee_id` = ? order by time_attendance_id desc limit 1';
		$binds = array($session['user_id']);
		$query = $this->db->query($sql, $binds);
	
		return $query->result();
	}
	
	// Check Attendance Time
	public function attendance_time_checks($id) {

		$session = $this->session->userdata('username');
		$sql = 'SELECT * FROM tat_attendance_time where `employee_id` = ? and clock_out = ? order by time_attendance_id desc limit 1';
		$binds = array($id,'');
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
    // Update Attendance ClockOut 
	public function update_attendance_clockedout($data,$id){
		$this->db->where('time_attendance_id', $id);
		if( $this->db->update('tat_attendance_time',$data)) {
			return true;
		} else {
			return false;
		}		
	}
    
	// Helper Functions - AUXILARY
	public function get_tat_employees() {
		
		$sql = 'SELECT * FROM tat_employees WHERE is_active = ? and user_role_id!=1';
		$binds = array(1);
		$query = $this->db->query($sql, $binds);
		return $query->result();
	}
	
	public function get_employee_leaves_department_wise($department_id) {
		
		$sql = 'SELECT * FROM tat_leave_applications WHERE department_id = ?';
		$binds = array($department_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function employee_count_total_leaves($leave_type_id,$employee_id) {
	
		$sql = 'SELECT * FROM tat_leave_applications WHERE employee_id = ? and leave_type_id = ? and status = ?';
		$binds = array($employee_id,$leave_type_id,2);
		$query = $this->db->query($sql, $binds);

		return $query->num_rows();
	}
	
	public function employee_show_last_leave($employee_id,$leave_id) {
		$sql = "SELECT * FROM tat_leave_applications WHERE leave_id != '".$leave_id."' and employee_id = ? order by leave_id desc limit 1";
		$binds = array($employee_id);
		$query = $this->db->query($sql, $binds);
		return $query->result();
	}
}
?>