<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_transaksi_model extends CI_Model {

	public function get_riwayat_transaksi()
	{
		$this->db->select('*');
		$this->db->from('riwayat_transaksi');
		$this->db->join('member', 'member.ID_MEMBER = riwayat_transaksi.ID_MEMBER');
		$this->db->order_by('riwayat_transaksi.ID_RIWAYAT_TRANSAKSI', 'ASC');

		return $this->db->get()->result();
	}


}

/* End of file admin_transaksi_model.php */
/* Location: ./application/models/admin_transaksi_model.php */