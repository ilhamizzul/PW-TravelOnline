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
			
			$this->form_validation->set_rules('name', 'Nama Member', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
			$this->form_validation->set_rules('no_identitas', 'Nomor Identitas', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				$nama_kolom = 'Pelanggan';
				$bulan = date('m');
				$tahun = date('Y');
				$digit = 4;

				$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);

				if ($this->register_model->insert($id)==TRUE) {
					$this->session->set_flashdata('success', 'success');
					redirect('register');
				} else {
					$this->session->set_flashdata('failed', 'failed');
					redirect('register');
				}
			} else {
				$this->session->set_flashdata('failed', 'failed');
					redirect('register');
			}
				
			
		}
		
	}

}

/* End of file register.php */
/* Location: ./application/controllers/register.php */