<?php
Class Timesheets extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
        $this->load->model('employee_model');
        $this->load->model('timesheets_model');
    }

    function index() {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $timesheets = $this->timesheets_model->get_list();
        $this->data['timesheets'] = $timesheets;

        $this->data['temp'] = 'admin/timesheets/index';
        $this->load->view('admin/layout', $this->data);
    }

    function add(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $timesheets = $this->timesheets_model->get_list();
        $this->data['timesheets'] = $timesheets;

        $this->data['temp'] = 'admin/timesheets/add';
        $this->load->view('admin/layout', $this->data);
    }
}