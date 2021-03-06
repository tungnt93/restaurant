<?php
Class Employee extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
        $this->load->model('employee_model');
    }

    function index() {

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $employees = $this->employee_model->get_list();
        $this->data['employees'] = $employees;

        $this->data['temp'] = 'admin/employee/index';
        $this->load->view('admin/layout', $this->data);
    }

    function add(){
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $input = array();
        $input['where']['parent_id'] = 0;
        $department = $this->department_model->get_list($input);
        foreach ($department as $key => $value){
            $input['where']['parent_id'] = $value->id;
            $department[$key]->child = $this->department_model->get_list($input);
        }
        $this->data['department'] = $department;
//        pre($department);

        if($this->input->post('btnAddAdmin')) {
            $name = $this->input->post('txtName');
            $phone = $this->input->post('txtPhone');
            $birthday = $this->input->post('txtBirthday');
            $address = $this->input->post('txtAddress');
            $department_id = $this->input->post('department');
            $wage = $this->input->post('txtWage');
            $start_date = $this->input->post('txtStartDate');
            $lunch_allowance = $this->input->post('txtLunch');
            $travel_allowance = $this->input->post('txtTravel');
            $tel_allowance = $this->input->post('txtTel');


            $now = new DateTime();
            $now = $now->getTimestamp();
            $dataSubmit = array(
                'name' => $name,
                'phone' => $phone,
                'birthday' => $birthday,
                'address' => $address,
                'department_id' => $department_id,
                'wage' => $wage,
                'start_date' => $start_date,
                'lunch_allowance' => $lunch_allowance,
                'travel_allowance' => $travel_allowance,
                'tel_allowance' => $tel_allowance,
            );
            if ($this->employee_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Thêm nhân viên thành công!');
                redirect(base_url('admin/employee'));
            } else {
                $this->session->set_flashdata('message', 'Thêm nhân viên thất bại!');
                redirect(base_url('admin/employee'));
            }
        }

        $this->data['temp'] = 'admin/employee/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $id = $this->uri->segment(4);
        $info = $this->employee_model->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message', 'Không tồn tại nhân viên này!');
            redirect(base_url('admin/employee'));
        }
        $this->data['info'] = $info;

        $input = array();
        $input['where']['parent_id'] = 0;
        $department = $this->department_model->get_list($input);
        foreach ($department as $key => $value){
            $input['where']['parent_id'] = $value->id;
            $department[$key]->child = $this->department_model->get_list($input);
        }
        $this->data['department'] = $department;
//        pre($department);

        if($this->input->post('btnAddAdmin')) {
            $name = $this->input->post('txtName');
            $phone = $this->input->post('txtPhone');
            $birthday = $this->input->post('txtBirthday');
            $address = $this->input->post('txtAddress');
            $department_id = $this->input->post('department');
            $wage = $this->input->post('txtWage');
            $start_date = $this->input->post('txtStartDate');
            $lunch_allowance = $this->input->post('txtLunch');
            $travel_allowance = $this->input->post('txtTravel');
            $tel_allowance = $this->input->post('txtTel');

            $now = new DateTime();
            $now = $now->getTimestamp();
            $dataSubmit = array(
                'name' => $name,
                'phone' => $phone,
                'birthday' => $birthday,
                'address' => $address,
                'department_id' => $department_id,
                'wage' => $wage,
                'start_date' => $start_date,
                'lunch_allowance' => $lunch_allowance,
                'travel_allowance' => $travel_allowance,
                'tel_allowance' => $tel_allowance,
            );
            if ($this->employee_model->create($dataSubmit)) {
                $this->session->set_flashdata('message', 'Cập nhật thông tin nhân viên thành công!');
                redirect(base_url('admin/employee'));
            } else {
                $this->session->set_flashdata('message', 'Cập nhật thông tin nhân viên thất bại!');
                redirect(base_url('admin/employee'));
            }
        }

        $this->data['temp'] = 'admin/employee/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del(){
        $id = $this->uri->segment(4);

    }
}