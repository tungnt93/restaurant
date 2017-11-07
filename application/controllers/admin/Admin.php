<?php
Class Admin extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}
	
	function index() {

		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;
		
		$list_admin = $this->admin_model->get_list();
		$this->data['list_admin'] = $list_admin;
	    
		$this->data['temp'] = 'admin/admin/index';
		$this->load->view('admin/layout', $this->data);
	}
	
	function add(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;
		
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
				//pre(count($this->admin_model->get_list($in)));
				if(count($this->admin_model->get_list($in)) > 0){
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
						'create_by' => $this->data['admin']->id,
						'type' => $type
					);
					if($this->admin_model->create($dataSubmit)){
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
	    
		$this->data['temp'] = 'admin/admin/add';
		$this->load->view('admin/layout', $this->data);
	}

	function del(){
		$id = $this->uri->segment(4);
		if($this->data['admin']->type != 1){
			$this->session->set_flashdata('message', 'Bạn không có quyền hạn này!');
			redirect(base_url('admin/admin'));
		}
		else if($this->admin_model->get_info($id) == null){
			$this->session->set_flashdata('message', 'Không tồn tại admin này!');
			redirect(base_url('admin/admin'));
		}
		else if($this->data['admin']->id == $id){
			$this->session->set_flashdata('message', 'Không thể xóa tài khoản của chính mình!');
			redirect(base_url('admin/admin'));
		}
		else if($id == 1){
			$this->session->set_flashdata('message', 'Không thể xóa tài khoản này!');
			redirect(base_url('admin/admin'));
		}
		else if($this->admin_model->delete($id)){
			$this->session->set_flashdata('message', 'Xóa thành công!');
			redirect(base_url('admin/admin'));
		}
	}
}