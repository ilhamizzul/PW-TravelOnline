<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_transaksi_model');
	}

	public function index()
	{
		$data['main_view'] = 'admin/admin_transaksi_view';
		$data['travel'] = $this->admin_transaksi_model->get_riwayat_transaksi();

		$this->load->view('admin/_layout', $data);
	}

}

/* End of file admin_transaksi.php */
/* Location: ./application/controllers/admin_transaksi.php */