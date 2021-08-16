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
      
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

   public function get_attendance_employees() {
		
	$sql = 'SELECT * FROM tat_employees WHERE is_active = ?';
	$binds = array(1);
	$query = $this->db->query($sql, $binds);
	
	return $query;
	}

	public function get_attendance_location_employees($location_id) {
	
	$sql = 'SELECT * FROM tat_employees WHERE location_id = ? and is_active = ?';
	$binds = array($location_id,1);
	$query = $this->db->query($sql, $binds);
	
	return $query;
	}


	public function all_office_shifts() {
		$query = $this->db->query("SELECT * from tat_office_shift");
		  return $query->result();
	  }

	//   Payroll Related DB calls


	public function count_employee_allowances_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_allowances WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}

	public function count_employee_commissions_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_commissions WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}


	public function count_employee_statutory_deductions_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_statutory_deductions WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}


	public function count_employee_other_payments_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_other_payments WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}

	public function count_employee_overtime_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_overtime WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	

	public function count_employee_deductions_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_loan WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}

	public function count_employee_allowances($id) {
	
		$sql = 'SELECT * FROM tat_salary_allowances WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}

	public function count_employee_commissions($id) {
	
		$sql = 'SELECT * FROM tat_salary_commissions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}

	public function count_employee_other_payments($id) {
	
		$sql = 'SELECT * FROM tat_salary_other_payments WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}

	public function count_employee_statutory_deductions($id) {
	
		$sql = 'SELECT * FROM tat_salary_statutory_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}

	public function count_employee_overtime($id) {
	
		$sql = 'SELECT * FROM tat_salary_overtime WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	
	
	public function count_employee_deductions($id) {
	
		$sql = 'SELECT * FROM tat_salary_loan_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query->num_rows();
	}
	

	public function read_salary_allowances($id) {
	
		$sql = 'SELECT * FROM tat_salary_allowances WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function get_employees_payslip() {
		
		$sql = 'SELECT * FROM tat_employees WHERE user_role_id != ?';
		$binds = array(1);
		$query = $this->db->query($sql, $binds);
	    return $query;
	}


	  public function set_employee_allowances($id) {
	
		$sql = 'SELECT * FROM tat_salary_allowances WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}


	public function set_employee_commissions($id) {
	
		$sql = 'SELECT * FROM tat_salary_commissions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}


	public function set_employee_statutory_deductions($id) {
	
		$sql = 'SELECT * FROM tat_salary_statutory_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}


	public function set_employee_other_payments($id) {
	
		$sql = 'SELECT * FROM tat_salary_other_payments WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}


	public function set_employee_overtime($id) {
	
		$sql = 'SELECT * FROM tat_salary_overtime WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	

	public function set_employee_deductions($id) {
	
		$sql = 'SELECT * FROM tat_salary_loan_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}


	public function set_employee_allowances_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_allowances WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	

	public function set_employee_commissions_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_commissions WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}


	public function set_employee_other_payments_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_other_payments WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	

	public function set_employee_statutory_deductions_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_statutory_deductions WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}


	public function set_employee_overtime_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_overtime WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}
	

	public function set_employee_deductions_payslip($id) {
	
		$sql = 'SELECT * FROM tat_salary_payslip_loan WHERE payslip_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	  	return $query;
	}


	public function read_salary_commissions($id) {
	
		$sql = 'SELECT * FROM tat_salary_commissions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


	public function read_salary_other_payments($id) {
	
		$sql = 'SELECT * FROM tat_salary_other_payments WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	

	public function read_salary_statutory_deductions($id) {
	
		$sql = 'SELECT * FROM tat_salary_statutory_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


	public function read_salary_overtime($id) {
	
		$sql = 'SELECT * FROM tat_salary_overtime WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


	public function read_salary_loan_deductions($id) {
	
		$sql = 'SELECT * FROM tat_salary_loan_deductions WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


	public function read_single_loan_deductions($id) {
	
		$sql = 'SELECT * FROM tat_salary_loan_deductions WHERE loan_deduction_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


	public function get_month_diff($start, $end = FALSE) {
		$end OR $end = time();
		$start = new DateTime($start);
		$end   = new DateTime($end);
		$diff  = $start->diff($end);
		return $diff->format('%y') * 12 + $diff->format('%m');
	}
	

	public function read_single_salary_allowance($id) {
	
		$sql = 'SELECT * FROM tat_salary_allowances WHERE allowance_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function read_single_salary_commissions($id) {
	
		$sql = 'SELECT * FROM tat_salary_commissions WHERE salary_commissions_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function read_single_salary_statutory_deduction($id) {
	
		$sql = 'SELECT * FROM tat_salary_statutory_deductions WHERE statutory_deductions_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	public function read_single_salary_other_payment($id) {
	
		$sql = 'SELECT * FROM tat_salary_other_payments WHERE other_payments_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function read_salary_overtime_record($id) {
	
		$sql = 'SELECT * FROM tat_salary_overtime WHERE salary_overtime_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function add_salary_allowances($data){
		$this->db->insert('tat_salary_allowances', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_commissions($data){
		$this->db->insert('tat_salary_commissions', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_statutory_deductions($data){
		$this->db->insert('tat_salary_statutory_deductions', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_other_payments($data){
		$this->db->insert('tat_salary_other_payments', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_loan($data){
		$this->db->insert('tat_salary_loan_deductions', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_salary_overtime($data){
		$this->db->insert('tat_salary_overtime', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function salary_allowance_update_record($data, $id){
		$this->db->where('allowance_id', $id);
		if( $this->db->update('tat_salary_allowances',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function salary_commissions_update_record($data, $id){
		$this->db->where('salary_commissions_id', $id);
		if( $this->db->update('tat_salary_commissions',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function salary_statutory_deduction_update_record($data, $id){
		$this->db->where('statutory_deductions_id', $id);
		if( $this->db->update('tat_salary_statutory_deductions',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function salary_other_payment_update_record($data, $id){
		$this->db->where('other_payments_id', $id);
		if( $this->db->update('tat_salary_other_payments',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function salary_loan_update_record($data, $id){
		$this->db->where('loan_deduction_id', $id);
		if( $this->db->update('tat_salary_loan_deductions',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function salary_overtime_update_record($data, $id){
		$this->db->where('salary_overtime_id', $id);
		if( $this->db->update('tat_salary_overtime',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function all_education_level() {
		$query = $this->db->query("SELECT * from tat_qualification_education_level");
		  return $query->result();
	  }
	  

	public function all_document_types() {
		$query = $this->db->query("SELECT * from tat_document_type");
		  return $query->result();
	  }


	  public function set_employee_documents($id) {
	
		$sql = 'SELECT * FROM tat_employee_documents WHERE employee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
	    return $query;
	}

	  public function read_education_information($id) {
	
		$sql = 'SELECT * FROM tat_qualification_education_level WHERE education_level_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function document_info_update($data, $id){
		$this->db->where('document_id', $id);
		if( $this->db->update('tat_employee_documents',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	
	public function document_info_add($data){
		$this->db->insert('tat_employee_documents', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}		
	}

	
		public function read_contact_information($id) {

			$sql = 'SELECT * FROM tat_employee_contacts WHERE contact_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
					
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
		

			public function read_document_information($id) {
		
			$sql = 'SELECT * FROM tat_employee_documents WHERE document_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
		
		
		public function set_employee_qualification($id) {
	
			$sql = 'SELECT * FROM tat_employee_qualification WHERE employee_id = ?';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			return $query;
		}
		

		public function set_employee_experience($id) {
		
			$sql = 'SELECT * FROM tat_employee_work_experience WHERE employee_id = ?';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
	
			return $query;
		}
		

		public function set_employee_bank_account($id) {
		
			$sql = 'SELECT * FROM tat_employee_bankaccount WHERE employee_id = ?';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			  return $query;
		}


		 public function get_employee_bank_account_last($id) {
		
			$sql = 'SELECT * FROM tat_employee_bankaccount WHERE employee_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}

		public function set_employee_contract($id) {
		
			$sql = 'SELECT * FROM tat_employee_contract WHERE employee_id = ?';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			 return $query;
		}
		
		public function set_employee_shift($id) {
		
			$sql = 'SELECT * FROM tat_employee_shift WHERE employee_id = ?';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			  return $query;
		}
		

		public function set_employee_leave($id) {
		
			$sql = 'SELECT * FROM tat_employee_leave WHERE employee_id = ?';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			return $query;
		}
				

		 public function read_document_type_information($id) {
		
			$sql = 'SELECT * FROM tat_document_type WHERE document_type_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
		
		
		
		public function read_shift_information($id) {
		
			$sql = 'SELECT * FROM tat_office_shift WHERE office_shift_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
		
		
			public function read_qualification_information($id) {
		
			$sql = 'SELECT * FROM tat_employee_qualification WHERE qualification_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}


		public function qualification_info_add($data){
			$this->db->insert('tat_employee_qualification', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}		
		}
		
		
		public function qualification_info_update($data, $id){
			$this->db->where('qualification_id', $id);
			if( $this->db->update('tat_employee_qualification',$data)) {
				return true;
			} else {
				return false;
			}		
		}
		
	
		public function work_experience_info_add($data){
			$this->db->insert('tat_employee_work_experience', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}		
		}
		
		
		public function work_experience_info_update($data, $id){
			$this->db->where('work_experience_id', $id);
			if( $this->db->update('tat_employee_work_experience',$data)) {
				return true;
			} else {
				return false;
			}		
		}
		
	
		public function bank_account_info_add($data){
			$this->db->insert('tat_employee_bankaccount', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}		
		}
	
		public function security_level_info_add($data){
			$this->db->insert('tat_employee_security_level', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}		
		}
		

		public function bank_account_info_update($data, $id){
			$this->db->where('bankaccount_id', $id);
			if( $this->db->update('tat_employee_bankaccount',$data)) {
				return true;
			} else {
				return false;
			}		
		}
		

		public function security_level_info_update($data, $id){
			$this->db->where('security_level_id', $id);
			if( $this->db->update('tat_employee_security_level',$data)) {
				return true;
			} else {
				return false;
			}		
		}
		
	
		public function contract_info_add($data){
			$this->db->insert('tat_employee_contract', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}		
		}
		

			public function read_work_experience_information($id) {
		
			$sql = 'SELECT * FROM tat_employee_work_experience WHERE work_experience_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
		
		
			public function read_bank_account_information($id) {
		
			$sql = 'SELECT * FROM tat_employee_bankaccount WHERE bankaccount_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
		
		 public function read_security_level_information($id) {
		
			$sql = 'SELECT * FROM tat_employee_security_level WHERE security_level_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
		
		
		 public function read_leave_information($id) {
		
			$sql = 'SELECT * FROM tat_employee_leave WHERE leave_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
			
		
		 public function read_emp_shift_information($id) {
		
			$sql = 'SELECT * FROM tat_employee_shift WHERE emp_shift_id = ? limit 1';
			$binds = array($id);
			$query = $this->db->query($sql, $binds);
			
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
		}
	
	public function all_qualification_language() {
	  $query = $this->db->query("SELECT * from tat_qualification_language");
  	  return $query->result();
	}
	
	 public function read_qualification_language_information($id) {
	
		$sql = 'SELECT * FROM tat_qualification_language WHERE language_id = ? limit 1';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	

	public function all_qualification_skill() {
	  $query = $this->db->query("SELECT * from tat_qualification_skill");
  	  return $query->result();
	} 


	public function delete_allowance_record($id){
		$this->db->where('allowance_id', $id);
		$this->db->delete('tat_salary_allowances');

	}

	public function delete_document_record($id){
		$this->db->where('document_id', $id);
		$this->db->delete('tat_employee_documents');
		
	}

	public function delete_commission_record($id){
		$this->db->where('salary_commissions_id', $id);
		$this->db->delete('tat_salary_commissions');
		
	}

	public function delete_statutory_deductions_record($id){
		$this->db->where('statutory_deductions_id', $id);
		$this->db->delete('tat_salary_statutory_deductions');
		
	}

	public function delete_other_payments_record($id){
		$this->db->where('other_payments_id', $id);
		$this->db->delete('tat_salary_other_payments');
		
	}

	public function delete_loan_record($id){
		$this->db->where('loan_deduction_id', $id);
		$this->db->delete('tat_salary_loan_deductions');
		
	}

	
	public function delete_overtime_record($id){
		$this->db->where('salary_overtime_id', $id);
		$this->db->delete('tat_salary_overtime');
		
	}


	public function delete_qualification_record($id){
		$this->db->where('qualification_id', $id);
		$this->db->delete('tat_employee_qualification');
		
	}
	
	public function delete_work_experience_record($id){
		$this->db->where('work_experience_id', $id);
		$this->db->delete('tat_employee_work_experience');
		
	}

	public function delete_bank_account_record($id){
		$this->db->where('bankaccount_id', $id);
		$this->db->delete('tat_employee_bankaccount');
		
	}
	
   
}
?>