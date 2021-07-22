<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
	 public function read_employee_information($id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE user_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function check_employee_id($id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}	

	public function check_employee_username($id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE username = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}
	
	public function check_employee_email($id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE email = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}
	
	public function add($data){
		$this->db->insert('tat_employees', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	
	public function update_record($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	
	public function delete_record($id){
		$this->db->where('user_id', $id);
		$this->db->delete('tat_employees');
		
	}
	
	
	public function get_employees() {
		return $this->db->get("tat_employees");
	  }
  
	  public function get_employees_for_other($cid) {
		  
		  $sql = 'SELECT * FROM tat_employees WHERE user_id != ? and company_id = ?';
		  $binds = array(1,$cid);
		  $query = $this->db->query($sql, $binds);
		  return $query;
	  }
	  
	  public function get_employees_for_location($cid) {
		  
		  $sql = 'SELECT * FROM tat_employees WHERE user_id != ? and location_id = ?';
		  $binds = array(1,$cid);
		  $query = $this->db->query($sql, $binds);
		  return $query;
	  }
  
	  public function get_company_employees_flt($cid) {
		  
		  $sql = 'SELECT * FROM tat_employees WHERE company_id = ?';
		  $binds = array($cid);
		  $query = $this->db->query($sql, $binds);
		  return $query;
	  }
	  
	  public function get_company_location_employees_flt($cid,$lid) {
		  
		  $sql = 'SELECT * FROM tat_employees WHERE company_id = ? and location_id = ?';
		  $binds = array($cid,$lid);
		  $query = $this->db->query($sql, $binds);
		  return $query;
	  }
	  
	  public function get_company_location_department_employees_flt($cid,$lid,$dep_id) {
		  
		  $sql = 'SELECT * FROM tat_employees WHERE company_id = ? and location_id = ? and department_id = ?';
		  $binds = array($cid,$lid,$dep_id);
		  $query = $this->db->query($sql, $binds);
		  return $query;
	  }
	  
	  public function get_company_location_department_designation_employees_flt($cid,$lid,$dep_id,$des_id) {
		  
		  $sql = 'SELECT * FROM tat_employees WHERE company_id = ? and location_id = ? and department_id = ? and designation_id = ?';
		  $binds = array($cid,$lid,$dep_id,$des_id);
		  $query = $this->db->query($sql, $binds);
		  return $query;
	  }
	  
	  
	  public function get_total_employees() {
		$query = $this->db->get("tat_employees");
		return $query->num_rows();
	  }
		   

	public function basic_info($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function change_password($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	
	public function profile_picture($data, $id){
		$this->db->where('user_id', $id);
		if( $this->db->update('tat_employees',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	

	
	public function location_info_add($data){
		$this->db->insert('tat_employee_location', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	
	public function location_info_update($data, $id){
		$this->db->where('office_location_id', $id);
		if( $this->db->update('tat_employee_location',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	

	
	public function set_employee_contacts($id) {
		
		$sql = 'SELECT * FROM tat_employee_contacts WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	    return $query;
	}
	
	
	public function set_employee_location($id) {
	
		$sql = 'SELECT * FROM tat_employee_location WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);

	  	return $query;
	}
	
	 

	public function delete_contact_record($id){
		$this->db->where('contact_id', $id);
		$this->db->delete('tat_employee_contacts');
		
	}
	

	public function delete_location_record($id){
		$this->db->where('office_location_id', $id);
		$this->db->delete('tat_employee_location');
		
	}
	
	 public function read_location_information($id) {
	
		$sql = 'SELECT * FROM tat_employee_location WHERE office_location_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function record_count() {
        return $this->db->count_all("tat_employees");
    }

	public function contact_info_add($data){
		$this->db->insert('tat_employee_contacts', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function contact_info_update($data, $id){
		$this->db->where('contact_id', $id);
		if( $this->db->update('tat_employee_contacts',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	
	public function check_employee_contact_current($id) {
	   
	    $sql = 'SELECT * FROM tat_employee_contacts WHERE employee_id = ? and contact_type = ? limit 1';
		$binds = array($id,'current');
		$query = $this->db->query($sql, $binds);
	
		return $query;		
	}
	
	
	public function check_employee_contact_permanent($id) {
	
		$sql = 'SELECT * FROM tat_employee_contacts WHERE employee_id = ? and contact_type = ? limit 1';
		$binds = array($id,'permanent');
		$query = $this->db->query($sql, $binds);
		
		return $query;		
	}
	

	 public function read_contact_info_current($id) {
	
		$sql = 'SELECT * FROM tat_employee_contacts WHERE contact_id = ? and contact_type = ? limit 1';
		$binds = array($id,'current');
		$query = $this->db->query($sql, $binds);
	
		$row = $query->row();
		return $row;
		
	}
	
	 public function read_contact_info_permanent($id) {
	
		$sql = 'SELECT * FROM tat_employee_contacts WHERE contact_id = ? and contact_type = ? limit 1';
		$binds = array($id,'permanent');
		$query = $this->db->query($sql, $binds);
		
		$row = $query->row();
		return $row;
	}
	
	
	public function contract_info_update($data, $id){
		$this->db->where('contract_id', $id);
		if( $this->db->update('tat_employee_contract',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function get_employee_by_department($cid) {
	
		$sql = 'SELECT * FROM tat_employees WHERE department_id = ?';
		$binds = array($cid);
		$query = $this->db->query($sql, $binds);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function record_count_company_employees($cid) {
	
		$sql = 'SELECT * FROM tat_employees WHERE company_id = ?';
		$binds = array($cid);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}

	public function record_count_company_location_employees($cid,$lid) {
	
		$sql = 'SELECT * FROM tat_employees WHERE company_id = ? and location_id= ?';
		$binds = array($cid,$lid);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}

	public function record_count_company_location_department_employees($cid,$lid,$dep_id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE company_id = ? and location_id= ? and department_id= ?';
		$binds = array($cid,$lid,$dep_id);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}

	public function record_count_company_location_department_designation_employees($cid,$lid,$dep_id,$des_id) {
	
		$sql = 'SELECT * FROM tat_employees WHERE company_id = ? and location_id= ? and department_id= ? and designation_id= ?';
		$binds = array($cid,$lid,$dep_id,$des_id);
		$query = $this->db->query($sql, $binds);
		return $query->num_rows();
	}

    public function fetch_all_employees($limit, $start) {
		$session = $this->session->userdata('username');
        $this->db->limit($limit, $start);
		$this->db->order_by("designation_id asc");
		//$this->db->where("user_role_id!=",1);
		$user_info = $this->Tat_model->read_user_info($session['user_id']);
		if($user_info[0]->user_role_id!=1){
			$this->db->where("company_id=",$user_info[0]->company_id);
		}
        $query = $this->db->get("tat_employees");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
 

   public function fetch_all_company_employees_flt($limit, $start,$cid) {
		$session = $this->session->userdata('username');
        $this->db->limit($limit, $start);
		$this->db->order_by("designation_id asc");
		$this->db->where("company_id=",$cid);
        $query = $this->db->get("tat_employees");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

   public function fetch_all_company_location_employees_flt($limit, $start,$cid,$lid) {
		$session = $this->session->userdata('username');
        $this->db->limit($limit, $start);
		$this->db->order_by("designation_id asc");
		$this->db->where("company_id=",$cid);
		$this->db->where("location_id=",$lid);
        $query = $this->db->get("tat_employees");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
  
   public function fetch_all_company_location_department_employees_flt($limit, $start,$cid,$lid,$dep_id) {
		$session = $this->session->userdata('username');
        $this->db->limit($limit, $start);
		$this->db->order_by("designation_id asc");
		$this->db->where("company_id=",$cid);
		$this->db->where("location_id=",$lid);
		$this->db->where("department_id=",$dep_id);
        $query = $this->db->get("tat_employees");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   

   public function fetch_all_company_location_department_designation_employees_flt($limit, $start,$cid,$lid,$dep_id,$des_id) {
		$session = $this->session->userdata('username');
        $this->db->limit($limit, $start);
		$this->db->order_by("designation_id asc");
		$this->db->where("company_id=",$cid);
		$this->db->where("location_id=",$lid);
		$this->db->where("department_id=",$dep_id);
		$this->db->where("designation_id=",$des_id);
        $query = $this->db->get("tat_employees");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
   public function des_fetch_all_employees($limit, $start) {
		$sql = 'SELECT * FROM tat_employees order by designation_id asc limit ?, ?';
		$binds = array($limit,$start);
		$query = $this->db->query($sql, $binds);
      //  $query = $this->db->get("tat_employees");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   
}
?>