<?php
Class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('employee_model');
		$this->load->model('department_model');
	}
	
	function index() {
		//$data = array();
//		pre($this->data);
//		$this->data['temp'] = 'admin/index';
//		$this->load->view('admin/layout', $this->data);
        redirect(base_url('admin/report'));
	}

	function logout()
    {
    	//pre($this->session->userdata('admin'));
        if($this->session->userdata('login')){
            $this->session->unset_userdata('login');
            $this->session->unset_userdata('Employee');
            $this->session->sess_destroy();
        }
        //pre($this->session->userdata('admin'));
        redirect(base_url('admin/login'));
    }
    function info(){
    	$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;
	    
    	if($this->input->post('btnUpdateInfo')){
    		$admin = $this->session->userdata('admin');
            $newPassword = $this->input->post('txtNewPassword');
            $confirm = $this->input->post('txtConfirm');
    		$oldPassword = $this->input->post('txtOldPassword');
    		$phone = $this->input->post('txtPhone');
    		$address = $this->input->post('txtAddress');
    		$birthday = $this->input->post('txtBirthday');
    		$dataUpdate = array(
    		    'phone' => $phone,
                'address' => $address,
                'birthday' => $birthday,
            );
//    		pre(strlen($oldPassword));
            if(strlen($oldPassword) > 0){
                if(md5($oldPassword) != $admin->password){
                    $this->session->set_flashdata('message', 'Mật khẩu cũ không đúng!');
                    redirect(base_url('admin/home/info'));
                }
                else if(strlen($newPassword) == 0){
                    $this->session->set_flashdata('message', 'Bạn chưa nhập mật khẩu mới!');
                    redirect(base_url('admin/home/info'));
                }
                else if($newPassword != $confirm){
                    $this->session->set_flashdata('message', 'Xác nhận mật khẩu không khớp!');
                    redirect(base_url('admin/home/info'));
                }
                else{
                    $dataUser = array('password'=>md5($newPassword));
                    $this->user_model->update($admin->id, $dataUser);
                    $this->employee_model->update($admin->employee_id, $dataUpdate);
                    $this->session->set_flashdata('message', 'Cập nhật thành công, vui lòng đăng xuất và đăng nhập lại!');
                    redirect(base_url('admin/home/info'));
                }
            }
            $this->employee_model->update($admin->employee_id, $dataUpdate);
            $this->session->set_flashdata('message', 'Cập nhật thành công!');
    		redirect(base_url('admin/home/info'));
    	}
    	$this->data['temp'] = 'admin/user/info';
		$this->load->view('admin/layout', $this->data);
    }
}