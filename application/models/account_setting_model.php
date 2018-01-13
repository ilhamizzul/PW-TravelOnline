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

	public function edit_account($id)
		{
			$data = array('NAMA_USER' 		=> $this->input->post('nama_user'),
						'USERNAME_ADMIN' 	=> $this->input->post('username'),
						'PASSWORD_ADMIN' 	=> $this->input->post('password'),
						'KOTA'				=> $this->input->post('kota'),
						'ALAMAT_USER' 		=> $this->input->post('alamat_user'),
						'NOMOR_REKENING' 	=> $this->input->post('nomor_rekening')
						);

			$this->db->select('*')
					->from('user')
					->where('ID_USER', $id)
					->update('user', $data);

			if ($this->db->affected_rows() > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
		}	

}

/* End of file account_setting_model.php */
/* Location: ./application/models/account_setting_model.php */