<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {

	// public function __construct()
	// {
	// 	parent::__construct();
	// 	//Do your magic here
	// }

	public function GetHistory()
	{
		$id_user = $this->session->userdata('ID_MEMBER');

		$this->db->select('*');
		$this->db->from('riwayat_transaksi');
		$this->db->join('jadwal_travel', 'jadwal_travel.ID_JADWAL_TRAVEL = riwayat_transaksi.ID_JADWAL_TRAVEL', 'left');
		$this->db->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL = jadwal_travel.ID_KENDARAAN_TRAVEL', 'left');

		$this->db->join('travel', 'travel.ID_TRAVEL = kendaraan_travel.ID_TRAVEL', 'left');
		$this->db->order_by('ID_RIWAYAT_TRANSAKSI', 'desc');
		$this->db->where('ID_MEMBER', $id_user);
		return $this->db->get()->result();
	}

	public function GetOperatorTravel()
	{
		$this->db->select('ID_TRAVEL, NAMA_USER, NOMOR_TELEPON, KOTA');
		$this->db->where('LEVEL', "OPERATOR");
		return $this->db->get('user')->result();
	}

	public function BlockInvalidData($id)
	{
		$set = array('STATUS' => 'BLOCKED');
		$this->db->where('ID_RIWAYAT_TRANSAKSI', $id);
		$this->db->update('riwayat_transaksi', $set);
	}

}

/* End of file history_model.php */
/* Location: ./application/models/history_model.php */