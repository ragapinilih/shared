<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct() 
   	{
        parent::__construct(); 
        $this->load->helper(array('form', 'url', 'html'));
   		$this->load->library(array('session'));

   		$this->output->enable_profiler(FALSE);
   	}
	
	public function index()
	{
		if ($this->session->userdata('logged_in')==FALSE) redirect('login');
		else
		{
			$this->session->sess_destroy();
			redirect('login/is_logout#form');
		}
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */