<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanggungan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('history_model');
		$this->load->helper('common_helper');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') && !is_null($this->session->userdata('ID_MEMBER'))) {
			$data['main_view']='tanggungan_view';
			$this->load->view('index',$data);
		}else{
			redirect('home','refresh');
		}
	}

}

/* End of file tanggungan.php */
/* Location: ./application/controllers/tanggungan.php */