<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_travel_detail_desa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('common_helper');
		$this->load->model('admin_squence_model', 'squencemodel');
		$this->load->model('admin_travel_detail_desa_model', 'detaildesamodel');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') && ($this->session->userdata('LEVEL') == 'OPERATOR' || $this->session->userdata('LEVEL') == 'OWNER')){
			$data['main_view']='admin/travel_detail_desa_view';
			$data['loader'] = 'loader';
			$this->load->view('admin/_layout',$data);
		}else{
			redirect('admin_dashboard','refresh');
		}
		
	}

	public function GetDataDetailDesa()
	{
		$data = $this->detaildesamodel->GetDetailDesa();

		echo json_encode($data);
	}

	public function GetDataDropdown()
	{
		$dataKota = $this->detaildesamodel->GetKota();
		$dataDesa = $this->detaildesamodel->GetDesa();
		$data = array('DATA_KOTA' => $dataKota, 'DATA_DESA'=>$dataDesa);
		echo json_encode($data);
	}

	public function SaveDetailDesa()
	{
		$nama_kolom = 'Detail Desa';
		$bulan = date('m');
		$tahun = date('Y');
		$digit = 4;

		$status = false;

		$id_travel = $this->session->userdata('ID_TRAVEL');

		$desa = array();

		$payload = $this->input->post("Data");
		$squence = GetDefaultSquence($nama_kolom, $bulan, $tahun);

		foreach ($payload as $newData) {
			$duplicateData = $this->detaildesamodel->chekDataDetailDesa($newData, $id_travel);
			if ($duplicateData == "") {
				$status = ($status || true);
				$id_detail_desa_travel = idGenerator($nama_kolom,$bulan, $tahun, $digit, ++$squence[1]);
				if (!$this->detaildesamodel->insertDataDetailDesa($id_detail_desa_travel, $newData, $id_travel)) {
					echo json_encode(setResultInfo(true,"Gagal menyimpan data", null));
					return;
				}
			}else{
				$status = ($status || false);
				array_push($desa, $duplicateData);
			}
		}

		$this->squencemodel->updateSquence($squence[0], $squence[1]);

		$result = setResultInfo(!$status, "Beberapa data tidak tersimpan", $desa);
		echo json_encode($result);
		return;
	}

	public function DeleteDetailDesa()
	{
		$id = $this->input->post("Id");
		$result;
		if ($this->detaildesamodel->DeleteDetailDesa($id)) {
			$result = setResultInfo(false, "OK", null);
		}else{
			$result = setResultInfo(true, "Gagal delete data", null);
		}

		echo json_encode($result);
	}
}

/* End of file admin_travel_detail_desa.php */
/* Location: ./application/controllers/admin_travel_detail_desa.php */