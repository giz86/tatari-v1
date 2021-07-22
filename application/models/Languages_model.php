<?php
// Languages Model - Base /Derivative for every visual string on View
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Languages_model extends CI_Model
	{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_languages()
	{
	  return $this->db->get("tat_languages");
	}
	 
	 public function read_language_information($id) {
	
		$sql = 'SELECT * FROM tat_languages WHERE language_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}	

	public function active_lang_record($data, $id){
		$this->db->where('language_id', $id);
		if( $this->db->update('tat_languages',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function add($data){
		$this->db->insert('tat_languages', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function update_record($data, $id){
		$this->db->where('language_id', $id);
		if( $this->db->update('tat_languages',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function delete_record($id){
		$this->db->where('language_id', $id);
		$this->db->delete('tat_languages');
		
	}
	
}
?>