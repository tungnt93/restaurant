<?php
require(APPPATH.'libraries/REST_Controller.php');

class Index extends REST_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('product_model');
    }

    function product_get(){
        $data = $this->product_model->get_list();
//        $this->response(NULL, 400);
        $this->response(array('status'=>'success', 'data'=>$data), 200);
    }

}