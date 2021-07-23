<?php
// Designation Model - Base
	defined('BASEPATH') OR exit('No direct script access allowed');
class designation_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_designations()
	{
	  return $this->db->get("tat_designations");
	}

    public function all_designations()
	{
	  $query = $this->db->query("SELECT * from tat_designations");
  	  return $query->result();
	}
	 
	 public function read_designation_information($id) {
	
		$sql = 'SELECT * FROM tat_designations WHERE designation_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function add($data){
		$this->db->insert('tat_designations', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

    public function update_record($data, $id){
		$this->db->where('designation_id', $id);
		if( $this->db->update('tat_designations',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function delete_record($id){
		$this->db->where('designation_id', $id);
		$this->db->delete('tat_designations');
		
	}
	
	public function ajax_is_designation_information($id) {
	
		$sql = 'SELECT * FROM tat_designations WHERE department_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function ajax_designation_information($id) {
	
		$sql = 'SELECT * FROM tat_designations WHERE sub_department_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

    public function get_company_designations($company_id) {
	
		$sql = 'SELECT * FROM tat_designations WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

	public function ajax_company_designation_info($id) {
	
		$sql = 'SELECT * FROM tat_designations WHERE company_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

}
?>