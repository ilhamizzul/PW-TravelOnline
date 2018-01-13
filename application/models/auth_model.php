<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->db->where('USERNAME_ADMIN', $username)
					      ->where('PASSWORD_ADMIN', $password)
					      ->get('user');

		if ($query->num_rows() > 0) {
			$result = $query->result_array();

			$role = array_shift($result);
			$data = array('USERNAME_ADMIN' => $username,
						'logged_in' => TRUE,
						'LEVEL' => $role['LEVEL'],
						'ID_USER' => $role['ID_USER'],
						'ID_TRAVEL' => $role['ID_TRAVEL']
					);
			$this->session->set_userdata($data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */