<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	public function insert()
	{
		$data = array(
			'ID_MEMBER' => $this->input->post('id_member'),
			'NAMA_MEMBER' => $this->input->post('name'),
			'USERNAME' => $this->input->post('username'),
			'PASSWORD' => md5($this->input->post('password')),
			'ALAMAT_MEMBER' => $this->input->post('alamat'),
			'NO_IDENTITAS' => $this->input->post('no_identitas'),
			'JENIS_IDENTITAS' => $this->input->post('jenis_identitas')
		);

		$this->db->insert('member', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file register_model.php */
/* Location: ./application/models/register_model.php */