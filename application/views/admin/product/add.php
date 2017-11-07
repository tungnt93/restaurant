<script language="javascript" src="<?php echo base_url('public')?>/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="page-title">
	<div class="title_left"><h3>Thêm món ăn mới</h3></div>
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
        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tên món ăn <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<input type="text" id="txtName" name="txtName" value="" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
      	</div>
      	<div class="form-group">
        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<select class="select2_multiple form-control" name="slCatalog">
                    <?php foreach ($list_catalog as $r) { ?>
                        <option value="<?php echo $r->id ?>" style="color: red"><?php echo $r->name?></option>
                    <?php } ?>
				</select>
        	</div>
      	</div>
      	<div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Giá <span class="required">*</span></label>
          <div class="col-md-2 col-sm-2 col-xs-12">
              <input type="number" id="txtPrice" name="txtPrice" value="" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Giảm giá <span class="required">*</span></label>
          <div class="col-md-2 col-sm-2 col-xs-12">
              <input type="number" id="txtDiscount" name="txtDiscount" value="0" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

      	<div class="form-group">
        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ảnh sản phẩm <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<input type="file" id="imageProduct" name="imageProduct" value="" required="required" style="padding: 5px;" accept="image/*">
              <img id="pre_img" style="width: 150px" />
        	</div>
      	</div>

<!--        <div class="form-group">-->
<!--          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mô tả sản phẩm <span class="required">*</span></label>-->
<!--          <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--              <textarea name="txtDescription" class="form-control" style="height: 120px"></textarea>-->
<!--              <script type="text/javascript">CKEDITOR.replace('txtDescription',{height: '300px'}); </script>-->
<!--          </div>-->
<!--        </div>-->
      	<div class="form-group">
        	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" style="width: 70px">
          		<input type="submit" id="btnAddProduct" name="btnAddProduct" required="required" class="btn btn-success" value="Thêm">
        	</div>
      	</div>
	</form>
</div>
<script type="text/javascript">
  
</script>