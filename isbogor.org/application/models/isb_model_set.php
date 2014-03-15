<?php
class Isb_model_set extends CI_Model {

	function __construct()
	{
		$this->load->database();
	}
	
	function ResetPassword($parameter)
	{
		$this->db->where($parameter['email']);
		$this->db->update('User', $parameter['update']);
		return $this->db->affected_rows();
	}

	function AddUser($parameter)
	{
		$data = $this->db->insert($parameter['tableName'], $parameter['value']);
		return $data;
	}

	function AddData($parameter)
	{
		$data = $this->db->insert($parameter['tableName'], $parameter['value']);
		return $this->db->insert_id();
	}

	function InsertBatch($parameter)
	{
		$data = $this->db->insert_batch($parameter['tableName'], $parameter['value']);
		return $data;
	}

	function UpdateUser($parameter)
	{
		$this->db->where('id', $parameter['id']);
		$data = $this->db->update('User', $parameter); 
			return $data;
	}

	function UpdateData($parameter)
	{
		$this->db->where($parameter['where']);
		$data = $this->db->update($parameter['tableName'], $parameter['data']); 
			return $data;
	}

	function InitializeUserPoint($data) {
		$insertStr = 'INSERT INTO UserPoint(userId, merchantId, totalPoint) VALUES';
        $valuesStr ='';
        $query = 'SELECT M.id FROM MerchantData M WHERE id NOT IN (SELECT merchantId FROM UserPoint U WHERE U.userId = ' . $uid . ');';
        $result = $this->QueryDatabase($query);
        $rowMid = array();
        while ($row = $result->fetch_assoc())
        {   
            foreach ($row as $value) 
            {
                $rowMid[] = $value;
            }
        }
        $result->free();
        $this->ClearResult();
        if(!empty($rowMid))
        {
            foreach ($rowMid as $id) 
            {
                $valuesStr = $valuesStr . '("' . $uid . '","' . $id . '","0"),';
            }
            $query = $insertStr . substr($valuesStr, 0, -1) . ';'; 
            $result = $this->UpdateDatabase($query);
            $this->ClearResult();
        }
	}
}
?>