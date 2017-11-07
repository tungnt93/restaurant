<section class="top-link clearfix">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="nav navbar-nav topmenu-contact">
					<li><i class="fa fa-phone"></i> Hotline: <?php echo phone_format($content->phone) ?></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!--end section head -->

<section class="header-content clearfix">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-xs-12 col-sm-12 header-left text-center">
				<div class="logo">
					<a href="<?php echo base_url() ?>" title="">
						<img alt="CÔNG TY ABC" src="<?php echo base_url()?>public/images/<?php echo $content->logo ?>" class="img-responsive" />
					</a>
				</div>
			</div>
			<div class="col-md-9 col-xs-12 col-sm-12 header-right">
				<div class="search hidden-sm hidden-xs">
					<form class="input-cat form-search clearfix" method="post" action="<?php echo base_url('search') ?>">
						<div class="form-search-controls">
							<input type="text" id="txtsearch" name="key" placeholder="Tìm kiếm ..." required="required" />
						</div>
						<input type="submit" value="Tìm kiếm" class="btn btn-search" name="btnSearch" style="margin-left: 5px">
					</form>
				</div>
			</div>
            <nav id="mobile-menu" class="mobile-menu collapse navbar-collapse">
                <ul class='menu nav navbar-nav'><li class="level0"><a class='' href='<?php echo base_url() ?>'><span>Trang chủ</span></a></li>
                    <li class="level0"><a class='' href='<?php echo base_url('gioi-thieu').'.html'?>'><span>Giới thiệu</span></a></li>
                    <li class="level0"><a class='' href=''><span>Thực đơn</span></a></li>
                    <li class="level0"><a class='' href=''><span>Đặt bàn</span></a></li>
                    <li class="level0"><a class='' href=''><span>Gọi món</span></a></li>
                     <li class="level0"><a class='' href='#'><span>Khuyến mại</span></a></li>
                    <li class="level0"><a class='' href='<?php echo base_url('lien-he').'.html'?>'><span>Liên hệ</span></a></li>
                </ul class='menu nav navbar-nav'>
            </nav>
		</div>
	</div>
</section>