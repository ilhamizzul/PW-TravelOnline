<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_setting_model extends CI_Model {

	public function get_account_profile($id)
		{
			$this->db->select('*')
					->from('user')
					->where('ID_USER', $id);

			return $this->db->get()->row();
		}	

}

/* End of file account_setting_model.php */
/* Location: ./application/models/account_setting_model.php */