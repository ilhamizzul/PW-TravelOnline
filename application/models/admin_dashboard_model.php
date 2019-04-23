<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard_model extends CI_Model {

	public function GetDataTransaksi()
	{
		$this->db->select('COUNT(*) AS QTY, SUM(TOTAL_BAYAR) AS TOTAL, STATUS, MONTH(TANGGAL_PEMESANAN) AS MONTH, Year(TANGGAL_PEMESANAN) AS YEAR');
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

	public function GetDataRevenue()
	{
		$this->db->select('SUM(TOTAL_BAYAR) AS TOTAL, MONTHNAME(TANGGAL_PEMESANAN) AS MONTH');
		$this->db->from('riwayat_transaksi');
		$this->db->join('jadwal_travel', 'jadwal_travel.ID_JADWAL_TRAVEL = riwayat_transaksi.ID_JADWAL_TRAVEL');
		$this->db->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL = jadwal_travel.ID_KENDARAAN_TRAVEL');
		$this->db->join('travel', 'travel.ID_TRAVEL = kendaraan_travel.ID_TRAVEL');
		$group = array('MONTH');
		$this->db->group_by($group);
		$this->db->where('Year(TANGGAL_PEMESANAN)', date('Y'));
		if ($this->session->userdata('LEVEL') != "ADMIN") {
			$this->db->where('travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}
		$this->db->order_by('TANGGAL_PEMESANAN', 'asc');
		$data = $this->db->get()->result();

		return $data;
	}

	public function GetJumlahTransaksi()
	{
		$this->db->select('COUNT(*) AS TOTAL');
		$this->db->from('riwayat_transaksi');
		$where = array(
			'YEAR(TANGGAL_PEMESANAN)' => date("Y"),
			'MONTH(TANGGAL_PEMESANAN)' => date("n") 
		);
		$this->db->where($where);
		if ($this->session->userdata('LEVEL') != 'ADMIN') {
			$this->db->join('member', 'member.ID_MEMBER = riwayat_transaksi.ID_MEMBER');
			$this->db->join('jadwal_travel', 'jadwal_travel.ID_JADWAL_TRAVEL = riwayat_transaksi.ID_JADWAL_TRAVEL');
			$this->db->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL = jadwal_travel.ID_KENDARAAN_TRAVEL');

			$this->db->where('kendaraan_travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}


		$data = $this->db->get()->result();
		return $data[0]->TOTAL;
	}

	public function GetJumlahMobil()
	{
		$this->db->select('COUNT(*) AS TOTAL');
		$this->db->from('kendaraan_travel');

		if ($this->session->userdata('LEVEL') != 'ADMIN') {
			$this->db->where('kendaraan_travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}

		$data = $this->db->get()->result();

		return $data[0]->TOTAL;
	}

	public function GetJumlahCakupanDaerah()
	{
		$this->db->select('COUNT(*) AS TOTAL');
		$this->db->from('detail_desa_travel');
		$this->db->join('desa', 'desa.ID_DESA = detail_desa_travel.ID_DESA');
		$this->db->join('kota', 'kota.ID_KOTA = desa.ID_KOTA');

		if ($this->session->userdata('LEVEL') != 'ADMIN') {
			$this->db->where('detail_desa_travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}

		$this->db->group_by('kota.ID_KOTA');

		$data = $this->db->get()->result();

		return $data[0]->TOTAL;
	}

	public function GetJumlahPelanggan()
	{
		$this->db->select('COUNT(*) AS TOTAL, member.ID_MEMBER');
		$this->db->from('member');
		if ($this->session->userdata('LEVEL') != 'ADMIN') {
			$this->db->group_by('member.ID_MEMBER');
			$this->db->join('riwayat_transaksi', 'riwayat_transaksi.ID_MEMBER = member.ID_MEMBER');
			$this->db->join('jadwal_travel', 'jadwal_travel.ID_JADWAL_TRAVEL = riwayat_transaksi.ID_JADWAL_TRAVEL');
			$this->db->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL = jadwal_travel.ID_KENDARAAN_TRAVEL');
			$this->db->where('kendaraan_travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}
		
		$data = $this->db->get()->result();

		return count($data);
		
	}
}

/* End of file admin_dashboard_model.php */
/* Location: ./application/models/admin_dashboard_model.php */