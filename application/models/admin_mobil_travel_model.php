<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_mobil_travel_model extends CI_Model {

	public function get_data_mobil()
	{
		// $this->db->select('*');
		// $this->db->from('kendaraan_travel');
		// $this->db->join('travel', 'travel.ID_TRAVEL = kendaraan_travel.ID_TRAVEL');
		// $this->db->join('jenis_kendaraan', 'jenis_kendaraan.ID_JENIS_KENDARAAN = kendaraan_travel.ID_JENIS_KENDARAAN');
		// $this->db->order_by('ID_KENDARAAN_TRAVEL', 'ASC');

		// return $this->db->get()->result();

		$this->db->select('*');
		$this->db->from('kendaraan_travel');
		$this->db->join('travel', 'travel.ID_TRAVEL = kendaraan_travel.ID_TRAVEL');
		$this->db->join('jenis_kendaraan', 'jenis_kendaraan.ID_JENIS_KENDARAAN = kendaraan_travel.ID_JENIS_KENDARAAN');
		$this->db->order_by('ID_KENDARAAN_TRAVEL', 'asc');
		$this->db->where('travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		// if ($this->session->userdata('LEVEL') != 'ADMIN') {
		// 	$this->db->where('ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));
		// }
		return $this->db->get()->result();
	}

		public function get_travel()
	{
		return $this->db->order_by('ID_TRAVEL', 'ASC')
						->get('travel')
						->result();	
	}

	public function get_merk()
	{
		return $this->db->order_by('ID_JENIS_KENDARAAN', 'ASC')
						->get('jenis_kendaraan')
						->result();
	}

		public function insert($id, $foto_kendaraan)
	{

		$data = array(
			'ID_KENDARAAN_TRAVEL'		=> $id,
			'ID_JENIS_KENDARAAN'		=> $this->input->post('tipe_kendaraan'),
			'ID_TRAVEL' 				=> $this->session->userdata('ID_TRAVEL'),
			'NO_POL_KENDARAAN' 			=> $this->input->post('plat_nomor'),
			'WARNA_KENDARAAN' 			=> $this->input->post('warna_kendaraan'),
			'FOTO_KENDARAAN' 	 		=> $foto_kendaraan['file_name'],
			'JML_KURSI'		 			=> $this->input->post('jumlah_kursi')
		);

		$this->db->insert('kendaraan_travel', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function hapus($id)
	{
		$this->db->where('ID_KENDARAAN_TRAVEL', $id)
				 ->delete('kendaraan_travel');

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	

}

/* End of file admin_mobil_travel_model.php */
/* Location: ./application/models/admin_mobil_travel_model.php */