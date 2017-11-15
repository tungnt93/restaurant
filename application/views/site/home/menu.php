<section class="product-content clearfix">
    <h1 class="title clearfix"><span>Thực đơn</span></h1>
    <div class="product-block product-grid clearfix">
        <?php foreach ($catalog as $key => $value): ?>
            <?php $name = create_slug($value->name) ?>
            <div class="col-md-3 col-sm-3 col-xs-6 product-resize product-item-box">
                <div class="product-item">
                    <div class="image image-resize">
                        <a href="<?php echo base_url('san-pham/'.$name.'-'.$value->id.'.html') ?>" title="<?php echo $value->name ?>">
                            <img src="<?php echo base_url()?>public/images/menu/<?php echo $value->img ?>" data-original="<?php echo base_url()?>public/images/product/<?php echo $value->img ?>" alt="<?php echo $value->name ?>" class="img-responsive lazy-img" style="height: 160px; width: 100%"/>
                        </a>
                    </div>
                    <div class="right-block">
                        <h2 class="name">
                            <a href="<?php echo base_url('khuyen-mai/'.$name.'-'.$value->id.'.html') ?>" title="<?php echo $value->name ?>"><?php echo $value->name ?></a>
                        </h2>
                        <div class="rating">
                            <div class="rating-1">
												<span class="rating-img">
												</span>
                            </div>
                        </div>
                        <div class="button">
                            <a class="btn btn-default btn-add-cart" href="#">Đặt bàn</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>