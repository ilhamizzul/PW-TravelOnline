<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_travel_detail_desa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('common_helper');
		$this->load->model('admin_travel_detail_desa_model', 'detaildesamodel');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') && ($this->session->userdata('LEVEL') == 'OPERATOR' || $this->session->userdata('LEVEL') == 'OWNER')){
			$data['main_view']='admin/travel_detail_desa_view';
			$data['loader'] = 'loader';
			$this->load->view('admin/_layout',$data);
		}else{
			redirect('admn_dashboard','refresh');
		}
		
	}

	public function GetDataDetailDesa()
	{
		$data = $this->detaildesamodel->GetDetailDesa();

		echo json_encode($data);
	}

}

/* End of file admin_travel_detail_desa.php */
/* Location: ./application/controllers/admin_travel_detail_desa.php */