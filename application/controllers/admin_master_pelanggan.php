<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_master_pelanggan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('common_helper');
	}

	public function index()
	{
		$data['main_view']='admin/master_pelanggan_view';
		$data['loader'] = 'loader';
		$this->load->view('admin/_layout',$data);
	}

}

/* End of file admin_master_pelanggan.php */
/* Location: ./application/controllers/admin_master_pelanggan.php */