<?php
Class Report extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('content_model');
		$this->load->model('product_model');
		$this->load->model('catalog_model');
	}
	
    function index(){
    	$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;
	    
    	$this->data['view'] = $this->content_model->get_info(1)->view;
    	$this->data['total_admin'] = $this->user_model->get_total();
    	$this->data['total_product'] = $this->product_model->get_total();
    	$this->data['total_catalog'] = $this->catalog_model->get_total();

    	$input = array();
    	$input['order'] = array('view','DESC');
		$input['limit'] = array('10' ,'0');

		if($this->input->post('top')){
			$top = $this->input->post('top');
			$input['limit'] = array($top ,'0');
			$top_product = $this->product_model->get_list($input);
			return $this->load->view('admin/report/top_product', array('top_product'=>$top_product));
		}

	    $this->data['top_product'] = $this->product_model->get_list($input);
	    $this->data['temp'] = 'admin/report/index';
		$this->load->view('admin/layout', $this->data);
    }
}