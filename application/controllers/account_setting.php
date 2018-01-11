<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_setting extends CI_Controller {

	public function index()
	{
		$data['main_view'] = 'admin/admin_account_setting_view';
		$this->load->view('admin/_layout', $data);
	}

}

/* End of file account_setting.php */
/* Location: ./application/controllers/account_setting.php */