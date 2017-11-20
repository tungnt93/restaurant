<?php
Class Warehouse extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('warehouse_model');
        $this->load->model('food_model');
        $this->load->model('catalog_model');
        $this->load->model('user_model');
        $this->load->model('import_model');
        $this->load->model('utensils_model');
    }

    function index() {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $foods = $this->food_model->get_list();
        $this->data['foods'] = $foods;
//        pre($foods);
        $utensils = $this->utensils_model->get_list();
        $this->data['utensils'] = $utensils;
        $this->data['temp'] = 'admin/warehouse/index';
        $this->load->view('admin/layout', $this->data);
    }

    function add(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $list_catalog = $this->catalog_model->get_list();
        $items = array();
        foreach ($list_catalog as $key => $value){
            $items[$key] = new stdClass();
            $items[$key]->optgroup = $value->name;
            $input = array();
            $input['where']['catalog_id'] = $value->id;
            $items[$key]->item = $this->food_model->get_list($input);
        }
        $this->data['items'] = $items;

        if($this->input->post('btnAdd')){
            $now = new DateTime();
            $id = $this->input->post('slItem');
            $quantity = $this->input->post('txtQuantity');
            $type = $this->input->post('slType');
            $data= array(
                'item_id' => $id,
                'quantity'=> $quantity,
                'price'=> $this->input->post('txtPrice'),
                'type'=> $type,
                'create_by'=> $this->data['admin']->id,
                'created'=> $now->getTimestamp(),
            );
            if($this->import_model->create($data)){
                if($type == 1){
                    $food = $this->food_model->get_info($id);
                    $dataFood = array(
                        'quantity' => $food->quantity + $quantity
                    );
                    $this->food_model->update($id, $dataFood);
                }
                else if($type == 2){
                    if($this->input->post('slItem') == 0){
                        $newUtensil = $this->input->post('txtNewUtensils');
                        $newUtensil = array(
                            'name'      => $newUtensil,
                            'quantity'  => $quantity,
                            'status'    => 1,
                            'created'   => $now->getTimestamp()
                        );
                        $this->utensils_model->create($newUtensil);
                    }
                    else{
                        $utensil = $this->utensils_model->get_info($id);
                        $dataUpdate = array(
                            'quantity' => $utensil->quantity + $quantity
                        );
                        $this->utensils_model->update($id, $dataUpdate);
                    }
                }
                $this->session->set_flashdata('message','Thêm thành công!');
            }
            else{
                $this->session->set_flashdata('message','Thêm thất bại!');
            }
            redirect(base_url('admin/warehouse/add'));

        }
        $foods = $this->food_model->get_list();
        $this->data['foods'] = $foods;
        $this->data['temp'] = 'admin/warehouse/add';
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
            $dataSubmit = array(
                'name'		=> $name,
                'position'	=> $position
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

    function history(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['where']['type'] = 1;
        $imports = $this->import_model->get_list($input);
        $this->data['imports'] = $imports;

        $this->data['temp'] = 'admin/warehouse/history';
        $this->load->view('admin/layout', $this->data);
    }

    function getHistoryByType(){
        $type = $this->input->post('type');
        $input = array();
        $input['where']['type'] = $type;
        $imports = $this->import_model->get_list($input);
        return $this->load->view('admin/warehouse/tb_history', array('imports'=> $imports));
    }

    function getItemsImportByType(){
        $type = $this->input->post('type');
        if($type == 1){
            $list_catalog = $this->catalog_model->get_list();
            $items = array();
            foreach ($list_catalog as $key => $value){
                $items[$key] = new stdClass();
                $items[$key]->optgroup = $value->name;
                $input = array();
                $input['where']['catalog_id'] = $value->id;
                $items[$key]->item = $this->food_model->get_list($input);
            }
            foreach ($items as $row){
                echo '<optgroup label="'.$row->optgroup.'">';
                foreach ($row->item as $item){
                    echo '<option value="'.$item->id.'" >'.$item->name.'</option>';
                }
                echo '</optgroup>';
            }
        }
        else if($type == 2){
            $untensils = $this->utensils_model->get_list();
            foreach ($untensils as $row){
                echo '<option value="'.$row->id.'" >'.$row->name.'</option>';
            }
            echo '<option value="0" >Thêm dụng cụ mới</option>';
        }
    }
}