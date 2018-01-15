<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

	public function GetTransaksi($id)
	{
		$this->db->select('*');
		$this->db->from('riwayat_transaksi');
		$this->db->join('jadwal_travel', 'jadwal_travel.ID_JADWAL_TRAVEL = riwayat_transaksi.ID_JADWAL_TRAVEL', 'left');
		$this->db->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL = jadwal_travel.ID_KENDARAAN_TRAVEL', 'left');

		$this->db->join('travel', 'travel.ID_TRAVEL = kendaraan_travel.ID_TRAVEL', 'left');
		// $this->db->order_by('ID_RIWAYAT_TRANSAKSI', 'desc');
		$this->db->where('ID_RIWAYAT_TRANSAKSI', $id);
		return $this->db->get()->result();
	}

	public function GetAdmin()
	{
		$this->db->select('BANK, NOMOR_REKENING');
		$this->db->from('user');
		$this->db->where('LEVEL', 'ADMIN');
		return $this->db->get()->result();
	}

	public function SetBuktiPembayaran($id, $filename)
	{
		$set = array('BUKTI_BAYAR' => $filename, 'STATUS' => 'WAITING');
		$this->db->where('ID_RIWAYAT_TRANSAKSI', $id);
		$this->db->update('riwayat_transaksi', $set);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}

}

/* End of file transaksi_model.php */
/* Location: ./application/models/transaksi_model.php */