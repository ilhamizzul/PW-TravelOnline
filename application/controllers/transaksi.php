<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$data['main_view'] = 'transaksi_view';
		$this->load->view('index', $data);	
	}


}

/* End of file transaksi.php */
/* Location: ./application/controllers/transaksi.php */