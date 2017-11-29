<?php
Class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('content_model');
		$this->load->model('sale_model');
		$this->load->model('catalog_model');
	}

	function index() {

		$per_page = 40;
		$offset=$this->uri->segment(1);
		$offset = intval($offset);
		$total = $this->product_model->get_total();
		$paginator = config_pagination($per_page, 1, $total, base_url());

        if ($offset >= 1) {
        	$offset -= 1;
        	$offset = $offset*$per_page;
        }
        $input = array();
		$input['limit'] = array($per_page, $offset);
		$list_product = $this->product_model->get_list($input);
		$this->data['paginator'] = $paginator;
		$this->data['list_product'] = $list_product;

        $input = array();
        $input['order'] = array('position', 'ASC');
				$input['where']['status'] = 1;
        $catalog = $this->catalog_model->get_list($input);
        $this->data['catalog'] = $catalog;

		$input = array();
        $input['limit'] = array(8, 0);
        $sales = $this->sale_model->get_list($input);
        $this->data['sales'] = $sales;

		$this->data['temp'] = 'site/home/index';
		$this->load->view('site/layout', $this->data);
	}

	function intro(){
		$this->data['temp'] = 'site/content/intro';
		$this->load->view('site/layout', $this->data);
	}
	function contact(){
		$this->data['temp'] = 'site/content/contact';
		$this->load->view('site/layout', $this->data);
	}

	function search(){
		$search_term = '';
		if($this->input->post('btnSearch')){
			$search_term = $this->input->post('key');
    		$this->session->set_userdata('search_term', $search_term);
		}
		elseif ($this->session->userdata('search_term')){
		    $search_term = $this->session->userdata('search_term');
		}
		if($search_term == '' || $search_term == null){
			redirect(base_url());
		}
		else{
			$per_page = 30;
			$offset=$this->uri->segment(2);
			$offset = intval($offset);

			$input = array();
	        $input['like'] = array('name', $search_term);
	        $total = count($this->product_model->get_list($input));

	        $paginator = config_pagination($per_page, 2, $total, base_url('search'));
	        if ($offset >= 1) {
	        	$offset -= 1;
	        	$offset = $offset*$per_page;
	        }


	        $input['limit'] = array($per_page, $offset);
	        $list_product = $this->product_model->get_list($input);
	        $this->data['list_product'] = $list_product;
	        $this->data['paginator'] = $paginator;
			$this->data['key'] = $search_term;
			$this->data['total'] = $total;
			$this->data['temp'] = 'site/product/search';
			$this->load->view('site/layout', $this->data);
		}
	}
}
