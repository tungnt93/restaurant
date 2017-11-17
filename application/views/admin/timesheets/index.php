
<?php $this->load->view('admin/timesheets/header')?>
<div class="x_panel">
    <div class="x_title">
        <h2>Danh sách</h2>
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
        <?php foreach ($timesheets as $key => $value) {?>
            <div class="col-md-2 col-sm-3 col-xs-6" style="text-align: center">
                <a href="#">
                    <img src="<?php echo public_url('images/timesheet.png')?>" style="max-width: 120px">
                    <div>Bảng chấm công tháng <?php echo $value->month_id?></div>
                </a>
            </div>
        <?php }?>
    </div>
</div>
<script type="text/javascript">
    function delCatalog(id){
        var r = confirm("Bạn có chắc chắn muốn xóa danh mục này?");
        if (r === true) {
            window.location.href = "<?php echo admin_url('warehouse/del/')?>" + id;
        }
    }
</script>
