<div class="slideshow">
	<div class="row">
		<div class="col-md-12">
			<!-- <img src="<?php echo base_url()?>public/images/slide/img.jpg" height="270px" width="100%"> -->
			<?php $this->load->view('site/home/slider') ?>
		</div>
	</div>
</div>
<div class="main" style="margin-top: 30px">
		<div class="row">
			<div class="col-md-12">
                <?php $this->load->view('site/home/sale') ?>
                <?php $this->load->view('site/home/menu') ?>
                <?php $this->load->view('site/home/blog') ?>
			</div>
		</div>
</div>
<!-- end main -->