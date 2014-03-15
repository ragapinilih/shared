<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_category extends CI_Controller {

	protected $message_status = "";

	public function __construct() 
   	{
        parent::__construct(); 
        date_default_timezone_set('Asia/Bangkok');
        $this->load->model(array('isb_model_get', 'isb_model_set'));
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
			$h['title'] = "Create New Category";
			$h['cbd'] = $this->base_design->get_cbd_all_property(); //get all config view property
			$body['error_message'] = "";


			$helper_html = array('<span class="hide" id="templatedirectory">' . base_url("asset/custom_1/themes/images/gotop.png") . '</span>');
			$body['helper_html'] = implode(" ", $helper_html);
			$body['logo_site'] = base_url('asset/custom_1/themes/images/logo_isb.png');

			$this->form_validation->set_rules('category', 'category', 'required|min_length[2]');

			$body['form_open_addPayment'] = form_open('payment#form');

			$data = array(
              'name'        => 'category',
              'id'          => 'category',
              'value'       => $this->input->post('category'),
              'placeholder' => 'Enter your category payment',
              'class'       => 'input-xlarge',
            );

			$body['form_add_payment'] = form_input($data);

			if ($this->form_validation->run() == FALSE)
			{

				$validation_errors = validation_errors();

				if (!empty($validation_errors)) $body['error_message'] = validation_errors();
				$this->load->view('header/main', $h);
				$this->load->view('header_attrib/main');
				$this->load->view('body/add_category_payment/add_category_payment', $body);
				$this->load->view('footer_attrib/main');
				$this->load->view('footer/main');
			}
			else
			{
				$this->category = $this->input->post('category');

				$insert_data = $this->_create_payment_category();

				$body['error_message'] = ($insert_data != FALSE) ? "Success created category ." . $this->category : "Failed Created category";
				$this->load->view('header/main', $h);
				$this->load->view('header_attrib/main');
				$this->load->view('body/login/login_form', $body);
				$this->load->view('footer_attrib/main');
				$this->load->view('footer/main');

			}

		}

	}

	private function _create_payment_category()
	{
		if ($this->session->userdata('logged_in')==FALSE) redirect('login');
		else
		{
			$dataCategory = $this->category;
			$roleId = $this->session->userdata('roleId');

			$parameter = array();
			$parameter['tableName']

			$insert = $this->isb_model_set->AddData($parameter); 
		}
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */