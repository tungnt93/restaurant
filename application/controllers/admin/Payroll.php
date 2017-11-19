<?php
Class Payroll extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
        $this->load->model('employee_model');
        $this->load->model('timesheets_model');
        $this->load->model('month_model');
        $this->load->model('payroll_model');
    }

    function index() {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $months = $this->month_model->get_list();
        foreach ($months as $key => $value){
            if(!$this->payroll_model->check_exists(array('month_id' => $value->id))){
                unset($months[$key]);
            }
        }
        $this->data['months'] = $months;

        $this->data['temp'] = 'admin/payroll/index';
        $this->load->view('admin/layout', $this->data);
    }

    function add(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $months = $this->month_model->get_list();
        foreach ($months as $key => $value){
            if(!$this->timesheets_model->check_exists(array('month_id' => $value->id)) ||
                $this->payroll_model->check_exists(array('month_id' => $value->id))){
                unset($months[$key]);
            }
        }
        $this->data['months'] = $months;

        if($this->input->post('btnAdd')){
            $month = $this->input->post('month');
            $input = array();
            $input['where']['status'] = 1;
            $employees = $this->employee_model->get_list($input);

            foreach ($employees as $value){
                $input = array();
                $input['where'] = array(
                    'month_id' => $month,
                    'employee_id' => $value->id
                );
                $timesheet = $this->timesheets_model->get_list($input)[0];
                $dataPayroll = array(
                    'month_id' => $month,
                    'employee_id' => $value->id,
                    'timesheet_id' => $timesheet->id,
                    'wage' => $value->wage,
                    'lunch_allowance' => $value->lunch_allowance,
                    'travel_allowance' => $value->travel_allowance,
                    'tel_allowance' => $value->tel_allowance,
                );
                $this->payroll_model->create($dataPayroll);
            }
            $this->session->set_flashdata('message', 'Tạo bảng thành công!');
//            redirect(base_url('admin/payroll/detail/'.$month));
            redirect(base_url('admin/payroll'));
        }

        $this->data['temp'] = 'admin/payroll/add';
        $this->load->view('admin/layout', $this->data);
    }

    function detail(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $month_id = $this->uri->segment(4);
        $month = $this->month_model->get_info($month_id);
        if(!$month){
            $this->session->set_flashdata('message', 'Không có thông tin tháng này!');
            redirect(base_url('admin/payroll'));
        }
        $arr = explode('/', $month->month_name);
        $total_day_of_month = cal_days_in_month(CAL_GREGORIAN, $arr[0], $arr[1]);
        $month->total_day = $total_day_of_month;
        $this->data['month'] = $month;

        $input = array();
        $input['where']['month_id'] = $month_id;
        $payrolls = $this->payroll_model->get_list($input);
        $payroll_by_department = [];
        foreach ($payrolls as $key => $value){
            $department_id = $this->employee_model->get_info($value->employee_id)->department_id;
            $department_parent = $this->department_model->get_info($department_id)->parent_id;
            $payrolls[$key]->department_id = $department_id;
            $total_working = 0;
            $working_times = $this->timesheets_model->get_info($value->timesheet_id)->working_times;
            for($i = 0; $i < $total_day_of_month; $i++){
                $total_working += $working_times[$i]/2;
            }
            $payrolls[$key]->total_working = $total_working;
            $total_money = $value->wage*$total_working/$total_day_of_month + $value->lunch_allowance
                + $value->tel_allowance + $value->travel_allowance;
            $payrolls[$key]->total_money = intval($total_money);
            if(!isset($payroll_by_department[$department_parent])){
                $payroll_by_department[$department_parent] = new stdClass();
                $payroll_by_department[$department_parent]->department_parent = $department_parent;
                $payroll_by_department[$department_parent]->payrolls = array();
            }
            $payroll_by_department[$department_parent]->payrolls[] = $payrolls[$key];
        }
        $this->data['payroll_by_department'] = $payroll_by_department;
//        pre($payroll_by_department);

        $this->data['temp'] = 'admin/payroll/detail';
        $this->load->view('admin/layout', $this->data);
    }

    function update(){
        $payroll_id = $this->input->post('payroll_id');
        $money = $this->input->post('money');
        $type = $this->input->post('type');

        $payroll = $this->payroll_model->get_info($payroll_id);
        if($payroll && intval($money) > 0){
            $dataUpdate = array($type=>$money);
            if($this->payroll_model->update($payroll_id, $dataUpdate)){
                $working_times = $this->timesheets_model->get_info($payroll->timesheet_id)->working_times;
                $len = strlen($working_times);
                $total_working = 0;
                for($i = 0; $i < $len; $i++){
                    $total_working += $working_times[$i]/2;
                }
                $payroll_new = $this->payroll_model->get_info($payroll_id);
                $total = $payroll_new->wage*$total_working/$len + $payroll_new->lunch_allowance
                    + $payroll_new->tel_allowance + $payroll_new->travel_allowance;
                echo json_encode(array('money'=>$money, 'total'=>intval($total)));
            }
            else{
                echo 0;
            }
        }
        else echo 0;
    }
}