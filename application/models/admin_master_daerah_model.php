<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_master_daerah_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getDataProvinsi()
	{
		return $this->db->order_by('NAMA_PROVINSI', 'ASC')->get('provinsi')->result();
	}

	public function getDataKota()
	{
		return $this->db->order_by('NAMA_KOTA', 'ASC')->get('kota')->result();
	}

	public function getDataDesa()
	{
		return $this->db->order_by('NAMA_DESA', 'ASC')->get('desa')->result();
	}

	// public function insertProvinsi()
	// {
		
	// }
}

/* End of file admin_master_daerah_model.php */
/* Location: ./application/models/admin_master_daerah_model.php */