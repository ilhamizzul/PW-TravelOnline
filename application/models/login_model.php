<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function cek_user()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->db->where('USERNAME', $username)
							->where('PASSWORD', md5($password))
							->get('member');

		$result = $query->result();

		if ($query->num_rows() > 0) {
			$data = array(
				'USERNAME' => $username,
				'logged_in' => TRUE,
				'ID_MEMBER' => $result[0]->ID_MEMBER
				 );

			$this->session->set_userdata($data);

			return TRUE;
		} else {
			return FALSE;
		}
		
	}
	

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */