<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_master_daerah extends CI_Controller {

	public $data = '';

	public function __construct()
	{
		parent::__construct();

		$this->load->model('admin_master_daerah_model');
		$this->load->helper('common_helper');
	}

	public function index()
	{
		$data['main_view']='admin/master_daerah_view';
		$data['loader'] = 'loader';
		$this->load->view('admin/_layout',$data);
	}

	public function getDataProvinsi()
	{
		$dataProvinsi = $this->admin_master_daerah_model->getDataProvinsi();
		
		echo json_encode($dataProvinsi);
	}

	public function getDataKota()
	{
		$dataKota = $this->admin_master_daerah_model->getDataKota();
		
		echo json_encode($dataKota);
	}

	public function getDataDesa()
	{
		$dataDesa= $this->admin_master_daerah_model->getDataDesa();
		
		echo json_encode($dataDesa);
	}

	public function saveDataProvinsi()
	{
		$squence = $this->input->post("Squence");
		// $data = $this->input->post("Data");
		$nama_kolom = $squence['nama_kolom'];
		$bulan = $squence['bulan'];
		$tahun = $squence['tahun'];
		$digit = $squence['digit_angka'];

		$errmess = $this->admin_master_daerah_model->chekDataProvinsi();
		if ($errmess != "") {
			$result = setResultInfo(true, $errmess, null);
		} else {
			$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);

			$status = $this->admin_master_daerah_model->insertProvinsi($id);

			$result = setResultInfo(!$status,"OK", null);
		}
		
		echo json_encode($result);
	}

	public function saveDataKota()
	{
		$squence = $this->input->post("Squence");
		// $data = $this->input->post("Data");
		$nama_kolom = $squence['nama_kolom'];
		$bulan = $squence['bulan'];
		$tahun = $squence['tahun'];
		$digit = $squence['digit_angka'];

		$errmess = $this->admin_master_daerah_model->chekDataKota();
		if ($errmess != "") {
			$result = setResultInfo(true, $errmess, null);
		} else {
			$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);

			$status = $this->admin_master_daerah_model->insertKota($id);

			$result = setResultInfo(!$status,"OK", null);
		}
		
		echo json_encode($result);
	}
	
	public function saveDataDesa()
	{
		$squence = $this->input->post("Squence");
		// $data = $this->input->post("Data");
		$nama_kolom = $squence['nama_kolom'];
		$bulan = $squence['bulan'];
		$tahun = $squence['tahun'];
		$digit = $squence['digit_angka'];

		$errmess = $this->admin_master_daerah_model->chekDataDesa();
		if ($errmess != "") {
			$result = setResultInfo(true, $errmess, null);
		} else {
			$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);

			$status = $this->admin_master_daerah_model->insertDesa($id);

			$result = setResultInfo(!$status,"OK", null);
		}
		
		echo json_encode($result);
	}

	public function updateDataProvinsi()
	{
		$errmess = $this->admin_master_daerah_model->chekDataProvinsi();
		if ($errmess != "") {
			$result = setResultInfo(true, $errmess, null);
		} else {
			$update = $this->admin_master_daerah_model->updateProvinsi();
			$result = setResultInfo(!$update, "OK", null);
		}

		echo json_encode($result);
	}

	public function updateDataKota()
	{
		$errmess = $this->admin_master_daerah_model->chekDataKota();
		if ($errmess != "") {
			$result = setResultInfo(true, $errmess, null);
		} else {
			$update = $this->admin_master_daerah_model->updateKota();
			$result = setResultInfo(!$update, "OK", null);
		}

		echo json_encode($result);
	}
	
	public function updateDataDesa()
	{
		$errmess = $this->admin_master_daerah_model->chekDataDesa();
		if ($errmess != "") {
			$result = setResultInfo(true, $errmess, null);
		} else {
			$update = $this->admin_master_daerah_model->updateDesa();
			$result = setResultInfo(!$update, "OK", null);
		}

		echo json_encode($result);
	}

	public function deleteDataProvinsi()
	{
		$id = $this->input->post("Data");

		$delete = $this->admin_master_daerah_model->deleteProvinsi($id);
		
		if ($delete) {
			$result = setResultInfo(false, "OK", null);
		}else{
			$result = setResultInfo(true, "ERROR", null);
		}

		echo json_encode($result);
	}

	public function deleteDataKota()
	{
		$id = $this->input->post("Data");

		$delete = $this->admin_master_daerah_model->deleteKota($id);
		
		if ($delete) {
			$result = setResultInfo(false, "OK", null);
		}else{
			$result = setResultInfo(true, "ERROR", null);
		}

		echo json_encode($result);
	}

	public function deleteDataDesa()
	{
		$id = $this->input->post("Data");

		$delete = $this->admin_master_daerah_model->deleteDesa($id);
		
		if ($delete) {
			$result = setResultInfo(false, "OK", null);
		}else{
			$result = setResultInfo(true, "ERROR", null);
		}

		echo json_encode($result);
	}

}

/* End of file admin_master_daerah.php */
/* Location: ./application/controllers/admin_master_daerah.php */