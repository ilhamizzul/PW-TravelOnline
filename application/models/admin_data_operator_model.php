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

		// return $this->db->order_by('ID_USER', 'ASC')
		// 		 ->where('LEVEL', 'OPERATOR')
		// 		 ->where('ID_TRAVEL', $this->session->userdata('ID_TRAVEL'))
		// 		 ->get('user')
		// 		 ->result();
		$this->db->order_by('ID_USER', 'asc');
		$this->db->where('LEVEL', 'OPERATOR');
		if ($this->session->userdata('LEVEL') != 'ADMIN') {
			$this->db->where('ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}
		return $this->db->get('user')->result();
	}

	public function insert($id)
	{

		$data = array(
			'ID_USER'		 => $id,
			'NAMA_USER'		 => $this->input->post('nama_user'),
			'USERNAME_ADMIN' => $this->input->post('username'),
			'PASSWORD_ADMIN' => $this->input->post('password'),
			'KOTA' 			 => $this->input->post('kota'),
			'ALAMAT_USER' 	 => $this->input->post('alamat'),
			'ID_TRAVEL'		 => $this->session->userdata('ID_TRAVEL'),
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

	public function hapus($id)
	{
		$this->db->where('ID_USER', $id)
				 ->delete('user');

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file admin_data_operator_model.php */
/* Location: ./application/models/admin_data_operator_model.php */