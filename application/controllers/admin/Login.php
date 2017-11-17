<?php
Class Login extends MY_Controller {
	function __construct() {
		parent::__construct();
		
	}
	
	function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post())
        {
            $this->form_validation->set_rules('login' ,'login', 'callback_check_login');
            if($this->form_validation->run())
            {
                $this->session->set_userdata('login', true);
                redirect(base_url('admin/report'));
            }
        }
        
        $this->load->view('admin/login');
    }
    
    /*
     * Kiem tra username va password co chinh xac khong
     */
    function check_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);
        
        $this->load->model('user_model');
        $where = array('username' => $username , 'password' => $password);
        if($this->user_model->check_exists($where))
        {
            $this->load->model('user_model');
            $input = array();
            $input['where']['username'] = $username;
            $admin = $this->user_model->get_list($input)[0];
            $this->session->set_userdata('admin', $admin);
            //pre($admin);
            return true;
        }
        $this->form_validation->set_message(__FUNCTION__, 'Không đăng nhập thành công');
        return false;
    }
}