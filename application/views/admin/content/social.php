

<div class="row" style="margin-top: 40px">
	<form id="formAddCatalog" data-parsley-validate class="form-horizontal form-label-left" method="post">
    <div class="form-group">
    	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Facebook <span class="required">*</span></label>
    	<div class="col-md-4 col-sm-4 col-xs-12">
      		<input type="text" id="txtFacebook" name="txtFacebook" value="<?php echo $content->facebook ?>" required="required" class="form-control col-md-7 col-xs-12">
    	</div>
  	</div>
  	<div class="form-group">
    	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Google+ <span class="required">*</span></label>
    	<div class="col-md-4 col-sm-4 col-xs-12">
          <input type="text" id="txtGoogle" name="txtGoogle" value="<?php echo $content->google ?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
  	</div>
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Youtube <span class="required">*</span></label>
      <div class="col-md-4 col-sm-4 col-xs-12">
          <input type="text" id="txtYoutube" name="txtYoutube" value="<?php echo $content->youtube ?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Twitter <span class="required">*</span></label>
      <div class="col-md-4 col-sm-4 col-xs-12">
          <input type="text" id="txtTwitter" name="txtTwitter" value="<?php echo $content->twitter ?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>
  	<div class="form-group" style="margin-top: 30px">
    	<div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-2" style="width: 70px">
      		<input type="submit" id="btnUpdateSocial" name="btnUpdateSocial" required="required" class="btn btn-primary" value="Cập nhật">
    	</div>
  	</div>
	</form>
</div>