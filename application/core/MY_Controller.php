<?php
Class MY_Controller extends CI_Controller {
	
	public $data = array();
	function __construct() {

		parent::__construct();
		$new_url = $this->uri->segment(1);
		//pre ($new_url);
		if($new_url != 'search'){
			$this->session->unset_userdata('search_term');
		}
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->count_view();
		
		switch ($new_url) {
			case 'admin' : {
//				pre("abc");
				$this->_check_login();
				$this->data['admin'] = $this->session->userdata('admin');
                break;
			}
			
			default: {
				//du lieu trang ngoai
				//lay danh sach catalog
				$this->load->model('content_model');
				// $view = $this->session->userdata('view');
				// if(!$view){
				// 	$this->session->set_userdata('view', 1);
				// 	$total_view = $this->content_model->get_info(1)->view;
				// 	$total_view += 1;
				// 	$this->content_model->update(1, array('view'=>$total_view));
				// }
				$this->update_view();
//				$this->load->model('catalog_model');
//				$input_catalog = array();
//				$input_catalog['where']['parent_id'] = 0;
//				$input_catalog['order'] = array('position','ASC');
//				$list_catalog = $this->catalog_model->get_list($input_catalog);
//
//				foreach ($list_catalog as $key => $value) {
//					$id_catalog = $value->id;
//					$input_catalog_child = array();
//					$input_catalog_child['where']['parent_id'] = $id_catalog;
//					$input_catalog_child['order'] = array('position','ASC');
//					$list_catalog[$key]->child_1 = $this->catalog_model->get_list($input_catalog_child);
//					foreach ($list_catalog[$key]->child_1 as $k => $v) {
//						$id_catalog_sub = $v->id;
//						$input_catalog_child_1 = array();
//						$input_catalog_child_1['where']['parent_id'] = $id_catalog_sub;
//						$input_catalog_child_1['order'] = array('position','ASC');
//						$list_catalog[$key]->child_1[$k]->child_2 = $this->catalog_model->get_list($input_catalog_child_1);
//					}
//				}
//				$this->data['catalog'] = $list_catalog;

				//noi dung website
				$content = $this->content_model->get_info(1);
				$this->data['content'] = $content;

				//san pham noi bat
//				$this->load->model('hot_product_model');
//				$this->load->model('product_model');
//				$list_product = $this->product_model->get_list();
//			    $list_hot = $this->hot_product_model->get_list();
//			    $list_hot_product = array();
//			    foreach ($list_hot as $value) {
//			    	$list_hot_product[] = $this->product_model->get_info($value->product_id);
//			    }
			    //pre($list_hot_product);
//			    $this->data['list_hot_product'] = $list_hot_product;
			}
		}
	}
	private function _check_login()
    {

        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);
    
        $login = $this->session->userdata('login');
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if(!$login && $controller != 'login')
        {
//        	pre("abc");
            redirect(base_url('admin/login'));
        }
        //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if($login && $controller == 'login')
        {
//            pre('abc');
            redirect(base_url('admin/report'));
        }
    }
    private function count_view(){
    	// formart: total-lastmonth-05/2017-thismonth- count_last_day -09/05/2017-today
    	$this->load->model('content_model');
    	$count = $this->content_model->get_info(1)->view;
    	$count = explode('-', $count);
    	$total = $count[0];
    	$count_last_month = $count[1];
    	$month = $count[2];
    	$count_this_month = $count[3];
    	$count_last_day = $count[4];
    	$today = $count[5];
    	$count_today = $count[6];
    	
    	$date_now = date("d/m/Y");
    	$month_now = date("m/Y");

    	if($date_now != $today){
    		$today = $date_now;
    		$count_last_day = $count_today;
    		$count_today = 0;
    	}
    	if($month_now != $month){
    		$month = $month_now;
    		$count_last_month = $count_this_month;
    		$count_this_month = 0;
    	}
    	$arr = array($total, $count_last_month, $month, $count_this_month, $count_last_day, $today, $count_today);
		$this->content_model->update(1, array('view'=>implode('-', $arr)));
    }
    private function update_view(){
    	$this->load->model('content_model');
    	$count = $this->content_model->get_info(1)->view;
    	$count = explode('-', $count);
    	$total = $count[0];
    	$count_last_month = $count[1];
    	$month = $count[2];
    	$count_this_month = $count[3];
    	$count_last_day = $count[4];
    	$today = $count[5];
    	$count_today = $count[6];

    	$view = $this->session->userdata('view');
		if(!$view){
			$this->session->set_userdata('view', 1);
			$total += 1;
			$count_today += 1;
			$count_this_month += 1;
			$arr = array($total, $count_last_month, $month, $count_this_month, $count_last_day, $today, $count_today);
			$this->content_model->update(1, array('view'=>implode('-', $arr)));
		}
    }
}