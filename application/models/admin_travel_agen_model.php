<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_travel_agen_model extends CI_Model {

	public function GetAgenTravel()
	{
		return $this->db->get('travel')->result();
	}

	public function GetAgenTravelX($id)
	{
		$this->db->where('ID_TRAVEL', $id);
		return $this->db->get('travel')->result();
	}

	public function CheckDataMobil($namatravel)
	{
		$this->db->where('NAMA_TRAVEL', $namatravel);

		$data = $this->db->get('travel')->result();

		if (count($data)>0) {
			return $namatravel.' sudah terdaftar!';
		} else {
			return "";
		}
	}

	public function InsertAgenTravel($id, $namatravel)
	{
		$data = array(
			'ID_TRAVEL' => $id, 
			'NAMA_TRAVEL'=>$namatravel,
			'LOGO' =>''
		);

		$this->db->insert('travel', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function DeleteDataAgenTravel($id)
	{
		$this->db->where('ID_TRAVEL', $id);
		$this->db->delete('travel');

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function CheckNamaTravel($id, $namatravel)
	{
		$where = array('ID_TRAVEL !=' => $id, 'NAMA_TRAVEL' => $namatravel);
		$this->db->where( $where);
		$data = $this->db->get('travel')->result();

		if (count($data) > 0) {
			return "Nama ".$namatravel." telah dipakai";
		}else{
			return "";
		}
	}

	public function ChangeNamaTravel($id, $namatravel)
	{
		$data = array('NAMA_TRAVEL' => $namatravel);
		$this->db->where('ID_TRAVEL', $id);
		$this->db->update('travel', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function UpdateLogoTravel($id, $filename)
	{
		$this->db->where('ID_TRAVEL', $id);
		$data = array('LOGO' => $filename);
		$this->db->update('travel', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

}

/* End of file admin_travel_agen_model.php */
/* Location: ./application/models/admin_travel_agen_model.php */