<?php $this->load->view('admin/catalog/header')?>
<div class="x_panel">
	<div class="x_title">
		<h2>Nhập thông tin</h2>
		<ul class="nav navbar-right panel_toolbox">
	        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#">Settings 1</a>
	            </li>
	            <li><a href="#">Settings 2</a>
	            </li>
	          </ul>
	        </li>
	        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
	    </ul>
	    <div class="clearfix"></div>
	</div>
	<div class="x_content">
		<div class="row">
			<form id="formAddCatalog" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
				<div class="form-group">
		        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên danh mục <span class="required">*</span></label>
		        	<div class="col-md-4 col-sm-4 col-xs-12">
		          		<input type="text" id="txtName" name="txtName" value="<?php echo $catalog->name?>" required="required" class="form-control col-md-7 col-xs-12">
		        	</div>
		      	</div>
		        <div class="form-group">
		            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Ảnh minh họa <span class="required">*</span></label>
		            <div class="col-md-4 col-sm-4 col-xs-12">
		                <input type="file" id="imageMenu" name="imageMenu" style="padding: 5px;" accept="image/*">
		                <img id="pre_img" style="width: 150px" />
		            </div>
		        </div>
		      	<div class="form-group">
		        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Thứ tự hiển thị <span class="required">*</span></label>
		        	<div class="col-md-1 col-sm-1 col-xs-12">
		          		<input type="number" id="txtPosition" name="txtPosition" value="<?php echo $catalog->position?>" required="required" class="form-control col-md-7 col-xs-12">
		        	</div>
		      	</div>
				<div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Trạng thái</label>
                    <div class="col-md-4 col-sm-4 col-xs-12" style="padding-top:8px">
                        <input type="radio" class="flat" name="status" id="genderM" value="1" <?php if ($catalog->status == 1) echo 'checked'; ?> required />
                        <span style="margin-right: 10px;">Hiển thi</span>
                        <input type="radio" class="flat" name="status" id="genderF" value="2"  <?php if ($catalog->status == 2) echo 'checked'; ?> />
                        Ẩn
                    </div>
                </div>
		      	<div class="form-group">
		        	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
		          		<input type="submit" id="btnAddCatalog" name="btnAddCatalog" required="required" class="btn btn-success" value="Cập nhật">
		        	</div>
		      	</div>
			</form>
		</div>
	</div>
</div>
