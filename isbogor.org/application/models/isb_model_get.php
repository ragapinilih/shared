<?php
class Isb_model_get extends CI_Model {

	function __construct()
	{
		$this->load->database();
	}
	
	function is_user_exist($data)
	{
		$this->db->select('username, id');
		if (!empty($data['facebook'])) $this->db->where('facebookId' , $data['facebookId']);
		else {
			$this->db->where('email' ,$data['email']);
			$this->db->where('password' ,$data['password']);
		}
		$data = $this->db->get('User');
		$data = $data->row(); 
		$result = (!empty($data->id)) ? array('userId' => $data->id, 'username' => $data->username) : '';
			return $result;
	}

	function get_last_insert_id($data)
	{
		$this->db->select('id, username');
		$this->db->where('email', $data['email']);
		$data = $this->db->get('User');
		$result = $data->row(); 
			return $result;
	}

	function is_email_exist($email)
	{
		$this->db->select('email');
		$this->db->where('email', $email);
		$data = $this->db->get('User');
		$result = ($data->num_rows() == 0) ? FALSE : TRUE;
			return $result;
	}


	function validate_user($data) 
	{
		switch ($data['case']) {
			case 'login':
				$validate_password = '';
				$this->db->select(' (CASE WHEN email ="' . $data['email'] . '" THEN 5 ELSE 0 END)email_indicator,  (CASE WHEN password = "' . $data['password'] . '" THEN 11 ELSE 0 END)password_indicator, id AS userId, username, password');
				$this->db->where('email' ,$data['email']);
				$this->db->or_where('password' ,$data['password']);
				$data = $this->db->get('User');
				if ($data->num_rows() == 0) $result =  FALSE;
				else 
				{
					$data = $data->row();
					$result['statusId'] = $data->email_indicator + $data->password_indicator;
					$result['data'] = array('userId' => (!empty($result['statusId'])) ? $data->userId : 0, 'username' => $data->username);
				}

				break;
			case 'register':
				$validate_password = '';
				$this->db->select(' (CASE WHEN email ="' . $data['email'] . '" THEN 1 ELSE 0 END)email_indicator, id AS userId, username, password');
				$this->db->where('email' ,$data['email']);
				$this->db->or_where('password' ,$data['password']);
				$data = $this->db->get('User');
				if ($data->num_rows() == 0) $result =  FALSE;
				else 
				{
					$data = $data->row();
					$result['statusId'] = $data->email_indicator + $data->password_indicator;
					$result['data'] = array('userId' => (!empty($result['statusId'])) ? $data->userId : 0, 'username' => $data->username);
				}
				break;
			default:
				break;
		}
		return $result;
	}

	
	function GetData($parameter){
		// $this->db->set('field', 'field+1', FALSE);
		$this->db->select($parameter['field']);
		$this->db->from($parameter['table']);
		if(isset($parameter['join']) && !empty($parameter['join']))	{
			foreach ($parameter['join'] as $key => $value) {
				$this->db->join($value['table'], $value['condition']);
			}
		}
		if (isset($parameter['where']) && !empty($parameter['where'])) $this->db->where($parameter['where']);
		if (isset($parameter['or_where']) && !empty($parameter['or_where'])) $this->db->or_where($parameter['or_where']);
		if (isset($parameter['where_in']) && !empty($parameter['where_in'])) {
			foreach ($parameter['where_in'] as $key => $value) {
				$this->db->where_in($key, $value);
			}
		}
		if (isset($parameter['or_where_in']) && !empty($parameter['or_where_in'])) {
			foreach ($parameter['or_where_in'] as $key => $value) {
				$this->db->or_where_in($key, $value);
			}
		}
		if (isset($parameter['or_where_not_in']) && !empty($parameter['or_where_not_in'])) {
			foreach ($parameter['or_where_not_in'] as $key => $value) {
				$this->db->or_where_not_in($key, $value);
			}
		}
		if (isset($parameter['like']) && !empty($parameter['like'])) $this->db->like($parameter['like']);
		if (isset($parameter['group_by'])) $this->db->group_by($parameter['group_by']); 
		if (isset($parameter['order_by'])) $this->db->order_by($parameter['order_by']); 
		if (isset($parameter['limit']) && isset($parameter['start'])) $this->db->limit($parameter['limit'], $parameter['start']);
		$query = $this->db->get();
		if (!empty($parameter['result_type'])) 
		{
			switch ($parameter['result_type']) {
				case 'row':
					return $query->row();
					break;
				case 'row_array':
					return $query->row_array();
					break;
				case 'result_array':
				default:
					return $query->result_array();
					break;
			}
		}
		else return $query->result_array();
	}
}
?>