<?php

// Expense Model: a separate model introducing expense management intended as an extension for the finance model.

defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_model extends CI_Model
	{
 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function read_expense_information($id) {
	
		$sql = 'SELECT * FROM tat_expenses WHERE expense_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		return $query->result();
	}
	
	public function read_expense_type_information($id) {
	
		$sql = 'SELECT * FROM tat_expense_type WHERE expense_type_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

    public function all_expense_types()
	{
	  $query = $this->db->query("SELECT * from tat_expense_type");
  	  return $query->result();
	}
 
	public function get_expenses() {
	  return $this->db->get("tat_expenses");
	}
	

	public function get_employee_expenses() {
	  	
		$session = $this->session->userdata('username');
		$sql = 'SELECT * FROM tat_expenses WHERE employee_id = ?';
		$binds = array($session['user_id']);
		$query = $this->db->query($sql, $binds);
		
  	 	return $query;
	}
	
	
	public function get_total_expenses() {
	  $query = $this->db->query("SELECT SUM(amount) as exp_amount FROM tat_expenses");
  	  return $query->result();
	}
	 


	public function add($data){
		$this->db->insert('tat_expenses', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

    public function update_record($data, $id){
		$this->db->where('expense_id', $id);
		if( $this->db->update('tat_expenses',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	

	public function update_record_no_logo($data, $id){
		$this->db->where('expense_id', $id);
		if( $this->db->update('tat_expenses',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	

	public function delete_record($id){
		$this->db->where('expense_id', $id);
		$this->db->delete('tat_expenses');
		
	}

}
?>