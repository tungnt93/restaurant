<div class="col-md-9">
	<?php if ($product == null): ?>
		<?php redirect(base_url()); ?>
	<?php else: ?>
		<ol class="breadcrumb">
		  	<li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
		  	<?php 
		  		$cat_name = $this->catalog_model->get_info($product->catalog_id)->name;
		  		$cat_link = base_url('danh-muc/').create_slug($cat_name).'-'.$product->catalog_id;
		  	?>
		  	<li><a href="<?php echo $cat_link ?>"><?php echo $cat_name?></a></li>
		  	<li class="active"><?php echo $product->name ?></li>
		</ol>
		<div class="row" style="background-color: #fff">
			<div class="col-md-6">
				<div class="bzoom_wrap">
			        <ul id="bzoom">
			            <li>
			            	<img class="bzoom_thumb_image" src="<?php echo public_url('images/product/'.$product->img_link) ?>" />
			            	<img class="bzoom_big_image" src="<?php echo public_url('images/product/'.$product->img_link) ?>"/>
			            </li>
			        </ul>
			    </div>
			</div>
			<div class="col-md-6">
				<h2 style="font-size: 24px"><?php echo $product->name ?></h2>
				<div class="price">
					<?php if ($product->discount > 0): ?>
						<span class="price-new" style="color: red; font-size: 20px"><?php echo $product->price - $product->discount ?>đ</span>
						<span class="price-old" style="font-size: 16px"><?php echo $product->price ?>đ</span>
					<?php else: ?>
						<span class="price-new" style="color: red; font-size: 20px"><?php echo $product->price ?>đ</span>
					<?php endif ?>
				</div>
				<div style="margin-top: 10px; font-size: 14px">
					Lượt xem: <?php echo $product->view ?> <br><br>
					<?php if(in_array($product->id, $list_hot_id)){ ?>
	        			<span class="label label-danger">Nổi bật</span>
	        		<?php }?>
	        		<?php if ($product->is_hot == 1): ?>
	        			<span class="label label-warning">Hot</span>
	        		<?php endif ?>
	        		<?php if ($product->discount > 0): ?>
	        			<span class="label label-info">Giảm giá</span>
	        		<?php endif ?>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 20px">
			<div class="panel panel-info">
				<div class="panel-heading">Thông tin chi tiết</div>
	  			<div class="panel-body"><?php echo $product->description ?></div>
			</div>
		</div>
	<?php endif ?>
</div>
<div class="col-md-3">
	<?php $this->load->view('site/right') ?>
</div>

<script type="text/javascript">
$("#bzoom").zoom({
	zoom_area_width: 300,
    autoplay_interval :3000,
    small_thumbs : 0,
    autoplay : false,
});
</script>