<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	protected $message_logout = "";

	public function __construct() 
   	{
        parent::__construct(); 
        date_default_timezone_set('Asia/Bangkok');
        $this->load->model(array('isb_model_get'));
        $this->load->database();
        $this->load->helper(array('form', 'url', 'html'));
   		$this->load->library(array('session', 'form_validation', 'encrypt', 'base_design'));

   		$this->output->enable_profiler(FALSE);
   	}
	
	public function index()
	{
		if ($this->session->userdata('logged_in')==TRUE) redirect('main');
		else
		{
			$h['title'] = "Login Page";
			$h['cbd'] = $this->base_design->get_cbd_all_property();
			$body['error_message'] = $this->message_logout;
			
			$helper_html = array('<span class="hide" id="templatedirectory">' . base_url("asset/custom_1/themes/images/gotop.png") . '</span>');
			$body['helper_html'] = implode(" ", $helper_html);
			$body['logo_site'] = base_url('asset/custom_1/themes/images/logo_isb.png');

			$this->form_validation->set_rules('username', 'username', 'required|min_length[5]');
			$this->form_validation->set_rules('password', 'password', 'required');

			$body['form_open_login'] = form_open('login#form');

			$data = array(
              'name'        => 'username',
              'id'          => 'username',
              'value'       => $this->input->post('username'),
              'placeholder' => 'Enter your username',
              'class'       => 'input-xlarge',
            );

			$body['form_username'] = form_input($data);

			$data = array(
              'name'        => 'password',
              'id'          => 'password',
              'value'       => "",
              'placeholder' => 'Enter your password',
              'class'       => 'input-xlarge',
            );

			$body['form_password'] = form_password($data);	



			if ($this->form_validation->run() == FALSE)
			{

				$validation_errors = validation_errors();

				if (!empty($validation_errors)) {
					$body['error_message'] = validation_errors();
				}
				$this->load->view('header/main', $h);
				$this->load->view('header_attrib/main');
				$this->load->view('body/login/login_form', $body);
				$this->load->view('footer_attrib/main');
				$this->load->view('footer/main');
			}
			else
			{
				$username_str = $this->input->post('username');
				$password_str = $this->input->post('password');

				$parameter['field'] = "U.id, U.roleId, (MR.name)roleName, U.email, U.username, U.password, U.first_name, U.last_name";
				$parameter['table'] = "User U";
				$parameter['join'][] = array('table' => 'Master_Role MR', 'condition' => 'U.roleId = MR.roleId');
				$parameter['where'] = array('username' => $username_str);
				$parameter['result_type'] = "row_array";

				$result = $this->isb_model_get->GetData($parameter);
				$valid = FALSE;
				if (!empty($result))
				{
					if ($this->encrypt->decode($result['password']) == $password_str){
						$valid = TRUE;
						$session_data = array(
						                   'username'  => $result['username'],
						                   'email'     => $result['email'],
						                   'roleId'     => $result['roleId'],
						                   'roleName'     => $result['roleName'],
						                   'first_name'     => $result['first_name'],
						                   'last_name'     => $result['last_name'],
						                   'logged_in' => TRUE
						               );

						$this->session->set_userdata($session_data);
					}
				}

				if (empty($result) || $valid == FALSE)
				{

					$body['error_message'] = "Username or Password Invalid.";
					$this->load->view('header/main', $h);
					$this->load->view('header_attrib/main');
					$this->load->view('body/login/login_form', $body);
					$this->load->view('footer_attrib/main');
					$this->load->view('footer/main');

				}
				else 
				{
					redirect('main');
				}

			}
			
		}

	}

	public function is_logout()
	{
		$this->message_logout = "You have been successfully logout.";
		$this->index();
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */