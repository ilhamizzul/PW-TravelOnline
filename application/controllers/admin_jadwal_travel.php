<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_jadwal_travel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_jadwal_travel_model');
	}

	public function index()
	{
		$data['main_view'] = 'admin/admin_jadwal_travel_view';
		$data['jadwal'] = $this->admin_jadwal_travel_model->get_jadwal_travel();
		$data['kendaraan'] = $this->admin_jadwal_travel_model->get_kendaraan_travel();
		$data['kota'] = $this->admin_jadwal_travel_model->get_kota();
		$this->load->view('admin/_layout', $data);
	}

	public function save()
	{
		$nama_kolom = 'Jadwal';
		$bulan = date('m');
		$tahun = date('Y');
		$digit = 4;

		if ($this->input->post('submit')) {

				$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);
				// print_r($id);
				// var_dump($this->input->post(''));exit();
				if ($this->admin_jadwal_travel_model->insert($id)==TRUE) {
					$this->session->set_flashdata('notif', 'success');
					redirect('admin_jadwal_travel');
				} else {
					$this->session->set_flashdata('notif', 'failed');
					redirect('admin_jadwal_travel');
				}
				
			
		}
	}

}

/* End of file admin_jadwal_travel.php */
/* Location: ./application/controllers/admin_jadwal_travel.php */