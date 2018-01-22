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
		if ($this->session->userdata('logged_in') && !is_null($this->session->userdata('LEVEL'))) {
			$data['main_view'] = 'admin/admin_jadwal_travel_view';
			$data['loader'] = 'loader';
			$this->load->view('admin/_layout', $data);
		}else{
			redirect('admin_dashboard','refresh');
		}
		
	}

	public function GetDataJadwalTravel()
	{
		$result = $this->admin_jadwal_travel_model->get_jadwal_travel();
		echo json_encode($result);
	}

	public function GetDataKendaraanTravel()
	{
		$result = $this->admin_jadwal_travel_model->get_kendaraan_travel();
		echo json_encode($result);
	}

	public function GetDataKota()
	{
		$result = $this->admin_jadwal_travel_model->get_kota();
		echo json_encode($result);
	}

	public function InsertJadwalTravel()
	{
		$nama_kolom = 'Jadwal';
		$bulan = date('m');
		$tahun = date('Y');
		$digit = 4;

		$result;

		$errmess = $this->admin_jadwal_travel_model->checkDataJadwal();
		if ($errmess != "") {
			$result = setResultInfo(true, $errmess, null);
		} else {
			$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);
			$status = $this->admin_jadwal_travel_model->insert($id);
			$result = setResultInfo(!$status,"OK", null);
		}
		
		echo json_encode($result);
	}

	public function UpdateJadwalTravel()
	{
		$result;

		$errmess = $this->admin_jadwal_travel_model->checkDataJadwal();
		if ($errmess != "") {
			$result = setResultInfo(true, $errmess, null);
		} else {
			$status = $this->admin_jadwal_travel_model->UpdateJadwal();
			$result = setResultInfo(!$status,"OK", null);
		}
		
		echo json_encode($result);
	}

	public function DeleteJadwalTravel()
	{
		$Id = $this->input->post("Id");
		$result;
		$delete = $this->admin_jadwal_travel_model->DeleteJadwal($Id);
		if ($delete) {
			$result = setResultInfo(!$delete, "OK", null);
		}else{
			$result = setResultInfo(!$delete, "Gagal menghapus data", null);
		}

		echo json_encode($result);
	}

}

/* End of file admin_jadwal_travel.php */
/* Location: ./application/controllers/admin_jadwal_travel.php */