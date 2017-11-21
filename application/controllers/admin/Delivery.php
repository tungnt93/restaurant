<?php
Class Delivery extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('food_model');
        $this->load->model('catalog_model');
        $this->load->model('warehouse_model');
        $this->load->model('ingredients_model');
        $this->load->model('product_model');
        $this->load->model('dailyMenu_model');
    }

    function index() {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $foods = $this->food_model->get_list();
        $this->data['foods'] = $foods;

        $this->data['temp'] = 'admin/delivery/index';
        $this->load->view('admin/layout', $this->data);
    }

    function buy(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $date = date("22-11-2017");
        $daily_menus = $this->dailyMenu_model->get_list(array('where'=>array('date'=>$date)));
//        pre($daily_menus);
        $foods = array();
        foreach ($daily_menus as $key => $value){
            $product = $this->product_model->get_info($value->product_id);
            $daily_menus[$key]->name = $product->name;
            $daily_menus[$key]->menu = $this->catalog_model->get_info($product->catalog_id)->name;

            $ingredients = $this->ingredients_model->get_list(array('where'=>array('product_id'=>$value->product_id)));
//            pre($ingredients);

            foreach ($ingredients as $row){
                $food = new stdClass();
                $food->food_id = $row->food_id;
                $food->total_weigh = $row->weigh*$value->quantity;
                $foods[] = $food;
            }
        }
        $key_arr = array();
        foreach ($foods as $key => $food) {
            $index = array_search($food->food_id, $key_arr);
            if(($index !== FALSE)) {
                $foods[$index]->total_weigh += $food->total_weigh;
                unset($foods[$key]);
                break;
            }
            $key_arr[] = $food->food_id;
        }

        $this->data['foods'] = $foods;

        $this->data['daily_menus'] = $daily_menus;
        $this->data['date'] = $date;

        $this->data['temp'] = 'admin/delivery/buy';
        $this->load->view('admin/layout', $this->data);
    }
}