<?php if ($message){$this->load->view('admin/message',$this->data); }?>

<div class="page-title">
	<div class="title_left"><h3>Thêm nhân viên mới</h3></div>
	<div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 pull-right">
			<a href="<?php echo admin_url('employee/add')?>" class="btn btn-primary btn-sm">Thêm mới</a>
			<a href="<?php echo admin_url('employee')?>" class="btn btn-info btn-sm">Danh sách</a>
		</div>
	</div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Nhập thông tin các trường</h2>
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
        <?php echo validation_errors(); ?>
        <div class="row">
            <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Họ tên <span class="required">*</span></label>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <input type="text" id="txtName" name="txtName" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Số điện thoại <span class="required">*</span></label>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <input type="text" id="txtPhone" name="txtPhone" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Địa chỉ <span class="required">*</span></label>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <input type="text" id="txtAddress" name="txtAddress" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Ngày sinh <span class="required">*</span></label>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <input type="text" id="txtBirthday" name="txtBirthday" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Vị trí<span class="required">*</span></label>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <select class="select2_multiple form-control" name="department" id="department">
                            <?php foreach ($department as $row) { ?>
                                <optgroup label="<?php echo $row->name?>">
                                    <?php foreach ($row->child as $r){ ?>
                                        <option value="<?php echo $r->id?>" ><?php echo $r->name?></option>
                                    <?php }?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Ngày gia nhập <span class="required">*</span></label>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <input type="text" id="txtStartDate" name="txtStartDate" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">

                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Mức lương <span class="required">*</span></label>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <input type="text" id="txtWage" name="txtWage" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Phụ cấp tiền ăn <span class="required">*</span></label>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <input type="text" id="txtLunch" name="txtLunch" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Phụ cấp điện thoại <span class="required">*</span></label>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <input type="text" id="txtTel" name="txtTel" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Phụ cấp xăng xe <span class="required">*</span></label>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <input type="text" id="txtTravel" name="txtTravel" value="" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                        <input type="submit" id="btnAddAdmin" name="btnAddAdmin" required="required" class="btn btn-success" value="Thêm">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

