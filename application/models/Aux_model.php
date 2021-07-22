<?php
	//Aux Model - Auxilary model to accomodate extra functions that require a model approach. 
class Aux_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function is_logged_in($id)
	{
		$CI =& get_instance();
		$is_logged_in = $CI->session->userdata($id);
		return $is_logged_in;       
	}

    public function login_update_record($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
 
	 public function read_location_info($id) {
	
		$sql = 'SELECT * FROM tat_departments WHERE department_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		$condition = "location_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('tat_office_location');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
		
	public function read_employee_info($id) {
	
		$sql = 'SELECT * FROM tat_departments WHERE department_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		$condition = "user_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('tat_employees');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
		
	}
	
	public function read_user_info($id) {
	
		$sql = 'SELECT * FROM tat_departments WHERE department_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		$condition = "user_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('tat_employees');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
		
	}
			
	public function generate_random_string($length = 7) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
}
?>