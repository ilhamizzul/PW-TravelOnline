<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin_dashboard_model', 'dashboardmodel');
	}

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


	public function GetTransaksi()
	{
		$data = $this->dashboardmodel->GetDataTransaksi();

		echo json_encode($data);
	}

}

/* End of file admin_dasboard.php */
/* Location: ./application/controllers/admin_dasboard.php */