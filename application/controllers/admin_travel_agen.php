<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_travel_agen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('common_helper');
		$this->load->model('admin_travel_agen_model', 'travelagenmodel');
		//Do your magic here
	}

	public function index()
	{
		$data['main_view']='admin/travel_agen_travel_view';
		$data['loader'] = 'loader';
		$this->load->view('admin/_layout',$data);
	}

	public function GetDataAdminTravel()
	{
		$data = $this->travelagenmodel->GetAgenTravel();

		echo json_encode($data);
	}

	public function DeleteAgenTravel()
	{
		$id = $this->input->post('ID');
		$errmes = "";
		$delete = $this->travelagenmodel->DeleteDataAgenTravel($id);
		if (!$delete) {
			$errmes = "Data digunakan oleh data lain";
		}

		echo json_encode(setResultInfo(!$delete, $errmes, $id));

	}

	public function SaveDataAgenTravel()
	{
		$namatravel = $this->input->post('NAMA_TRAVEL');
		$insert = false;
		$errmes = $this->travelagenmodel->CheckDataMobil($namatravel);

		if ($errmes == "") {
			$nama_kolom = "Travel";
	        $bulan = date("m");
	        $tahun = date("Y");
	        $digit = 4;

	        $id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);
			$insert = $this->travelagenmodel->InsertAgenTravel($id, $namatravel);
		}

		$result = setResultInfo(!$insert, $errmes, null);
		echo json_encode($result);
	}

}

/* End of file admin_travel_agen.php */
/* Location: ./application/controllers/admin_travel_agen.php */