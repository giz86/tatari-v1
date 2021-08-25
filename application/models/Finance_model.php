<?php

/** 
 * Finance Model: This model contains models and schema for the Finance (2nd) Module of Tatari System.
 * It will manage the ledger account along with transactions on different accounts.
 * 
**/

defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_model extends CI_Model {
 
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }


    // Read from DB - Finance related tables
 
	public function get_bankcash() {
	  return $this->db->get("tat_finance_bankcash");
	}


	public function get_deposit() {
	  return $this->db->query("SELECT * from tat_finance_transaction where transaction_type = 'income'");
	}
	

	public function get_expense() {
	  return $this->db->query("SELECT * from tat_finance_transaction where transaction_type = 'expense'");
	}
	

	public function get_invoice_payments() {
	  return $this->db->query("SELECT * from tat_finance_transaction where invoice_id != ''");
	}
	

	public function get_transfer() {
	  return $this->db->get("tat_finance_transfer");
	}
	

	public function get_transaction() {
	  return $this->db->query("SELECT * from tat_finance_transaction order by transaction_id desc");
	}


    public function all_payees()
	{
	  $query = $this->db->query("SELECT * from tat_finance_payees");
  	  return $query->result();
	}


    public function get_bankwise_transactions($id)
	{
		$sql = "SELECT transaction_date,dr_cr,amount,account_id,transaction_type,description,IF(dr_cr='dr',amount,NULL) as debit,IF(dr_cr='cr',amount,NULL) as credit FROM tat_finance_transaction WHERE account_id='$id'";
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

    public function get_payers()
	{
	  return $this->db->get("tat_finance_payers");
	}


	public function get_payees()
	{
	  return $this->db->get("tat_finance_payees");
	}
	
	public function all_bank_cash()
	{
	  $query = $this->db->query("SELECT * from tat_finance_bankcash");
  	  return $query->result();
	}


	public function all_payers()
	{
	  $query = $this->db->query("SELECT * from tat_finance_payers");
  	  return $query->result();
	}


    public function read_expense_information($id) {
	
		$sql = 'SELECT * FROM tat_finance_expense WHERE expense_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function read_transfer_information($id) {
	
		$sql = 'SELECT * FROM tat_finance_transfer WHERE transfer_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
		 
	public function read_bankcash_information($id) {
	
		$sql = 'SELECT * FROM tat_finance_bankcash WHERE bankcash_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function read_transaction_information($id) {
	
		$sql = 'SELECT * FROM tat_finance_transaction WHERE transaction_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


	 public function ajax_company_expense_types_info($id) {
	
		$sql = 'SELECT * FROM tat_expense_type WHERE company_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


    public function read_payer_info($id) {
	
		$sql = 'SELECT * FROM tat_finance_payers WHERE payer_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

    
    public function read_payee_info($id) {
	
		$sql = 'SELECT * FROM tat_finance_payees WHERE payee_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}


	public function read_direct_invoice_transaction($id) {
	
		$sql = 'SELECT * FROM tat_finance_transaction WHERE invoice_type = ? and invoice_id = ?';
		$binds = array('direct',$id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}
	

	public function read_transaction_by_bank_info($id) {
	
		$sql = 'SELECT * FROM tat_finance_transaction WHERE account_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

    public function read_invoice_transaction($id) {
	
		$sql = 'SELECT * FROM tat_finance_transaction WHERE invoice_type = ? and invoice_id = ?';
		$binds = array('customer',$id);
		$query = $this->db->query($sql, $binds);
		return $query;
	}

    public function all_income_categories_list()
	{
	  $query = $this->db->query("SELECT * from tat_income_categories");
  	  return $query->result();
	}
	

	public function get_all_payment_method() {
	 	$query = $this->db->query("SELECT * from tat_payment_method");
		return $query->result();
	}


	public function read_income_category($id) {
	
		$sql = 'SELECT * FROM tat_income_categories WHERE category_id = ?';
		$binds = array($id);
		$query = $this->db->query($sql, $binds);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	


    // Insert Records to DB : Finance related tables

	public function add_payer_record($data){
		$this->db->insert('tat_finance_payers', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	

	public function add_payee_record($data){
		$this->db->insert('tat_finance_payees', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

    public function add_bankcash($data){
		$this->db->insert('tat_finance_bankcash', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	

	public function add_deposit($data){
		$this->db->insert('tat_finance_deposit', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	

	public function add_expense($data){
		$this->db->insert('tat_finance_expense', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	

	public function add_transfer($data){
		$this->db->insert('tat_finance_transfer', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

    public function add_transactions($data){
		$this->db->insert('tat_finance_transaction', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


    // Update Records on Finance related tabels
	
	public function update_transaction_record($data, $id){
		$this->db->where('transaction_id', $id);
		if( $this->db->update('tat_finance_transaction',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	

	public function update_expense_record($data, $id){
		$this->db->where('expense_id', $id);
		if( $this->db->update('tat_finance_expense',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	

	public function update_transfer_record($data, $id){
		$this->db->where('transfer_id', $id);
		if( $this->db->update('tat_finance_transfer',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	
	public function update_payee_record($data, $id){
		$this->db->where('payee_id', $id);
		if( $this->db->update('tat_finance_payees',$data)) {
			return true;
		} else {
			return false;
		}		
	}


    public function update_payer_record($data, $id){
		$this->db->where('payer_id', $id);
		if( $this->db->update('tat_finance_payers',$data)) {
			return true;
		} else {
			return false;
		}		
	}

    public function update_bankcash_record($data, $id){
		$this->db->where('bankcash_id', $id);
		if( $this->db->update('tat_finance_bankcash',$data)) {
			return true;
		} else {
			return false;
		}		
	}
	


    // Delete records from finance related tables.

	public function delete_bankcash_record($id){
		$this->db->where('bankcash_id', $id);
		$this->db->delete('tat_finance_bankcash');
		
	}
	

	public function delete_transaction_record($id){
		$this->db->where('transaction_id', $id);
		$this->db->delete('tat_finance_transaction');
		
	}
	

	public function delete_expense_record($id){
		$this->db->where('expense_id', $id);
		$this->db->delete('tat_finance_expense');
		
	}

    public function delete_payer_record($id){
		$this->db->where('payer_id', $id);
		$this->db->delete('tat_finance_payers');
		
	}

	public function delete_payee_record($id){
		$this->db->where('payee_id', $id);
		$this->db->delete('tat_finance_payees');
		
	}
	
    public function delete_transfer_record($id){
		$this->db->where('transfer_id', $id);
		$this->db->delete('tat_finance_transfer');
		
	}
	
	public function delete_transaction_deposit_record($id){
		$this->db->where('deposit_id', $id);
		$this->db->delete('tat_finance_transactions');
		
	}
	

	public function delete_transaction_expense_record($id){
		$this->db->where('expense_id', $id);
		$this->db->delete('tat_finance_transactions');
		
	}
	
	public function delete_transaction_transfer_record($id){
		$this->db->where('transfer_id', $id);
		$this->db->delete('tat_finance_transactions');
		
	}
	


    // Fiscal Reporting - filtering


    public function get_ledger_accounts($start_date,$end_date)
	{
		$sql = "SELECT transaction_date,dr_cr,amount,account_id,transaction_type,description,IF(dr_cr='dr',amount,NULL) as debit,IF(dr_cr='cr',amount,NULL) as credit FROM tat_finance_transaction where DATE(transaction_date) BETWEEN ? AND ?";
		$binds = array($start_date,$end_date);
		$query = $this->db->query($sql, $binds);
		return $query;
	}


	public function get_income_expense_search($start_date,$end_date){
			
			$sql = 'SELECT * FROM `tat_finance_transaction` where DATE(transaction_date) BETWEEN ? AND ?';
			$binds = array($start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
	}

	public function get_expense_search($start_date,$end_date,$type_id,$company_id){
		if($type_id=='none') {
			
			$sql = 'SELECT * FROM `tat_finance_transaction` where transaction_type = "eexpense" and DATE(transaction_date) BETWEEN ? AND ?';
			$binds = array($start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
			
		} else if($type_id==0 && $company_id ==0) {
			
			$sql = 'SELECT * FROM `tat_finance_transaction` where transaction_type = "expense" and DATE(transaction_date) BETWEEN ? AND ?';
			$binds = array($start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
			
		} else if($company_id!=0 && $type_id==0) {
			
			$sql = 'SELECT * FROM `tat_finance_transaction` where transaction_type = "expense" and company_id = ? and DATE(transaction_date) BETWEEN ? AND ?';
			$binds = array($company_id,$start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
		} else if($company_id!=0 && $type_id!=0) {
			
			$sql = 'SELECT * FROM `tat_finance_transaction` where transaction_type = "expense" and company_id = ? and transaction_cat_id = ? and DATE(transaction_date) BETWEEN ? AND ?';
			$binds = array($company_id,$type_id,$start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
		}
	}

	
	public function get_deposit_search($start_date,$end_date,$type_id){
		if($type_id=='none') {
			
			$sql = 'SELECT * FROM `tat_finance_transaction` where transaction_type = "iiincome" and DATE(transaction_date) BETWEEN ? AND ?';
			$binds = array($start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
			
		} else if($type_id=='all_types') {
			
			$sql = 'SELECT * FROM `tat_finance_transaction` where transaction_type = "income" and DATE(transaction_date) BETWEEN ? AND ?';
			$binds = array($start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
			
		} else if($type_id!=0 || $type_id!='all_types') {
			
			$sql = 'SELECT * FROM `tat_finance_transaction` where transaction_type = "income" and transaction_cat_id = ? and DATE(transaction_date) BETWEEN ? AND ?';
			$binds = array($type_id, $start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
		}
	}
	
	
	public function get_transfer_search($start_date,$end_date){
		    
			$sql = "SELECT transaction_date,dr_cr,amount,account_id,payment_method_id,reference,transaction_type,description,IF(dr_cr='dr',amount,NULL) as debit,IF(dr_cr='cr',amount,NULL) as credit FROM tat_finance_transaction where transaction_type = 'transfer' and DATE(transaction_date) BETWEEN ? AND ?";
			$binds = array($start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
	}
	

	public function get_sales_report($start_date,$end_date){
			$sql = "SELECT transaction_date,dr_cr,invoice_id,amount,account_id,payment_method_id,payer_payee_id,reference,transaction_type,description,IF(dr_cr='dr',amount,NULL) as debit,IF(dr_cr='cr',amount,NULL) as credit FROM tat_finance_transaction where transaction_type = 'income' and invoice_id>0 and DATE(transaction_date) BETWEEN ? AND ?";
			$binds = array($start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
	}


    public function account_statement_search($start_date,$end_date,$account_id){

		if($account_id!=0) {
			$sql = "SELECT transaction_date,dr_cr,amount,account_id,transaction_type,description,IF(dr_cr='dr',amount,NULL) as debit,IF(dr_cr='cr',amount,NULL) as credit FROM tat_finance_transaction WHERE account_id=? AND DATE(transaction_date) BETWEEN ? AND ? order by transaction_id asc";
			
			$binds = array($account_id,$start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;		
		} else {
			$sql = "SELECT transaction_date,dr_cr,amount,account_id,transaction_type,description,IF(dr_cr='dr',amount,NULL) as debit,IF(dr_cr='cr',amount,NULL) as credit FROM tat_finance_transaction WHERE account_id=? AND DATE(transaction_date) BETWEEN ? AND ? order by transaction_id asc";
			$binds = array('AA',$start_date,$end_date);
			$query = $this->db->query($sql, $binds);
			return $query;
		}
	}
	

}
?>