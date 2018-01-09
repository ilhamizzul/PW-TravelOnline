<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_travel_agen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$data['main_view']='admin/travel_agen_travel_view';
		$data['loader'] = 'loader';
		$this->load->view('admin/_layout',$data);
	}

}

/* End of file admin_travel_agen.php */
/* Location: ./application/controllers/admin_travel_agen.php */