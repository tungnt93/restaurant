<?php if (isset($message)){$this->load->view('admin/message',$this->data); }?>

<div class="x_panel">
	<div class="x_title">
		<h2>Thông tin cá nhân</h2>
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
		<div class="row" style="margin-top: 40px">
		  <form id="formInfoPerson" data-parsley-validate class="form-horizontal form-label-left" method="post">
		    <div class="form-group">
		      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Họ tên <span class="required">*</span></label>
		      <div class="col-md-4 col-sm-4 col-xs-12">
                  <label class="control-label">
                  <?php echo $admin->employee_id == 0 ? $admin->username :
                      $this->employee_model->get_info($admin->employee_id)->name ?>
                  </label>
		      </div>
		    </div>
              <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Vị trí <span class="required">*</span></label>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label">
                          <?php echo $admin->employee_id > 0 ?
                              $this->department_model->get_info($this->employee_model->get_info($admin->employee_id)->department_id)->name
                              : 'Quản trị viên website'
                          ?>
                      </label>
                  </div>
              </div>
              <?php if($admin->employee_id > 0){
                  $employee = $this->employee_model->get_info($admin->employee_id);
                  ?>
                  <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Số điện thoại <span class="required">*</span></label>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="txtPhone" name="txtPhone" value="<?php echo $employee->phone?>" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Địa chỉ <span class="required">*</span></label>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="txtAddress" name="txtAddress" value="<?php echo $employee->address?>" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Ngày sinh <span class="required">*</span></label>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" id="txtBirthday" name="txtBirthday" value="<?php echo $employee->birthday?>" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                  </div>
              <?php } ?>
		    <div class="form-group">
		      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Mật khẩu cũ <span class="required">*</span></label>
		      <div class="col-md-4 col-sm-4 col-xs-12">
		          <input type="password" id="txtOldPassword" name="txtOldPassword" class="form-control col-md-7 col-xs-12">
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Mật khẩu mới </label>
		      <div class="col-md-4 col-sm-4 col-xs-12">
		          <input type="password" id="txtNewPassword" name="txtNewPassword" class="form-control col-md-7 col-xs-12">
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nhập lại mật khẩu mới </label>
		      <div class="col-md-4 col-sm-4 col-xs-12">
		          <input type="password" id="txtConfirm" name="txtConfirm" class="form-control col-md-7 col-xs-12">
		      </div>
		    </div> 
		    <div class="form-group" style="margin-top: 30px">
		      <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-2" style="width: 70px">
		          <input type="submit" id="btnUpdateInfo" name="btnUpdateInfo"  class="btn btn-primary" value="Cập nhật">
		      </div>
		    </div>
		  </form>
		</div>
	</div>
</div>


