
<?php $this->load->view('admin/payroll/header')?>
<div class="x_panel">
    <div class="x_title">
        <h2>Thêm bảng lương</h2>
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
        <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Chọn tháng<span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <select class="select2_multiple form-control" name="month" id="month">
                        <?php foreach ($months as $row) { ?>
                            <option value="<?php echo $row->id?>" ><?php echo $row->month_name?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                    <input type="submit" id="btnAdd" name="btnAdd" required="required" class="btn btn-success" value="Thêm">
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .table-condensed tbody, .table-condensed thead tr:nth-child(2){
        display: none;
    }
    .daterangepicker{
        width: 250px;
    }
</style>