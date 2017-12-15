<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_squence_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getLastSquence($nama_kolom, $bulan, $tahun)
	{
		$where = '(NAMA_KOLOM="'.$nama_kolom.'" and BULAN="'.$bulan.'" and TAHUN="'.$tahun.'")';

		$data = $this->db->where($where)->get('squence')->result();
		if (count($data)==0) {
			return [NULL, 0];
		}
		return[(int)$data[0]->ID_SQUENCE, (int)$data[0]->NOMOR_TERAKHIR];
	}

	public function setNewSquence($nama_kolom, $bulan, $tahun, $last_number)
	{
		$data = array(
			'ID_SQUENCE' => NULL,
			'NAMA_KOLOM' => $nama_kolom,
			'NOMOR_TERAKHIR' => $last_number,
			'BULAN' => $bulan,
			'TAHUN' => $tahun
		);

		$this->db->insert('squence', $data);

		if ($this->db->affected_rows() > 0) {
			return "succes";
		} else {
			return "failed";
		}
		
	}

	public function updateSquence($id, $nomor_terakhir)
	{
		$set = array('NOMOR_TERAKHIR' => $nomor_terakhir);
		$this->db->where('ID_SQUENCE', $id);
		$this->db->update('squence', $set);
	}
}

/* End of file admin_squence_model.php */
/* Location: ./application/models/admin_squence_model.php */