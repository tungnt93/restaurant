<?php
Class Catalog extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('catalog_model');
		$this->load->model('product_model');
	}

	function index() {
		$message = $this->session->flashdata('message');
	  	$this->data['message'] = $message;
		$input = array();
		$input['order'] = array('position','ASC');
		$list_catalog = $this->catalog_model->get_list($input);
		$this->data['list_catalog'] = $list_catalog;
		$this->data['type'] = 0;
		$this->data['temp'] = 'admin/catalog/index';
		$this->load->view('admin/layout', $this->data);
	}

	function add(){
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
              );
              if($this->catalog_model->create($dataSubmit)){
                  $this->session->set_flashdata('message','Thêm danh mục thành công');
                  redirect(base_url('admin/catalog'));
              }
              else{
                  $this->session->set_flashdata('message', 'Thêm sản phẩm thất bại!');
                  redirect(base_url('admin/catalog/add'));
              }
          }
          else{
              $this->session->set_flashdata('message', $this->upload->display_errors());
              redirect(base_url('admin/catalog/add'));
          }
		}
		$this->data['type'] = 0;
		$this->data['temp'] = 'admin/catalog/add';
		$this->load->view('admin/layout', $this->data);
	}
	function edit(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
		$id_catalog = $this->uri->segment(4);
		$id_catalog = intval($id_catalog);
		if($id_catalog == 0){
			$this->session->set_flashdata('message','Danh mục không tồn tại!');
			redirect(base_url('admin/catalog'));
		}
		else{
			$catalog = $this->catalog_model->get_info($id_catalog);
			$this->data['catalog'] = $catalog;
			//pre($catalog);
		}
		if($this->input->post('btnAddCatalog')){
			$name = $this->input->post('txtName');
			$position = $this->input->post('txtPosition');
			$status = $this->input->post('status');
            $dataSubmit = array(
                'name'		=> $name,
                'position'	=> $position,
				'status'	=> $status
            );
            $config['upload_path'] = './public/images/menu';
            $config['allowed_types'] = 'jpg|png|JPG|PNG';
            $this->load->library("upload", $config);
            if($this->upload->do_upload('imageMenu')){
                $img_data = $this->upload->data();
                $img = $img_data['file_name'];
                $dataSubmit['img'] = $img;
                $old_img = './public/images/menu/'.$catalog->img;
                unlink($old_img);
            }
            if($this->catalog_model->update($id_catalog, $dataSubmit)){
                $this->session->set_flashdata('message','Sửa thành công');
                redirect(base_url('admin/catalog'));
            }
            else{
                $this->session->set_flashdata('message', 'Sửa thất bại!');
                redirect(base_url('admin/catalog/edit/'.$id_catalog));
            }
		}
		//pre($id_catalog);
		$this->data['type'] = 0;
		$this->data['temp'] = 'admin/catalog/edit';
		$this->load->view('admin/layout', $this->data);
	}
	function del(){
		$id = $this->uri->segment(4);
		$catalog = $this->catalog_model->get_info($id);
		$input['where']['parent_id'] = $id;
		$parent = $this->catalog_model->get_total($input);
		if($parent > 0){
			$this->session->set_flashdata('message','Không thể xóa danh mục này vì có chứa danh mục con, hãy xóa danh mục con trước!');
			redirect(base_url('admin/catalog'));
		}
		else{
			$input_product['where']['catalog_id'] = $id;
			$product = $this->product_model->get_total($input_product);
			if($product > 0){
				$this->session->set_flashdata('message','Không thể xóa danh mục này vì có chứa sản phẩm, hãy xóa sản phẩm trước!');
				redirect(base_url('admin/catalog'));
			}
			else{
				if($this->catalog_model->delete($id)){
					$this->session->set_flashdata('message','Xóa thành công!');
					redirect(base_url('admin/catalog'));
				}
				else{
					$this->session->set_flashdata('message','Xóa thất bại!');
					redirect(base_url('admin/catalog'));
				}
			}
		}
	}
}
