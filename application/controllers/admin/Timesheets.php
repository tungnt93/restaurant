<?php
Class Timesheets extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('department_model');
        $this->load->model('employee_model');
        $this->load->model('timesheets_model');
        $this->load->model('month_model');
    }

    function index() {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $timesheets = $this->month_model->get_list();
        $this->data['timesheets'] = $timesheets;
//        pre($timesheets);

        $this->data['temp'] = 'admin/timesheets/index';
        $this->load->view('admin/layout', $this->data);
    }

    function add(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if($this->input->post('btnAdd')){
            $month = $this->input->post('txtMonth');
            $input = array();
            $input['where']['month_name'] = $month;
            $m = $this->month_model->get_list($input);
            $month_id = 0;
            if($m){
                $month_id = $m[0]->id;
            }
            else{
                $first_date_find = strtotime(date("d/m/Y", strtotime('01/'.$month)) . ", first day of this month");
                $last_date_find = strtotime(date("d/m/Y", strtotime('01/'.$month)) . ", last day of this month");
//                $last_date = date("d/m/Y",$last_date_find);
//                $first_date = date("d/m/Y",$first_date_find);
                $start_day = date('N', $first_date_find);
                $dataMonth = array(
                    'start_date' => $first_date_find,
                    'end_date'   => $last_date_find,
                    'month_name' => $month,
                    'start_day'  => $start_day
                );
                $month_id = $this->month_model->create($dataMonth);
            }
            $where = array('month_id' => $month_id);
            $timesheet = $this->timesheets_model->check_exists($where);
//            pre($timesheet);
            if(!$timesheet){
                $arr = explode('/', $month);
                $total_day_of_month = cal_days_in_month(CAL_GREGORIAN, $arr[0], $arr[1]);
                $working_times = '';
                for ($i = 0; $i < $total_day_of_month; $i++){
                    $working_times = $working_times.'2';
                }
                $input = array();
                $input['where']['status'] = 1;
                $employees = $this->employee_model->get_list($input);
                foreach ($employees as $value){
                    $dataTimesheet = array(
                        'month_id' => $month_id,
                        'employee_id' => $value->id,
                        'working_times' => $working_times
                    );
                    $this->timesheets_model->create($dataTimesheet);
                }
                $this->session->set_flashdata('message', 'Tạo bảng thành công!');
                redirect(base_url('admin/timesheets/detail/'.$month_id));
            }
            else{
                $this->session->set_flashdata('message', 'Bảng đã tồn tại, tạo bảng thất bại!');
                redirect(base_url('admin/timesheets/add/'));
            }
        }

        $this->data['temp'] = 'admin/timesheets/add';
        $this->load->view('admin/layout', $this->data);
    }

    function detail(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $month_id = $this->uri->segment(4);
        $month = $this->month_model->get_info($month_id);
        if(!$month){
            $this->session->set_flashdata('message', 'Không có thông tin bảng chấm công tháng này!');
            redirect(base_url('admin/timesheets'));
        }
        $arr = explode('/', $month->month_name);
        $total_day_of_month = cal_days_in_month(CAL_GREGORIAN, $arr[0], $arr[1]);
        $month->total_day = $total_day_of_month;

        $input = array();
        $input['where']['month_id'] = $month_id;
        $timesheets = $this->timesheets_model->get_list($input);

        $timesheet_by_department = [];
        foreach ($timesheets as $key => $value){
            $department_id = $this->employee_model->get_info($value->employee_id)->department_id;
            $department_parent = $this->department_model->get_info($department_id)->parent_id;
            $timesheets[$key]->department_id = $department_id;
//            $timesheets[$key]->department_parent = $department_parent;

            if(!isset($timesheet_by_department[$department_parent])){
                $timesheet_by_department[$department_parent] = new stdClass();
                $timesheet_by_department[$department_parent]->department_parent = $department_parent;
                $timesheet_by_department[$department_parent]->timesheets = array();
            }


            $timesheet_by_department[$department_parent]->timesheets[] = $timesheets[$key];
        }
//        pre($timesheets);
//        pre($timesheet_by_department);

        $this->data['timesheet_by_department'] = $timesheet_by_department;
        $this->data['month'] = $month;
        $this->data['temp'] = 'admin/timesheets/detail';
        $this->load->view('admin/layout', $this->data);
    }

    function update(){
        $month_id = $this->input->post('month_id');
        $employee_id = $this->input->post('employee_id');
        $working = $this->input->post('working_times');
        $day_index = $this->input->post('day_index');

        $input = array();
        $input['where'] = array(
            'month_id' => $month_id,
            'employee_id' => $employee_id
        );
        $timesheet = $this->timesheets_model->get_list($input)[0];
        $working_times = $timesheet->working_times;
        $working_times[$day_index] = $working;
        $dataUpdate = array('working_times'=>$working_times);
        if($this->timesheets_model->update($timesheet->id, $dataUpdate)){
            $len = strlen($working_times);
            $total = 0;
            for ($i = 0; $i < $len; $i++){
                $total += $working_times[$i];
            }
            echo json_encode(array('working_times'=>$working, 'total'=>$total/2));
        }
        else{
            echo 0;
        }


    }
}