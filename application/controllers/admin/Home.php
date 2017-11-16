<?php
Class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
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
    		$admin = $this->session->userdata('Employee');
    		$oldPassword = $this->input->post('txtOldPassword');
    		$fullname = $this->input->post('txtName');
    		if(strlen($fullname) > 0){
    			if($admin->password == md5($oldPassword)){
	    			$newPassword = $this->input->post('txtNewPassword');
	    			if(strlen($newPassword) > 0){
	    				$confirmPassword = $this->input->post('txtConfirm');
	    				if($newPassword == $confirmPassword){
	    					$dataSubmit = array('fullname' => $fullname,'password'=>md5($newPassword));
	    					if($this->user_model->update($admin->id, $dataSubmit)){
		    					$this->session->set_flashdata('message', 'Cập nhật thông tin thành công, vui lòng đăng xuất và đăng nhập lại!');
		    				}
		    				else{
		    					$this->session->set_flashdata('message', 'Cập nhật thông tin thất bại!');
		    				}
	    				}
	    				else{
	    					$this->session->set_flashdata('message', 'Xác nhận mật khẩu không khớp!');
	    				}
	    			}
	    			else{
	    				$dataSubmit = array('fullname' => $fullname);
	    				if($this->user_model->update($admin->id, $dataSubmit)){
	    					$this->session->set_flashdata('message', 'Cập nhật thông tin thành công, vui lòng đăng xuất và đăng nhập lại!');
	    				}
	    				else{
	    					$this->session->set_flashdata('message', 'Cập nhật thông tin thất bại!');
	    				}
	    			}
	    		}
	    		else{
	    			$this->session->set_flashdata('message', 'Mật khẩu cũ không đúng!');
	    		}
    		}
    		else{
    			$this->session->set_flashdata('message', 'Họ tên không được để trống!');
    		}
    		redirect(base_url('admin/home/info'));
    	}
    	$this->data['temp'] = 'admin/admin/info';
		$this->load->view('admin/layout', $this->data);
    }
}