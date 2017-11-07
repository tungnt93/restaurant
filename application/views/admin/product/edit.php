<script language="javascript" src="<?php echo base_url('public')?>/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="page-title">
	<div class="title_left"><h3>Chỉnh sửa thông tin sản phẩm</h3></div>
	<div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 pull-right">
			<a href="<?php echo admin_url('product/add')?>" class="btn btn-primary btn-sm">Thêm mới</a>
			<a href="<?php echo admin_url('product')?>" class="btn btn-info btn-sm">Danh sách</a>
		</div>
	</div>
</div>
<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="row">
	<form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
		<div class="form-group">
        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tên sản phẩm <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<input type="text" id="txtName" name="txtName" value="<?php echo $product->name ?>" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
      	</div>
      	<div class="form-group">
        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Danh mục sản phẩm <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<select class="select2_multiple form-control" name="slCatalog">
				      <?php foreach ($list_catalog as $r) { ?>
                <option value="<?php echo $r->id ?>" style="color: red" <?php if($product->catalog_id == $r->id) echo 'selected'; else echo '';?> ><?php echo $r->name?></option>
                <?php foreach ($r->child as $value) { ?>
                  <option value="<?php echo $r->id ?>" style="color: blue" <?php if($product->catalog_id == $value->id) echo 'selected'; else echo '';?> >--- <?php echo $value->name?></option>
                  <?php foreach ($value->child_1 as $v): ?>
                  	<option value="<?php echo $v->id ?>" <?php if($product->catalog_id == $v->id) echo 'selected'; else echo '';?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--- <?php echo $v->name?></option>
                  <?php endforeach ?>
                <?php }?>
			        <?php } ?>
				</select>
        	</div>
      	</div>
      	<div class="form-group">
        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Giá <span class="required">*</span></label>
        	<div class="col-md-2 col-sm-2 col-xs-12">
          		<input type="number" id="txtPrice" name="txtPrice" value="<?php echo $product->price?>" onchange="change_price()" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
          <label class="col-md-3 col-sm-3 col-xs-12" style="padding-top: 8px" id="format_price"><?php echo number_format($product->price)?>đ</label>
      	</div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Giảm giá <span class="required">*</span></label>
          <div class="col-md-2 col-sm-2 col-xs-12">
              <input type="number" id="txtDiscount" name="txtDiscount" value="<?php echo $product->discount ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
          <label class="col-md-3 col-sm-3 col-xs-12" style="padding-top: 8px" id="format_discount"><?php echo number_format($product->discount)?>đ</label>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sản phẩm hot <span class="required">*</span></label>
          <div class="col-md-2 col-sm-2 col-xs-12">
              <input type="radio" name="is_hot" value="0" checked="<?php echo ($product->is_hot == 0) ? 'checked' : '' ?>"> Không <br>
              <input type="radio" name="is_hot" value="1" checked="<?php echo ($product->is_hot == 1) ? 'checked' : '' ?>"> Có
          </div>
        </div>
      	<div class="form-group">
        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ảnh sản phẩm <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
              <img src="<?php echo public_url('images/product/'.$product->img_link) ?>" height="150px"><br>
              <input type="radio" name="changeImg" value="2" checked> Để ảnh cũ<br>
              <input type="radio" name="changeImg" value="1"> Chọn ảnh mới<br>
              <div id="imgChange"></div>
              <img id="pre_img" style="max-width: 150px; max-height: 150px" />
        	</div>
      	</div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Xoay ảnh <span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="radio" name="img_rotate" value="0" checked="checked"> 0&#176; &nbsp;
              <input type="radio" name="img_rotate" value="90"> 90&#176; &nbsp;
              <input type="radio" name="img_rotate" value="180"> 180&#176; &nbsp;
              <input type="radio" name="img_rotate" value="270"> -90&#176; &nbsp;
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mô tả sản phẩm <span class="required">*</span></label>
          <div class="col-md-8 col-sm-8 col-xs-12">
              <textarea name="txtDescription" class="form-control" style="height: 120px"><?php echo ($product->description);?></textarea>
              <script type="text/javascript">CKEDITOR.replace('txtDescription',{height: '300px'}); </script>
          </div>
        </div>
      	<div class="form-group">
        	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" style="width: 70px">
          		<input type="submit" id="btnUpdateProduct" name="btnUpdateProduct" required="required" class="btn btn-success" value="Cập nhật">
        	</div>
      	</div>
	</form>
</div>
