<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	function data_login($field1, $field2)
	{		
		$this->db->select('*');
		$this->db->from('user_aktif');
		$this->db->join('user_group', 'user_group.id_akses = user_aktif.id_level', 'left');
		$this->db->join('penduduk', 'user_aktif.id_user = penduduk.id', 'left');
		$this->db->where($field1);
		$this->db->where($field2);
		$this->db->limit(1);
		$q = $this->db->get();
		if ($q->num_rows() == 0) {
			return FALSE;
		}else {
			return $q->result();
		}
	}

}

/* End of file LoginModel.php */
/* Location: ./application/models/LoginModel.php */