<?php
require(APPPATH.'libraries/REST_Controller.php');

class MobileApp extends REST_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('catalog_model');
        $this->load->model('user_model');
        $this->load->model('table_model');
        $this->load->model('employee_model');
        $this->load->model('order_model');
    }

    function my_response($status, $message){
        if($status){
            $this->response(array('status'=>'success', 'message'=>$message, 200));
        }
        else{
            $this->response(array('status'=>'failed', 'message'=>$message, 200));
        }
    }

    function login_post(){
//        pre($this->input->request_headers());
        $username = $this->post('username');
        $password = $this->post('password');
        $input = array();
        $input['where'] = array('username' => $username,'password' => $password);
        $user = $this->user_model->get_list($input);
        if($user){
            $token = md5(uniqid(rand(), true));
            if($this->user_model->update($user[0]->id, array('token'=>$token))){
                $info = $this->employee_model->get_info($user[0]->id);
//                $this->response(array('status'=>'success', 'token'=>$token, 'info'=>$info));
                $this->my_response(true, array('token'=>$token, 'info'=>$info));
            }
            else{
                $this->my_response(false, array('error'=>'Lỗi server, vui lòng thử lại!'));
            }
        }
        else{
            $this->my_response(false, array('error'=>'Tên đăng nhập hoặc mật khẩu không đúng!'));
        }
    }

    function catalog_get(){
        $input = array();
        $input['order'] = array('position', 'ASC');
        $catalogs = $this->catalog_model->get_list($input);
        foreach ($catalogs as $row){
            $row->img = public_url('images/menu/'.$row->img);
        }
        $this->my_response(true, array('catalogs'=>$catalogs));
    }

    function product_get(){
        $catalog_id = $this->input->get('catalog_id');

        $input = array();
        $input['where']['catalog_id'] = $catalog_id;
        $products = $this->product_model->get_list($input);
        foreach ($products as $row){
            $row->img_link = public_url('images/product/'.$row->img_link);
        }
        $this->my_response(true, array('products'=>$products));
    }

    function all_product_get(){
        $input = array();
        $input['order'] = array('catalog_id', 'ASC');
        $products = $this->product_model->get_list($input);
        foreach ($products as $row){
            $row->img_link = public_url('images/product/'.$row->img_link);
        }
        $this->my_response(true, array('products'=>$products));
    }

    function listTable_get(){
        $tables = $this->table_model->get_list();
        $this->my_response(true, array('tables'=>$tables));
    }

    function ordereds_get(){
        $bill_id = $this->input->get('bill_id');
        $input = array();
        $input['where']['bill_id'] = $bill_id;
        $ordereds = $this->order_model->get_list($input);
        foreach ($ordereds as $row){
            $product = $this->product_model->get_info($row->product_id);
            $row->product_name = $product->name;
            $row->product_price = $product->price;
        }
        $this->my_response(true, array('ordereds'=>$ordereds));
    }

//    function payments_get(){
//        $bill_id = $this->input->get('bill_id');
//        $input = array();
//        $input['where']['bill_id'] = $bill_id;
//        $ordereds = $this->order_model->get_list($input);
//        foreach ($ordereds as $row){
//            $row->product_name = $this->product_model->get_info($row->product_id)->name;
//        }
//        $this->my_response(true, array('ordereds'=>$ordereds));
//    }

//    function product_get(){
//            echo file_get_contents('php://input', 'r');
//        pre($this->input->get_request_header());
//        pre(md5(uniqid(rand(), true)));
//        $data = $this->product_model->get_list();
//        $this->response(array('status'=>'success', 'data'=>$data), 200);
//    }

//    function catalog_get(){
//        $data = $this->catalog_model->get_list();
//        $this->response(array('status'=>'success', 'data'=>$data), 200);
//    }

}