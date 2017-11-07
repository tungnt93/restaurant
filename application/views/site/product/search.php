<div class="col-md-9">
	<div class="row" style="background-color: #fff">
		<section class="product-content clearfix">
			<h1 class="title clearfix"><span style="font-size: 20px; line-height: 50px; padding-left: 10px">Kết quả tìm kiếm với từ khóa "<?php echo $key ?>" </span><span style="font-size: 14px; color: #337ab7;">(<?php echo $total ?> kết quả)</span></h1>
			
			
			<div class="product-block product-grid clearfix">
				<?php foreach ($list_product as $key => $value): ?>
					<?php $name = create_slug($value->name) ?>
					<div class="col-md-4 col-sm-4 col-xs-12 product-resize product-item-box">
						<div class="product-item">
							<div class="image image-resize">
								<a href="<?php echo base_url('san-pham/'.$name.'-'.$value->id.'.html') ?>" title="<?php echo $value->name ?>">
									<img src="<?php echo base_url()?>public/images/product/<?php echo $value->img_link ?>" data-original="<?php echo base_url()?>public/images/product/<?php echo $value->img_link ?>" alt="<?php echo $value->name ?>" class="img-responsive lazy-img" style="height: 160px;"/>
								</a>
								<?php if ($value->discount > 0): ?>
									<span class="promotion">-<?php echo round(100*$value->discount/$value->price, 2) ?>%</span>
								<?php elseif($value->is_hot == 1): ?>
									<span class="hot">Hot</span>
								<?php endif ?>
								
							</div>
							<div class="right-block">
								<h2 class="name">
									<a href="<?php echo base_url('san-pham/'.$name.'-'.$value->id.'.html') ?>" title="<?php echo $value->name ?>"><?php echo $value->name ?></a>
								</h2>
								<div class="rating">
									<div class="rating-1">
										<span class="rating-img">
										</span>
									</div>
								</div>
								<div class="price">
									<?php if ($value->discount > 0): ?>
				                        <span class="price-new"><?php echo $value->price - $value->discount ?>₫</span><br>
				                        <span class="price-old"><?php echo $value->price ?>₫</span>
				                    <?php else: ?>
				                        <span class="price-new"><?php echo $value->price ?>₫</span><br><br>
				                    <?php endif ?>
								</div>
								<div class="button">
									<a class="btn btn-default btn-add-cart" href="<?php echo base_url('san-pham/'.$name.'-'.$value->id.'.html') ?>">Chi tiết</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
			<div class="navigation">
				<?php echo $paginator; ?>
			</div>
		</section>
	</div>
</div>
<div class="col-md-3">
	<?php $this->load->view('site/right') ?>
</div>
