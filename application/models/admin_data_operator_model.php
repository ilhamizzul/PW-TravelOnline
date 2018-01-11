<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_data_operator_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_id_travel()
	{
		return $this->db->order_by('ID_TRAVEL', 'ASC')
						->get('travel')
						->result();
	}

	public function get_data_operator()
	{
		return $this->db->order_by('ID_USER', 'ASC')
				 ->where('LEVEL', 'OPERATOR')
				 ->get('user')
				 ->result();
	}

	public function insert()
	{
		$data = array(
			'NAMA_USER'		 => $this->input->post('nama_user'),
			'USERNAME_ADMIN' => $this->input->post('username'),
			'PASSWORD_ADMIN' => $this->input->post('password'),
			'KOTA' 			 => $this->input->post('kota'),
			'ALAMAT_USER' 	 => $this->input->post('alamat'),
			'BANK' 			 => $this->input->post('bank'),
			'NOMOR_REKENING' => $this->input->post('no_rekening'),
			'LEVEL' 		 => $this->input->post('level')
		);

		$this->db->insert('user', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file admin_data_operator_model.php */
/* Location: ./application/models/admin_data_operator_model.php */