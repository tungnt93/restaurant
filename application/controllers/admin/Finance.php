<?php
Class Finance extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('catalog_model');
        $this->load->model('product_model');
        $this->load->model('bill_model');
        $this->load->model('table_model');
        $this->load->model('order_model');
    }

    function index() {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['order'] = array('position','ASC');
        $list_catalog = $this->catalog_model->get_list($input);
        $this->data['list_catalog'] = $list_catalog;

        $this->data['temp'] = 'admin/catalog/index';
        $this->load->view('admin/layout', $this->data);
    }

    function cashier(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $input = array();
        $input['limit'] = array(100, 0);
        $bills = $this->bill_model->get_list($input);
        $this->data['bills'] = $bills;

        $this->data['temp'] = 'admin/finance/cashier';
        $this->load->view('admin/layout', $this->data);
    }

    function payment(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $bill_id = $this->uri->segment(4);
        $bill = $this->bill_model->get_info($bill_id);
        if(!$bill){
            redirect(admin_url('finance/cashier'));
        }
        $input = array();
        $input['where']['bill_id'] = $bill_id;
        $orders = $this->order_model->get_list($input);
        foreach ($orders as $key => $value){
            if($value->status == 4){
                unset($orders[$key]);
            }
        }
        $this->data['orders'] = $orders;
        $this->data['table'] = $this->table_model->get_info($bill->table_id);
        $this->data['bill'] = $bill;

        if($this->input->post('btnPaymentDone')){
            $this->bill_model->update($bill_id, array('status'=>4));
            $this->table_model->update($bill->table_id, array('status'=>1, 'bill_id'=>0));
            redirect(admin_url('finance/cashier'));
        }

        $this->data['temp'] = 'admin/finance/payment';
        $this->load->view('admin/layout', $this->data);
    }
}