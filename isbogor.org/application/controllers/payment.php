<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	protected $message_status = "";
	protected $category = "";

	public function __construct() 
   	{
        parent::__construct(); 
        date_default_timezone_set('Asia/Bangkok');
        $this->load->model(array('isb_model_get', 'isb_model_set'));
        $this->load->database();
        $this->load->helper(array('form', 'url', 'html'));
   		$this->load->library(array('session', 'form_validation', 'encrypt', 'base_design'));

   		$this->output->enable_profiler(TRUE);
   	}
	
	public function index()
	{
		if ($this->session->userdata('logged_in')==FALSE) redirect('login');
		else
		{
			$h['title'] = "Payment";

			$body['username'] = $this->session->userdata('username');

			$payment_method = $this->_get_payment_method();
			$body = array_merge($body, $payment_method);

			$h['cbd'] = $this->base_design->get_cbd_all_property();
			$body['error_message'] = "";


			$helper_html = array('<span class="hide" id="templatedirectory">' . base_url("asset/custom_1/themes/images/gotop.png") . '</span>');
			$body['helper_html'] = implode(" ", $helper_html);
			$body['logo_site'] = base_url('asset/custom_1/themes/images/logo_isb.png');

			$this->form_validation->set_rules('category', 'category', 'required|min_length[2]');

			// $this->form_validation->set_rules('role', 'role', '');

			$roleData = $this->_get_role_data();

			$body = array_merge($body, $roleData);

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

				$roleSelected = $this->input->post('role');

				$insert_data = $this->_insert_category_data($this->input->post('category'), $roleSelected);

				if ($insert_data['code'])
				{
					$body['error_message'] = "Success created Category. ";
					$body['payment_method'][] = array('id' => $insert_data['id'], 'name' => $insert_data['name']);
				}
				else
				{
					$body['error_message'] = "Failed Created Category. ";
				}

				$body['error_message'] .= (!empty($this->message_status)) ? $this->message_status : "";
				
				$this->load->view('header/main', $h);
				$this->load->view('header_attrib/main');
				$this->load->view('body/add_category_payment/add_category_payment', $body);
				$this->load->view('footer_attrib/main');
				$this->load->view('footer/main');

			}

		}

	}


	public function add_data($type = NULL, $value_url = NULL)
	{
		if ($this->session->userdata('logged_in')==FALSE) redirect('login');
		else
		{

			if (is_null($type) || is_null($value_url)) redirect("Error_404");
			
			$params = array();

			$params['field'] = $type;
			$params['table'] = "Master_Sub_Module MS";
			$params['join'][] = array('table' => "Master_Role_Reference MRR", 'condition' => "MS.id = MRR.subModuleId");
			$params['where'][$type] = $value_url;

			$is_method_exist = $this->isb_model_get->GetData($params);

			if (empty($is_method_exist)) redirect('Error_404');

			unset($params['where']);

			$params['where']['roleIdReference'] = $this->session->userdata('roleId');

			$access = $this->isb_model_get->GetData($params);

			if (!$access > 0) redirect("access_denied");

			// Validation Ends Here.

			$h['title'] = "Payment";

			$body['username'] = $this->session->userdata('username');

			$payment_method = $this->_get_payment_method();
			$body = array_merge($body, $payment_method);

			$cbd = $this->base_design->get_cbd_all_property();
			$h['cbd'] = array('link' => $cbd['link']);
			$f_a['cbd'] = array('script' => $cbd['script']);
			
			$body['error_message'] = "";

			$helper_html = array('<span class="hide" id="templatedirectory">' . base_url("asset/custom_1/themes/images/gotop.png") . '</span>');
			$body['helper_html'] = implode(" ", $helper_html);
			$body['logo_site'] = base_url('asset/custom_1/themes/images/logo_isb.png');

			$this->load->view('header/main', $h);
			$this->load->view('header_attrib/payment_add_data/main');
			$this->load->view('body/payment_add_data/main', $body);
			$this->load->view('footer_attrib/payment_add_data/main', $f_a);
			$this->load->view('footer/main');

		}
	}


	// function private ------------------------------------------------------------------------------

	private function _get_payment_method()
	{
		
		$params['field'] = "MS.id, MS.name";
		
		$params['table'] = "Master_Sub_Module MS";
		
		$params['join'][] = array('table' => 'Master_Module MM', 'condition' => 'MM.id = MS.moduleId');
		
		$params['where']['MM.name'] = "payment";

		$data['payment_method'] = $this->isb_model_get->GetData($params);
		
		return $data;
	}

	private function _get_role_data()
	{
		
		$role['field'] = "roleId, name";
		
		$role['table'] = "Master_Role";

		$role['where']['roleId !='] = "1";
		
		$data['roleData'] = $this->isb_model_get->GetData($role);
		
		return $data;
	}

	private function _insert_category_data($category = NULL, $roleData = NULL)
	{

		$status['code'] = FALSE;

		$params = array();
		$params['field'] = "id, name"; 
		$params['table'] = "Master_Module"; 
		$params['where']['name'] = "payment";
		$module = $this->isb_model_get->GetData($params);

		$params = array();
		$params['field'] = "id, LOWER(name)"; 
		$params['table'] = "Master_Sub_Module"; 
		$params['where']['name'] = strtolower($category);
		$subModule = $this->isb_model_get->GetData($params);

		if (count($module) > 0 && ! $subModule > 0)
		{
			//first insert roleId into reference so we can get roleIdReference
			
			$params = array();
			
			$params['tableName'] = "Master_Sub_Module";	
			
			$params['value'] = array("name" => $category, 'moduleId' => $module[0]['id'], 'timeCreated' => date("Y-m-d H:i:s"));

			$created_sub_module = $this->isb_model_set->AddData($params);

			if ($created_sub_module > 0)
			{
				$subModuleId = $created_sub_module;

				$roleDataId = array();

				//set Super Admin Id
				array_push($roleDataId, array('roleIdReference' => 1, 'subModuleId' => $subModuleId));
				
				foreach ($roleData as $key => $value) {
					array_push($roleDataId, array('roleIdReference' => $value, 'subModuleId' => $subModuleId));
				}

				$params = array();
				
				$params['tableName'] = "Master_Role_Reference";	

				$params['value'] = $roleDataId;

				$query = $this->isb_model_set->InsertBatch($params);
				
				$status['code'] = TRUE;
				$status['id'] = $subModuleId;
				$status['name'] = $category;
			}	
			
		}
		else $this->message_status = "Category already exist";

	return $status;
		
	}


}

/* End of file Payment.php */
/* Location: ./application/controllers/Payment.php */