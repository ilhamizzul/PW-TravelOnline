<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('history_model');
		$this->load->helper('common_helper');
	}
	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			$data['main_view']='history_view';
			$this->load->view('index',$data);
		}else{
			redirect('home','refresh');
		}
		
	}

	public function GetDataHistory()
	{
		$datahistory = $this->history_model->GetHistory();
		echo json_encode($datahistory);
	}

	public function PushBlockedData()
	{
		$data = $this->input->post("Data");
		foreach ($data as $id) {
			echo json_encode($id);
		}
	}


}

/* End of file history.php */
/* Location: ./application/controllers/history.php */