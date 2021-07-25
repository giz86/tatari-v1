<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class promotion_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_promotions() {
	  return $this->db->get("tat_employee_promotions");
	}
	
	public function get_employee_promotions($id) {
	 	
		$sql = 'SELECT * FROM tat_employee_promotions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}

	public function get_company_promotions($company_id) {
	
		$sql = 'SELECT * FROM tat_employee_promotions WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	 
	 public function read_promotion_information($id) {
	
		$sql = 'SELECT * FROM tat_employee_promotions WHERE promotion_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	
	public function add($data){
		$this->db->insert('tat_employee_promotions', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	

	public function delete_record($id){
		$this->db->where('promotion_id', $id);
		$this->db->delete('tat_employee_promotions');
		
	}
	

	public function update_record($data, $id){
		$this->db->where('promotion_id', $id);
		if( $this->db->update('tat_employee_promotions',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>