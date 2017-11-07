<div class="box-product">
    <h3>
        <span>
            Danh mục sản phẩm
        </span>
    </h3>
    <div class="box-product-block vertical-menu">
    	<ul>
        <?php foreach ($catalog as $key => $value): ?>
            <?php $cat_name = create_slug($value->name) ?>
    		<li style="padding: 10px 0px;">
    			<a href="<?php echo base_url('danh-muc/'.$cat_name.'-'.$value->id) ?>" ><?php echo $value->name ?></a>
    			<ul style="padding-left: 15px">
    				<?php foreach ($value->child_1 as $k => $v): ?>
                        <?php $cat_name = create_slug($v->name) ?>
    					<li style="padding: 5px 0px;"><a href="<?php echo base_url('danh-muc/'.$cat_name.'-'.$v->id) ?>" ><?php echo $v->name ?></a></li>
    					<ul style="padding-left: 15px">
    						<?php foreach ($v->child_2 as $k1 => $v1): ?>
                                <?php $cat_name = create_slug($v1->name) ?>
    							<li><a href="<?php echo base_url('danh-muc/'.$cat_name.'-'.$v1->id) ?>"><?php echo $v1->name ?></a></li>
    						<?php endforeach ?>
    					</ul>
    				<?php endforeach ?>
    			</ul>
    		</li>
        <?php endforeach ?>
        </ul>
    </div>
</div>
<style type="text/css">
	li{
		/*padding: 5px 0px;*/
	}
</style>