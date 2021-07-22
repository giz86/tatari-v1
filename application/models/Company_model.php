<?php

// Company Model -Base
	defined('BASEPATH') OR exit('No direct script access allowed');
	class company_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_companies() {
	  return $this->db->get("tat_companies");
	}
    

    public function get_all_companies() {
        $query = $this->db->get("tat_companies");
        return $query->result();
      }

 
	  public function read_company_information($id) {
	
		$sql = 'SELECT * FROM tat_companies WHERE company_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	public function get_company_types() {
		$query = $this->db->get("tat_company_type");
		return $query->result();
	}

   
	public function get_company_single($company_id) {
	
		$sql = 'SELECT * FROM tat_companies WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	


	public function delete_record($id){
		$this->db->where('company_id', $id);
		$this->db->delete('tat_companies');
		
	}

	public function ajax_company_departments_info($id) {
	
		$condition = "company_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('tat_departments');
		$this->db->where($condition);
		$this->db->limit(100);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function read_company_type($id) {
	
		$sql = 'SELECT * FROM tat_company_type WHERE type_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	

	public function add($data){
		$this->db->insert('tat_companies', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	public function update_record($data, $id){
		$this->db->where('company_id', $id);
		if( $this->db->update('tat_companies',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function update_record_no_logo($data, $id){
		$this->db->where('company_id', $id);
		if( $this->db->update('tat_companies',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	

}
?>