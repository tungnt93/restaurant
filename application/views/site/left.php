<div class="box-product">
    <h3>
        <span>
            Sản phẩm nổi bật
        </span>
    </h3>
    <div class="box-product-block">
        <?php foreach ($list_hot_product as $key => $value): ?>
            <?php $name = create_slug($value->name) ?>
            <div class="item item-left">
                <div class="image">
                    <a href="<?php echo base_url('san-pham/'.$name.'-'.$value->id.'.html') ?>" title="Lioa ổn áp">
                        <img class="img-responsive lazy-img" src="<?php echo base_url()?>public/images/product/<?php echo $value->img_link ?>" data-original="<?php echo base_url()?>public/images/product/<?php echo $value->img_link ?>" alt="<?php echo $value->name ?>" title="Lioa ổn áp"/>
                    </a>
                </div>
                <div class="name">
                    <a href="<?php echo base_url('san-pham/'.$name.'-'.$value->id.'.html') ?>" title="<?php echo $value->name ?>"><?php echo $value->name ?></a>
                </div>
                <div class="rating">
                    <div class="rating-1">
                        <span class="rating-img"></span>
                    </div>
                </div>
                <div class="price">
                    <?php if ($value->discount > 0): ?>
                        <span class="price-new"><?php echo $value->price - $value->discount ?>₫</span>
                        <span class="price-old"><?php echo $value->price ?>₫</span>
                    <?php else: ?>
                        <span class="price-new"><?php echo $value->price ?>₫</span>
                    <?php endif ?>
                    
                </div>
                <div class="button text-center">
                    <a class="btn btn-default" href="<?php echo base_url('san-pham/'.$name.'-'.$value->id.'.html') ?>" >Chi tiết</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>


