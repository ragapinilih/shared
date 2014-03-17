<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_insert extends CI_Controller {

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
	
	public function index($type = NULL, $value_url = NULL)
	{
		if ($this->session->userdata('logged_in')==FALSE) redirect('login');
		else
		{
			$params = array();
			$params['field'] = $type . ",name, MS.id";
			$params['table'] = "Master_Sub_Module MS";
			$params['join'][] = array('table' => "Master_Role_Reference MRR", 'condition' => "MS.id = MRR.subModuleId");
			$params['where'][$type] = $value_url;
			$is_method_exist = $this->isb_model_get->GetData($params);

			if (empty($is_method_exist)) redirect('Error_404');

			$h['title'] = "Insert Data";

			$body['username'] = $this->session->userdata('username');

			$payment_method = $this->_get_payment_method();
			$body = array_merge($body, $payment_method);

			$h['cbd'] = $this->base_design->get_cbd_all_property();
			$body['error_message'] = "";


			$helper_html = array('<span class="hide" id="templatedirectory">' . base_url("asset/custom_1/themes/images/gotop.png") . '</span>');
			$body['helper_html'] = implode(" ", $helper_html);
			$body['logo_site'] = base_url('asset/custom_1/themes/images/logo_isb.png');

			// $this->form_validation->set_rules('role', 'role', '');

			$roleData = $this->_get_role_data();

			$body = array_merge($body, $roleData);
			
			$body['category_name'] = ucwords(strtolower($is_method_exist[0]['name']));
			$body['smiH'] = form_hidden('subModuleId', $is_method_exist[0]['id']);
			$body['fuH'] = form_hidden('fuH', current_url());

			$params = array();
			$params['field'] = "label, field";
			$params['table'] = "configuration_field_submodule";
			$params['where']['subModuleId'] = $is_method_exist[0]["id"];


			$fieldSet = $this->isb_model_get->GetData($params);

			$body['form'] = "";
			$body['form'] .= form_open(current_url());

			foreach ($fieldSet as $key => $value) {
				$this->form_validation->set_rules($value['field'], $value['field'], 'required');

				$body['form'] .= '<div class="control-group"> ';
			    $body['form'] .= '<label class="control-label" for="' . $value['field'] . '">' . $value['label'] . '</label> ';
				
				$form_field = array(
				              'name'        => $value['field'],
				              'id'          => $value['field'],
				              'value'       => $this->input->post($value['field']),
				              'placeholder' => 'Input' . $value['label'],
				            );

				$body['form'] .= form_input($form_field);

				$body['form'] .= ' </div> ';
			}

			$body['form'] .= '<div class="control-group"><input tabindex="3" class="btn btn-inverse large" type="submit" id="save" value="Save"></div>';

			if ($this->form_validation->run() == FALSE)
			{

				$validation_errors = validation_errors();

				if (!empty($validation_errors)) $body['error_message'] = validation_errors();
				$this->load->view('header/main', $h);
				$this->load->view('header_attrib/main');
				$this->load->view('body/payment_insert_data/main', $body);
				$this->load->view('footer_attrib/main');
				$this->load->view('footer/main');
			}
			else
			{

				$params = array();
				$params['field'] = "groupId";
				$params['table'] = "Master_Data_Payment";
				$params['where']['subModuleId'] = $is_method_exist[0]['id'];
				$params['order_by'] = "groupId DESC";

				$getGroupId = $this->isb_model_get->GetData($params);

				if (empty($getGroupId)) $groupIds = 1;
				else $groupIds = $getGroupId[0]['groupId'] + 1;

				$params = array();
				$params['tableName'] = "Master_Data_Payment";
				$params['value'] = array('groupId' => $groupIds, 'subModuleId' => $is_method_exist[0]['id'], 'timeInsert' => date('Y-m-d H:i:s'));
				$this->isb_model_set->AddData($params);

				$data_insert = array();

				$params = array();

				$params['tableName'] = "Data_Payment";

				foreach ($fieldSet as $key => $value) {
					array_push($data_insert, array('groupId' => $groupIds, 'fieldName' => $value['field'], 'value' => $this->input->post($value['field'])));
				}

				$params["value"] = $data_insert;

				$insert_query = $this->isb_model_set->InsertBatch($params);

				if ($insert_query > 0)
				{
					$body['error_message'] = "Success Insert Data  " . $is_method_exist[0]['name'];
				}
				else
				{
					$body['error_message'] = "Failed Insert Data " . $is_method_exist[0]['name'];
				}

				$body['error_message'] .= (!empty($this->message_status)) ? $this->message_status : "";
				
				$this->load->view('header/main', $h);
				$this->load->view('header_attrib/main');
				$this->load->view('body/payment_insert_data/main', $body);
				$this->load->view('footer_attrib/main');
				$this->load->view('footer/main');

			}

		}

	}


	// function private ------------------------------------------------------------------------------

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
			
			$page = str_replace(' ', '_', $category);

			$params['value'] = array("name" => $category, 'page' => $page, 'moduleId' => $module[0]['id'], 'timeCreated' => date("Y-m-d H:i:s"));

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
				$status['page'] = $page;
			}	
			
		}
		else $this->message_status = "Category already exist";

	return $status;
		
	}


}

/* End of file Payment.php */
/* Location: ./application/controllers/Payment.php */