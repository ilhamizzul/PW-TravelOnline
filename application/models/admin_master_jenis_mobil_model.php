<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_master_jenis_mobil_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function checkDataMobil()
	{
		$payload = $this->input->post("Data");
		$merk_kendaraan = $payload["MERK_KENDARAAN"];
		$type_kendaraan = $payload["TYPE_KENDARAAN"];

		$this->db->where('MERK_KENDARAAN', $merk_kendaraan);
		$this->db->where('TYPE_KENDARAAN', $type_kendaraan);

		$data = $this->db->get('jenis_kendaraan')->result();

		if (count($data)>0) {
			return 'Mobil '.$merk_kendaraan." ".$type_kendaraan.' sudah terdaftar';
		} else {
			return "";
		}
	}

	public function insertDataMobil($id)
	{
		$payload = $this->input->post("Data");
		$data = array(
			'ID_JENIS_KENDARAAN' => $id,
			'MERK_KENDARAAN' => $payload['MERK_KENDARAAN'],
			'TYPE_KENDARAAN'=> $payload['TYPE_KENDARAAN']
		);

		$this->db->insert('jenis_kendaraan', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getJenisMobil()
	{
		return $this->db->order_by('MERK_KENDARAAN', 'ASC')->get('jenis_kendaraan')->result();
	}

	public function editDataMobil()
	{
		$payload = $this->input->post("Data");
		$set = array(
			'MERK_KENDARAAN' => $payload['MERK_KENDARAAN'],
			'TYPE_KENDARAAN' => $payload['TYPE_KENDARAAN']
		);

		$this->db->where('ID_JENIS_KENDARAAN', $payload['ID_JENIS_KENDARAAN']);
		$this->db->update('jenis_kendaraan', $set);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteDataMobil($id)
	{
		$this->db->where('ID_JENIS_KENDARAAN', $id);
		$this->db->delete('jenis_kendaraan');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}

}

/* End of file admin_master_jenis_mobil_model.php */
/* Location: ./application/models/admin_master_jenis_mobil_model.php */