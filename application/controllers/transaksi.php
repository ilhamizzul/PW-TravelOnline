<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi_model');
		$this->load->library('upload');
		$this->load->helper('common_helper');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') && !is_null($this->session->userdata('ID_MEMBER'))) {
			$id = $this->uri->segment(3);
			$data['data_transaksi'] = $this->transaksi_model->GetTransaksi($id);
			$data['main_view'] = 'transaksi_view';
			$this->load->view('index', $data);
		}else{
			redirect('home','refresh');
		}
	}

	public function GetAdminData()
	{
		$data = $this->transaksi_model->GetAdmin();

		echo json_encode($data[0]);
	}

	public function UploadBuktiPembayaran()
	{
		$id = $this->input->post('ID');
		// $this->load->library('u', $config);
		// $data = $this->input->post('fileUpload');
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '2048';
		$config['file_name'] = $id;
		

		$error = "";
		$data = "";

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->upload->overwrite = true;
		
		if ( ! $this->upload->do_upload('fileUpload')){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			// echo "success";
		}

		$status = false;

		if ($data != "") {
			$filename = $data['upload_data']['file_name'];
			$status = $this->transaksi_model->SetBuktiPembayaran($id, $data['upload_data']['file_name']);
		}

		$result = setResultInfo(!$status ,$error, []);

		echo json_encode($result);
	}
}

/* End of file transaksi.php */
/* Location: ./application/controllers/transaksi.php */