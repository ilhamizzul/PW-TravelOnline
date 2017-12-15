<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function get_data_travel()
	{
		$this->db->select('*')->from('jadwal_trevel')
							  ->join('kendaraan_travel', 'kendaraan_travel.ID_JENIS_KENDARAAN=jadwal_trevel.ID_JENIS_KENDARAAN')
							  ->join('travel', 'travel.ID_TRAVEL=kendaraan_travel.ID_TRAVEL')
							  ->join('jenis_kendaraan', 'jenis_kendaraan.ID_JENIS_KENDARAAN=kendaraan_travel.ID_JENIS_KENDARAAN')
							  ;

		return $this->db->get()->result();
		/*return $this->db->order_by('ID_JADWAL_TRAVEL', 'ASC')
						->get('jadwal_trevel')
						->result();*/
	}

	public function get_id_detail_desa_travel()
	{		
		return $this->db->order_by('ID_DETAIL_DESA_TRAVEL', 'ASC')
						->get('detail_desa_travel')
						->result();

		$this->db->select('*')->from('detail_desa_travel')
							  ->join('desa', 'desa.ID_DESA=detail_desa_travel.ID_DESA');
	}

	public function get_id_kota_jemput($id)
	{
		return $this->db->select('*')->from('desa')->where('ID_KOTA',$id)->get()->result();
	}

	public function get_id_kota_tujuan()
	{
		$this->db->from('desa NATURAL JOIN detail_desa_travel');
	}

}

/* End of file home_model.php */
/* Location: ./application/models/home_model.php */