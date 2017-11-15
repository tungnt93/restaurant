<?php
Class Food extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('food_model');
        $this->load->model('catalog_model');
    }

    function index() {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $foods = $this->food_model->get_list();
        $this->data['foods'] = $foods;

        $this->data['temp'] = 'admin/food/index';
        $this->load->view('admin/layout', $this->data);
    }

    function add(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if($this->input->post('btnAdd')){
            $data = array(
                'name' => $this->input->post('txtName'),
                'catalog_id' => $this->input->post('slCatalog'),
                'dram' => $this->input->post('txtDram'),
            );
            if($this->food_model->create($data)){
                $this->session->set_flashdata('message','Thêm thành công!');
                redirect(base_url('admin/food/add'));
            }
            else{
                $this->session->set_flashdata('message','Thêm thất bại!');
                redirect(base_url('admin/food/add'));
            }
        }
        $catalogs = $this->catalog_model->get_list();
        $this->data['catalogs'] = $catalogs;
        $this->data['temp'] = 'admin/food/add';
        $this->load->view('admin/layout', $this->data);
    }
    function edit(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $id = intval($id);
        if($id == 0){
            redirect(base_url('admin/food'));
        }
        else{
            $food = $this->food_model->get_info($id);
            $this->data['food'] = $food;
            //pre($catalog);
        }
        if($this->input->post('btnEdit')){
            $data = array(
                'name' => $this->input->post('txtName'),
                'catalog_id' => $this->input->post('slCatalog'),
                'dram' => $this->input->post('txtDram'),
            );
            if($this->food_model->update($id, $data)){
                $this->session->set_flashdata('message','Cập nhật thành công!');
                redirect(base_url('admin/food/edit/'.$id));
            }
            else{
                $this->session->set_flashdata('message','Cập nhật thất bại!');
                redirect(base_url('admin/food/edit/'.$id));
            }
        }
        $catalogs = $this->catalog_model->get_list();
        $this->data['catalogs'] = $catalogs;
        $this->data['temp'] = 'admin/food/edit';
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