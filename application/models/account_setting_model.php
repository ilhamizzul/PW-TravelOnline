<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_setting_model extends CI_Model {

	public function get_account_profile($id)
	{
		$this->db->select(
			"USERNAME_ADMIN,
			NAMA_USER,
			NOMOR_TELEPON,
			KOTA,
			ALAMAT_USER,
			NOMOR_REKENING,
			BANK"		
		)
				->from('user')
				->where('ID_USER', $id);

		return $this->db->get()->row();
	}

	public function CheckPassword($id, $password)
	{
		$this->db->where('ID_USER', $id);
		$this->db->where('PASSWORD_ADMIN', md5($password));

		$data = $this->db->get('user')->result();

		if (count($data) > 0) {
			return "";
		}else{
			return "Password yang anda masukkan salah";
		}
	}

	public function CheckUsername($id, $username)
	{
		// $id = $this->session->userdata('USERNAME_ADMIN');
		$where = array(
			'ID_USER !=' => $id,
			'USERNAME_ADMIN' => $username
		);
		$this->db->where($where);
		$data = $this->db->get('user')->result();

		if (count($data)>0) {
			return "Username telah digunakan";
		}else{
			return "";
		}
	}

	public function edit_account($id)
	{
		$payload = $this->input->post("Data");

		$data = array('NAMA_USER' 		=> $payload["NAMA_USER"],
					'USERNAME_ADMIN' 	=> $payload["USERNAME_ADMIN"],
					'PASSWORD_ADMIN' 	=> md5($payload["PASSWORD_ADMIN"]),
					'KOTA'				=> $payload["KOTA"],
					'NOMOR_TELEPON'		=> $payload["NOMOR_TELEPON"],
					'BANK'				=> $payload["BANK"],
					'ALAMAT_USER' 		=> $payload["ALAMAT_USER"],
					'NOMOR_REKENING' 	=> $payload["NOMOR_REKENING"]
					);
		if ($payload["PASSWORD_ADMIN"] == "") {
			$data = array(
					'NAMA_USER' 		=> $payload["NAMA_USER"],
					'USERNAME_ADMIN' 	=> $payload["USERNAME_ADMIN"],
					'KOTA'				=> $payload["KOTA"],
					'NOMOR_TELEPON'		=> $payload["NOMOR_TELEPON"],
					'BANK'				=> $payload["BANK"],
					'ALAMAT_USER' 		=> $payload["ALAMAT_USER"],
					'NOMOR_REKENING' 	=> $payload["NOMOR_REKENING"]
				);
		}

		$this->db->where('ID_USER', $id);
		$this->db->update('user', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
			$array = array(
				'USERNAME_ADMIN' => $payload["USERNAME_ADMIN"]
			);
			
			$this->session->set_userdata( $array );
		} else {
			return FALSE;
		}
	}	

}

/* End of file account_setting_model.php */
/* Location: ./application/models/account_setting_model.php */