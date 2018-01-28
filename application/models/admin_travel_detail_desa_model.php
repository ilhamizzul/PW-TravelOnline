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

	public function chekDataDetailDesa($id_desa, $id_travel)
	{
		$this->db->where('ID_DESA', $id_desa);
		$this->db->where('ID_TRAVEL', $id_travel);
		$data = $this->db->get('detail_desa_travel')->result();

		if (count($data)>0) {
			$result = $this->db->where('ID_DESA', $id_desa)->get('desa')->result();
			return $result[0]->NAMA_DESA;
		} else {
			return "";
		}
		
	}

	public function insertDataDetailDesa($id_detail_desa_travel, $id_desa, $id_travel)
	{
		$data = array(
			'ID_DETAIL_DESA_TRAVEL' => $id_detail_desa_travel,
			'ID_DESA' 				=> $id_desa,
			'ID_TRAVEL' 			=> $id_travel 
		);

		$this->db->insert('detail_desa_travel', $data);
		if ($this->db->affected_rows() >0) {
			return true;
		}else{
			return false;
		}
	}

	public function DeleteDetailDesa($id)
	{
		$this->db->where('ID_DETAIL_DESA_TRAVEL', $id);
		$this->db->delete('detail_desa_travel');
		if ($this->db->affected_rows() >0) {
			return true;
		}else{
			return false;
		}
	}
}

/* End of file admin_travel_detail_desa_model.php */
/* Location: ./application/models/admin_travel_detail_desa_model.php */