<?php
require(APPPATH.'libraries/REST_Controller.php');

class Index extends REST_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('catalog_model');
    }

    function product_get(){
//            echo file_get_contents('php://input', 'r');
            pre( $this->input->request_headers());
//        $data = $this->product_model->get_list();
//        $this->response(array('status'=>'success', 'data'=>$data), 200);
    }

    function catalog_get(){
        $data = $this->catalog_model->get_list();
        $this->response(array('status'=>'success', 'data'=>$data), 200);
    }

}