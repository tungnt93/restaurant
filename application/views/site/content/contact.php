<div class="col-md-9">
	<div class="row" style="background-color: #fff">
		<section class="product-content clearfix">
			<h1 class="title clearfix"><span style="font-size: 20px; line-height: 50px; padding-left: 20px">Thông tin liên hệ</span></h1>
			<div style="padding: 20px">
                <div class="box-address-content">
                    <b style="font-size: 20px;"><?php echo $content->company_name ?></b>
                    <p style="margin-top: 20px; font-size: 16px"><i class="fa fa-map-marker"></i> Địa chỉ: <?php echo $content->address ?></p>
                    <p style="font-size: 16px">
                        <i class="fa fa-envelope"></i>
                        Email: <a href="mailto:<?php echo $content->email ?>" style="color: #3c3f44;"> <?php echo $content->email ?></a>
                    </p>
                    <p style="font-size: 16px">
                        <i class="fa fa-phone"></i> Điện thoại: <?php echo $content->phone ?>
                    </p>
                </div>
			</div>
		</section>
	</div>
</div>
<div class="col-md-3">
	<?php $this->load->view('site/right') ?>
</div>

