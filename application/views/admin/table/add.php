
<?php $this->load->view('admin/table/header')?>
<div class="x_panel">
    <div class="x_title">
        <h2>Thêm bàn</h2>
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
            <form id="formAddCatalog" data-parsley-validate class="form-horizontal form-label-left" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên bàn<span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" id="txtName" name="txtName" value="<?php echo isset($table) ? $table->name : ''?>" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Số ghế <span class="required">*</span></label>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                        <input type="number" id="txtSeat" name="txtSeat" value="<?php echo isset($table) ? $table->seat : ''?>" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                        <input type="submit" id="btnAdd" name="btnAdd" required="required" class="btn btn-success" value="<?php echo isset($table) ? 'Cập nhật' : 'Thêm'?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">

</script>
