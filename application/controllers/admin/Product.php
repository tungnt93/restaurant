<?php
Class Product extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('catalog_model');
		$this->load->model('product_model');
		$this->load->model('hot_product_model');
	}
	
	function index() {
		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;
		
	    $list_product = $this->product_model->get_list();
//	    $list_hot = $this->hot_product_model->get_list();
//	    $list_hot_id = array();
//	    foreach ($list_hot as $value) {
//	    	$list_hot_id[] = $value->product_id;
//	    }
	    //pre($list_hot_id);
	    //pre($list_product);
//	    $this->data['list_hot_id'] = $list_hot_id;
	    $this->data['list_product'] = $list_product;
		$this->data['temp'] = 'admin/product/index';
		$this->load->view('admin/layout', $this->data);
	}

	function add(){
		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;
		$list_catalog = $this->catalog_model->get_list();

		if($this->input->post('btnAddProduct')){
			$name = $this->input->post('txtName');
			$catalog_id = $this->input->post('slCatalog');
			$price = $this->input->post('txtPrice');
			$discount = $this->input->post('txtDiscount');
			$now = new DateTime();
			$now = $now->getTimestamp();
			//upload images
			$config['upload_path'] = './public/images/product';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library("upload", $config);
            if($this->upload->do_upload('imageProduct')){

                $img_data = $this->upload->data();
                $img = $img_data['file_name'];
                
                $dataSubmit = array(
                	'name'			=> $name,
                	'catalog_id'	=> $catalog_id,
                	'price'			=> $price,
                	'discount'		=> $discount,
                	'img_link'		=> $img,
                	'view'			=> 0,
                	'create_time' 	=> $now
                );
                if($this->product_model->create($dataSubmit)){
                	$this->session->set_flashdata('message', 'Thêm món ăn thành công!');
					redirect(base_url('admin/product'));
                }
                else{
                	$this->session->set_flashdata('message', 'Thêm món ăn thất bại!');
					redirect(base_url('admin/product'));
                }
            }else{
            	$this->session->set_flashdata('message', $this->upload->display_errors());
				redirect(base_url('admin/product/add'));
            }
		}
		$this->data['list_catalog'] = $list_catalog;
		$this->data['temp'] = 'admin/product/add';
		$this->load->view('admin/layout', $this->data);
	}

	function format_img($img, $rotate){
		$this->load->library("image_lib");
        $config_img['image_library'] = 'gd2';
        $config_img['source_image'] = './public/images/product/'.$img;
        $config_img['create_thumb'] = TRUE;
        $config_img['maintain_ratio'] = FALSE;
        $config_img['width']     = 1024;
        $config_img['height']   = 1024;
        $this->image_lib->initialize($config_img);
        if(!$this->image_lib->resize()){
        	$this->session->set_flashdata('message', $this->image_lib->display_errors());
			redirect(base_url('admin/product/add'));
        }
        $this->image_lib->clear();
        unset($config_img);

        $thumb_img = explode('.', $img);
        $thumb_img[0] = $thumb_img[0].'_thumb';
        $thumb_img = implode('.', $thumb_img);

        $config_img['source_image'] = './public/images/product/'.$thumb_img;
        
        switch ($rotate) {
        	case 90:
        		$rotate = 270;
        		break;
        	case -90:
        		$rotate = 90;
        		break;
        	default:
        		break;
        }
        if($rotate != 0){
        	$config_img['rotation_angle'] = $rotate;
	        $this->image_lib->initialize($config_img);
	        if(!$this->image_lib->rotate()){
	        	$this->session->set_flashdata('message', $this->image_lib->display_errors());
				redirect(base_url('admin/product/add'));
	        }
        }
        $this->image_lib->clear();
        unset($config_img);

        $config_img['source_image'] = './public/images/product/'.$thumb_img;
        $config_img['create_thumb'] = FALSE;
        $config_img['wm_text'] = 'letsgoled.vn';
		$config_img['wm_type'] = 'text';
		$config_img['wm_font_size']	= '32';
		$config_img['wm_font_color'] = 'B50000';
        $config_img['wm_vrt_alignment'] = 'bottom';
        $config_img['wm_hor_alignment'] = 'center';
        $config_img['wm_padding'] = '0';
        $config_img['wm_opacity'] = '10';
        $this->image_lib->initialize($config_img);
        if(!$this->image_lib->watermark()){
        	$this->session->set_flashdata('message', $this->image_lib->display_errors());
			redirect(base_url('admin/product/add'));
        }
        $img_source = './public/images/product/'.$img;
        unlink($img_source);
        return $thumb_img;
}

	function edit(){
		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;
		$input = array();
		$input['where']['parent_id'] = 0;
		$list_catalog = $this->catalog_model->get_list($input);
		foreach ($list_catalog as $key => $value) {
			$input['where']['parent_id'] = $value->id;
			$list_catalog_child = $this->catalog_model->get_list($input);
			$list_catalog[$key]->child = $list_catalog_child;
			foreach ($list_catalog[$key]->child as $k => $v) {
				$input['where']['parent_id'] = $v->id;
				$list_catalog_child_1 = $this->catalog_model->get_list($input);
				$list_catalog[$key]->child[$k]->child_1 = $list_catalog_child_1;
			}
		}

		$product_id = $this->uri->segment(4);
		$product_id = intval($product_id);
		$product = $this->product_model->get_info($product_id);
		if($product == null){
			$this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
			redirect(base_url('admin/product'));
		}
		else{
			$this->data['product'] = $product;
		}

		if($this->input->post('btnUpdateProduct')){
			$name = $this->input->post('txtName');
			$catalog_id = $this->input->post('slCatalog');
			$price = $this->input->post('txtPrice');
			$discount = $this->input->post('txtDiscount');
			$des = $this->input->post('txtDescription');
			$now = new DateTime();
			$now = $now->getTimestamp();
			$changeImg = $this->input->post('changeImg');
			if($changeImg == 1){
				$config['upload_path'] = './public/images/product';
	            $config['allowed_types'] = 'gif|jpg|png';
	            
	            
	            $this->load->library("upload", $config);
	            if($this->upload->do_upload('imageProduct')){
	            	$old_img = './public/images/product/'.$product->img_link;
	            	unlink($old_img);
	                $img_data = $this->upload->data();
	                $img = $img_data['file_name'];

	                $rotate = $this->input->post('img_rotate');
                	$thumb_img = $this->format_img($img, $rotate);

	                $dataSubmit = array(
	                	'name'			=> $name,
	                	'catalog_id'	=> $catalog_id,
	                	'price'			=> $price,
	                	'discount'		=> $discount,
	                	'img_link'		=> $thumb_img,
	                	'description'	=> $des,
	                	'create_time' 	=> $now
	                );
	                if($this->product_model->update($product_id, $dataSubmit)){
	                	$this->session->set_flashdata('message', 'Sửa thông tin sản phẩm thành công!');
						redirect(base_url('admin/product'));
	                }
	                else{
	                	$this->session->set_flashdata('message', 'Sửa thông tin sản phẩm thất bại!');
						redirect(base_url('admin/product'));
	                }
	            }else{
	            	$this->session->set_flashdata('message', $this->upload->display_errors());
					redirect(base_url('admin/product/edit/'.$product_id));
	            }
			}
			if($changeImg == 2){
				$dataSubmit = array(
                	'name'			=> $name,
                	'catalog_id'	=> $catalog_id,
                	'price'			=> $price,
                	'discount'		=> $discount,
                	'description'	=> $des,
                	'create_time' 	=> $now
                );
				if($this->product_model->update($product_id, $dataSubmit)){
                	$this->session->set_flashdata('message', 'Sửa thông tin sản phẩm thành công!');
					redirect(base_url('admin/product'));
                }
                else{
                	$this->session->set_flashdata('message', 'Sửa thông tin sản phẩm thất bại!');
					redirect(base_url('admin/product'));
                }
			}
		}

		$this->data['list_catalog'] = $list_catalog;
		$this->data['temp'] = 'admin/product/edit';
		$this->load->view('admin/layout', $this->data);
	}

	function del(){
		$product_id = $this->uri->segment(4);
		$product_id = intval($product_id);
		$product = $this->product_model->get_info($product_id);

		$list_hot = $this->hot_product_model->get_list();
	    $list_hot_id = array();
	    foreach ($list_hot as $value) {
	    	$list_hot_id[] = $value->product_id;
	    }

		if($product == null){
			$this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
			redirect(base_url('admin/product'));
		}
		elseif (in_array($product_id, $list_hot_id)) {
			$this->session->set_flashdata('message', 'Không thể xóa sản phẩm nổi bật!');
			redirect(base_url('admin/product'));
		}
		else{
			if($this->product_model->delete($product_id)){
				$img = './public/images/product/'.$product->img_link;
	        	unlink($img);
	        	//unlink($thumb_img);
	        	$this->session->set_flashdata('message', 'Xóa sản phẩm thành công!');
				redirect(base_url('admin/product'));
			}
			else{
				$this->session->set_flashdata('message', 'Thao tác không thành công!');
				redirect(base_url('admin/product'));
			}
		}
	}

	function product(){
	    $list_product = $this->product_model->get_list();
	    $list_hot = $this->hot_product_model->get_list();
	    $list_hot_id = array();
	    foreach ($list_hot as $value) {
	    	$list_hot_id[] = $value->product_id;
	    }

	    $type = $this->input->post('type');
	    //pre($type);
	    if($type == 2){
	    	foreach ($list_product as $key => $value) {
		    	if(!in_array($value->id, $list_hot_id)){
		    		unset($list_product[$key]);
		    	}
		    }
	    }
	    $this->data_product['list_hot_id'] = $list_hot_id;
	    $this->data_product['list_product'] = $list_product;
		$this->load->view('admin/product/product', $this->data_product);
	}

	function remove_hot(){
		$id = $this->uri->segment(4);
		$input = array();
		$input['where']['product_id'] = $id;
		$product = $this->hot_product_model->get_list($input);
		if(count($product) <= 0){
			$this->session->set_flashdata('message', 'Thao tác không thành công!');
			redirect(base_url('admin/product'));
		}
		else{
			$this->hot_product_model->delete($product[0]->id);
			$this->reload_product();
		}
	}

	function add_hot(){
		$id = $this->uri->segment(4);
		$input = array();
		$input['where']['product_id'] = $id;
		$product = $this->hot_product_model->get_list($input);
		$total_hot = $this->hot_product_model->get_total();

		if(count($product) > 0){
			$this->session->set_flashdata('message', 'Thao tác không thành công!');
			redirect(base_url('admin/product'));
		}
		else if ($total_hot >= 5) {
			echo "<script type='text/javascript'>alert('Số lượng sản phẩm nổi bật không lớn hơn 5');</script>";
			$this->reload_product();
		}
		else{
			$dataSubmit = array(
				'product_id' => $id
			);
			$this->hot_product_model->create($dataSubmit);
			$this->reload_product();
		}
	}

	function reload_product(){
		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;

		$list_product = $this->product_model->get_list();
	    $list_hot = $this->hot_product_model->get_list();
	    $list_hot_id = array();
	    foreach ($list_hot as $value) {
	    	$list_hot_id[] = $value->product_id;
	    }

	    $type = $this->input->post('type');
	    if($type == 2){
	    	foreach ($list_product as $key => $value) {
		    	if(!in_array($value->id, $list_hot_id)){
		    		unset($list_product[$key]);
		    	}
		    }
	    }
	    $this->data['type'] = $type;
	    $this->data['list_hot_id'] = $list_hot_id;
	    $this->data['list_product'] = $list_product;
		$this->load->view('admin/product/product', $this->data);
	}
}