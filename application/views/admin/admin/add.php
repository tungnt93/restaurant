<?php if ($message){$this->load->view('admin/message',$this->data); }?>

<div class="page-title">
	<div class="title_left"><h3>Thêm quản trị viên mới</h3></div>
	<div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 pull-right">
			<a href="<?php echo admin_url('admin/add')?>" class="btn btn-primary btn-sm">Thêm mới</a>
			<a href="<?php echo admin_url('admin')?>" class="btn btn-info btn-sm">Danh sách</a>
		</div>
	</div>
</div>
<?php echo validation_errors(); ?>
<div class="row">
	<form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
		<div class="form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Họ tên <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<input type="text" id="txtName" name="txtName" value="" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
      	</div>
      	<div class="form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Username <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<input type="text" id="txtUsername" name="txtUsername" value="" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
      	</div>
      	<div class="form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Password <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<input type="password" id="txtPassword" name="txtPassword" value="" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
      	</div>
      	<div class="form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nhập lại password <span class="required">*</span></label>
        	<div class="col-md-4 col-sm-4 col-xs-12">
          		<input type="password" id="txtRePassword" name="txtRePassword" value="" required="required" class="form-control col-md-7 col-xs-12">
        	</div>
      	</div>
      	<div class="form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Quyền hạn<span class="required">*</span></label>
        	<div class="col-md-2 col-sm-2 col-xs-12">
          		<select class="select2_multiple form-control" name="slType">
          			<option value="2" selected="selected">Giới hạn</option>
          			<option value="1">Toàn quyền</option>
				</select>
        	</div>
      	</div>
      	<div class="form-group">
        	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
          		<input type="submit" id="btnAddAdmin" name="btnAddAdmin" required="required" class="btn btn-success" value="Thêm">
        	</div>
      	</div>
	</form>
</div>