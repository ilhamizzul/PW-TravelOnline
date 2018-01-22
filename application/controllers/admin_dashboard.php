<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('logged_in') && !is_null($this->session->userdata('LEVEL'))) {
			$data['main_view']='admin/dashboard_view';
			$data['loader'] = 'loader';
			$this->load->view('admin/_layout',$data);
		}else{
			redirect('admin_auth','refresh');
		}
		
	}

	public function GetJumlahMobil($value='')
	{
		# code...
	}

	public function FunctionName($value='')
	{
		# code...
	}

}

/* End of file admin_dasboard.php */
/* Location: ./application/controllers/admin_dasboard.php */