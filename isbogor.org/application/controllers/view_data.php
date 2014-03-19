<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_data extends CI_Controller {

	protected $message_status = "";
	protected $category = "";

	public function __construct() 
   	{
        parent::__construct(); 
        date_default_timezone_set('Asia/Bangkok');
        $this->load->model(array('isb_model_get', 'isb_model_set'));
        $this->load->database();
        $this->load->helper(array('form', 'url', 'html', 'dompdf', 'file'));
   		$this->load->library(array('session', 'form_validation', 'encrypt', 'base_design', 'table'));

   		$this->output->enable_profiler(FALSE);
   	}
	
	public function index($type = NULL, $value_url = NULL)
	{
		if ($this->session->userdata('logged_in')==FALSE) redirect('login');
		else
		{
			//intialize End

			if (is_null($type) || is_null($value_url)) redirect("Error_404");

			$params = array();

			$params['field'] = $type . ",name, MS.id";
			$params['table'] = "Master_Sub_Module MS";
			$params['join'][] = array('table' => "Master_Role_Reference MRR", 'condition' => "MS.id = MRR.subModuleId");
			$params['where']['roleIdReference'] = $this->session->userdata('roleId');

			$access = $this->isb_model_get->GetData($params);
			
			if (!$access > 0) redirect("access_denied");

			//intialize End

			$h['title'] = "Data";
			$body['errorMessage'] = "";

			$body['username'] = $this->session->userdata('username');

			$payment_method = $this->_get_payment_method();
			$body = array_merge($body, $payment_method);

			$h['cbd'] = $this->base_design->get_cbd_all_property();
			$body['error_message'] = "";


			$helper_html = array('<span class="hide" id="templatedirectory">' . base_url("asset/custom_1/themes/images/gotop.png") . '</span>');
			$body['helper_html'] = implode(" ", $helper_html);
			$body['logo_site'] = base_url('asset/custom_1/themes/images/logo_isb.png');

			$params = array();
			$params['field'] = "(MS.name)subModuleName, MDP.id, MDP.title, MDP.timeInsert, MDP.timeUpdate";
			$params['table'] = "Master_Data_Payment MDP";
			$params['join'][] = array('table' => 'Master_Sub_Module MS', 'condition' => 'MS.id = MDP.subModuleId');
			// $params['join'][] = array('table' => 'Data_Payment DP', 'condition' => 'DP.groupId = MDP.groupId');
			$params['where'][$type] = $value_url;

			$listData = $this->isb_model_get->GetData($params);

			if (count($listData) > 0)
			{

				$this->table->set_heading(array('Nomor', 'Title', 'Time Created', 'Last Updated', 'Action'));

				$no = 1;
				
				foreach ($listData as $key => $value) {
					$this->table->add_row(array($no, $value['title'], $value['timeInsert'], $value['timeUpdate'], '<a href="' . site_url("view_data/general") . '/' . $value['id'] . '">View Data</a>'));
					$no++;
				}

				$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-striped">' );
				$this->table->set_template($tmpl);
				
				$body['listData'] = $this->table->generate(); 

				$body['subModuleName'] = $listData[0]['subModuleName'];
				
				$this->load->view('header/main', $h);
				$this->load->view('header_attrib/main');
				$this->load->view('body/view_data/general/main', $body);
				$this->load->view('footer_attrib/main');
				$this->load->view('footer/main');

			}

		}

	}


	public function general($id = NULL)
	{
		if ($this->session->userdata('logged_in')==FALSE) redirect('login');
		else
		{
			//intialize End

			if (is_null($id)) redirect("Error_404");

			//intialize End


			$h['title'] = "Data";
			$body['errorMessage'] = "";

			$body['username'] = $this->session->userdata('username');

			$payment_method = $this->_get_payment_method();
			$body = array_merge($body, $payment_method);

			$h['cbd'] = $this->base_design->get_cbd_all_property();
			$body['error_message'] = "";


			$helper_html = array('<span class="hide" id="templatedirectory">' . base_url("asset/custom_1/themes/images/gotop.png") . '</span>');
			$body['helper_html'] = implode(" ", $helper_html);
			$body['logo_site'] = base_url('asset/custom_1/themes/images/logo_isb.png');

			$params = array();
			$params['field'] = "(MS.name)subModuleName, MDP.id, MDP.title, MDP.timeInsert, MDP.timeUpdate, DP.fieldName, DP.value";
			$params['table'] = "Master_Data_Payment MDP";
			$params['join'][] = array('table' => 'Master_Sub_Module MS', 'condition' => 'MS.id = MDP.subModuleId');
			$params['join'][] = array('table' => 'Data_Payment DP', 'condition' => 'DP.groupId = MDP.groupId');
			$params['where']['MDP.id'] = $id;

			$userData = $this->isb_model_get->GetData($params);

			if (count($userData) > 0)
			{

				$h['title'] = $userData[0]['value'];

				$this->table->set_heading(array('Field', 'Value'));

				foreach ($userData as $key => $value) {
					$fieldName = str_replace('_', ' ', $value['fieldName']);

					$fieldName = ucwords(strtolower($fieldName));

					$this->table->add_row(array($fieldName, $value['value']));
				}

				$tmpl = array ( 'table_open'  => '<table border="0" cellpadding="4" cellspacing="4" class="table table-striped">' );
				$this->table->set_template($tmpl);
				
				$body['listData'] = $this->table->generate(); 

				$image_properties = array(
				          'src' => base_url('asset/custom_1/themes/images/pdf_icon.png'),
				          'alt' => 'pdf',
				          'class' => 'thumbnail',
				          'title' => $h['title'],
				          'rel' => 'lightbox',
				);

				$icon_pdf = img($image_properties);
 				$body['linkPdf'] = '<a href="' . site_url('view_data/pdf') . '/' . $id . '">' . $icon_pdf . '</a>';

				$body['subModuleName'] = $userData[0]['subModuleName'];
				
				$this->load->view('header/main', $h);
				$this->load->view('header_attrib/main');
				$this->load->view('body/view_data/detail/main', $body);
				$this->load->view('footer_attrib/main');
				$this->load->view('footer/main');

			}

		}

	}


	public function pdf($id = NULL)
	{
		if ($this->session->userdata('logged_in')==FALSE) redirect('login');
		else
		{
			//intialize End

			if (is_null($id)) redirect("Error_404");

			//intialize End


			$h['title'] = "Data";
			$body['errorMessage'] = "";

			$body['username'] = $this->session->userdata('username');

			$payment_method = $this->_get_payment_method();
			$body = array_merge($body, $payment_method);

			$h['cbd'] = $this->base_design->get_cbd_all_property();
			$body['error_message'] = "";


			$helper_html = array('<span class="hide" id="templatedirectory">' . base_url("asset/custom_1/themes/images/gotop.png") . '</span>');
			$body['helper_html'] = implode(" ", $helper_html);
			$body['logo_site'] = base_url('asset/custom_1/themes/images/logo_isb.png');

			$params = array();
			$params['field'] = "(MS.name)subModuleName, MDP.id, MDP.title, MDP.timeInsert, MDP.timeUpdate, DP.fieldName, DP.value";
			$params['table'] = "Master_Data_Payment MDP";
			$params['join'][] = array('table' => 'Master_Sub_Module MS', 'condition' => 'MS.id = MDP.subModuleId');
			$params['join'][] = array('table' => 'Data_Payment DP', 'condition' => 'DP.groupId = MDP.groupId');
			$params['where']['MDP.id'] = $id;

			$userData = $this->isb_model_get->GetData($params);

			if (count($userData) > 0)
			{

				$h['title'] = $userData[0]['value'];

				$this->table->set_heading(array('Field', 'Value'));

				foreach ($userData as $key => $value) {
					$fieldName = str_replace('_', ' ', $value['fieldName']);

					$fieldName = ucwords(strtolower($fieldName));

					$this->table->add_row(array($fieldName, $value['value']));
				}

				$tmpl = array ( 'table_open'  => '<table border="0" cellpadding="4" cellspacing="4" class="table table-striped">' );
				$this->table->set_template($tmpl);
				
				$body['listData'] = $this->table->generate(); 
 
				$body['time'] = date('Y-m-d H:i:s');
				$body['subModuleName'] = $userData[0]['subModuleName'];
				
				$html = "";
				$html .= $this->load->view('header/main', $h, true);
				$html .= $this->load->view('header_attrib/main', true);
				$html .= $this->load->view('body/view_data/pdf/main', $body, true);
				$html .= $this->load->view('footer_attrib/main', true);
				$html .= $this->load->view('footer/main', true);

				pdf_create($html, 'filename');

			}

		}

	}


	private function _get_payment_method($type = NULL)
	{

		if (is_null($type)) $type = "page";
		
		$params['field'] = "MS.id, MS.name, MS.page";
		
		$params['table'] = "Master_Sub_Module MS";
		
		$params['join'][] = array('table' => 'Master_Module MM', 'condition' => 'MM.id = MS.moduleId');
		
		$params['where']['MM.name'] = "payment";

		$data['payment_method'] = $this->isb_model_get->GetData($params);
		
		return $data;
	}

}

/* End of file View_data.php */
/* Location: ./application/controllers/View_data.php */