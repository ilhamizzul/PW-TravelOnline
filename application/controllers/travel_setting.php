<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Travel_setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_travel_agen_model', 'agentravelmodel');
		$this->load->helper('common_helper');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == true && !is_null($this->session->userdata('ID_TRAVEL'))) {
			if ($this->session->userdata('LEVEL')=="OWNER") {
				$data['main_view'] = 'admin/admin_travel_setting_view';
				$data['loader'] = 'loader';
				$this->load->view('admin/_layout', $data);
			}else{
				redirect('admin_dashboard','refresh');
			}
		}else{
			redirect('admin_auth/login_admin','refresh');
		}
	}

	public function GetDataTravel()
	{
		$id = $this->session->userdata('ID_TRAVEL');
		$data = $this->agentravelmodel->GetAgenTravelX($id);

		echo json_encode($data);
	}

	public function UpdateNamaTravel()
	{
		$namatravel = $this->input->post("NAMA_TRAVEL");
		$id = $this->session->userdata('ID_TRAVEL');
		$result;
		$errmes = $this->agentravelmodel->CheckNamaTravel($id, $namatravel);
		if ($errmes == "") {
			$update = $this->agentravelmodel->ChangeNamaTravel($id, $namatravel);
			if ($update) {
				$result = setResultInfo(false, "OK", null);
			}else{
				$result = setResultInfo(true, "Gagal mengubah nama", null);
			}
		}else{
			$result = setResultInfo(true,$errmes,null);
		}

		echo json_encode($result);
	}

	public function ChangeLogoTravel()
	{
		$id = $this->session->userdata('ID_TRAVEL');
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '2048';
		$config['file_name'] = $id;
		// $config['max_width']  = '1024';
		// $config['max_height']  = '768';
		
		// $error = "";
		// $data = "";
		$result;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->overwrite = true;
		
		if ( ! $this->upload->do_upload('fileUpload')){
			$error = array('error' => $this->upload->display_errors());
			$result = setResultInfo(true, $error, null);
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			$filename = $data['upload_data']['file_name'];
			$update = $this->agentravelmodel->UpdateLogoTravel($id, $filename);
			if ($update) {
				$result = setResultInfo(false,"OK", null);
			}else{
				$result = setResultInfo(true,"Ubah logo travel gagal", null);
			}
		}

		echo json_encode($result);
	}

}

/* End of file travel_setting.php */
/* Location: ./application/controllers/travel_setting.php */