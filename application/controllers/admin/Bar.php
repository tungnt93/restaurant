<?php
Class Bar extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('catalog_model');
        $this->load->model('product_model');
        $this->load->model('food_model');
        $this->load->model('order_model');
        $this->load->model('table_model');
        $this->load->model('ingredients_model');
        $this->load->model('dailyMenu_model');
        $this->load->model('utensils_model');
    }

    function ingredients() {
      $message = $this->session->flashdata('message');
      $this->data['message'] = $message;
      $input = array();
      $input['where']['type'] = 2;
      $foods = $this->food_model->get_list($input);
      $this->data['foods'] = $foods;

      $this->data['temp'] = 'admin/bar/ingredient/index';
      $this->load->view('admin/layout', $this->data);
    }

    function catalog(){
      $message = $this->session->flashdata('message');
  	  $this->data['message'] = $message;
  		$input = array();
  		$input['order'] = array('position','ASC');
      $input['where']['type'] = 2;
  		$list_catalog = $this->catalog_model->get_list($input);
  		$this->data['list_catalog'] = $list_catalog;
      $this->data['type'] = 2;
  		$this->data['temp'] = 'admin/catalog/index';
  		$this->load->view('admin/layout', $this->data);
    }

    function add_catalog(){
      $message = $this->session->flashdata('message');
      $this->data['message'] = $message;
			if($this->input->post('btnAddCatalog')){
					$name = $this->input->post('txtName');
					$position = $this->input->post('txtPosition');
            //upload images
          $config['upload_path'] = './public/images/menu';
          $config['allowed_types'] = 'jpg|png|JPG|PNG';

          $this->load->library("upload", $config);
          if($this->upload->do_upload('imageMenu')){
              $img_data = $this->upload->data();
              $img = $img_data['file_name'];
              $dataSubmit = array(
                  'name'		=> $name,
                  'position'	=> $position,
                  'img'       => $img,
                  'type' => 2,
                  'status'  => 2
              );
              if($this->catalog_model->create($dataSubmit)){
                  $this->session->set_flashdata('message','Thêm thành công');
                  redirect(base_url('admin/bar/catalog'));
              }
              else{
                  $this->session->set_flashdata('message', 'Thêm thất bại!');
                  redirect(base_url('admin/bar/add_catalog'));
              }
          }
          else{
              $this->session->set_flashdata('message', $this->upload->display_errors());
              redirect(base_url('admin/bar/add_catalog'));
          }
			}
      $this->data['type'] = 2;
      $this->data['temp'] = 'admin/catalog/add';
      $this->load->view('admin/layout', $this->data);
    }

    function add_ing(){
      $message = $this->session->flashdata('message');
      $this->data['message'] = $message;
      if($this->input->post('btnAdd')){
          $data = array(
              'name' => $this->input->post('txtName'),
              'catalog_id' => $this->input->post('slCatalog'),
              'dram' => $this->input->post('txtDram'),
              'type' => 2
          );
          if($this->food_model->create($data)){
              $this->session->set_flashdata('message','Thêm thành công!');
              redirect(base_url('admin/bar/add_ing'));
          }
          else{
              $this->session->set_flashdata('message','Thêm thất bại!');
              redirect(base_url('admin/bar/add_ing'));
          }
      }
      $input = array();
      $input['where']['type'] = 2;
      $catalogs = $this->catalog_model->get_list($input);
      $this->data['catalogs'] = $catalogs;
      $this->data['temp'] = 'admin/bar/ingredient/add';
      $this->load->view('admin/layout', $this->data);
    }

    function product(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $list_product = $this->product_model->get_list(array('where'=>array('type'=>2)));
        foreach ($list_product as $key => $value){
            $input = array();
            $input['where']['product_id'] = $value->id;
            $list_product[$key]->ing = $this->ingredients_model->get_list($input);
        }
        $this->data['list_product'] = $list_product;
        $this->data['type'] = 2;
        $this->data['temp'] = 'admin/kitchen/product';
        $this->load->view('admin/layout', $this->data);
    }

    function add_product(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $list_catalog = $this->catalog_model->get_list(array('where'=>array('type'=>2)));
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
                    'status'        => 0,
                    'type'  => 2
                );
                $product_id = $this->product_model->create($dataSubmit);
                if($product_id > 0){
                    $this->session->set_flashdata('message', 'Thêm sản phẩm thành công!');
                    $update_nl = array('product_id'=>$product_id);
                    $this->ingredients_model->update_rule(array('product_id'=> 0), $update_nl);
                    redirect(base_url('admin/bar/product'));
                }
                else{
                    $this->session->set_flashdata('message', 'Thêm sản phẩm thất bại!');
                    redirect(base_url('admin/bar/add_product'));
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
        $this->data['type'] = 2;
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
        $product_id = $this->uri->segment(4);
        $product_id = intval($product_id);
        $product = $this->product_model->get_info($product_id);
        if($product == null){
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/product'));
        }
        $this->data['product'] = $product;

        $input = array();
        $input['where']['type'] = $product->type;

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
                redirect(base_url('admin/bar/product'));
            }
            else{
                $this->session->set_flashdata('message', 'Sửa thông tin sản phẩm thất bại!');
                redirect(base_url('admin/bar/product'));
            }

        }
        $this->ingredients_model->del_rule(array('product_id'=> 0));
        $this->data['foods'] = $foods;
        $this->data['list_catalog'] = $list_catalog;
        $this->data['type'] = 2;
        $this->data['temp'] = 'admin/kitchen/edit_product';
        $this->load->view('admin/layout', $this->data);
    }

    function daily_menu(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $list_catalog = $this->catalog_model->get_list(array('where'=>array('type'=>2)));
        $products = array();
        foreach ($list_catalog as $key => $value){
            $products[$key] = new stdClass();
            $products[$key]->catalog = $value->name;
            $input = array();
            $input['where']['catalog_id'] = $value->id;
            $products[$key]->product = $this->product_model->get_list($input);
        }
        $this->data['products'] = $products;
        $this->data['type'] = 2;
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

    function order(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $order_undo = $this->order_model->get_order_undo(2);
        $orders = $this->order_model->get_order(2);
        $orders = array_merge($order_undo, $orders);
        $this->data['orders'] = $orders;
        $this->session->set_userdata('type', 2);
        $this->data['temp'] = 'admin/table/order/queue';
        $this->load->view('admin/layout', $this->data);
    }

    function utensil(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['type'] = 2;
        $utensils = $this->utensils_model->get_list(array('where'=>array('type'=> 2)));
        $this->data['utensils'] = $utensils;
        $this->data['temp'] = 'admin/warehouse/utensil/index';
        $this->load->view('admin/layout', $this->data);
    }
}
