<?php
Class User extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('department_model');
	}
	
	function index() {

		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;
		
		$list_admin = $this->user_model->get_list();
		$this->data['list_admin'] = $list_admin;
	    
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
            $department[$key]->child = $this->department_model->get_list($input);
        }
        $this->data['department'] = $department;
//        pre($department);

		if($this->input->post('btnAddAdmin')){
			$fullname = $this->input->post('txtName');
			$username = $this->input->post('txtUsername');
			$password = $this->input->post('txtPassword');
			$rePassword = $this->input->post('txtRePassword');
			$type = $this->input->post('slType');
			if($fullname == null){
				$this->session->set_flashdata('message', 'Họ tên không được để trống!');
				redirect(base_url('admin/admin/add'));
			}
			else if($username == null){
				$this->session->set_flashdata('message', 'Username không được để trống!');
				redirect(base_url('admin/admin/add'));
			}
			else if($password == null){
				$this->session->set_flashdata('message', 'Mật khẩu không được để trống!');
				redirect(base_url('admin/admin/add'));
			}
			else if(strlen($password) < 6){
				$this->session->set_flashdata('message', 'Mật khẩu phải lớn hơn 6 kí tự!');
				redirect(base_url('admin/admin/add'));
			}
			else if($password != $rePassword){
				$this->session->set_flashdata('message', 'Xác nhận mật khẩu không khớp!');
				redirect(base_url('admin/admin/add'));
			}
			else{
				$in = array();
				$in['where']['username'] = $username;
				//pre(count($this->user_model->get_list($in)));
				if(count($this->user_model->get_list($in)) > 0){
					$this->session->set_flashdata('message', 'Username đã tồn tại!');
					redirect(base_url('admin/admin/add'));
				}
				else{
					$now = new DateTime();
					$now = $now->getTimestamp();
					$dataSubmit = array(
						'username' => $username,
						'password' => md5($password),
						'fullname' => $fullname,
						'create_time' => $now,
						'create_by' => $this->data['Employee']->id,
						'type' => $type
					);
					if($this->user_model->create($dataSubmit)){
						$this->session->set_flashdata('message', 'Thêm quản trị viên thành công!');
						redirect(base_url('admin/admin'));
					}
					else{
						$this->session->set_flashdata('message', 'Thêm quản trị viên thất bại!');
						redirect(base_url('admin/admin'));
					}
				}
			}
		}
	    
		$this->data['temp'] = 'admin/user/add';
		$this->load->view('admin/layout', $this->data);
	}

	function del(){
		$id = $this->uri->segment(4);
		if($this->data['Employee']->type != 1){
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