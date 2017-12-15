<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Squence_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('admin_squence_model');
		$this->load->helper('common_helper');
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

/* End of file squence_controller.php */
/* Location: ./application/controllers/squence_controller.php */