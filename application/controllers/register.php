<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('register_model');
	}

	public function index()
	{
		$data['main_view'] = 'register_view';
		$this->load->view('index', $data);
	}

	public function simpan()
	{
		if ($this->input->post('submit')) {
			
			$this->form_validation->set_rules('name', 'Nama', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
			$this->form_validation->set_rules('no_identitas', 'Nomor Identitas', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if ($this->register_model->insert()==TRUE) {
					$this->session->set_flashdata('notif', 'success');
					redirect('index.php/register');
				} else {
					$this->session->set_flashdata('notif', 'failed');
					redirect('index.php/register');
				}
				
			} else {
				$data['notif'] = validation_errors();
				redirect('index.phpregister');
			}
			
		}
		
	}

}

/* End of file register.php */
/* Location: ./application/controllers/register.php */