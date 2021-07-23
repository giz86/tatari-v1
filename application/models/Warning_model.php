<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class warning_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_warning() {
	  return $this->db->get("tat_employee_warnings");
	}
	
	public function get_employee_warning($id) {
	 	
		$sql = 'SELECT * FROM tat_employee_warnings WHERE warning_to = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

	public function get_company_warning($company_id) {
	
		$sql = 'SELECT * FROM tat_employee_warnings WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	 
	 public function read_warning_information($id) {
	
		$sql = 'SELECT * FROM tat_employee_warnings WHERE warning_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function read_warning_type_information($id) {
	
		$sql = 'SELECT * FROM tat_warning_type WHERE warning_type_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function all_warning_types() {
	  $query = $this->db->query("SELECT * from tat_warning_type");
  	  return $query->result();
	}
	

	public function add($data){
		$this->db->insert('tat_employee_warnings', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	

	public function delete_record($id){
		$this->db->where('warning_id', $id);
		$this->db->delete('tat_employee_warnings');
		
	}

	public function update_record($data, $id){
		$this->db->where('warning_id', $id);
		if( $this->db->update('tat_employee_warnings',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>