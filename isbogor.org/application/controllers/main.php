<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

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
		if ($this->session->userdata('logged_in')==FALSE) redirect('login');
		else
		{
			$h['title'] = "International School Bogor";
			$h['cbd'] = $this->base_design->get_cbd_all_property();
			
			$helper_html = array('<span class="hide" id="templatedirectory">' . base_url('asset/custom_1/themes/images/gotop.png') . '</span>');
			$body['helper_html'] = implode(" ", $helper_html);
			$body['logo_site'] = base_url('asset/custom_1/themes/images/logo_isb.png');
			$body['username'] = $this->session->userdata('username');

			$payment_method = $this->_get_payment_method();
			$body = array_merge($body, $payment_method);

			$this->load->view('header/main', $h);
			$this->load->view('header_attrib/main');
			$this->load->view('body/main/main', $body);
			$this->load->view('footer_attrib/main');
			$this->load->view('footer/main');
			//filter by role
		}
	}

	private function _get_payment_method()
	{
		
		$params['field'] = "MS.id, MS.name, MS.page";
		
		$params['table'] = "Master_Sub_Module MS";
		
		$params['join'][] = array('table' => 'Master_Module MM', 'condition' => 'MM.id = MS.moduleId');
		
		$params['where']['MM.name'] = "payment";

		$data['payment_method'] = $this->isb_model_get->GetData($params);
		
		return $data;
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */