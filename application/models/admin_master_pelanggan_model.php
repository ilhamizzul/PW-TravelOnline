<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_master_pelanggan_model extends CI_Model {

	public function getPelanggan()
	{
		return $this->db->get('member')->result();
	}

}

/* End of file admin_master_pelanggan_model.php */
/* Location: ./application/models/admin_master_pelanggan_model.php */