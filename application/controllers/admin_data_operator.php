<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_data_operator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_data_operator_model');
	}

	public function index()
	{
		$data['main_view'] = 'admin/data_operator_view';

		$data['operator'] = $this->admin_data_operator_model->get_data_operator();
		$data['travel'] = $this->admin_data_operator_model->get_id_travel();

		$this->load->view('admin/_layout', $data);
	}

	public function save()
	{
		$nama_kolom = 'Oprator';
		$bulan = date('m');
		$tahun = date('Y');
		$digit = 4;

		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('no_rekening', 'Nomor Rekening', 'trim|required|min_length[10]|max_length[10]');

			if ($this->form_validation->run() == TRUE) {
				$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);
				// print_r($id);
				// var_dump($this->input->post(''));exit();
				if ($this->admin_data_operator_model->insert($id)==TRUE) {
					$this->session->set_flashdata('notif', 'success');
					redirect('admin_data_operator');
				} else {
					$this->session->set_flashdata('notif', 'failed');
					redirect('admin_data_operator');
				}
				
			} else {
				$data['notif'] = validation_errors();
				redirect('admin_data_operator' , $data);
			}
			
		}
	}

}

/* End of file admin_data_operator.php */
/* Location: ./application/controllers/admin_data_operator.php */