<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
        $this->load->model('search_model');
	}


	public function index($offset = NULL)
	{
		$limit = 8;
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

        $this->output->enable_profiler(TRUE);
	}

    public function get_data()
    {   
        $limit = 2;
        $offset = 1;

        // if(!is_null($offset))
        // {
        //     $offset = $this->uri->segment(3 );
        // }
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

        $departure = $this->input->post('depart');
        $arrival = $this->input->post('to');
        $date = $this->input->post('date');

        if ($departure == "" && $arrival == "" && $date == "") {
            
        }else{
            $data['data_trevel'] = $this->search_model->get_results();
        }
        $data['main_view']='home-page_view';
        
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('index', $data);
    }



    public function showDetail()
    {
        $id = $this->uri->segment(3);
        $asal = $this->uri->segment(4);
        $tujuan = $this->uri->segment(5);

        $data['desaasal'] = $this->home_model->getDetailDesa($id, $asal, $tujuan)[0];
        $data['desatujuan'] = $this->home_model->getDetailDesa($id, $asal, $tujuan)[1];

        $data['main_view']='home-page_view';
        $this->load->view('index', $data);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */