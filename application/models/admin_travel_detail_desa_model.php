<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_travel_detail_desa_model extends CI_Model {

	public function GetDetailDesa()
	{
		$this->db->from('detail_desa_travel');
		$this->db->join('desa', 'desa.ID_DESA = detail_desa_travel.ID_DESA', 'left');
		$this->db->join('kota', 'kota.ID_KOTA = desa.ID_KOTA', 'left');
		$this->db->where('detail_desa_travel.ID_TRAVEL', $this->session->userdata('ID_TRAVEL'));


		return $this->db->get()->result();
	}

	public function GetKota()
	{
		return $this->db->get('kota')->result();
	}

	public function GetDesa()
	{
		return $this->db->get('desa')->result();
	}
}

/* End of file admin_travel_detail_desa_model.php */
/* Location: ./application/models/admin_travel_detail_desa_model.php */