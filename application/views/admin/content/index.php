<?php if ($message){$this->load->view('admin/message',$this->data); }?>

<div class="x_panel">
	<div class="x_title">
		<h2><?php echo $title ?></h2>
		<ul class="nav navbar-right panel_toolbox">
	        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#">Settings 1</a>
	            </li>
	            <li><a href="#">Settings 2</a>
	            </li>
	          </ul>
	        </li>
	        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
	    </ul>
	    <div class="clearfix"></div>
	</div>
	<div class="x_content">
		<?php $this->load->view($temp_content) ?>
	</div>
</div>




<!-- <div class="page-title">
	<div class="title_left"><h3>Quản lý nội dung website</h3></div>
</div>
<div class="row"></div>
<div class="row">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Thông tin liên hệ</a>
	    </li>
	    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Liên kết mạng xã hội</a>
	    </li>
	    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Giới thiệu</a>
	    </li>
	    <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Logo</a>
	    </li>
	    <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Slider</a>
	    </li>
	  </ul>
	</div>

	<div id="myTabContent" class="tab-content">
	    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
	    	<?php $this->load->view('admin/content/info') ?>
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
	    	<?php $this->load->view('admin/content/social') ?>
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
	    	<?php $this->load->view('admin/content/intro') ?>
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
	    	<?php $this->load->view('admin/content/logo') ?>
	    </div>
	    <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
	    	<?php $this->load->view('admin/content/slider') ?>
	    </div>
	</div>
</div> -->