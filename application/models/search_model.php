<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {

	public function get_results()
	{
		$departure = $this->input->post('depart');
        $arrival = $this->input->post('to');
        
		$this->db->select('*')->from('jadwal_trevel')
							->join('kendaraan_travel', 'kendaraan_travel.ID_JENIS_KENDARAAN=jadwal_trevel.ID_JENIS_KENDARAAN')
							->join('travel', 'travel.ID_TRAVEL=kendaraan_travel.ID_TRAVEL')
							->join('jenis_kendaraan', 'jenis_kendaraan.ID_JENIS_KENDARAAN=kendaraan_travel.ID_JENIS_KENDARAAN')
							->where('KOTAT_ASAL', $departure)
							->where('KOTA_TUJUAN', $arrival);

		return $this->db->get()->result();
	}

	

}

/* End of file search_model.php */
/* Location: ./application/models/search_model.php */