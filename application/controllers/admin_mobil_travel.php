<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_mobil_travel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_mobil_travel_model');
	}

	public function index()
	{
		$data['main_view'] = 'admin/admin_mobil_travel_view';
		$data['mobil_travel'] = $this->admin_mobil_travel_model->get_data_mobil();
		$data['merk'] = $this->admin_mobil_travel_model->get_merk();
		$data['travel'] = $this->admin_mobil_travel_model->get_travel();
		$this->load->view('admin/_layout', $data);
	}



	public function save()
	{
		$nama_kolom = 'Kendaraan';
		$bulan = date('m');
		$tahun = date('Y');
		$digit = 4;

		if ($this->input->post('submit')) {

			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size'] = '5000';

			$this->load->library('upload', $config);
			
			// var_dump($this->input->post('submit'));exit();
			if ($this->upload->do_upload('foto_kendaraan')) {
				$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);
				// print_r($id);
				
				if ($this->admin_mobil_travel_model->insert($id, $this->upload->data())==TRUE) {
					$this->session->set_flashdata('notif', 'success');
					redirect('admin_mobil_travel');
				} else {
					$this->session->set_flashdata('notif', 'failed');
					redirect('admin_mobil_travel');
				}
			} else {
				var_dump($this->upload->display_errors());exit();
			}
			
				
			
		}

	}

	public function delete($id){
		

			$id = $this->uri->segment(3);

			if ($this->admin_mobil_travel_model->hapus($id) == TRUE) {
				$this->session->set_flashdata('notif', 'Hapus Sukses');
				redirect('admin_mobil_travel');
			} else {
				$this->session->set_flashdata('notif', 'Hapus Gagal');
				redirect('admin_mobil_travel');
			}
			
		
		
	}

}

/* End of file admin_mobil_travel.php */
/* Location: ./application/controllers/admin_mobil_travel.php */