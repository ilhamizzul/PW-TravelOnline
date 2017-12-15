<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {

	public function index()
	{
		$data['main_view']='admin/dashboard_view';
		$this->load->view('admin/_layout',$data);
	}

}

/* End of file admin_dasboard.php */
/* Location: ./application/controllers/admin_dasboard.php */