<?php
Class User extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('department_model');
		$this->load->model('employee_model');
	}
	
	function index() {

		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;
		
		$users = $this->user_model->get_list();
		$this->data['users'] = $users;
	    
		$this->data['temp'] = 'admin/user/index';
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
            $department[$key]->user = $this->employee_model->get_employee_by_department($value->id);
            foreach ($department[$key]->user as $k => $v){
                if($this->user_model->get_total(array('where'=>array('employee_id'=>$v->id))) > 0){
                    unset($department[$key]->user[$k]);
                }
            }
        }
        $this->data['department'] = $department;

		if($this->input->post('btnAddAdmin')){
			$employee_id = $this->input->post('employee_id');
			$username = $this->input->post('txtUsername');
			$password = $this->input->post('txtPassword');
			$rePassword = $this->input->post('txtRePassword');
			$role = $employee_id == 1 ? 1 : 2;

            $in = array();
            $in['where']['username'] = $username;
            //pre(count($this->user_model->get_list($in)));
            if(count($this->user_model->get_list($in)) > 0){
                $this->session->set_flashdata('message', 'Username đã tồn tại!');
                redirect(base_url('admin/user/add'));
            }
            else if($password != $rePassword){
                $this->session->set_flashdata('message', 'Mật khẩu không khớp!');
                redirect(base_url('admin/user/add'));
            }
            else{
                $now = new DateTime();
                $now = $now->getTimestamp();
                $dataSubmit = array(
                    'username' => $username,
                    'password' => md5($password),
                    'employee_id' => $employee_id,
                    'create_time' => $now,
                    'create_by' => $this->data['admin']->id,
                    'role' => $role,
                    'status' => 1
                );
                if($this->user_model->create($dataSubmit)){
                    $this->session->set_flashdata('message', 'Thêm tài khoản thành công!');
                    redirect(base_url('admin/user'));
                }
                else{
                    $this->session->set_flashdata('message', 'Thêm tài khoản thất bại!');
                    redirect(base_url('admin/user'));
                }
            }

		}
	    
		$this->data['temp'] = 'admin/user/add';
		$this->load->view('admin/layout', $this->data);
	}

	function edit(){
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $id = $this->uri->segment(4);
        $user = $this->user_model->get_info($id);
        if(!$user){
            $this->session->set_flashdata('message', 'Không tồn tại user này!');
            redirect(base_url('admin/user'));
        }
        $input = array();
        $input['where']['parent_id'] = 0;
        $department = $this->department_model->get_list($input);
        foreach ($department as $key => $value){
            $input['where']['parent_id'] = $value->id;
            $department[$key]->user = $this->employee_model->get_employee_by_department($value->id);
            foreach ($department[$key]->user as $k => $v){
                if($v->id != $user->employee_id && $this->user_model->get_total(array('where'=>array('employee_id'=>$v->id))) > 0){
                    unset($department[$key]->user[$k]);
                }
            }
        }
        $this->data['department'] = $department;
        $this->data['user'] = $user;
//        pre($user);

        if($this->input->post('btnAddAdmin')){
            $employee_id = $this->input->post('employee_id');
            $username = $this->input->post('txtUsername');
            $password = $this->input->post('txtPassword');
            $rePassword = $this->input->post('txtRePassword');
            $role = $employee_id == 1 ? 1 : 2;
            $status = $this->input->post('status');
            $in = array();
            $in['where']['username'] = $username;
            //pre(count($this->user_model->get_list($in)));
            if($username != $user->username && count($this->user_model->get_list($in)) > 0){
                $this->session->set_flashdata('message', 'Username đã tồn tại!');
                redirect(base_url('admin/user/add'));
            }
            else if($password != $rePassword){
                $this->session->set_flashdata('message', 'Mật khẩu không khớp!');
                redirect(base_url('admin/user/add'));
            }
            else{
                $now = new DateTime();
                $now = $now->getTimestamp();
                $dataSubmit = array(
                    'username' => $username,
                    'password' => md5($password),
                    'employee_id' => $employee_id,
                    'create_time' => $now,
                    'create_by' => $this->data['admin']->id,
                    'role' => $role,
                    'status' => $status
                );
                if($this->user_model->update($id, $dataSubmit)){
                    $this->session->set_flashdata('message', 'Sửa tài khoản thành công!');
                    redirect(base_url('admin/user'));
                }
                else{
                    $this->session->set_flashdata('message', 'Sửa tài khoản thất bại!');
                    redirect(base_url('admin/user'));
                }
            }

        }

        $this->data['temp'] = 'admin/user/edit';
        $this->load->view('admin/layout', $this->data);

    }

	function del(){
		$id = $this->uri->segment(4);
		if($this->data['admin']->role != 1){
			$this->session->set_flashdata('message', 'Bạn không có quyền hạn này!');
			redirect(base_url('admin/user'));
		}
		else if($this->user_model->get_info($id) == null){
			$this->session->set_flashdata('message', 'Không tồn tại admin này!');
			redirect(base_url('admin/user'));
		}
		else if($this->data['Employee']->id == $id){
			$this->session->set_flashdata('message', 'Không thể xóa tài khoản của chính mình!');
			redirect(base_url('admin/user'));
		}
		else if($id == 1){
			$this->session->set_flashdata('message', 'Không thể xóa tài khoản này!');
			redirect(base_url('admin/user'));
		}
		else if($this->user_model->delete($id)){
			$this->session->set_flashdata('message', 'Xóa thành công!');
			redirect(base_url('admin/user'));
		}
	}
}