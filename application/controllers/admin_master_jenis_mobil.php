<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_master_jenis_mobil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('common_helper');
		$this->load->model('admin_master_jenis_mobil_model', 'jenismobilmodel');
	}

	public function index()
	{
		$data['main_view']='admin/master_jenis_mobil_view';
		$data['loader'] = 'loader';
		$this->load->view('admin/_layout',$data);
	}

	public function saveData()
	{
		$squence = $this->input->post("Squence");
		$data = $this->input->post("Data");
		$nama_kolom = $squence['nama_kolom'];
		$bulan = $squence['bulan'];
		$tahun = $squence['tahun'];
		$digit = $squence['digit_angka'];

		$errmess = $this->jenismobilmodel->checkDataMobil();
		if ($errmess != "") {
			$result = setResultInfo(true, $errmess, null);
		} else {
			$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);
			$status = $this->jenismobilmodel->insertDataMobil($id);
			$result = setResultInfo(!$status,"OK", null);
		}
		
		echo json_encode($result);
	}

	public function getDataJenisMobil()
	{
		$status = true;
		$data = $this->jenismobilmodel->getJenisMobil();
		if (count($data)== 0) {
			$status = false;
		}
		$result = setResultInfo(!$status,"OK", $data);
		echo json_encode($result);
	}

	public function editData()
	{
		// $status = true;
		$errmess = $this->jenismobilmodel->checkDataMobil();
		if ($errmess != "") {
			$result = setResultInfo(true, $errmess, null);
		} else {
			$status = $this->jenismobilmodel->editDataMobil();
			$result = setResultInfo(!$status,"OK", null);
		}

		echo json_encode($result);
	}

	public function deleteData()
	{
		$id = $this->input->post("Data");

		$delete = $this->jenismobilmodel->deleteDataMobil($id);
		
		if ($delete) {
			$result = setResultInfo(false, "OK", null);
		}else{
			$result = setResultInfo(true, "ERROR", null);
		}

		echo json_encode($result);
	}

}

/* End of file admin_master_jenis_mobil.php */
/* Location: ./application/controllers/admin_master_jenis_mobil.php */