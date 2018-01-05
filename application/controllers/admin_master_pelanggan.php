<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_master_pelanggan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('common_helper');
		$this->load->model('admin_master_pelanggan_model', 'pelangganmodel');
	}

	public function index()
	{
		$data['main_view']='admin/master_pelanggan_view';
		$data['loader'] = 'loader';
		$this->load->view('admin/_layout',$data);
	}

	public function getDataPelanggan()
	{
		$status = true;
		$data = $this->pelangganmodel->getPelanggan();
		if (count($data)== 0) {
			$status = false;
		}
		$result = setResultInfo(!$status,"OK", $data);
		echo json_encode($result);
	}

}

/* End of file admin_master_pelanggan.php */
/* Location: ./application/controllers/admin_master_pelanggan.php */