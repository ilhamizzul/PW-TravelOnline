<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}


	public function index()
	{
		$data['data_trevel'] = $this->home_model->get_data_travel();
		$data['main_view']='home-page_view';
		$data['detail_desa_travel'] = $this->home_model->get_id_detail_desa_travel();
		$this->load->view('index',$data);
	}

	public function desaJemput()
	{
		$data['desa'] = $this->home_model->get_id_kota_jemput($id);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */