<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_data_pemilik extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_data_pemilik_model');
	}

	public function index()
	{
		$data['main_view'] = 'admin/data_pemilik_view';

		$data['owner'] = $this->admin_data_pemilik_model->get_data_owner();
		$data['travel'] = $this->admin_data_pemilik_model->get_id_travel();

		$this->load->view('admin/_layout', $data);
	}

	public function save()
	{
		if ($this->input->post('submit')) {

			if ($this->form_validation->run() == TRUE) {
				if ($this->admin_data_pemilik_model->insert()==TRUE) {
					$this->session->set_flashdata('notif', 'success');
					redirect('admin_data_pemilik');
				} else {
					$this->session->set_flashdata('notif', 'failed');
					redirect('admin_data_pemilik');
				}
				
			} else {
				$data['notif'] = validation_errors();
				redirect('admin_data_pemilik');
			}
			
		}
		
	}
	

}

/* End of file admin_data_pemilik.php */
/* Location: ./application/controllers/admin_data_pemilik.php */