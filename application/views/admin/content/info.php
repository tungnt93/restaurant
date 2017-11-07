<div class="row" style="margin-top: 40px">
  <form id="formAddCatalog" data-parsley-validate class="form-horizontal form-label-left" method="post">
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên công ty/cửa hàng <span class="required">*</span></label>
      <div class="col-md-4 col-sm-4 col-xs-12">
          <input type="text" id="txtName" name="txtName" value="<?php echo $content->company_name ?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Địa chỉ <span class="required">*</span></label>
      <div class="col-md-4 col-sm-4 col-xs-12">
          <input type="text" id="txtAddress" name="txtAddress" value="<?php echo $content->address ?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Email <span class="required">*</span></label>
      <div class="col-md-4 col-sm-4 col-xs-12">
          <input type="text" id="txtEmail" name="txtEmail" value="<?php echo $content->email ?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Số điện thoại <span class="required">*</span></label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input type="text" id="txtPhone" name="txtPhone" value="<?php echo $content->phone ?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div> 
    <div class="form-group" style="margin-top: 30px">
      <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-2" style="width: 70px">
          <input type="submit" id="btnUpdateInfo" name="btnUpdateInfo" required="required" class="btn btn-primary" value="Cập nhật">
      </div>
    </div>
  </form>
</div>