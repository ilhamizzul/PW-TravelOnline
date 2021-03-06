<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function masuk()
	{
		if ($this->login_model->cek_user() == TRUE) {
			$this->session->set_flashdata('success', 'success');
			redirect('home');
		} else {
			$this->session->set_flashdata('failed', 'failed');
			redirect('home');
		}
		
	}

	public function logout()
	{
		$data = array(
			'USERNAME' => '', 
			'logged_in' => FALSE,
			'ID_MEMBER' => '',
		);
		
		$this->session->sess_destroy();
		redirect('home');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */