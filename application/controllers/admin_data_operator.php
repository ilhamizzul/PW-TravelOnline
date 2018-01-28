<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_data_operator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_data_operator_model');
		$this->load->helper('common_helper');
	}

	public function index()
	{
		$data['main_view'] = 'admin/data_operator_view';
		$data['loader'] = 'loader';
		// $data['operator'] = $this->admin_data_operator_model->get_data_operator();
		// $data['travel'] = $this->admin_data_operator_model->get_id_travel();

		$this->load->view('admin/_layout', $data);
	}

	public function GetDataOperator()
	{
		$data = $this->admin_data_operator_model->get_data_operator();

		echo json_encode($data);
	}

	public function SaveDataOperator()
	{
		$nama_kolom = 'Oprator';
		$bulan = date('m');
		$tahun = date('Y');
		$digit = 4;

		$result;

		$errmess = $this->admin_data_operator_model->CheckDataOperator();

		if ($errmess == "") {
			$id = setSquenceAndGenerateID($nama_kolom,$bulan, $tahun, $digit);
			if ($this->admin_data_operator_model->IsertDataOperator($id)) {
				$result = setResultInfo(false,"OK",null);
			} else {
				$result = setResultInfo(true,"Data Gagal Disimpan",null);
			}
		}else{
			$result = setResultInfo(true,$errmess,null);
		}
		
		echo json_encode($result);
	}

	public function DeleteDataOperator(){
		$result;
		$id = $this->input->post("Id");
		if ($this->admin_data_operator_model->hapus($id) == TRUE) {
			$result = setResultInfo(false, "Delete sukses", null);
		} else {
			$result = setResultInfo(true, "Delete Gagal", null);
		}

		echo json_encode($result);
	}

}

/* End of file admin_data_operator.php */
/* Location: ./application/controllers/admin_data_operator.php */