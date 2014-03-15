<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_design extends CI_Controller {

	public function __construct() 
   	{
        log_message('debug', "Session Class Initialized");


   	}
	
	public function load_all_configuration($parameter = array())
	{
		$CI =& get_instance();
        $CI->load->model(array('isb_model_get'));
        $CI->load->database();
		

		$params = array();
        
        if (!empty($parameter['type'])) $params['where']['type'] = $parameter['type'];
		
		$params['field'] = "*";
		$params['table'] = "config_view";
		$result = $CI->isb_model_get->GetData($params);

		foreach ($result as $key => $value) {
			$this->config_data[$value['type']][] = $value;
		}
	}

	public function get_cbd_all_property($parameter = array())
	{
		if (empty($this->config_data)) $this->load_all_configuration($parameter);

		return $this->config_data;
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */