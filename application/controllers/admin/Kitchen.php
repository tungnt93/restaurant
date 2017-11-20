<?php
Class Kitchen extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('catalog_model');
        $this->load->model('product_model');
        $this->load->model('food_model');
        $this->load->model('ingredients_model');
        $this->load->model('product_model');
        $this->load->model('dailyMenu_model');
    }

    function index() {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;


        $this->data['temp'] = 'admin/kitchen/index';
        $this->load->view('admin/layout', $this->data);
    }

    function product(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $list_product = $this->product_model->get_list();
        foreach ($list_product as $key => $value){
            $input = array();
            $input['where']['product_id'] = $value->id;
            $list_product[$key]->ing = $this->ingredients_model->get_list($input);
        }
        $this->data['list_product'] = $list_product;

        $this->data['temp'] = 'admin/kitchen/product';
        $this->load->view('admin/layout', $this->data);
    }

    function add_product(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $list_catalog = $this->catalog_model->get_list();
        $foods = array();
        foreach ($list_catalog as $key => $value){
            $foods[$key] = new stdClass();
            $foods[$key]->catalog = $value->name;
            $input = array();
            $input['where']['catalog_id'] = $value->id;
            $foods[$key]->food = $this->food_model->get_list($input);
        }
        if($this->input->post('btnAddProduct')){
            $name = $this->input->post('txtName');
            $catalog_id = $this->input->post('slCatalog');
            $price = $this->input->post('txtPrice');
            $now = new DateTime();
            $now = $now->getTimestamp();
            $nl = $this->ingredients_model->get_total(array('where'=>array('product_id'=>0)));
            if($nl > 0){
                $dataSubmit = array(
                    'name'			=> $name,
                    'catalog_id'	=> $catalog_id,
                    'price'			=> $price,
                    'view'			=> 0,
                    'create_time' 	=> $now,
                    'status'        => 0
                );
                $product_id = $this->product_model->create($dataSubmit);
                if($product_id > 0){
                    $this->session->set_flashdata('message', 'Xây dựng thực đơn thành công!');
                    $update_nl = array('product_id'=>$product_id);
                    $this->ingredients_model->update_rule(array('product_id'=> 0), $update_nl);
                    redirect(base_url('admin/kitchen/product'));
                }
                else{
                    $this->session->set_flashdata('message', 'Xây dựng thực đơn thất bại!');
                    redirect(base_url('admin/kitchen/add_product'));
                }
            }
            else {
                $this->data['name'] = $name;
                $this->data['catalog_id'] = $catalog_id;
                $this->data['price'] = $price;
                $this->data['message'] = 'Bạn chưa thêm Nguyên liệu!';
            }
        }
        $this->ingredients_model->del_rule(array('product_id'=> 0));
        $this->data['list_catalog'] = $list_catalog;
        $this->data['foods'] = $foods;
        $this->data['temp'] = 'admin/kitchen/add_product';
        $this->load->view('admin/layout', $this->data);
    }

//    function addIngredient(){
//        $food_id = $this->input->post('food_id');
//        $quantity = $this->input->post('quantity');
//        $data = array(
//            'food_id' => $food_id,
//            'product_id' => 0,
//            'weigh' => $quantity
//        );
//        $id = $this->ingredients_model->create($data);
//        echo $id;
//    }
//
//    function addEditIngredient(){
//        $food_id = $this->input->post('food_id');
//        $quantity = $this->input->post('quantity');
//        $product_id = $this->input->post('product_id');
//        $data = array(
//            'food_id' => $food_id,
//            'product_id' => $product_id,
//            'weigh' => $quantity
//        );
//        $id = $this->ingredients_model->create($data);
//        echo $id;
//    }
//
//    function del_nl(){
//        $nl_id = $this->input->post('nl_id');
//        if($this->ingredients_model->delete($nl_id)){
//            echo $nl_id;
//        }
//        else{
//            echo -1;
//        }
//    }

    function edit_product(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
//		$input['where']['parent_id'] = 0;
        $list_catalog = $this->catalog_model->get_list($input);
        $foods = array();
        foreach ($list_catalog as $key => $value){
            $foods[$key] = new stdClass();
            $foods[$key]->catalog = $value->name;
            $input = array();
            $input['where']['catalog_id'] = $value->id;
            $foods[$key]->food = $this->food_model->get_list($input);
        }
        $product_id = $this->uri->segment(4);
        $product_id = intval($product_id);
        $product = $this->product_model->get_info($product_id);
        if($product == null){
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/product'));
        }
        $this->data['product'] = $product;
        $nl = $this->ingredients_model->get_list(array('where'=>array('product_id'=>$product_id)));
        $this->data['nl'] = $nl;

        if($this->input->post('btnUpdateProduct')){
            $name = $this->input->post('txtName');
            $catalog_id = $this->input->post('slCatalog');
            $now = new DateTime();
            $now = $now->getTimestamp();
            $dataSubmit = array(
                'name'			=> $name,
                'catalog_id'	=> $catalog_id,
                'create_time' 	=> $now
            );
            if($this->product_model->update($product_id, $dataSubmit)){
                $this->session->set_flashdata('message', 'Sửa thông tin sản phẩm thành công!');
                redirect(base_url('admin/kitchen/product'));
            }
            else{
                $this->session->set_flashdata('message', 'Sửa thông tin sản phẩm thất bại!');
                redirect(base_url('admin/kitchen/product'));
            }

        }
        $this->ingredients_model->del_rule(array('product_id'=> 0));
        $this->data['foods'] = $foods;
        $this->data['list_catalog'] = $list_catalog;
        $this->data['temp'] = 'admin/kitchen/edit_product';
        $this->load->view('admin/layout', $this->data);
    }

    function daily_menu(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $list_catalog = $this->catalog_model->get_list();
        $products = array();
        foreach ($list_catalog as $key => $value){
            $products[$key] = new stdClass();
            $products[$key]->catalog = $value->name;
            $input = array();
            $input['where']['catalog_id'] = $value->id;
            $products[$key]->product = $this->product_model->get_list($input);
        }
        $this->data['products'] = $products;

        $this->data['temp'] = 'admin/kitchen/daily_menu/daily_menu';
        $this->load->view('admin/layout', $this->data);
    }

    function add_daily_menu(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'admin/kitchen/add_daily_menu';
        $this->load->view('admin/layout', $this->data);
    }

    function addProductDailyMenu(){
        $product_id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');
        $date = $this->input->post('date');
//        echo $date;
        $now = new DateTime();
        $data = array(
            'product_id'    => $product_id,
            'quantity'      => $quantity,
            'date'          => $date,
            'create_by'     => $this->data['admin']->id,
            'created'       => $now->getTimestamp()
        );
        $id = $this->dailyMenu_model->create($data);
        if($id > 0){
            $daily_menus = $this->dailyMenu_model->get_list(array('where'=>array('date'=>$date)));
            foreach ($daily_menus as $key => $value){
                $product = $this->product_model->get_info($value->product_id);
                $daily_menus[$key]->name = $product->name;
                $daily_menus[$key]->menu = $this->catalog_model->get_info($product->catalog_id)->name;
            }
            return $this->load->view('admin/kitchen/daily_menu/tb_daily_menu', array('daily_menus'=>$daily_menus));
        }
        else{
            echo false;
        }
    }

    function getDailyMenu(){
        $date = $this->input->post('date');
        $daily_menus = $this->dailyMenu_model->get_list(array('where'=>array('date'=>$date)));
        foreach ($daily_menus as $key => $value){
            $product = $this->product_model->get_info($value->product_id);
            $daily_menus[$key]->name = $product->name;
            $daily_menus[$key]->menu = $this->catalog_model->get_info($product->catalog_id)->name;
        }
        return $this->load->view('admin/kitchen/daily_menu/tb_daily_menu', array('daily_menus'=>$daily_menus));
    }

    function delDailyMenu(){
        $id = $this->input->post('id');
        $date = $this->input->post('date');
        $this->dailyMenu_model->delete($id);
        $daily_menus = $this->dailyMenu_model->get_list(array('where'=>array('date'=>$date)));
        foreach ($daily_menus as $key => $value){
            $product = $this->product_model->get_info($value->product_id);
            $daily_menus[$key]->name = $product->name;
            $daily_menus[$key]->menu = $this->catalog_model->get_info($product->catalog_id)->name;
        }
        return $this->load->view('admin/kitchen/daily_menu/tb_daily_menu', array('daily_menus'=>$daily_menus));
    }

    function copyMenu(){
        $date = $this->input->post('date');
        $dateCopy = $this->input->post('dateCopy');
        $input = array();
        $input['where']['date'] = $dateCopy;
        $daily_menus = $this->dailyMenu_model->get_list($input);
        $now = new DateTime();
        $created = $now->getTimestamp();
        foreach ($daily_menus as $row){
            $dataCreate = array(
                'product_id'    => $row->product_id,
                'quantity'      => $row->quantity,
                'date'          => $date,
                'create_by'     => $this->data['admin']->id,
                'created'       => $created
            );
            $this->dailyMenu_model->create($dataCreate);
        }
        $daily_menus = $this->dailyMenu_model->get_list(array('where'=>array('date'=>$date)));
        foreach ($daily_menus as $key => $value){
            $product = $this->product_model->get_info($value->product_id);
            $daily_menus[$key]->name = $product->name;
            $daily_menus[$key]->menu = $this->catalog_model->get_info($product->catalog_id)->name;
        }
        return $this->load->view('admin/kitchen/daily_menu/tb_daily_menu', array('daily_menus'=>$daily_menus));
    }
}