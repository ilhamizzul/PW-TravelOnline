<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('account_setting_model');
	}

	public function index()
	{
		$id = $this->session->userdata('ID_USER');
		$data['main_view'] = 'admin/admin_account_setting_view';
		$data['profil'] = $this->account_setting_model->get_account_profile($id);
		$this->load->view('admin/_layout', $data);
	}

}

/* End of file account_setting.php */
/* Location: ./application/controllers/account_setting.php */