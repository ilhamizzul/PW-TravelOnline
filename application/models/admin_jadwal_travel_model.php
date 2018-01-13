<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_jadwal_travel_model extends CI_Model {

	public function get_jadwal_travel()
	{
		$this->db->select('*');
		$this->db->from('jadwal_travel');
		$this->db->join('kendaraan_travel', 'kendaraan_travel.ID_KENDARAAN_TRAVEL = jadwal_travel.ID_KENDARAAN_TRAVEL');
		$this->db->join('jenis_kendaraan', 'jenis_kendaraan.ID_JENIS_KENDARAAN = kendaraan_travel.ID_JENIS_KENDARAAN');
		$this->db->order_by('jadwal_travel.ID_JADWAL_TRAVEL', 'ASC');

		return $this->db->get()->result();
	}

	public function get_kendaraan_travel()
	{
		$this->db->select('*');
		$this->db->from('kendaraan_travel');
		$this->db->join('jenis_kendaraan', 'jenis_kendaraan.ID_JENIS_KENDARAAN = kendaraan_travel.ID_JENIS_KENDARAAN');
		$this->db->order_by('ID_KENDARAAN_TRAVEL', 'ASC');

		return $this->db->get()->result();
	}

	public function get_kota()
	{
		return $this->db->order_by('ID_KOTA', 'ASC')
				->get('kota')
				->result();
	}

	public function insert($id)
	{

		$data = array(
			'ID_JADWAL_TRAVEL'		=> $id,
			'ID_KENDARAAN_TRAVEL'	=> $this->input->post('kendaraan_travel'),
			'KOTAT_ASAL' 			=> $this->input->post('asal'),
			'KOTA_TUJUAN' 			=> $this->input->post('tujuan'),
			'WAKTU_BERANGKAT' 		=> $this->input->post('berangkat'),
			'WAKTU_SAMPAI' 	 		=> $this->input->post('sampai'),
			'TARIF'		 			=> $this->input->post('tarif')
		);

		$this->db->insert('jadwal_travel', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	

}

/* End of file admin_jadwal_travel_model.php */
/* Location: ./application/models/admin_jadwal_travel_model.php */