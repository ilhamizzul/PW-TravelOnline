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

	public function CheckDataOperator()
	{
		$payload = $this->input->post("Data");

		$USERNAME_ADMIN = $payload["USERNAME_ADMIN"];

		$this->db->where('USERNAME_ADMIN', $USERNAME_ADMIN);
		$data = $this->db->get('user')->result();

		if (count($data)>0) {
			return "Username ".$USERNAME_ADMIN." telah digunakan";
		}else{
			return "";
		}
	}

	public function IsertDataOperator($id)
	{
		$payload = $this->input->post("Data");

		$NAMA_USER = $payload["NAMA_USER"];
		$USERNAME_ADMIN = $payload["USERNAME_ADMIN"];
		$PASSWORD_ADMIN = md5($payload["PASSWORD_ADMIN"]);
		$KOTA = $payload["KOTA"];
		$ALAMAT_USER = $payload["ALAMAT_USER"];
		$NOMOR_TELEPON = $payload["NOMOR_TELEPON"];
		$ID_TRAVEL = $this->session->userdata('ID_TRAVEL');
		$LEVEL = "OPERATOR";

		$data = array(
			'ID_USER'		 => $id,
			'NAMA_USER'		 => $NAMA_USER,
			'USERNAME_ADMIN' => $USERNAME_ADMIN,
			'PASSWORD_ADMIN' => $PASSWORD_ADMIN,
			'KOTA' 			 => $KOTA,
			'ALAMAT_USER' 	 => $ALAMAT_USER,
			'NOMOR_TELEPON'  => $NOMOR_TELEPON,
			'ID_TRAVEL'		 => $ID_TRAVEL,
			'LEVEL' 		 => $LEVEL
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