<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('account_setting_model');
		$this->load->helper('common_helper');
	}

	public function index()
	{
		$data['main_view'] = 'admin/admin_account_setting_view';
		$data['loader'] = 'loader';
		$this->load->view('admin/_layout', $data);
	}

	// public function edit_account_submit()
	// {
	// 	$id = $this->session->userdata('ID_USER');
	// 	if($this->account_setting_model->edit_account($id) == TRUE){
	// 		$this->session->set_flashdata('success', 'success');
	// 		redirect('account_setting');
	// 	} else {
	// 		$this->session->set_flashdata('failed', 'failed');
	// 	    redirect('account_setting');
	// 	}
	// }

	public function UpdateDataAccount()
	{
		$id = $this->session->userdata('ID_USER');
		$payload = $this->input->post("Data");

		$password = $payload['PASSWORD'];
		$username = $payload['USERNAME_ADMIN'];

		$result;

		$errmes = $this->account_setting_model->CheckPassword($id, $password);
		if ($errmes == "") {
			$errmes = $this->account_setting_model->CheckUsername($id, $username);
			if ($errmes == "") {
				$update = $this->account_setting_model->edit_account($id);
				if ($update) {
					$result = setResultInfo(False,"OK",null);
				}else{
					$result = setResultInfo(TRUE,"Gagal mengedit data",null);
				}
			}else{
				$result = setResultInfo(TRUE,$errmes,null);
			}
		}else{
			$result = setResultInfo(TRUE,$errmes,null);
		}

		echo json_encode($result);
	}

	public function GetDataAccount()
	{
		$id = $this->session->userdata('ID_USER');
		$data = $this->account_setting_model->get_account_profile($id);
		
		echo json_encode($data);
	}

}

/* End of file account_setting.php */
/* Location: ./application/controllers/account_setting.php */