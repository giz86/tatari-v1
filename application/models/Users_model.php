<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Users_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_users() {
	  return $this->db->get("tat_users");
	}
		
	public function get_all_users() {
	  $query = $this->db->get("tat_users");
	  return $query->result();
	}
	 
	public function read_users_info($id) {
	
		$sql = 'SELECT * FROM tat_users WHERE user_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	// check email address
	public function check_user_email($email) {
	
		$sql = 'SELECT * FROM tat_users WHERE email = ?';
		$binds = array($email);
		$query = $this->db->query($sql, $binds);
		
		return $query;
	}
	

	public function add($data){
		$this->db->insert('tat_users', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
		

	public function delete_record($id){
		$this->db->where('user_id', $id);
		$this->db->delete('tat_users');
		
	}
	

	public function update_record($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_users',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	

	public function update_record_no_photo($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_users',$data)) {
			return true;
		} else {
			return false;
		}		
	}
}
?>