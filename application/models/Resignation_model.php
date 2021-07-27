<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class resignation_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_resignations()
	{
	  return $this->db->get("tat_employee_resignations");
	}
	 
	 public function read_resignation_information($id) {
	
		$sql = 'SELECT * FROM tat_employee_resignations WHERE resignation_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_company_resignations($company_id) {
	
		$sql = 'SELECT * FROM tat_employee_resignations WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	public function get_employee_resignation($id) {
		
		$sql = 'SELECT * FROM tat_employee_resignations WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
	 	return $query;
	}
	

	public function add($data){
		$this->db->insert('tat_employee_resignations', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	

	public function delete_record($id){
		$this->db->where('resignation_id', $id);
		$this->db->delete('tat_employee_resignations');
		
	}
	

	public function update_record($data, $id){
		$this->db->where('resignation_id', $id);
		if( $this->db->update('tat_employee_resignations',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>