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

				$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);
				// print_r($id);
				// var_dump($this->input->post(''));exit();
				if ($this->admin_data_operator_model->insert($id)==TRUE) {
					$this->session->set_flashdata('success', 'success');
					redirect('admin_data_operator');
				} else {
					$this->session->set_flashdata('failed', 'failed');
					redirect('admin_data_operator');
				}
				
			
		}
	}

	public function delete($id){
		

		$id = $this->uri->segment(3);

		if ($this->admin_data_operator_model->hapus($id) == TRUE) {
			$this->session->set_flashdata('delsuccess', 'delsuccess');
			redirect('admin_data_operator');
		} else {
			$this->session->set_flashdata('delfailed', 'delfailed');
			redirect('admin_data_operator');
		}
			
		
		
	}

}

/* End of file admin_data_operator.php */
/* Location: ./application/controllers/admin_data_operator.php */