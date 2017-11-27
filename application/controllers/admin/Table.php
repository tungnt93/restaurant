<?php
Class Table extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('food_model');
        $this->load->model('catalog_model');
        $this->load->model('table_model');
        $this->load->model('order_model');
        $this->load->model('bill_model');
        $this->load->model('dailyMenu_model');
        $this->load->model('product_model');
    }

    function index() {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $tables = $this->table_model->get_list();
        $this->data['tables'] = $tables;

        $this->data['temp'] = 'admin/table/index';
        $this->load->view('admin/layout', $this->data);
    }

    function add(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if($this->input->post('btnAdd')){
            $name = $this->input->post('txtName');
            $seat = $this->input->post('txtSeat');
            if($name != '' && $seat != ''){
                $dataAdd = array(
                    'name' => $name,
                    'seat' => $seat,
                    'status' => 1
                );
                if($this->table_model->create($dataAdd)){
                    $this->session->set_flashdata('message','Thêm bàn thành công');
                    redirect(base_url('admin/table'));
                }
                else{
                    $this->session->set_flashdata('message','Lỗi thao tác với cơ sở dữ liệu. Thêm bàn thất bại');
                    redirect(base_url('admin/table/add'));
                }
            }
            else{
                $this->session->set_flashdata('message','Bạn chưa nhập tên bàn!');
                redirect(base_url('admin/table/add'));
            }
        }

        $this->data['temp'] = 'admin/table/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $id = $this->uri->segment(4);
        $table = $this->table_model->get_info($id);
        if(!$table){
            redirect(base_url('admin/table'));
        }
        else if($table->status != 1){
            $this->session->set_flashdata('message','Chỉ được sửa thông tin bàn đang trống!');
            redirect(base_url('admin/table'));
        }

        $this->data['table'] = $table;
        if($this->input->post('btnAdd')){
            $name = $this->input->post('txtName');
            $seat = $this->input->post('txtSeat');
            if($name != '' && $seat != ''){
                $dataAdd = array(
                    'name' => $name,
                    'seat' => $seat,
                );
                if($this->table_model->update($id, $dataAdd)){
                    $this->session->set_flashdata('message','Chỉnh sửa bàn thành công');
                    redirect(base_url('admin/table'));
                }
                else{
                    $this->session->set_flashdata('message','Lỗi thao tác với cơ sở dữ liệu. Chỉnh sửa bàn thất bại');
                    redirect(base_url('admin/table/edit/'.$id));
                }
            }
            else{
                $this->session->set_flashdata('message','Bạn chưa nhập tên bàn!');
                redirect(base_url('admin/table/edit/'.$id));
            }
        }

        $this->data['temp'] = 'admin/table/add';
        $this->load->view('admin/layout', $this->data);
    }

    function del(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $id = $this->uri->segment(4);
        $table = $this->table_model->get_info($id);
        if(!$table){
            redirect(base_url('admin/table'));
        }
        else if($table->status != 1){
            $this->session->set_flashdata('message','Chỉ được xóa bàn đang trống!');
            redirect(base_url('admin/table'));
        }
        if($this->table_model->delete($id)){
            $this->session->set_flashdata('message','Xóa bàn thành công!');
            redirect(base_url('admin/table'));
        }
        else{
            $this->session->set_flashdata('message','Lỗi thao tác với cơ sở sữ liệu. Xóa bàn thất bại!');
            redirect(base_url('admin/table'));
        }
    }

    function order(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $table_id = $this->uri->segment(4);
        if($table_id){
            $table = $this->table_model->get_info($table_id);
            $bill = $this->bill_model->get_info($table->bill_id);
            $this->data['table'] = $table;
            $this->data['bill'] = $bill;

            $input = array();
            $input['where']['bill_id'] = $table->bill_id;
            $orders = $this->order_model->get_list($input);
            $this->data['orders'] = $orders;

            $input = array();
            $input['where']['date'] = date('d-m-Y');
            $daily_menus = $this->dailyMenu_model->get_daily_menu(date('d-m-Y'));
            $products = array();
            foreach ($daily_menus as $key => $value){
                if(!isset($products[$value->catalog_id])){
                    $products[$value->catalog_id] = array();
                }
                $products[$value->catalog_id][] = $value;
            }
//            pre($products);
            $this->data['products'] = $products;

            $this->data['temp'] = 'admin/table/order/detail';
            $this->load->view('admin/layout', $this->data);
        }
        else{
            $tables = $this->table_model->get_list();
            $this->data['tables'] = $tables;
            $this->data['temp'] = 'admin/table/order/index';
            $this->load->view('admin/layout', $this->data);
        }
    }

    function list_table(){
        $tables = $this->table_model->get_list();
        $this->data['tables'] = $tables;
        $this->data['temp'] = 'admin/table/order/index';
        return $this->load->view('admin/table/order/list_table', $this->data);
    }

    function open_table(){
        $table_id = $this->input->post('table_id');
        $table = $this->table_model->get_info($table_id);
        if($table->status == 1){
            $now = new DateTime();
            $bill_id = $this->bill_model->create(array(
                'table_id'  => $table_id,
                'status'    => 2,
                'created'    => $now->getTimestamp()
            ));
            if($bill_id){
                $this->table_model->update($table_id, array('status'=>2, 'bill_id'=>$bill_id));
                $table = $this->table_model->get_info($table_id);
                echo json_encode((array)$table);
            }
            else{
                echo 0;
            }
        }
        else{
            echo 0;
        }
    }

    function addOrder(){
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');
        $table_id = $this->input->post('table_id');
        $bill_id = $this->table_model->get_info($table_id)->bill_id;
        $now = new DateTime();
        $dataAdd = array(
            'product_id'    => $product_id,
            'bill_id'       => $bill_id,
            'table_id'      => $table_id,
            'quantity'      => $quantity,
            'status'        => 1,
            'created'       => $now->getTimestamp()
        );
        $idOrder = $this->order_model->create($dataAdd);
        if($idOrder > 0){
            $input = array();
            $input['where']['bill_id'] = $bill_id;
            $orders = $this->order_model->get_list($input);
            $this->data['orders'] = $orders;
            return $this->load->view('admin/table/order/list_order_in_table', $this->data);
        }
        echo false;
    }

    function change_order(){
        $order_id = $this->input->post('order_id');
        $table_id = $this->input->post('table_id');
        $change_type = $this->input->post('change_type');
        $dataUpdate = array(
            'status'=>$change_type
        );
        if($change_type == 4 || $change_type == 2){
            $now = new DateTime();
            $dataUpdate['edited'] = $now->getTimestamp();
        }
        if($this->order_model->update($order_id, $dataUpdate)){
            $table = $this->table_model->get_info($table_id);
            $input = array();
            $input['where']['bill_id'] = $table->bill_id;
            $orders = $this->order_model->get_list($input);
            $this->data['orders'] = $orders;
            return $this->load->view('admin/table/order/list_order_in_table', $this->data);
        }
        else{
            echo false;
        }
    }

    function getOrderByTable(){
        $table_id = $this->input->post('table_id');
        $table = $this->table_model->get_info($table_id);
        $input = array();
        $input['where']['bill_id'] = $table->bill_id;
        $orders = $this->order_model->get_list($input);
        $this->data['orders'] = $orders;
        return $this->load->view('admin/table/order/list_order_in_table', $this->data);
    }

//    function cancel_order(){
//        $order_id = $this->input->post('order_id');
//        $table_id = $this->input->post('table_id');
//        if($this->order_model->update($order_id, array('status'=>3))){
//            $table = $this->table_model->get_info($table_id);
//            $input = array();
//            $input['where']['bill_id'] = $table->bill_id;
//            $orders = $this->order_model->get_list($input);
//            $this->data['orders'] = $orders;
//            return $this->load->view('admin/table/order/list_order_in_table', $this->data);
//        }
//        else{
//            echo false;
//        }
//    }
//
//    function undo_order(){
//        $order_id = $this->input->post('order_id');
//        $table_id = $this->input->post('table_id');
//        if($this->order_model->update($order_id, array('status'=>1))){
//            $table = $this->table_model->get_info($table_id);
//            $input = array();
//            $input['where']['bill_id'] = $table->bill_id;
//            $orders = $this->order_model->get_list($input);
//            $this->data['orders'] = $orders;
//            return $this->load->view('admin/table/order/list_order_in_table', $this->data);
//        }
//        else{
//            echo false;
//        }
//    }

    function accept_cancel_order(){
        $order_id = $this->input->post('order_id');
        $change_type = $this->input->post('change_type');
        $dataUpdate = array(
            'status'=>$change_type
        );
        if($change_type == 4 || $change_type == 2){
            $now = new DateTime();
            $dataUpdate['edited'] = $now->getTimestamp();
        }
        if($this->order_model->update($order_id, $dataUpdate)){
            $input = array();
            $input['where']['status'] = 1;
            $input['or_where']['status'] = 3;
            $orders = $this->order_model->get_list($input);
            $this->data['orders'] = $orders;
            return $this->load->view('admin/table/order/table_queue', $this->data);
        }
        else{
            echo false;
        }
    }

    function queue(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $input = array();
        $input['where']['status'] = 2;
        $input['or_where']['status'] = 4;
        $input['order'] = array('edited','DESC');
        $input['limit'] = array('4' ,'0');
        $order_undo = $this->order_model->get_list($input);

        $input = array();
        $input['where']['status'] = 1;
        $input['or_where']['status'] = 3;
        $input['order'] = array('id','ASC');
        $orders = $this->order_model->get_list($input);

        $orders = array_merge($order_undo, $orders);

        $this->data['orders'] = $orders;

        $this->data['temp'] = 'admin/table/order/queue';
        $this->load->view('admin/layout', $this->data);
    }

    function getQueue(){
        $input = array();
        $input['where']['status'] = 2;
        $input['or_where']['status'] = 4;
        $input['order'] = array('edited','DESC');
        $input['limit'] = array('4' ,'0');
        $order_undo = $this->order_model->get_list($input);

        $input = array();
        $input['where']['status'] = 1;
        $input['or_where']['status'] = 3;
        $input['order'] = array('id','ASC');
        $orders = $this->order_model->get_list($input);
        $orders = array_merge($order_undo, $orders);

        $this->data['orders'] = $orders;
        return $this->load->view('admin/table/order/table_queue', $this->data);
    }

    function payment(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $table_id = $this->uri->segment(4);
        $table = $this->table_model->get_info($table_id);
        if($table->bill_id <= 0){
            redirect(admin_url('table/order/'.$table_id));
        }
        $input = array();
        $input['where']['bill_id'] = $table->bill_id;
        $orders = $this->order_model->get_list($input);
        foreach ($orders as $key => $value){
            if($value->status == 4){
                unset($orders[$key]);
            }
        }
        $this->data['orders'] = $orders;
        $this->data['table'] = $table;

        $this->data['temp'] = 'admin/payment/index';
        $this->load->view('admin/layout', $this->data);
    }

    function book(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/table/book';
        $this->load->view('admin/layout', $this->data);
    }
}