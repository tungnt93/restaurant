<?php
Class Sendmail extends MY_Controller {
	function __construct() {
		parent::__construct();
		
	}
	
	function index(){
        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => 465,
          'smtp_user' => 'tungnt93@gmail.com', // change it to yours
          'smtp_pass' => 'xxx', // change it to yours
          'mailtype' => 'html',
          'charset' => "utf-8",
          'newline' => "\r\n",
          'wordwrap' => TRUE
        );
        $this->load->library('email',$config);
        $this->email->from( 'tungnt93@gmail.com', 'Thanh Tung' );
        $this->email->to( 'tungnt93@gmail.com' );
        $this->email->subject( 'Some subject' );
        $this->email->message('Message');
        if($this->email->send()){
            echo 'Email sent.';
        }
        else{
            pre($this->email->print_debugger());
        }
    }  
}
// https://accounts.google.com/DisplayUnlockCaptcha
// https://myaccount.google.com/security