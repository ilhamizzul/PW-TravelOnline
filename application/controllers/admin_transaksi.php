<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_transaksi_model');
		$this->load->helper('common_helper');
	}

	public function index()
	{
		$data['main_view'] = 'admin/admin_transaksi_view';
		$data['loader'] = 'loader';
		$this->load->view('admin/_layout',$data);
	}

	public function GetDataTransaksi()
	{
		$data = $this->admin_transaksi_model->get_riwayat_transaksi();
		$result = setResultInfo(false,"OK", $data);
		echo json_encode($result);
	}

}

/* End of file admin_transaksi.php */
/* Location: ./application/controllers/admin_transaksi.php */