<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_data_pemilik extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_data_pemilik_model');
		$this->load->helper('common_helper');
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
		$nama_kolom = 'Owner';
		$bulan = date('m');
		$tahun = date('Y');
		$digit = 4;

		if ($this->input->post('submit')) {


				$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);
				// print_r($id);
				// var_dump($this->input->post(''));exit();
				if ($this->admin_data_pemilik_model->insert($id)==TRUE) {
					$this->session->set_flashdata('success', 'success');
					redirect('admin_data_pemilik');
				} else {
					$this->session->set_flashdata('failed', 'failed');
					redirect('admin_data_pemilik');
				}
				
			
		}
	}

	public function delete($id){
		

		$id = $this->uri->segment(3);

		if ($this->admin_data_pemilik_model->hapus($id) == TRUE) {
			$this->session->set_flashdata('delsuccess', 'delsuccess');
			redirect('admin_data_pemilik');
		} else {
			$this->session->set_flashdata('delfailed', 'delfailed');
			redirect('admin_data_pemilik');
		}
			
		
		
	}
		
}

/* End of file admin_data_pemilik.php */
/* Location: ./application/controllers/admin_data_pemilik.php */