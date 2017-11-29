<?php
Class Product extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('catalog_model');
	}

	function detail($name = '', $id = '') {
		$product_id = $id;
		$product = $this->product_model->get_info($product_id);
		if($product != null){
			$view = $product->view + 1;
			$this->product_model->update($product_id, array('view'=>$view));
		}
		//pre($product);
		// $list_hot = $this->hot_product_model->get_list();
	    // $list_hot_id = array();
	    // foreach ($list_hot as $value) {
	    // 	$list_hot_id[] = $value->product_id;
	    // }
		
	    $this->data['list_hot_id'] = $list_hot_id;
		$this->data['product'] = $product;
		$this->data['temp'] = 'site/product/detail';
		$this->load->view('site/layout', $this->data);
		//pre($view);
	}

	function catalog($name = '', $id = ''){
		$catalog_id = $id;
		$cat = $this->catalog_model->get_info($catalog_id);
		$breadcrumb_catalog = $cat->id;
		if($cat->parent_id != 0){
			$parent = $this->catalog_model->get_info($cat->parent_id);
			$breadcrumb_catalog = $breadcrumb_catalog.','.$parent->id;
			if($parent->parent_id != 0){
				$g_parent = $this->catalog_model->get_info($parent->parent_id);
				$breadcrumb_catalog = $breadcrumb_catalog.','.$g_parent->id;
			}
		}

		//$list_product = array();
		$list_cat = array();
		$list_cat[] = $catalog_id;
		$input['where']['parent_id'] = $catalog_id;
		$list = $this->catalog_model->get_list($input);
		if(count($list > 0)){
			foreach ($list as $key => $value) {
				$list_cat[] = $value->id;

				$in['where']['parent_id'] = $value->id;
				$list_1 = $this->catalog_model->get_list($in);
				if(count($list_1) > 0){
					foreach ($list_1 as $value_1) {
						$list_cat[] = $value_1->id;

						$in['where']['parent_id'] = $value_1->id;
						$list_2 = $this->catalog_model->get_list($in);
						if (count($list_2) > 0) {
							foreach ($list_2 as $value_2) {
								$list_cat[] = $value_2->id;
							}
						}
					}
				}
			}
		}

		$per_page = 30;
		$offset=$this->uri->segment(3);
		$offset = intval($offset);
		$total = count($this->product_model->get_product_by_catalog($list_cat, $limit = array()));

		$paginator = config_pagination($per_page, 3, $total, base_url('danh-muc/').$name.'-'.$id);
        if ($offset >= 1) {
        	$offset -= 1;
        	$offset = $offset*$per_page;
        }

		$list_product = $this->product_model->get_product_by_catalog($list_cat, array($per_page, $offset));
		$this->data['paginator'] = $paginator;
		$this->data['breadcrumb_catalog'] = $breadcrumb_catalog;
		$this->data['list_product'] = $list_product;
		$this->data['temp'] = 'site/product/catalog';
		$this->load->view('site/layout', $this->data);
	}
}
