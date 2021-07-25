<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transfers_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_transfers() {
	  return $this->db->get("tat_employee_transfer");
	}
	
	public function get_employee_transfers($id) {
	 	
		$sql = 'SELECT * FROM tat_employee_transfer WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}

	public function get_company_transfers($company_id) {
	
		$sql = 'SELECT * FROM tat_employee_transfer WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	 
	public function read_transfer_information($id) {
	
		$sql = 'SELECT * FROM tat_employee_transfer WHERE transfer_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	

	public function add($data){
		$this->db->insert('tat_employee_transfer', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_record($id){
		$this->db->where('transfer_id', $id);
		$this->db->delete('tat_employee_transfer');
		
	}
	
	// Function to update record in table
	public function update_record($data, $id){
		$this->db->where('transfer_id', $id);
		if( $this->db->update('tat_employee_transfer',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>