<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    // Overtime Model - to handle data for Overtime requests and records
	class Overtime_request_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    // Insert
	public function add_employee_overtime_request($data){
		$this->db->insert('tat_overtime_request', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

    // Fetch
    public function read_overtime_request_info($id) {
	
		$sql = 'SELECT * FROM tat_overtime_request WHERE time_request_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function all_employee_overtime_requests() {
		
		$sql = 'SELECT * FROM tat_overtime_request';
		$query = $this->db->query($sql);
		
		return $query;
	}

    public function employee_overtime_requests($emp_id) {
		
		$sql = 'SELECT * FROM tat_overtime_request where employee_id = ?';
		$binds = array($emp_id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	
	public function get_overtime_request_count($employee_id,$pay_date) {
		
		$sql = 'SELECT * FROM `tat_overtime_request` where employee_id = ? and is_approved = ? and request_date_request = ?';
		$binds = array($employee_id,2,$pay_date);
		$query = $this->db->query($sql, $binds);
		$result = $query->result();
		return $result;
	}
	
    // Update
	public function update_request_record($data, $id){
		$this->db->where('time_request_id', $id);
		if( $this->db->update('tat_overtime_request',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
    // Delete
	public function delete_overtime_request_record($id){ 
		$this->db->where('time_request_id', $id);
		$this->db->delete('tat_overtime_request');
		
	}
	
}
?>