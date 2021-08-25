<?php

/**
 * Tax Model: an extension of Invoices model to determine the tax types for the purchase invoice.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Tax_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	 	 
	public function get_taxes() {
	  return $this->db->get("tat_tax_types");
	}

    public function get_all_taxes() {
        $query = $this->db->query("SELECT * from tat_tax_types");
          return $query->result();
      }
	
	public function read_tax_information($id) {
	
		$condition = "tax_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('tat_tax_types');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function add_tax_record($data){
		$this->db->insert('tat_tax_types', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

    public function update_tax_record($data, $id){
		$this->db->where('tax_id', $id);
		if( $this->db->update('tat_tax_types',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	public function delete_tax_record($id){
		$this->db->where('tax_id', $id);
		$this->db->delete('tat_tax_types');
		
	}
	
}
?>