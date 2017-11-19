<?php 
function public_url($url='')
{
	return base_url('public/'.$url);
}
function admin_url($url='')
{
	return base_url('admin/'.$url);
}
function admin_theme($url=''){
	return base_url('public/admin_temp/'.$url);
}

function pre($list,$exit=true){
	echo "<pre>";
	print_r($list);
	
	if($exit){
		die();
	}
}
function create_slug($string) {
    $search = array (
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
        '#(ì|í|ị|ỉ|ĩ)#',
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',
        '#(đ)#',
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
        '#(Đ)#',
        "/[^a-zA-Z0-9\-\_]/",
        ) ;
    $replace = array ('a','e','i','o','u','y','d','A','E','I','O','U','Y','D','-',) ;
    $string = preg_replace($search, $replace, $string);
    $string = preg_replace('/(-)+/', '-', $string);
    $string = strtolower($string);
    return $string;
}
function config_pagination($per_page = 10, $segment = 1, $total = 0, $base_url = ''){
    //phan trang
    $ci =& get_instance();
    $ci->load->library("pagination");
    $config['base_url'] = $base_url;
    $config['total_rows'] = $total;
    $config['per_page'] = $per_page;
    $config['prev_link']  = '&lt;';
    $config['next_link']  = '&gt;';
    $config['last_link']  = 'Cuối';
    $config['first_link'] = 'Đầu';
    $config['use_page_numbers'] = TRUE;

    $config['full_tag_open'] = "<ul class='pagination'>";
    $config['full_tag_close'] ="</ul>";
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
    $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
    $config['next_tag_open'] = "<li>";
    $config['next_tagl_close'] = "</li>";
    $config['prev_tag_open'] = "<li>";
    $config['prev_tagl_close'] = "</li>";
    $config['first_tag_open'] = "<li>";
    $config['first_tagl_close'] = "</li>";
    $config['last_tag_open'] = "<li>";
    $config['last_tagl_close'] = "</li>";

    $config['uri_segment'] = $segment;
    $ci->pagination->initialize($config);
    $paginator=$ci->pagination->create_links();  

    return $paginator;
}
function phone_format($number){
    //pre(strlen($number));
    if(strlen($number) == 10){
        $str = array(substr($number, 0, 4), substr($number, 4, 3), substr($number, 7, 3));
        // $s1 = substr($number, 0, 3);
        // $s2 = substr($number, 4, 6);
        // $s3 = substr($number, 7, 9);
        return implode(' ', $str);
    }
    else if(strlen($number) == 11){
        $str = array(substr($number, 0, 5), substr($number, 5, 3), substr($number, 8, 3));
        return implode(' ', $str);
    }
    else
        return $number;
}

function money_fomart($money){

}