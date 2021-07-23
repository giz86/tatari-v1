<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class complaints_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_complaints()
	{
	  return $this->db->get("tat_employee_complaints");
	}
	 
	 public function read_complaint_information($id) {
	
		$sql = 'SELECT * FROM tat_employee_complaints WHERE complaint_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function get_employee_complaints($id) {
		
		$sql = 'SELECT * FROM tat_employee_complaints WHERE complaint_from = ?';
		$binds = array($id);
		$query = $this->db->query($sql,$binds);
	 	return $query;
	}

	public function get_company_complaints($company_id) {
	
		$sql = 'SELECT * FROM tat_employee_complaints WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	

	public function add($data){
		$this->db->insert('tat_employee_complaints', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	

	public function delete_record($id){
		$this->db->where('complaint_id', $id);
		$this->db->delete('tat_employee_complaints');
		
	}

	public function update_record($data, $id){
		$this->db->where('complaint_id', $id);
		if( $this->db->update('tat_employee_complaints',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>