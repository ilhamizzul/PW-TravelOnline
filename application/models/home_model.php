<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {


	public function total_record_travel()
	{
		return $this->db->from('jadwal_trevel', 'kendaraan_travel', 'travel', 'jenis_kendaraan')
						->count_all_results();
	}

	public function get_data_travel($limit, $offset)
	{
		$this->db->select('*')->from('jadwal_trevel')
							  ->join('kendaraan_travel', 'kendaraan_travel.ID_JENIS_KENDARAAN=jadwal_trevel.ID_JENIS_KENDARAAN')
							  ->join('travel', 'travel.ID_TRAVEL=kendaraan_travel.ID_TRAVEL')
							  ->join('jenis_kendaraan', 'jenis_kendaraan.ID_JENIS_KENDARAAN=kendaraan_travel.ID_JENIS_KENDARAAN')
							  ;

		// $query = $this->db->get($limit, $offset);
		// return $query->result();

		$this->db->order_by('ID_JADWAL_TRAVEL','ASC');
		$this->db->limit($limit, $offset);
		$query = $this->db->get()->result();
		return $query;
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