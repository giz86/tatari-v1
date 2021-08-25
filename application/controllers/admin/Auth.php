<?php
// Auth Controller
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller
{
    // Load the required models.
	
	public function __construct()
     {
          parent::__construct();
			$this->load->model('Login_model');
			$this->load->model('Employees_model');
			$this->load->model('Users_model');
			$this->load->model("Tat_model");
			$this->load->model("Designation_model");
			$this->load->model("Department_model");
			$this->load->model("Location_model");
			/* Load PHPMailer library */
			$this->load->library('phpmailer_lib');
     }

	 
	 /*Function to set header and JSON output*/
	public function output($Return=array()){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		exit(json_encode($Return));
	}
	 
	public function login() {
	
		$this->form_validation->set_rules('iusername', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('ipassword', 'Password', 'trim|required|xss_clean');
		//$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		
		/*if ($this->form_validation->run() == FALSE)
		{
				//$this->load->view('myform');
		}*/
		$username = $this->input->post('iusername');
		$password = $this->input->post('ipassword');
	
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		/* Server side Input validation */
		if($username==='') {
			$Return['error'] = $this->lang->line('tat_employee_error_username');
		} elseif($password===''){
			$Return['error'] = $this->lang->line('tat_employee_error_password');
		}
		if($Return['error']!=''){
			$this->output($Return);
		}
		
		$data = array(
			'username' => $username,
			'password' => $password
			);
		$result = $this->Login_model->login($data);	
		
		if ($result == TRUE) {
			
				$result = $this->Login_model->read_user_information($username);
				$session_data = array(
				'user_id' => $result[0]->user_id,
				'username' => $result[0]->username,
				'email' => $result[0]->email,
				);
                
				$this->session->set_userdata('username', $session_data);
				$this->session->set_userdata('user_id', $session_data);
				$Return['result'] = $this->lang->line('tat_success_logged_in');
				
				$ipaddress = $this->input->ip_address();
				  
				 $last_data = array(
					'last_login_date' => date('d-m-Y H:i:s'),
					'last_login_ip' => $ipaddress,
					'is_logged_in' => '1'
				); 
				
				$id = $result[0]->user_id;
				$this->Tat_model->login_update_record($last_data, $id);
				$Return['csrf_hash'] = $this->security->get_csrf_hash();
				$this->output($Return);
				
			} else {
				$Return['error'] = $this->lang->line('tat_error_invalid_credentials');
				$Return['csrf_hash'] = $this->security->get_csrf_hash();
				$this->output($Return);
			}
	}
	

	public function forgot_password() {
		$data['title'] = $this->lang->line('tat_forgot_password_link');
		$this->load->view('admin/auth/forgot_password', $data);
	}

	
	public function lock() {
		
		$data['title'] = $this->lang->line('tat_lock_user');

		$session = $this->session->userdata('username');
		$this->session->unset_userdata('username');
		$Return['result'] = 'Locked User.';
		$this->load->view('admin/auth/user_lock', $data);
		if(empty($session)){ 
			redirect('admin/');
		}
	}
	

	public function unlock() {
	
		$this->form_validation->set_rules('ipassword', 'Password', 'trim|required|xss_clean');
		$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
		
		$Return['csrf_hash'] = $this->security->get_csrf_hash();
		
		$password = $this->input->post('ipassword');
		$session_id = $this->session->userdata('user_id');
		$iresult = $this->Login_model->read_user_info_session_id($session_id['user_id']);
		
		if($password===''){
			$Return['error'] = $this->lang->line('tat_employee_error_password');
		}
		if($Return['error']!=''){
			$this->output($Return);
		}
		
		$username = $iresult[0]->username;
		$data = array(
			'username' => $username,
			'password' => $password
			);
		$result = $this->Login_model->login($data);	
		
		if ($result == TRUE) {
			
				$result = $this->Login_model->read_user_information($username);
				$session_data = array(
				'user_id' => $result[0]->user_id,
				'username' => $result[0]->username,
				'email' => $result[0]->email,
				);

				$this->session->set_userdata('username', $session_data);
				$this->session->set_userdata('user_id', $session_data);
				$Return['result'] = $this->lang->line('tat_success_logged_in');
				
				$ipaddress = $this->input->ip_address();
				  
				$last_data = array(
					'last_login_date' => date('d-m-Y H:i:s'),
					'last_login_ip' => $ipaddress,
					'is_logged_in' => '1'
				); 
				
				$id = $result[0]->user_id; 
				  
				$this->Tat_model->login_update_record($last_data, $id);
				$this->output($Return);
				
			} else {
				$Return['error'] = $this->lang->line('tat_error_invalid_credentials');
				$this->output($Return);
			}
		}


		public function send_mail() {

			 /* PHPMailer object */
			 $mail = $this->phpmailer_lib->load();
       
			 /* SMTP configuration */
			 $mail->isSMTP();
			 $mail->Host     = 'smtp.gmail.com';
			 $mail->SMTPAuth = true;
			 $mail->Username = 'tatarisystem@gmail.com';
			 $mail->Password = 'TatariGmail1';
			 $mail->SMTPSecure = 'ssl';
			 $mail->Port     = 465;
			
			 $mail->setFrom('tatarisystem@gmail.com', 'Tatari System');
						
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			
			$Return['csrf_hash'] = $this->security->get_csrf_hash();

			if($this->input->post('iemail')==='') {
				$Return['error'] = $this->lang->line('tat_error_enter_email_address');
			} else if(!filter_var($this->input->post('iemail'), FILTER_VALIDATE_EMAIL)) {
				$Return['error'] = $this->lang->line('tat_employee_error_invalid_email');
			}
			
			if($Return['error']!=''){
				$this->output($Return);
			}
			
			if($this->input->post('iemail')) {
		
				$cinfo = $this->Tat_model->read_company_setting_info(1);
				$template = $this->Tat_model->read_email_template(1);
				$query = $this->Tat_model->read_user_info_byemail($this->input->post('iemail'));
				
				$user = $query->num_rows();
				if($user > 0) {
					
					$user_info = $query->result();
					$full_name = $user_info[0]->first_name.' '.$user_info[0]->last_name;
					
					$subject = $template[0]->subject.' - '.$cinfo[0]->company_name;
									
					$body = '
					<div style="background:#f6f6f6;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;">
					<br>'.str_replace(array("{var site_name}","{var site_url}","{var email}"),array($cinfo[0]->company_name,site_url(),$user_info[0]->email),htmlspecialchars_decode(stripslashes($template[0]->message))).'</div>';

						$mail->addAddress($this->input->post('iemail'));
						$mail->Subject = $subject;
						$mail->isHTML(true);
						$mail->Body = $body;

						if($mail->send()){
							$Return['result'] = $this->lang->line('tat_reset_password_link_success_sent_email');
						}

				} else {
					$Return['error'] = $this->lang->line('tat_error_email_addres_not_exist');
				}
				$this->output($Return);
				exit;
			}
		}
		
		public function reset_password() {

			$mail = $this->phpmailer_lib->load();
       
			/* SMTP configuration */
			$mail->isSMTP();
			$mail->Host     = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'tatarisystem@gmail.com';
			$mail->Password = 'TatariGmail1';
			$mail->SMTPSecure = 'ssl';
			$mail->Port     = 465;
		   
			$mail->setFrom('tatarisystem@gmail.com', 'Tatari System');

					
			$Return = array('result'=>'', 'error'=>'', 'csrf_hash'=>'');
			
			$Return['csrf_hash'] = $this->security->get_csrf_hash();
			if($this->input->get('change') == 'true'){
					
				if($this->input->get('email')) {
			
					$cinfo = $this->Tat_model->read_company_setting_info(1);
					$template = $this->Tat_model->read_email_template(2);
					$query = $this->Tat_model->read_user_info_byemail($this->input->get('email'));
					
					$user = $query->num_rows();
					if($user > 0) {
						
						$user_info = $query->result();
						$full_name = $user_info[0]->first_name.' '.$user_info[0]->last_name;
						
						$subject = $template[0]->subject.' - '.$cinfo[0]->company_name;

						$password = $this->AlphaNumeric(15);
						$options = array('cost' => 12);
						$password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
						$last_data = array(
							'password' => $password_hash,
						); 
						
						$id = $user_info[0]->user_id; 
						  
						$this->Tat_model->login_update_record($last_data, $id);
						
					$body = '<div style="background:#f6f6f6;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;padding: 20px;"><br>'.str_replace(array("{var site_name}","{var username}","{var email}","{var password}"),array($cinfo[0]->company_name,$user_info[0]->username,$user_info[0]->email,$password),htmlspecialchars_decode(stripslashes($template[0]->message))).'</div>';
						
						$mail->addAddress($this->input->post('email'));	
						$mail->Subject = $subject;

						$mail->isHTML(true);
						$mail->Body = $body;
						$mail->send();
									
						$this->session->set_flashdata('reset_password_success', 'reset_password_success');
						redirect(site_url('admin/'));
					} else {

						$Return['error'] = $this->lang->line('tat_error_email_addres_not_exist');
					}
					
				}
			}
		}
	
  
	public static function AlphaNumeric($length)
      {
          $chars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
          $clen   = strlen( $chars )-1;
          $id  = '';

          for ($i = 0; $i < $length; $i++) {
                  $id .= $chars[mt_rand(0,$clen)];
          }
          return ($id);
      }
	
} 
?>