<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard_model extends CI_Model {

	public function GetDataTransaksi()
	{
		$this->db->select('COUNT(*) AS QTY, SUM(TOTAL_BAYAR) AS TOTAL, STATUS, MONTHNAME(TANGGAL_PEMESANAN) AS MONTH, Year(TANGGAL_PEMESANAN) AS YEAR');
		$this->db->from('riwayat_transaksi');
		$this->db->join('jadwal_travel', 'jadwal_travel.ID_JADWAL_TRAVEL = riwayat_transaksi.ID_JADWAL_TRAVEL');
		$this->db->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL = jadwal_travel.ID_KENDARAAN_TRAVEL');
		$this->db->join('travel', 'travel.ID_TRAVEL = kendaraan_travel.ID_TRAVEL');
		$group = array('MONTH', 'STATUS');
		$this->db->group_by($group);
		$this->db->where('Year(TANGGAL_PEMESANAN)', date('Y'));
		if ($this->session->userdata('LEVEL') != "ADMIN") {
			$this->db->where('travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}
		$data = $this->db->get()->result();

		return $data;
	}

}

/* End of file admin_dashboard_model.php */
/* Location: ./application/models/admin_dashboard_model.php */