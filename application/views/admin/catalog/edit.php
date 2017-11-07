<?php $this->load->view('admin/catalog/header')?>
<div class="row">
	<form id="formAddCatalog" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
		<div class="form-group">
        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tên danh mục <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<input type="text" id="txtName" name="txtName" value="<?php echo $catalog->name?>" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
      	</div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ảnh minh họa <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="file" id="imageMenu" name="imageMenu" style="padding: 5px;" accept="image/*">
                <img id="pre_img" style="width: 150px" />
            </div>
        </div>
      	<div class="form-group">
        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Thứ tự hiển thị <span class="required">*</span></label>
        	<div class="col-md-1 col-sm-1 col-xs-12">
          		<input type="number" id="txtPosition" name="txtPosition" value="<?php echo $catalog->position?>" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
      	</div>
      	<div class="form-group">
        	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" style="width: 70px">
          		<input type="submit" id="btnAddCatalog" name="btnAddCatalog" required="required" class="btn btn-success" value="Cập nhật">
        	</div>
      	</div>
	</form>
</div>