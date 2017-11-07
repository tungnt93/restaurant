<?php
Class Content extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('content_model');
	}
	
	function index() {
		redirect(base_url('admin/content/info'));
	}

	function info(){
		$content = $this->content_model->get_info(1);
		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;

	    if($this->input->post('btnUpdateInfo')){
			$dataSubmit = array(
				'company_name'	=> $this->input->post('txtName'),
				'address'		=> $this->input->post('txtAddress'),
				'email'			=> $this->input->post('txtEmail'),
				'phone'			=> $this->input->post('txtPhone'),
			);
			if($this->content_model->update(1, $dataSubmit)){
            	$this->session->set_flashdata('message', 'Cập nhật thông tin thành công!');
				redirect(base_url('admin/content/info'));
            }
            else{
            	$this->session->set_flashdata('message', 'Cập nhật thông tin thất bại!');
				redirect(base_url('admin/content/info'));
            }
		}

	    $this->data['content'] = $content;
	    $this->data['title'] = 'Thông tin công ty';
	    $this->data['temp_content'] = 'admin/content/info';
		$this->data['temp'] = 'admin/content/index';
		$this->load->view('admin/layout', $this->data);
	}

	function social(){
		$content = $this->content_model->get_info(1);
		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;

	    if($this->input->post('btnUpdateSocial')){
			$dataSubmit = array(
				'facebook'	=> $this->input->post('txtFacebook'),
				'google'	=> $this->input->post('txtGoogle'),
				'youtube'	=> $this->input->post('txtYoutube'),
				'twitter'	=> $this->input->post('txtTwitter'),
			);
			if($this->content_model->update(1, $dataSubmit)){
            	$this->session->set_flashdata('message', 'Cập nhật thông tin thành công!');
				redirect(base_url('admin/content/social'));
            }
            else{
            	$this->session->set_flashdata('message', 'Cập nhật thông tin thất bại!');
				redirect(base_url('admin/content/social'));
            }
		}

	    $this->data['content'] = $content;
	    $this->data['title'] = 'Liên kết mạng xã hội';
	    $this->data['temp_content'] = 'admin/content/social';
		$this->data['temp'] = 'admin/content/index';
		$this->load->view('admin/layout', $this->data);
	}

	function intro(){
		$content = $this->content_model->get_info(1);
		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;

	    if($this->input->post('btnUpdateIntro')){
			// $intro = nl2br($this->input->post('txtIntro'));
			// $intro = trim($intro);
			$dataSubmit = array(
				'intro'	=> $this->input->post('txtIntro')
			);
			if($this->content_model->update(1, $dataSubmit)){
            	$this->session->set_flashdata('message', 'Cập nhật thông tin thành công!');
				redirect(base_url('admin/content/intro'));
            }
            else{
            	$this->session->set_flashdata('message', 'Cập nhật thông tin thất bại!');
				redirect(base_url('admin/content/intro'));
            }
		}

	    $this->data['content'] = $content;
	    $this->data['title'] = 'Giới thiệu';
	    $this->data['temp_content'] = 'admin/content/intro';
		$this->data['temp'] = 'admin/content/index';
		$this->load->view('admin/layout', $this->data);
	}

	function logo(){
		$content = $this->content_model->get_info(1);
		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;

	    if($this->input->post('btnUpdateLogo')){
			$config['upload_path'] = './public/images';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '3000';
            $config['max_width']  = '7000';
            $config['max_height']  = '7000';

            $this->load->library("upload", $config);
            if($this->upload->do_upload('logoUpload')){
                $img_data = $this->upload->data();
                $dataSubmit = array(
                	'logo'			=> $img_data['file_name']
                );
                $old_img = $this->content_model->get_info(1)->logo;
                if($this->content_model->update(1, $dataSubmit)){
                	$this->session->set_flashdata('message', 'Cập nhật logo thành công!');
                	$old_img = './public/images/'.$old_img;
	            	unlink($old_img);
					redirect(base_url('admin/content/logo'));
                }
                else{
                	$this->session->set_flashdata('message', 'Cập nhật logo thất bại!');
					redirect(base_url('admin/content/logo'));
                }
            }else{
            	$this->session->set_flashdata('message', $this->upload->display_errors());
				redirect(base_url('admin/content/logo'));
            }
		}

	    $this->data['content'] = $content;
	    $this->data['title'] = 'Logo công ty';
	    $this->data['temp_content'] = 'admin/content/logo';
		$this->data['temp'] = 'admin/content/index';
		$this->load->view('admin/layout', $this->data);
	}

	function slider(){
		$content = $this->content_model->get_info(1);
		$this->data['content'] = $content;

		$message = $this->session->flashdata('message');
	    $this->data['message'] = $message;

	    $list_slider = $content->slider;
	    $list_slider = explode('/', $list_slider);
	    $this->data['list_slider'] = $list_slider;

	    if($this->input->post('btnAddSlide')){
			$config['upload_path'] = './public/images/slide';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '900';
            $config['max_width']  = '1024';
            $config['max_height']  = '1024';

            $this->load->library("upload", $config);
            if($this->upload->do_upload('slideUpload')){
                $img_name = $this->upload->data()['file_name'];
                $list_slider[] = $img_name;
                $slider = implode('/', $list_slider);
                
                $dataSubmit = array('slider'=> $slider);
                if($this->content_model->update(1, $dataSubmit)){
                	$this->session->set_flashdata('message', 'Thêm slide thành công!');
					redirect(base_url('admin/content/slider'));
                }
                else{
                	$this->session->set_flashdata('message', 'Thêm slide thất bại!');
					redirect(base_url('admin/content/slider'));
                }
            }else{
            	$this->session->set_flashdata('message', $this->upload->display_errors());
				redirect(base_url('admin/content/slider'));
            }
		}

	    
	    $this->data['title'] = 'Quản lý slide';
	    $this->data['temp_content'] = 'admin/content/slider';
		$this->data['temp'] = 'admin/content/index';
		$this->load->view('admin/layout', $this->data);
	}

	function delSlide(){
		$content = $this->content_model->get_info(1);
		$pos = $this->uri->segment(4);
		$list_slider = $content->slider;
	    $list_slider = explode('/', $list_slider);
	    if($pos >= sizeof($list_slider)){
	    	$this->session->set_flashdata('message', 'Không tồn tại slide này!');
			redirect(base_url('admin/content/slider'));
	    }
	    else{
	    	$old_img = './public/images/slide'.$list_slider[$pos];
		    unset($list_slider[$pos]);
		    $slider = implode('/', $list_slider);
		    $dataSubmit = array('slider'=> $slider);
		    if($this->content_model->update(1, $dataSubmit)){
	        	$this->session->set_flashdata('message', 'Xóa slide thành công!');
		        unlink($old_img);
				redirect(base_url('admin/content/slider'));
	        }
	        else{
	        	$this->session->set_flashdata('message', 'Xóa slide thất bại!');
				redirect(base_url('admin/content/slider'));
	        }
	    }
	}
}