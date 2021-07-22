<?php
// Login Model -  Model for Login and Session management for backend/admin system
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Login_model extends CI_Model
	{

     public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function read_setting_info($id) {
	
		$sql = 'SELECT * FROM tat_system_setting WHERE setting_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function login($data) {
	
		$system = $this->read_setting_info(1);
		if($system[0]->employee_login_id=='username'):		
			$sql = 'SELECT * FROM tat_employees WHERE username = ? AND is_active = ?';
			$binds = array($data['username'],1);
			$query = $this->db->query($sql, $binds);
			
		else:
			$sql = 'SELECT * FROM tat_employees WHERE email = ? AND is_active = ?';
			$binds = array($data['username'],1);
			$query = $this->db->query($sql, $binds);
			
		endif;		
		
	    $options = array('cost' => 12);
		$password_hash = password_hash($data['password'], PASSWORD_BCRYPT, $options);
		if ($query->num_rows() > 0) {
			$rw_password = $query->result();
			if(password_verify($data['password'],$rw_password[0]->password)){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function read_user_information($username) {
	
		$system = $this->read_setting_info(1);
		if($system[0]->employee_login_id=='username'):
			$sql = 'SELECT * FROM tat_employees WHERE username = ?';
			$binds = array($username);
			$query = $this->db->query($sql, $binds);
		else:
			$sql = 'SELECT * FROM tat_employees WHERE email = ?';
			$binds = array($username);
			$query = $this->db->query($sql, $binds);
		endif;
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function read_user_info_session_id($user_id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE user_id = ?';
		$binds = array($user_id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

}
?>