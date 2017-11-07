<?php foreach ($top_product as $key => $value): ?>
	<div class="media">
	  <div class="media-left">
	    <a href="<?php echo admin_url('product/edit/'.$value->id) ?>">
	      <img class="media-object" src="<?php echo public_url('images/product/'.$value->img_link) ?>" alt="..." style="width:64px; border: 1px solid #ccc">
	    </a>
	  </div>
	  <div class="media-body">
	    <a href="<?php echo admin_url('product/edit/'.$value->id) ?>"><h4 class="media-heading" style="color: #000"><?php echo $value->name ?></h4></a>
	    <p>
	    	<span style="color: red">
		    	<?php if($value->discount > 0){ ?>
		    		Giá: <?php echo number_format($value->price - $value->discount) ?>đ
		    		<span style="color: gray; text-decoration: line-through;"><?php echo number_format($value->price) ?>đ</span>
		    	<?php } else{ ?>
		    		Giá: <?php echo number_format($value->price) ?>đ
		    	<?php }?>
		    </span><br>
		    <span>Lượt xem: <?php echo $value->view ?></span>
	    </p>
	  </div>
	</div>
<?php endforeach ?>