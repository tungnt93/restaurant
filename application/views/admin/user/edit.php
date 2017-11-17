<?php if ($message){$this->load->view('admin/message',$this->data); }?>

<div class="page-title">
    <div class="title_left"><h3>Chỉnh sửa tài khoản</h3></div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <a href="<?php echo admin_url('user/add')?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <a href="<?php echo admin_url('user')?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>
<?php echo validation_errors(); ?>
<div class="row">
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Họ tên <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="select2_multiple form-control" name="employee_id" id="department">
                    <?php if($admin->role == 1){ ?><option value="0" ></option> <?php } ?>
                    <?php foreach ($department as $row) { ?>
                        <optgroup label="<?php echo $row->name?>">
                            <?php foreach ($row->user as $r){ ?>
                                <option value="<?php echo $r->id?>" <?php echo $r->id == $user->employee_id ? 'selected' : ''?> ><?php echo $r->name?></option>
                            <?php }?>
                        </optgroup>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Username <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="txtUsername" name="txtUsername" value="<?php echo $user->username?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Trạng thái</label>
            <div class="col-md-4 col-sm-4 col-xs-12" style="padding-top:8px">
                Hoạt động: <input type="radio" class="flat" name="status" id="genderM" value="1" <?php if ($user->status == 1) echo 'checked'; ?> required />
                Khóa: <input type="radio" class="flat" name="status" id="genderF" value="0"  <?php if ($user->status == 0) echo 'checked'; ?> />
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddAdmin" name="btnAddAdmin" required="required" class="btn btn-success" value="Cập nhật">
            </div>
        </div>
    </form>
</div>