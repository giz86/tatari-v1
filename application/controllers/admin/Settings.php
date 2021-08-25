<?php
// Settings Controller - general configuration center for features: for now just DB backup

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {
	
	 public function __construct() {
        parent::__construct();
		$this->load->model("Employees_model");
		$this->load->model("Finance_model");
		$this->load->model("Tat_model");
        $this->load->helper('string');
        $this->load->helper('file');
	}
	

	public function output($Return=array()){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		exit(json_encode($Return));
    }
    
    public function database_backup()
     {
		$session = $this->session->userdata('username');
		if(empty($session)){ 
			redirect('admin/');
		}
		$data['title'] = $this->lang->line('left_db_backup').' | '.$this->Tat_model->site_title();
		$setting = $this->Tat_model->read_setting_info(1);
		$company_info = $this->Tat_model->read_company_setting_info(1);
		$data['breadcrumbs'] = $this->lang->line('left_db_backup');
		$data['path_url'] = 'database_backup';
		$role_resources_ids = $this->Tat_model->user_role_resource();
		if(in_array('62',$role_resources_ids)) {
			if(!empty($session)){ 
				$data['subview'] = $this->load->view("admin/settings/database_backup", $data, TRUE);
				$this->load->view('admin/layout/layout_main', $data); 
			} else {
				redirect('admin/');
			}
		} else {
			redirect('admin/dashboard');
		}
     }

     public function backup_database( $directory, $outname , $dbhost, $dbuser, $dbpass ,$dbname ) {
	  
		// check mysqli extension installed
		if( ! function_exists('mysqli_connect') ) {
		die(' This scripts need mysql extension to be running properly ! please resolve!!');
		}
		$mysqli = @new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		
		if( $mysqli->connect_error ) {
			print_r( $mysqli->connect_error );
			return false;
		}
		$dir = $directory;
		$result = '<p> Could not create backup directory on :'.$dir.' Please Please make sure you have set Directory on 755 or 777 for a while.</p>';  
		$res = true;
		if( ! is_dir( $dir ) ) {
		  if( ! @mkdir( $dir, 755 )) {
			$res = false;
		  }
		}
		$n = 1;
		if( $res ) {
		$name     = $outname;
		# counts
		if( file_exists($dir.'/'.$name.'.sql.gz' ) ) {
		  for($i=1;@count( file($dir.'/'.$name.'_'.$i.'.sql.gz') );$i++){
			$name = $name;
			if( ! file_exists( $dir.'/'.$name.'_'.$i.'.sql.gz') ) {
			  $name = $name.'_'.$i;
			  break;
			}
		  }
		}
		$fullname = $dir.'/'.$name.'.sql.gz'; 
		if( ! $mysqli->error ) {
		  $sql = "SHOW TABLES";
		  $show = $mysqli->query($sql);
		  while ( $r = $show->fetch_array() ) {
			$tables[] = $r[0];
		  }
		  if( ! empty( $tables ) ) {
		//cycle through
		$return = '';
		foreach( $tables as $table )
		{
		$result     = $mysqli->query('SELECT * FROM '.$table);
		$num_fields = $result->field_count;
		$row2       = $mysqli->query('SHOW CREATE TABLE '.$table );
		$row2       = $row2->fetch_row();
		$return    .= 
		"\n
		-- ---------------------------------------------------------
		--
		-- Table structure for table : `{$table}`
		--
		-- ---------------------------------------------------------
		".$row2[1].";\n";
		for ($i = 0; $i < $num_fields; $i++) 
		{
		  $n = 1 ;
		  while( $row = $result->fetch_row() )
		  { 
			
			if( $n++ == 1 ) { # set the first statements
			  $return .= 
		"
		--
		-- Dumping data for table `{$table}`
		--
		";  
			/**
			 * Get structural of fields each tables
			 */
			$array_field = array(); #reset ! important to resetting when loop 
			 while( $field = $result->fetch_field() ) # get field
			{
			  $array_field[] = '`'.$field->name.'`';
			  
			}
			$array_f[$table] = $array_field;
			// $array_f = $array_f;
			# endwhile
			$array_field = implode(', ', $array_f[$table]); #implode arrays
			  $return .= "INSERT INTO `{$table}` ({$array_field}) VALUES\n(";
			} else {
			  $return .= '(';
			}
			for($j=0; $j<$num_fields; $j++) 
			{
			  
			  $row[$j] = str_replace('\'','\'\'', preg_replace("/\n/","\\n", $row[$j] ) );
			  if ( isset( $row[$j] ) ) { $return .= is_numeric( $row[$j] ) ? $row[$j] : '\''.$row[$j].'\'' ; } else { $return.= '\'\''; }
			  if ($j<($num_fields-1)) { $return.= ', '; }
			}
			  $return.= "),\n";
		  }
		  # check matching
		  @preg_match("/\),\n/", $return, $match, false, -3); # check match
		  if( isset( $match[0] ) )
		  {
			$return = substr_replace( $return, ";\n", -2);
		  }
		}
		
		  $return .= "\n";
		}
		$return = 
		"-- ---------------------------------------------------------
		--
		-- SIMPLE SQL Dump
		-- Host Connection Info: ".$mysqli->host_info."
		-- Generation Time: ".date('F d, Y \a\t H:i A ( e )')."
		-- PHP Version: ".PHP_VERSION."
		--
		-- ---------------------------------------------------------\n\n
		SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
		SET time_zone = \"+00:00\";
		/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
		/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
		/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
		/*!40101 SET NAMES utf8 */;
		".$return."
		/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
		/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
		/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
		# end values result
		@ini_set('zlib.output_compression','Off');

		$gzipoutput = gzencode( $return, 9);
		if(  @ file_put_contents( $fullname, $gzipoutput  ) ) { # 9 as compression levels
		
		$result = $name.'.sql.gz'; # show the name
		
		} else { # if could not put file , automaticly you will get the file as downloadable
		$result = false;   
		// various headers, those with # are mandatory
		header('Content-Type: application/x-gzip'); // change it to mimetype
		header("Content-Description: File Transfer");
		header('Content-Encoding: gzip'); #
		header('Content-Length: '.strlen( $gzipoutput ) ); #
		header('Content-Disposition: attachment; filename="'.$name.'.sql.gz'.'"');
		header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
		header('Connection: Keep-Alive');
		header("Content-Transfer-Encoding: binary");
		header('Expires: 0');
		header('Pragma: no-cache');
		
		echo $gzipoutput;
		}
		   } else {
			 $result = '<p>Error when executing database query to export.</p>'.$mysqli->error;
		   }
		 }
		} else {
		  $result = '<p>Wrong mysqli input</p>';
		}
		
		if( $mysqli && ! $mysqli->error ) {
		  @$mysqli->close();
		}
		return $result;
    }
    
    public function create_database_backup()
    {
       $data['title'] = $this->Tat_model->site_title();
       if($this->input->post('type')==='backup') {
           
           $Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
           $Return['csrf_hash'] = $this->security->get_csrf_hash();
           
           $db = array('default' => array());
           // get db credentials
           require 'application/config/database.php';
           $hostname = $db['default']['hostname'];
           $username = $db['default']['username'];
           $password = $db['default']['password'];
           $database = $db['default']['database'];
               
           $dir  = 'uploads/dbbackup/'; // directory files
           $name = 'backup_'.date('d-m-Y_H_i_s'); // name sql backup
           $this->backup_database( $dir, $name, $hostname, $username, $password, $database); // execute
                   
           $fname = $name.'.sql.gz';
                   
           $data = array(
           'backup_file' => $fname,
           'created_at' => date('d-m-Y H:i:s')
           );
           
           $result = $this->Tat_model->add_backup($data);	
           
           if ($result == TRUE) {
               $Return['result'] = $this->lang->line('tat_database_backup_generated');
           } else {
               $Return['error'] = $this->lang->line('tat_error_msg');
           }
           $this->output($Return);
           exit;
       }
    }
    
    public function delete_db_backup()
    {
       if($this->input->post('type')==='delete_old_backup') {
           
           $Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
           $Return['csrf_hash'] = $this->security->get_csrf_hash();
           
           $result = $this->Tat_model->delete_all_backup_record();
           $baseurl = base_url();
           $files = glob('uploads/dbbackup/*'); 
           foreach($files as $file){
               if(is_file($file))
               unlink($file); 
           }
           
           $Return['result'] = $this->lang->line('tat_success_database_old_backup_deleted');
           $this->output($Return);
           exit;
       }
    }
    

     public function database_backup_list()
    {

       $data['title'] = $this->Tat_model->site_title();
       $session = $this->session->userdata('username');
       if(!empty($session)){ 
           $this->load->view("admin/settings/database_backup", $data);
       } else {
           redirect('admin/');
       }
  
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));
       
       $db_backup = $this->Tat_model->all_db_backup();

       $data = array();

       foreach($db_backup->result() as $r) {
           
           $created_at = $this->Tat_model->set_date_format($r->created_at);
                                                      
       $data[] = array('<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_download').'"><a href="'.site_url().'admin/download?type=dbbackup&filename='.$r->backup_file.'"><button type="button" class="btn icon-btn btn-xs btn-default waves-effect waves-light"><span class="fa fa-download"></span></button></a></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('tat_delete').'"><button type="button" class="btn icon-btn btn-xs btn-danger waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->backup_id . '"><span class="fa fa-trash"></span></button></span>',
           $r->backup_file,
           $created_at
       );
     }

     $output = array(
          "draw" => $draw,
            "recordsTotal" => $db_backup->num_rows(),
            "recordsFiltered" => $db_backup->num_rows(),
            "data" => $data
       );
       
     echo json_encode($output);
     exit();
   }

}