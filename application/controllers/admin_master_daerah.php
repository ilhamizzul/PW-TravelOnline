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

	public function testSquence()
	{
		$data = $this->input->post("Squence");
		$nama_kolom = $data['nama_kolom'];
		$bulan = $data['bulan'];
		$tahun = $data['tahun'];
		$digit = $data['digit_angka'];

		$result = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);

		echo json_encode($result);
	}
}

/* End of file admin_master_daerah.php */
/* Location: ./application/controllers/admin_master_daerah.php */