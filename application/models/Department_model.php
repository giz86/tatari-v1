<?php
// Department Model - Base

	defined('BASEPATH') OR exit('No direct script access allowed');
	class department_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	public function get_departments() {
	  return $this->db->get("tat_departments");
	}
	public function get_sub_departments() {
	  return $this->db->get("tat_sub_departments");
	}
	 
	
	public function all_departments()
	{
	  $query = $this->db->query("SELECT * from tat_departments");
  	  return $query->result();
	}

    public function get_company_departments($company_id) {
	
		$sql = 'SELECT * FROM tat_departments WHERE company_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

    public function get_department_subdepartments($company_id) {
	
		$sql = 'SELECT * FROM tat_sub_departments WHERE department_id = ?';
		$binds = array($company_id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

	 public function read_department_information($id) {
	
		$sql = 'SELECT * FROM tat_departments WHERE department_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function read_sub_department_info($id) {
	
		$sql = 'SELECT * FROM tat_sub_departments WHERE sub_department_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
    public function add($data){
		$this->db->insert('tat_departments', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_sub($data){
		$this->db->insert('tat_sub_departments', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	 public function ajax_location_information($id) {
	
		$sql = 'SELECT * FROM tat_office_location WHERE company_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	 public function ajax_company_location_information($id) {
	
		$sql = 'SELECT * FROM tat_office_location WHERE company_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	 public function ajax_location_departments_information($id) {
	
		$sql = 'SELECT * FROM tat_departments WHERE location_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	 public function ajax_company_employee_info($id) {
		$sql = "SELECT * FROM tat_employees WHERE company_id = ? and user_role_id!='1'";
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

    public function update_record($data, $id){
		$this->db->where('department_id', $id);
		$data = $this->security->xss_clean($data);
		if( $this->db->update('tat_departments',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function update_sub_record($data, $id){
		$this->db->where('sub_department_id', $id);
		$data = $this->security->xss_clean($data);
		if( $this->db->update('tat_sub_departments',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function delete_record($id){
		$this->db->where('department_id', $id);
		$this->db->delete('tat_departments');
		
	}

	public function delete_sub_record($id){
		$this->db->where('sub_department_id', $id);
		$this->db->delete('tat_sub_departments');
		
	}
	
	public function is_department_head($id) {

        $condition = "employee_id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('tat_departments');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
?>