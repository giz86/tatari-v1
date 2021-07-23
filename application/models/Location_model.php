<?php
// Location Model - handles location related data management
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Location_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_locations()
	{
	  return $this->db->get("tat_office_location");
	}

	public function all_office_locations() {
        $query = $this->db->query("SELECT * from tat_office_location");
          return $query->result();
      }
	 
	 public function read_location_information($id) {
	
		$sql = 'SELECT * FROM tat_office_location WHERE location_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	public function get_company_office_location($company_id) {
	
		$sql = 'SELECT * FROM tat_office_location WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	
	public function add($data){
		$this->db->insert('tat_office_location', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

    public function update_record($data, $id){
		$this->db->where('location_id', $id);
		if( $this->db->update('tat_office_location',$data)) {
			return true;
		} else {
			return false;
		}		
	}

    public function update_record_no_logo($data, $id){
		$this->db->where('location_id', $id);
		if( $this->db->update('tat_office_location',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function delete_record($id){
		$this->db->where('location_id', $id);
		$this->db->delete('tat_office_location');
		
	}
	
}
?>