<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		$data['main_view']='history_view';
		$this->load->view('index',$data);
	}

	public function history()
	{
			
	}


}

/* End of file history.php */
/* Location: ./application/controllers/history.php */