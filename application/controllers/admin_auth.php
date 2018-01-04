<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect(base_url('admin_dashboard'));
		} else {
			redirect('admin/login_admin_view');
		}
		
	}

	public function login_admin_submit()
	{
		if($this->auth_model->login() == TRUE){
			redirect(base_url('admin_dashboard'));
		} else {
			$this->session->set_flashdata('failed', 'Login Gagal, Username/Password Salah');
			redirect('admin_auth/login_admin');
		}
	}

	public function login_admin()
	{
		$this->load->view('admin/login_admin_view');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin_auth');
	}

}

/* End of file admin_auth.php */
/* Location: ./application/controllers/admin_auth.php */