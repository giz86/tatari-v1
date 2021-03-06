<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class roles_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_user_roles()
	{
	  return $this->db->get("tat_user_roles");
	}
	 
	 public function read_role_information($id) {
	
		$sql = 'SELECT * FROM tat_user_roles WHERE role_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function add($data){
		$this->db->insert('tat_user_roles', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	

	public function delete_record($id){
		$this->db->where('role_id', $id);
		$this->db->delete('tat_user_roles');
		
	}

	public function update_record($data, $id){
		$this->db->where('role_id', $id);
		if( $this->db->update('tat_user_roles',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	

	public function all_user_roles()
	{
	  $query = $this->db->query("SELECT * from tat_user_roles");
  	  return $query->result();
	}
}
?>