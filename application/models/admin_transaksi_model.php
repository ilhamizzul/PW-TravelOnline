<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_transaksi_model extends CI_Model {

	public function get_riwayat_transaksi()
	{
		$this->db->select('*');
		$this->db->from('riwayat_transaksi');
		$this->db->join('member', 'member.ID_MEMBER = riwayat_transaksi.ID_MEMBER');
		$this->db->join('jadwal_travel', 'jadwal_travel.ID_JADWAL_TRAVEL = riwayat_transaksi.ID_JADWAL_TRAVEL');
		$this->db->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL = jadwal_travel.ID_KENDARAAN_TRAVEL');
		$this->db->join('travel', 'travel.ID_TRAVEL = kendaraan_travel.ID_TRAVEL');
		$this->db->order_by('riwayat_transaksi.ID_RIWAYAT_TRANSAKSI', 'ASC');
		if ($this->session->userdata('LEVEL') != "ADMIN") {
			$this->db->where('travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}

		return $this->db->get()->result();
	}


}

/* End of file admin_transaksi_model.php */
/* Location: ./application/models/admin_transaksi_model.php */