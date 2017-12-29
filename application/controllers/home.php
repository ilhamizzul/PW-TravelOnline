<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}


	public function index($offset = NULL)
	{
		$limit = 2;
    	if(!is_null($offset))
    	{
    	    $offset = $this->uri->segment(3 );
    	}
    	$this->load->library('pagination');
    	$config['uri_segment'] = 3;
    	$config['base_url'] = site_url('home/index');
    	$config['total_rows'] = $this->home_model->total_record_travel();
        $config['per_page'] = $limit;
        $config['num_links'] = 5;
    	$config['full_tag_open']= "<ul class='pagination'>";
    	$config['full_tag_close']= "</ul>";
    	$config['num_tag_open']= "<li>";
    	$config['num_tag_close']= "</li>";
    	$config['cur_tag_open']= "<li class='active'><a href='#'>";
    	$config['cur_tag_close']= "<span class='sr-only'></span></a></li>";
    	$config['next_tag_open']= "<li>";
    	$config['next_tag_close']= "</li>";
    	$config['prev_tag_open']= "<li>";
    	$config['prev_tag_close']= "</li>";
    	$config['first_tag_open']= "<li>";
    	$config['first_tag_close']= "</li>";
    	$config['last_tag_open']= "<li>";
    	$config['last_tag_close']= "</li>";
    	$this->pagination->initialize($config);

		$data['data_trevel'] = $this->home_model->get_data_travel($limit,$offset);
		$data['main_view']='home-page_view';
        $data['pagination'] = $this->pagination->create_links();
		
		$data['detail_desa_travel'] = $this->home_model->get_id_detail_desa_travel();
		$this->load->view('index',$data);


	}

	public function desaJemput()
	{
		$data['desa'] = $this->home_model->get_id_kota_jemput($id);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */