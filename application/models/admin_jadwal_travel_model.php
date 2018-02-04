<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_jadwal_travel_model extends CI_Model {

	public function get_jadwal_travel()
	{
		$this->db->select('*');
		$this->db->from('jadwal_travel');
		$this->db->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL = jadwal_travel.ID_KENDARAAN_TRAVEL');
		$this->db->join('jenis_kendaraan', 'jenis_kendaraan.ID_JENIS_KENDARAAN = kendaraan_travel.ID_JENIS_KENDARAAN');
		if ($this->session->userdata('LEVEL') != 'ADMIN') {
			$this->db->where('kendaraan_travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}
		$this->db->order_by('jadwal_travel.ID_JADWAL_TRAVEL', 'ASC');

		return $this->db->get()->result();
	}

	public function get_kendaraan_travel()
	{
		$this->db->select('*');
		$this->db->from('kendaraan_travel');
		$this->db->join('jenis_kendaraan', 'jenis_kendaraan.ID_JENIS_KENDARAAN = kendaraan_travel.ID_JENIS_KENDARAAN');
		if ($this->session->userdata('LEVEL') != 'ADMIN') {
			$this->db->where('kendaraan_travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		}
		$this->db->order_by('ID_KENDARAAN_TRAVEL', 'ASC');

		return $this->db->get()->result();
	}

	public function get_kota()
	{
		return $this->db->order_by('NAMA_KOTA', 'ASC')
				->get('kota')
				->result();
	}

	public function checkDataJadwal()
	{
		$payload = $this->input->post('Data');
		$ID_JADWAL_TRAVEL = $payload['ID_JADWAL_TRAVEL'];
		$ID_KENDARAAN_TRAVEL = $payload['ID_KENDARAAN_TRAVEL'];
		$ID_KOTA_ASAL = $payload['ID_KOTA_ASAL'];
		$KOTAT_ASAL = $payload['KOTAT_ASAL'];
		$ID_KOTA_TUJUAN = $payload['ID_KOTA_TUJUAN'];
		$KOTA_TUJUAN = $payload['KOTA_TUJUAN'];
		$WAKTU_BERANGKAT = $payload['WAKTU_BERANGKAT'];
		$WAKTU_SAMPAI = $payload['WAKTU_SAMPAI'];
		// $TARIF = $payload['TARIF'];
		$where = array(
			'ID_KENDARAAN_TRAVEL' => $ID_KENDARAAN_TRAVEL,
			'ID_KOTA_ASAL' => $ID_KOTA_ASAL,
			'ID_KOTA_TUJUAN' => $ID_KOTA_TUJUAN,
			'WAKTU_BERANGKAT' => $WAKTU_BERANGKAT,
			'WAKTU_SAMPAI' => $WAKTU_SAMPAI
		);

		$this->db->where($where);
		if ($ID_JADWAL_TRAVEL != "") {
			$data = array('ID_JADWAL_TRAVEL !=' => $ID_JADWAL_TRAVEL);
			$this->db->where($data);
		}
		$res = $this->db->get('jadwal_travel')->result();
		if (count($res) > 0) {
			return "Data Telah Terdaftar";
		}else{
			return "";
		}
	}

	public function insert($id)
	{
		$payload = $this->input->post('Data');
		$ID_KENDARAAN_TRAVEL = $payload['ID_KENDARAAN_TRAVEL'];
		$ID_KOTA_ASAL = $payload['ID_KOTA_ASAL'];
		$KOTAT_ASAL = $payload['KOTAT_ASAL'];
		$ID_KOTA_TUJUAN = $payload['ID_KOTA_TUJUAN'];
		$KOTA_TUJUAN = $payload['KOTA_TUJUAN'];
		$WAKTU_BERANGKAT = $payload['WAKTU_BERANGKAT'];
		$WAKTU_SAMPAI = $payload['WAKTU_SAMPAI'];
		$TARIF = $payload['TARIF'];

		$data = array(
			'ID_JADWAL_TRAVEL'		=> $id,
			'ID_KENDARAAN_TRAVEL'	=> $ID_KENDARAAN_TRAVEL,
			'ID_KOTA_ASAL'			=> $ID_KOTA_ASAL,
			'KOTAT_ASAL' 			=> $KOTAT_ASAL,
			'ID_KOTA_TUJUAN'		=> $ID_KOTA_TUJUAN,
			'KOTA_TUJUAN' 			=> $KOTA_TUJUAN,
			'WAKTU_BERANGKAT' 		=> $WAKTU_BERANGKAT,
			'WAKTU_SAMPAI' 	 		=> $WAKTU_SAMPAI,
			'TARIF'		 			=> $TARIF
		);

		$this->db->insert('jadwal_travel', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function UpdateJadwal()
	{
		$payload = $this->input->post('Data');
		$ID_JADWAL_TRAVEL = $payload['ID_JADWAL_TRAVEL'];
		$ID_KENDARAAN_TRAVEL = $payload['ID_KENDARAAN_TRAVEL'];
		$ID_KOTA_ASAL = $payload['ID_KOTA_ASAL'];
		$KOTAT_ASAL = $payload['KOTAT_ASAL'];
		$ID_KOTA_TUJUAN = $payload['ID_KOTA_TUJUAN'];
		$KOTA_TUJUAN = $payload['KOTA_TUJUAN'];
		$WAKTU_BERANGKAT = $payload['WAKTU_BERANGKAT'];
		$WAKTU_SAMPAI = $payload['WAKTU_SAMPAI'];
		$TARIF = $payload['TARIF'];

		$data = array(
			'ID_KENDARAAN_TRAVEL'	=> $ID_KENDARAAN_TRAVEL,
			'ID_KOTA_ASAL'			=> $ID_KOTA_ASAL,
			'KOTAT_ASAL' 			=> $KOTAT_ASAL,
			'ID_KOTA_TUJUAN'		=> $ID_KOTA_TUJUAN,
			'KOTA_TUJUAN' 			=> $KOTA_TUJUAN,
			'WAKTU_BERANGKAT' 		=> $WAKTU_BERANGKAT,
			'WAKTU_SAMPAI' 	 		=> $WAKTU_SAMPAI,
			'TARIF'		 			=> $TARIF
		);

		$this->db->where('ID_JADWAL_TRAVEL', $ID_JADWAL_TRAVEL);
		$this->db->update('jadwal_travel', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function DeleteJadwal($Id)
	{
		$this->db->where('ID_JADWAL_TRAVEL', $Id);
		$this->db->delete('jadwal_travel');
		if ($this->db->affected_rows()>0) {
			return true;
		}else{
			return false;
		}
	}
}

/* End of file admin_jadwal_travel_model.php */
/* Location: ./application/models/admin_jadwal_travel_model.php */