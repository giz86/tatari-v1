<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_post_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 	
	public function get_jobs() {
	  return $this->db->get("tat_jobs");
	}
	
	public function get_jobs_candidates() {
        return $this->db->get("tat_job_applications");
	}

    public function get_jobs_single_candidate($id) {
        return $query = $this->db->query("SELECT * from tat_job_applications where job_id = '".$id."'");
    }

    public function all_active_jobs() {
        $query = $this->db->query("SELECT * from tat_jobs where status='1'");
          return $query->num_rows();
    }
  
    public function job_applications_available($job_id) {
        $query = $this->db->query("SELECT * from tat_job_applications where job_id='".$job_id."'");
          return $query->num_rows();
    }
  
	
	public function read_job_information($id) {
	
		$condition = "job_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('tat_jobs');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function read_job_application_info($id) {
	
		$condition = "application_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('tat_job_applications');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	
	public function read_job_infor_by_url($url) {
	
		$condition = "job_url =" . "'" . $url . "'";
		$this->db->select('*');
		$this->db->from('tat_jobs');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	
	public function read_all_jobs_by_type() {
	
		$condition = "job_type !='' group by job_type";
		$this->db->select('*');
		$this->db->from('tat_jobs');
		$this->db->where($condition);
		$this->db->limit(1000);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function all_job_types() {
	  $query = $this->db->query("SELECT jt.*, j.* from tat_job_type as jt, tat_jobs as j where jt.type_url = j.type_url group by jt.job_type_id");
  	  return $query->result();
	}
	
	public function read_all_jobs_by_designation() {
	
		$condition = "designation_id !='' group by designation_id";
		$this->db->select('*');
		$this->db->from('tat_jobs');
		$this->db->where($condition);
		$this->db->limit(1000);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	// public function check_apply_job($job_id,$user_id) {
	
	// 	$condition = "job_id='".$job_id."' and user_id='".$user_id."'";
	// 	$this->db->select('*');
	// 	$this->db->from('tat_job_applications');
	// 	$this->db->where($condition);
	// 	$this->db->limit(1);
	// 	return $query = $this->db->get();

	// }

    public function all_jobs() {
        $query = $this->db->query("SELECT * from tat_jobs");
          return $query->result();
      }
  
	public function all_interview_jobs()
	{
	  $query = $this->db->query("SELECT j.*, jap.* FROM tat_jobs as j, tat_job_applications as jap where j.job_id = jap.job_id group by j.job_id");
  	  return $query->result();
	}
	

	public function read_job_type_information($id) {
		$condition = "job_type_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('tat_job_type');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	
	public function add($data){
		$this->db->insert('tat_jobs', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	
	public function add_resume($data){
		$this->db->insert('tat_job_applications', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	

    public function update_record($data, $id){
		$this->db->where('job_id', $id);
		if( $this->db->update('tat_jobs',$data)) {
			return true;
		} else {
			return false;
		}		
	}


	public function update_applicant_status($data, $id){
		$this->db->where('application_id', $id);
		if( $this->db->update('tat_job_applications',$data)) {
			return true;
		} else {
			return false;
		}		
	}

	
	public function delete_record($id){
		$this->db->where('job_id', $id);
		$this->db->delete('tat_jobs');
		
	}

	
	public function delete_application_record($id){
		$this->db->where('application_id', $id);
		$this->db->delete('tat_job_applications');
		
	}
	

	public function delete_interview_record($id){
		$this->db->where('job_interview_id', $id);
		$this->db->delete('tat_job_interviews');
		
	}
	
	public function ajax_job_user_information($id) {
		$condition = "job_id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('tat_job_applications');
		$this->db->where($condition);
		$this->db->limit(100);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	

}
?>