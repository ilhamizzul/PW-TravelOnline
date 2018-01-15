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
					$this->session->set_flashdata('success', 'success');
					redirect('admin_mobil_travel');
				} else {
					$this->session->set_flashdata('failed', 'failed');
					redirect('admin_mobil_travel');
				}
			} else {
				var_dump($this->upload->display_errors());exit();
			}
			
				
			
		}

	}

	public function edit($url, $id)
	{
		if ($this->input->post('submit')) {

			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size'] = '5000';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('foto_kendaraan')){
				$upload = $this->upload->data();
				$name = $upload['file_name'];
				if($this->admin_mobil_travel_model->edit_mobil_travel($id,$name) == TRUE){
					if($url == '1'){
						$this->session->set_flashdata('success', 'Edit data success');
						redirect('admin_mobil_travel');
					} else {
						$this->session->set_flashdata('success', 'Edit data success');
						redirect('admin_mobil_travel');
					}
				} else {
					if($url == '1'){
						$this->session->set_flashdata('failed', 'Edit data failed');
						redirect('admin_mobil_travel');
					}
					$this->session->set_flashdata('failed', 'Edit data failed');
					redirect('admin_mobil_travel');
				}
			} else {
				if($url == '1'){
					$this->session->set_flashdata('failed',  $this->upload->display_errors());
					redirect('admin_mobil_travel');
				}
				$this->session->set_flashdata('failed', $this->upload->display_errors());
			   	redirect('admin_mobil_travel');
			}
		}
			

	}

	public function delete($id){
		

			$id = $this->uri->segment(3);

			if ($this->admin_mobil_travel_model->hapus($id) == TRUE) {
				$this->session->set_flashdata('delsuccess', 'delsuccess');
				redirect('admin_mobil_travel');
			} else {
				$this->session->set_flashdata('delfailed', 'delfailed');
				redirect('admin_mobil_travel');
			}
			
		
		
	}

}

/* End of file admin_mobil_travel.php */
/* Location: ./application/controllers/admin_mobil_travel.php */